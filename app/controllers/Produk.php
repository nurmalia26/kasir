<?php

class Produk extends Controller
{

    public function __construct()
    {
        // Memeriksa autentikasi pengguna sebelum mengakses fitur produk
        $this->checkAuthentication();
    }

    // Method untuk menampilkan halaman daftar produk
    public function index()
    {
        // Mendapatkan data seluruh produk dari model ProdukModel
        $data['produk'] = $this->model("ProdukModel")->getAllProduk();
        $data['judul'] = 'Produk';
        $this->view('templates/header');
        $this->view('produk/index', $data);
        $this->view('templates/footer');
    }

    // Method untuk menampilkan form tambah produk
    public function create()
    {
        // Memeriksa otorisasi pengguna untuk fitur admin sebelum menampilkan form tambah produk
        $this->checkAuthorizationAdmin();
        $data['supplier'] = $this->model("SupplierModel")->getAllSupllier();
        $data['judul'] = 'Produk';
        $this->view('templates/header');
        $this->view('produk/create', $data);
        $this->view('templates/footer');
    }

    public function save()
    {
        if (empty(trim($_POST['nama_produk']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'nama produk wajib diisi');
            header("Location: " . APP_URL . '/produk/create');
            exit;
        }
        // if (!isset($_FILES["foto_produk"]) && $_FILES['foto_produk']['error'] != UPLOAD_ERR_OK) {
        //     Flasher::setFlash('error', 'Upload Foto Gagal', 'foto wajib diisi');
        //     header("Location: " . APP_URL . '/produk/create');
        //     exit;
        // }
        if (empty(trim($_POST['harga'])) || $_POST['harga'] === 'Rp ') {
            Flasher::setFlash('error', 'Data gagal disimpan', 'harga wajib diisi');
            header("Location: " . APP_URL . '/produk/create');
            exit;
        } else {
            $_POST['harga'] = str_replace('Rp ', '', $_POST['harga']);
            $_POST['harga'] = trim(str_replace('.', '', $_POST['harga']));
        }
        if (empty(trim($_POST['stok']))) {
            Flasher::setFlash('error', 'Data gagal disimpan', 'stok wajib diisi');
            header("Location: " . APP_URL . '/produk/create');
            exit;
        }
        // if ($cekIdProduk > 0) {
        //     Flasher::setFlash('error', 'Data gagal disimpan', 'Id produk telah digunakan');
        //     header("Location: " . APP_URL . '/produk/create');
        //     exit;
        // }

        // $extension = pathinfo($_FILES['foto_produk']['name'], PATHINFO_EXTENSION);
        // $namaFile = 'img/foto_produk/' .  str_replace(" ", "_", strtolower($_POST['nama_produk'])) . '.' . $extension;

        // Menyimpan data produk baru ke dalam database
        $rowAffacted = $this->model("ProdukModel")->insert($_POST);
        if ($rowAffacted > 0) {
            // move_uploaded_file($_FILES['foto_produk']['tmp_name'], $namaFile);
            Flasher::setFlash('success', 'Data Berhasil disimpan', 'Produk Berhasil ditambahkan');
            header("Location: " . APP_URL . "/produk");
            exit;
        } else {
            Flasher::setFlash('error', 'Data gagal disimpan', 'Produk gagal ditambahkan');
            header("Location: " . APP_URL . "/produk");
            exit;
        }
    }

    // Method untuk menampilkan form edit produk berdasarkan id
    public function edit($id)
    {
        $this->checkAuthorizationAdmin();
        $data['judul'] = 'Edit';
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
        if (empty(trim($_POST['harga'])) || $_POST['harga'] === 'Rp ') {
            Flasher::setFlash('error', 'Data gagal diperbarui', 'harga wajib diisi');
            header("Location: " . APP_URL . '/produk/edit/' . $id);
            exit;
        } else {
            $_POST['harga'] = str_replace('Rp ', '', $_POST['harga']);
            $_POST['harga'] = trim(str_replace('.', '', $_POST['harga']));
        }
        if ($_POST['stok'] < 0) {
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
