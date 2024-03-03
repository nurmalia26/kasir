<?php

class ProdukModel
{
    // Menyimpan nama tabel di database
    protected $table = 'tbl_produk';
    // Objek database
    private $db;

    // Konstruktor untuk inisialisasi objek Database
    public function __construct()
    {
        $this->db = new Database;
    }

    // Mendapatkan semua data produk dari database
    public function getAllProduk()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->get();
    }

    // Mendapatkan data produk berdasarkan ID
    public function getProdukById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_produk = :id_produk");
        $this->db->bind('id_produk', $id);
        return $this->db->first();
    }

    // Memeriksa apakah ID produk tertentu ada di database
    public function cekIdProduk($idProduk)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_produk = :id_produk");
        $this->db->bind('id_produk', $idProduk);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }

    // Memasukkan data produk baru ke dalam database
    public function insert($data, $namaFile)
    {
        $this->db->query("INSERT INTO $this->table VALUES (:id_produk, :nama_produk, :foto_produk, :harga, :stok)");
        $this->db->bind('id_produk', $data['id_produk']);
        $this->db->bind('nama_produk', $data['nama_produk']);
        $this->db->bind('foto_produk', $namaFile);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('stok', $data['stok']);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }

    // Memperbarui data produk di database berdasarkan ID
    public function update($id, $data)
    {
        $this->db->query("UPDATE $this->table SET nama_produk = :nama_produk , harga = :harga , stok = :stok WHERE id_produk = :id_produk");
        $this->db->bind('id_produk', $id);
        $this->db->bind('nama_produk', $data['nama_produk']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('stok', $data['stok']);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }

    // Mendapatkan semua data produk yang memiliki stok lebih dari 0
    public function getAllReadyProduk()
    {
        $this->db->query("SELECT * FROM $this->table WHERE stok > 0");
        return $this->db->get();
    }
}
