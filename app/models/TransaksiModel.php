<?php

class TransaksiModel
{
    protected $table = 'tbl_transaksi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllTransaksi()
    {
        $this->db->query("SELECT tt.*, tp.nama AS nama_pelanggan, tu.nama AS nama_user FROM 
                    $this->table AS tt
                    LEFT JOIN tbl_pelanggan AS tp
                    ON tt.id_pelanggan = tp.id_pelanggan 
                    JOIN tbl_user AS tu
                    ON tt.id_user = tu.id_user
                    ORDER BY tt.id_transaksi");
        return $this->db->get();
    }

    public function getLastIdTransaksi()
    {
        $this->db->query("SELECT id_transaksi FROM $this->table ORDER BY id_transaksi DESC LIMIT 1");
        return $this->db->first()['id_transaksi'];
    }

    public function save($data)
    {
        $this->db->query("INSERT INTO $this->table VALUES ('', :id_pelanggan, :id_user, CURDATE(), :total_harga, 'order', :bayar)");
        $this->db->bind('id_pelanggan', $data['id_pelanggan']);
        $this->db->bind('id_user', $_SESSION['user']['id_user']);
        $this->db->bind('total_harga', $data['total_harga']);
        $this->db->bind('bayar', $data['bayar']);
        $this->db->execute();
        if ($this->db->rowCountAffected() < 1) {
            return $this->db->rowCountAffected();
        }

        $idTransaksi = $this->getLastIdTransaksi();
        foreach ($data['detail_transaksi'] as $detail) {
            $this->db->query("INSERT INTO tbl_detail VALUES ('', $idTransaksi, :id_produk, :jumlah_produk, :sub_total)");
            $this->db->bind('id_produk', $detail->id_produk);
            $this->db->bind('jumlah_produk',  $detail->jumlah_produk);
            $this->db->bind('sub_total',  $detail->sub_total);
            $this->db->execute();
            if ($this->db->rowCountAffected() < 1) {
                return $this->db->rowCountAffected();
            }

            $this->db->query("UPDATE tbl_produk SET stok = stok - :qty WHERE id_produk = :id_produk");
            $this->db->bind('qty', $detail->jumlah_produk);
            $this->db->bind('id_produk',  $detail->id_produk);
            $this->db->execute();
            if ($this->db->rowCountAffected() < 1) {
                return $this->db->rowCountAffected();
            }
        }
        return $this->db->rowCountAffected();
    }

    public function order($data)
    {
        $this->db->query("INSERT INTO $this->table VALUES ('', null, null, CURDATE(), :total_harga, 'order', :bayar)");
        $this->db->bind('total_harga', $data['total_harga']);
        $this->db->bind('bayar', $data['bayar']);
        $this->db->execute();
        if ($this->db->rowCountAffected() < 1) {
            return $this->db->rowCountAffected();
        }

        $idTransaksi = $this->getLastIdTransaksi();
        foreach ($data['detail_transaksi'] as $detail) {
            $this->db->query("INSERT INTO tbl_detail VALUES ('', $idTransaksi, :id_produk, :jumlah_produk, :sub_total)");
            $this->db->bind('id_produk', $detail->id_produk);
            $this->db->bind('jumlah_produk',  $detail->jumlah_beli);
            $this->db->bind('sub_total',  $detail->harga_total);
            $this->db->execute();
            if ($this->db->rowCountAffected() < 1) {
                return $this->db->rowCountAffected();
            }

            $this->db->query("UPDATE tbl_produk SET stok = stok - :qty WHERE id_produk = :id_produk");
            $this->db->bind('qty', $detail->jumlah_beli);
            $this->db->bind('id_produk',  $detail->id_produk);
            $this->db->execute();
            if ($this->db->rowCountAffected() < 1) {
                return $this->db->rowCountAffected();
            }
        }
        return $this->db->rowCountAffected();
    }

    public function updateStatusPaid($idTransaksi)
    {
        $this->db->query("UPDATE $this->table SET status = 'paid' WHERE id_transaksi = :id_transaksi");
        $this->db->bind('id_transaksi', $idTransaksi);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }
}
