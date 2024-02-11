<?php

class Produk extends Controller
{

    public function __construct()
    {
        $this->checkAuthentication();
    }

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
        $this->checkAuthorizationAdmin();
        $data['judul'] = 'Produk';
        $this->view('templates/header');
        $this->view('produk/create', $data);
        $this->view('templates/footer');
    }

    public function save()
    {
        $this->checkAuthorizationAdmin();
        $cekIdProduk = $this->model('ProdukModel')->cekIdProduk($_POST['id_produk']);
        if (empty(trim($_POST['id_produk']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'id produk wajib diisi');
            header("Location: " . APP_URL . '/produk/create');
            exit;
        }
        if (empty(trim($_POST['nama_produk']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'nama produk wajib diisi');
            header("Location: " . APP_URL . '/produk/create');
            exit;
        }
        if (empty(trim($_POST['harga']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'harga wajib diisi');
            header("Location: " . APP_URL . '/produk/create');
            exit;
        }
        if (empty(trim($_POST['stok']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'stok wajib diisi');
            header("Location: " . APP_URL . '/produk/create');
            exit;
        }
        if ($cekIdProduk > 0) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'Id produk telah digunakan');
            header("Location: " . APP_URL . '/produk/create');
            exit;
        }

        $rowAffacted = $this->model("ProdukModel")->insert($_POST);
        if ($rowAffacted > 0) {
            Flasher::setFlash('success', 'Data Berhasil disimpan', 'Produk Berhasil ditambahkan');
            header("Location: " . APP_URL . "/produk");
            exit;
        } else {
            Flasher::setFlash('error', 'Data gagal disimpan', 'Produk gagal ditambahkan');
            header("Location: " . APP_URL . "/produk");
            exit;
        }
    }

    public function edit($id)
    {
        $this->checkAuthorizationAdmin();
        $data['judul'] = 'edit';
        $data['produk'] = $this->model("ProdukModel")->getProdukById($id);
        if (!$data['produk']) {
            $this->view('templates/header');
            $this->view('templates/404');
            $this->view('templates/footer');
            exit;
        };
        $this->view('templates/header');
        $this->view('produk/edit', $data);
        $this->view('templates/footer');
    }

    public function update($id)
    {

        $this->checkAuthorizationAdmin();
        if (empty(trim($_POST['nama_produk']))) {
            Flasher::setFlash('error', 'Data gagal diperbarui', 'nama produk wajib diisi');
            header("Location: " . APP_URL . '/produk/edit/' . $id);
            exit;
        }
        if (empty(trim($_POST['harga']))) {
            Flasher::setFlash('error', 'Data gagal diperbarui', 'harga wajib diisi');
            header("Location: " . APP_URL . '/produk/edit/' . $id);
            exit;
        }
        if (empty(trim($_POST['stok']))) {
            Flasher::setFlash('error', 'Data gagal diperbarui', 'stok wajib diisi');
            header("Location: " . APP_URL . '/produk/edit/' . $id);
            exit;
        }

        $rowAffacted = $this->model("ProdukModel")->update($id, $_POST);
        if ($rowAffacted > 0) {
            Flasher::setFlash('success', 'Data Berhasil diperbarui', 'Produk Berhasil diperbarui');
            header("Location: " . APP_URL . "/produk");
            exit;
        } else {
            Flasher::setFlash('error', 'Data gagal diperbarui', 'Produk gagal diperbarui');
            header("Location: " . APP_URL . "/produk");
            exit;
        }
    }
}
