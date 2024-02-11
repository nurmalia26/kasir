<?php

class PegawaiModel
{
    protected $table = 'tbl_user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPegawai()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->get();
    }

    public function cekUsername($username)
    {
        $this->db->query("SELECT * FROM $this->table WHERE username = :username");
        $this->db->bind('username', $username);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }

    public function insert($data)
    {
        $this->db->query("INSERT INTO $this->table VALUES ( '', :nama, :username, :password, 'pegawai')");
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $data['password']);

        $this->db->execute();
        return $this->db->rowCountAffected();
    }

    public function cekLogin($data)
    {
        $this->db->query("SELECT * FROM $this->table WHERE username = :username AND password = :password");
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $data['password']);
        return $this->db->first();
    }
}
