<?php

class Pegawai extends Controller
{

    public function __construct()
    {
        $this->checkAuthentication();
        $this->checkAuthorizationAdmin();
    }

    public function index()
    {
        $data['pegawai'] = $this->model("PegawaiModel")->getAllPegawai();
        $data['judul'] = 'Pegawai';
        $this->view('templates/header');
        $this->view('pegawai/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Pegawai';
        $this->view('templates/header');
        $this->view('pegawai/create', $data);
        $this->view('templates/footer');
    }

    public function save()
    {
        $cekUsername = $this->model('PegawaiModel')->cekUsername($_POST['username']);

        if (empty(trim($_POST['nama']))) {
            Flasher::setFlash('error', 'Pendaftaran pegawai gagal', 'Nama wajib diisi');
            header("Location: " . APP_URL . '/pegawai/create');
            exit;
        }
        if (empty(trim($_POST['username']))) {
            Flasher::setFlash('error', 'Pendaftaran pegawai gagal', 'Username wajib diisi');
            header("Location: " . APP_URL . '/pegawai/create');
            exit;
        }
        if (empty(trim($_POST['password']))) {
            Flasher::setFlash('error', 'Pendaftaran pegawai gagal', 'Password wajib diisi');
            header("Location: " . APP_URL . '/pegawai/create');
            exit;
        }
        if ($cekUsername > 0) {
            Flasher::setFlash('error', 'Pendaftaran pegawai gagal', 'Username Telah digunakan');
            header("Location: " . APP_URL . '/pegawai/create');
            exit;
        }
        $rowAffacted = $this->model("PegawaiModel")->insert($_POST);
        if ($rowAffacted > 0) {
            Flasher::setFlash('success', 'Data Berhasil disimpan', 'Pegawai Berhasil ditambahkan');
            header("Location: " . APP_URL . "/pegawai");
            exit;
        }
    }
}
