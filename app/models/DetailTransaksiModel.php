<?php

class DetailTransaksiModel
{
    protected $table = 'tbl_detail';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllDetailByIdTransaksi($idTransaksi)
    {
        $this->db->query("SELECT tt.id_transaksi,tt.tanggal, tpl.nama AS nama_pelanggan, tu.nama AS nama_kasir, tp.id_produk, tp.harga, tp.nama_produk, td.jumlah_produk, td.sub_total, tt.bayar, tt.total_harga
                            FROM tbl_transaksi AS tt
                            LEFT JOIN $this->table AS td
                            ON tt.id_transaksi = td.id_transaksi 
                            LEFT JOIN tbl_produk AS tp 
                            ON td.id_produk = tp.id_produk
                            LEFT JOIN tbl_pelanggan AS tpl
                            ON tt.id_pelanggan = tpl.id_pelanggan
                            LEFT JOIN tbl_user AS tu
                            ON tt.id_user = tu.id_user
                            WHERE tt.id_transaksi = :id_transaksi");
        $this->db->bind('id_transaksi', $idTransaksi);
        return $this->db->get();
    }
}
