<?php

class PelangganModel
{
    protected $table = 'tbl_pelanggan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPelanggan()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->get();
    }

    public function insert($data)
    {
        $this->db->query("INSERT INTO $this->table VALUES ( '', :nama, :alamat, :no_telpon)");
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_telpon', $data['no_telpon']);
      
        $this->db->execute();
        return $this->db->rowCountAffected();
    
    }
    
   
}