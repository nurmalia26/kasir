<?php

class Transaksi extends Controller
{

    public function __construct()
    {
        $this->checkAuthentication();
        $this->checkAuthorizationPegawai();
    }

    public function index()
    {
        $data['transaksi'] = $this->model("TransaksiModel")->getAllTransaksi();
        $data['judul'] = 'Transaksi';
        $this->view('templates/header');
        $this->view('transaksi/index', $data);
        $this->view('templates/footer');
    }

    public function getDetailByIdTransaksi($idTransaksi)
    {
        $getDetail = $this->model('DetailTransaksiModel')->getAllDetailByIdTransaksi($idTransaksi);
        echo json_encode($getDetail);
    }
}
