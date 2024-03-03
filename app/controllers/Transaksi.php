<?php

class Transaksi extends Controller
{

    public function __construct()
    {
        $this->checkAuthentication();
        // $this->checkAuthorizationPegawai();
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

    public function create()
    {
        // $this->checkAuthorizationAdmin();
        $data['pelanggan'] = $this->model("PelangganModel")->getAllPelanggan();
        $data['produk'] = $this->model("ProdukModel")->getAllReadyProduk();
        $data['judul'] = 'Produk';
        $this->view('templates/header');
        $this->view('transaksi/create', $data);
        $this->view('templates/footer');
    }

    public function save()
    {
        $_POST['detail_transaksi'] = json_decode($_POST['detail_transaksi']);
        $_POST['id_pelanggan'] = !empty(trim($_POST['id_pelanggan'])) ? $_POST['id_pelanggan'] : NULL;

        if (empty($_POST['detail_transaksi'])) {
            Flasher::setFlash('error', 'Transaksi Gagal', 'Produk Belum ditambahkan');
            header('Location: ' . APP_URL . '/transaksi/create');
            exit;
        } else if ($this->model('TransaksiModel')->save($_POST) > 0) {
            Flasher::setFlash('success', 'Transaksi Berhasil', 'Transaksi Berhasil disimpan');
            header('Location: ' . APP_URL . '/transaksi');
            exit;
        } else {
            Flasher::setFlash('error', 'Transaksi Gagal', 'Transaksi Gagal disimpan');
            header('Location: ' . APP_URL . '/transaksi');
            exit;
        }
    }

    public function statusPaid($idTransaksi)
    {
        if ($this->model('TransaksiModel')->updateStatusPaid($idTransaksi) > 0) {
            Flasher::setFlash('success', 'Pembayaran Berhasil', 'Pembayaran Berhasil disimpan');
            header('Location: ' . APP_URL . '/transaksi');
            exit;
        } else {
            Flasher::setFlash('error', 'Pembayaran Gagal', 'Pembayaran Gagal disimpan');
            header('Location: ' . APP_URL . '/transaksi');
            exit;
        }
    }
}
