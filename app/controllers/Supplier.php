<?php

class supplier extends Controller
{

    public function __construct()
    {
        $this->checkAuthentication();
        $this->checkAuthorizationAdmin();
    }

    public function index()
    {
        $data['supplier'] = $this->model("SupplierModel")->getAllSupllier();
        $data['judul'] = 'Supplier';
        $this->view('templates/header');
        $this->view('supplier/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Supplier';
        $this->view('templates/header');
        $this->view('supplier/create', $data);
        $this->view('templates/footer');
    }
    public function save()
    {
        $rowAffacted = $this->model("SupplierModel")->insert($_POST);
        if (empty(trim($_POST['nama_supplier']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'nama pelanggan wajib diisi');
            header("Location: " . APP_URL . '/supplier/create');
            exit;
        }
        if (empty(trim($_POST['alamat']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'Alamat supplier wajib diisi');
            header("Location: " . APP_URL . '/supplier/create');
            exit;
        }
        if (empty(trim($_POST['no_tlp']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'nomor supplier wajib diisi');
            header("Location: " . APP_URL . '/supplier/create');
            exit;
        }
        if ($rowAffacted > 0) {
            Flasher::setFlash('success', 'Data Berhasil disimpan', 'supplier Berhasil ditambahkan');
            header("Location: " . APP_URL . "/supplier");
            exit;
        }
    }
}