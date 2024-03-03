<?php

class Order extends Controller
{

    public function __construct()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION = [];
            session_unset();
            session_destroy();
            header("Location: " . APP_URL . '/order');
            exit;
        }
    }

    public function index()
    {
        $data['produk'] = $this->model("ProdukModel")->getAllReadyProduk();
        $data['judul'] = 'Dashboard';
        $this->view('order/index', $data);
    }

    public function checkout()
    {
        $_POST['detail_transaksi'] = json_decode($_POST['detail_transaksi']);

        if (empty($_POST['detail_transaksi'])) {
            Flasher::setFlash('error', 'Checkout Gagal', 'Produk Belum ditambahkan');
            header('Location: ' . APP_URL . '/order');
            exit;
        } else if ($this->model('TransaksiModel')->order($_POST) > 0) {
            Flasher::setFlash('success', 'Checkout Berhasil', 'Checkout Berhasil disimpan');
            $id_transaksi = $this->model('TransaksiModel')->getLastIdTransaksi();
            $_SESSION['transaction']['status'] = true;
            $_SESSION['transaction']['detail'] = $this->model('DetailTransaksiModel')->getAllDetailByIdTransaksi($id_transaksi);
            header('Location: ' . APP_URL . '/order');
            exit;
        } else {
            Flasher::setFlash('error', 'Checkout Gagal', 'Checkout Gagal disimpan');
            header('Location: ' . APP_URL . '/order');
            exit;
        }
    }
}
