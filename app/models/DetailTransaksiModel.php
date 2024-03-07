<?php

class DetailTransaksiModel
{
    protected $table = 'tbl_detail';
    private $db;

    // Constructor untuk inisialisasi objek Database
    public function __construct()
    {
        $this->db = new Database;
    }

    // Method untuk mendapatkan semua detail transaksi berdasarkan id transaksi
    public function getAllDetailByIdTransaksi($idTransaksi)
    {
        // Query untuk mendapatkan detail transaksi berdasarkan id transaksi
        $this->db->query("SELECT tt.id_transaksi, tt.tanggal, tpl.nama AS nama_pelanggan, tpl.no_telpon, tu.nama AS nama_kasir, tp.id_produk, td.sub_total / td.jumlah_produk AS harga, tp.nama_produk, td.jumlah_produk, td.sub_total, tt.bayar, tt.total_harga
                            FROM tbl_transaksi AS tt
                            LEFT JOIN $this->table AS td ON tt.id_transaksi = td.id_transaksi 
                            LEFT JOIN tbl_produk AS tp ON td.id_produk = tp.id_produk
                            LEFT JOIN tbl_pelanggan AS tpl ON tt.id_pelanggan = tpl.id_pelanggan
                            LEFT JOIN tbl_user AS tu ON tt.id_user = tu.id_user
                            WHERE tt.id_transaksi = :id_transaksi");
        // Binding parameter id_transaksi
        $this->db->bind('id_transaksi', $idTransaksi);
        // Mengembalikan hasil query dalam bentuk array asosiatif
        return $this->db->get();
    }
}
