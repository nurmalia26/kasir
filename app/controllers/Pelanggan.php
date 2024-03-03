<?php

class Pelanggan extends Controller
{

    public function __construct()
    {
        $this->checkAuthentication();
        $this->checkAuthorizationPegawai();
    }

    public function index()
    {
        $data['pelanggan'] = $this->model("PelangganModel")->getAllPelanggan();
        $data['judul'] = 'Pelanggan';
        $this->view('templates/header');
        $this->view('pelanggan/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Pelanggan';
        $this->view('templates/header');
        $this->view('pelanggan/create', $data);
        $this->view('templates/footer');
    }

    public function save()
    {
        $rowAffacted = $this->model("PelangganModel")->insert($_POST);
        if (empty(trim($_POST['nama']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'nama pelanggan wajib diisi');
            header("Location: " . APP_URL . '/pelanggan/create');
            exit;
        }
        if (empty(trim($_POST['alamat']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'Alamat pelanggan wajib diisi');
            header("Location: " . APP_URL . '/pelanggan/create');
            exit;
        }
        if (empty(trim($_POST['no_telpon']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'nomor pelanggan wajib diisi');
            header("Location: " . APP_URL . '/pelanggan/create');
            exit;
        }
        if ($rowAffacted > 0) {
            Flasher::setFlash('success', 'Data Berhasil disimpan', 'Pelanggan Berhasil ditambahkan');
            header("Location: " . APP_URL . "/pelanggan");
            exit;
        }
    }
}