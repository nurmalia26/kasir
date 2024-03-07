<?php

class SupplierModel
{
    protected $table = 'tbl_supplier';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllSupllier()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->get();
    }

    public function insert($data)
    {
        $this->db->query("INSERT INTO $this->table VALUES ( '', :nama_supplier, :no_tlp, :alamat)");
        $this->db->bind('nama_supplier', $data['nama_supplier']);
        $this->db->bind('no_tlp', $data['no_tlp']);
        $this->db->bind('alamat', $data['alamat']);
      
        $this->db->execute();
        return $this->db->rowCountAffected();
    
    }
    
   
}