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

    public function getProdukById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_produk = :id_produk");
        $this->db->bind('id_produk', $id);
        return $this->db->first();
    }

    public function cekIdProduk($idProduk)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_produk = :id_produk");
        $this->db->bind('id_produk', $idProduk);
        $this->db->execute();
        return $this->db->rowCountAffected();
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
    public function getAllReadyProduk()
    {
        $this->db->query("SELECT * FROM $this->table WHERE stok > 0");
        return $this->db->get();
    }


}
