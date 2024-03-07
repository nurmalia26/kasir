<?php

class ProdukModel
{
    protected $table = 'tbl_produk';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Mendapatkan semua data produk dari database
    public function getAllProduk()
    {
        $this->db->query("SELECT tp.*, ts.nama_supplier FROM 
        $this->table AS tp LEFT JOIN tbl_supplier AS ts
        ON tp.id_supplier = ts.id_supplier ORDER BY tp.id_produk
        ");
        return $this->db->get();
    }

    public function getLastIdProduk()
    {
        $this->db->query("SELECT id_produk FROM $this->table ORDER BY id_produk DESC");
        return $this->db->first()['id_produk'];
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

    public function insert($data)
    {
        $lastIdProduk = substr($this->getLastIdProduk(), 3) + 1;
        $idProduk = "BRG" . str_pad($lastIdProduk, 4, "0", STR_PAD_LEFT);
        $this->db->query("INSERT INTO $this->table VALUES (:id_produk, :nama_produk, null, :harga, :stok, :id_supplier)");
        $this->db->bind('id_produk', $idProduk);
        $this->db->bind('nama_produk', $data['nama_produk']);
        // $this->db->bind('foto_produk', $namaFile);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('id_supplier', $data['id_supplier']);

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
