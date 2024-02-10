<?php

class ProdukModel
{
    protected $table = 'tbl_produk';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProduk()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->get();
    }

    public function insert($data)
    {
        $this->db->query("INSERT INTO $this->table VALUES (:id_produk, :nama_produk, :harga, :stok)");
        $this->db->bind('id_produk', $data['id_produk']);
        $this->db->bind('nama_produk', $data['nama_produk']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('stok', $data['stok']);
        $this->db->execute();
        return $this->db->rowCountAffected();
    
    }
}
