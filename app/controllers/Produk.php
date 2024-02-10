<?php

class Produk extends Controller
{

    public function index()
    {
        $data['produk'] = $this->model("ProdukModel")->getAllProduk();
        $data['judul'] = 'Produk';
        $this->view('templates/header');
        $this->view('produk/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Produk';
        $this->view('templates/header');
        $this->view('produk/create', $data);
        $this->view('templates/footer');
    }

    public function save()
    {
        $rowAffacted = $this->model("ProdukModel")->insert($_POST);
        if ($rowAffacted > 0) {
            Flasher::setFlash('success','Data Berhasil disimpan','Produk Berhasil ditambahkan');
            header("Location: " . APP_URL . "/produk");
            exit;
        }
    }
}
