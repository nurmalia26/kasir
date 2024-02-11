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
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->get();
    }
}