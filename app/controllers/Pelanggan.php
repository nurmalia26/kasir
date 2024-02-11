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
        if ($rowAffacted > 0) {
            Flasher::setFlash('success','Data Berhasil disimpan','Pelanggan Berhasil ditambahkan');
            header("Location: " . APP_URL . "/pelanggan");
            exit;
        }
    }
}