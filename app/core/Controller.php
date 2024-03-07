<?php

class Controller
{
    // Method untuk menampilkan view dengan data yang diberikan
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    // Method untuk memuat model yang diperlukan dan mengembalikan objek model baru
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
    public function load($libraries)
    {
        require_once '../app/libraries/' . $libraries . '.php';
    }


    // Method untuk memeriksa apakah pengguna telah terautentikasi
    public function checkAuthentication()
    {
        if (!$_SESSION['user']) {
            $_SESSION = [];
            session_unset();
            session_destroy();
            header("Location: " . APP_URL . '/authentication');
            exit;
        }
    }

    // Method untuk memeriksa apakah pengguna memiliki hak akses atau izin sebagai admin
    public function checkAuthorizationAdmin()
    {
        if ($_SESSION['user']['role'] !== 'admin') {
            $this->view('templates/header');
            $this->view('templates/404');
            $this->view('templates/footer');
            exit;
        }
    }
    
    // Method untuk memeriksa apakah pengguna memiliki hak akses atau izin sebagai pegawai
    public function checkAuthorizationPegawai()
    {
        if ($_SESSION['user']['role'] !== 'pegawai') {
            $this->view('templates/header');
            $this->view('templates/404');
            $this->view('templates/footer');
            exit;
        }
    }

   
}
