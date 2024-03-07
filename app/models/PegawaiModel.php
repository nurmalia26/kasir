<?php

class PegawaiModel
{
    protected $table = 'tbl_user';
    private $db;

    // Constructor untuk inisialisasi objek Database
    public function __construct()
    {
        $this->db = new Database;
    }

    // Method untuk mendapatkan semua data pegawai
    public function getAllPegawai()
    {
        $this->db->query("SELECT * FROM $this->table");
        // Mengembalikan hasil query dalam bentuk array asosiatif
        return $this->db->get();
    }

    // Method untuk melakukan pengecekan username pada basis data
    public function cekUsername($username)
    {
        $this->db->query("SELECT * FROM $this->table WHERE username = :username");
        $this->db->bind('username', $username);
        // Eksekusi query
        $this->db->execute();
        // Mengembalikan jumlah baris yang terpengaruh oleh hasil query
        return $this->db->rowCountAffected();
    }

    // Method untuk menyimpan data pegawai baru ke dalam basis data
    public function insert($data)
    {
        $this->db->query("INSERT INTO $this->table VALUES ('', :nama, :username, :password, 'pegawai')");
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $data['password']);

        // Eksekusi query
        $this->db->execute();
        // Mengembalikan jumlah baris yang terpengaruh oleh hasil query
        return $this->db->rowCountAffected();
    }

    public function cekLogin($data)
    {
        // Query untuk melakukan pengecekan login berdasarkan username dan password
        $this->db->query("SELECT * FROM $this->table WHERE username = :username AND password = :password");
        // Binding parameter username dan password
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $data['password']);
        // Mengembalikan hasil query dalam bentuk array asosiatif
        return $this->db->first();
    }
}
