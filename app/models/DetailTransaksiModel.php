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
        $this->db->query("SELECT * FROM $this->table WHERE id_transaksi = :id_transaksi");
        $this->db->bind('id_transaksi', $idTransaksi);
        return $this->db->get();
    }
}
