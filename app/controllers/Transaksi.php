<?php
require_once '../vendor/autoload.php'; // Sesuaikan dengan lokasi autoload.php jika Anda menginstal melalui Composer

use Dompdf\Dompdf;

class Transaksi extends Controller
{

    // Constructor: Dieksekusi saat objek Transaksi dibuat
    public function __construct()
    {
        // Memeriksa autentikasi pengguna sebelum mengakses fitur transaksi
        $this->checkAuthentication();
    }

    // Method untuk menampilkan halaman daftar transaksi
    public function index()
    {
        // Mendapatkan data seluruh transaksi dari model TransaksiModel
        $data['transaksi'] = $this->model("TransaksiModel")->getAllTransaksi();
        $data['judul'] = 'Transaksi';

        $this->view('templates/header');
        $this->view('transaksi/index', $data);
        $this->view('templates/footer');
    }

    // Method untuk mendapatkan detail transaksi berdasarkan id transaksi
    public function getDetailByIdTransaksi($idTransaksi)
    {
        // Mendapatkan detail transaksi berdasarkan id transaksi dari model DetailTransaksiModel
        $getDetail = $this->model('DetailTransaksiModel')->getAllDetailByIdTransaksi($idTransaksi);
        // Mengembalikan data detail transaksi dalam format JSON
        echo json_encode($getDetail);
    }

    // Method untuk menampilkan form transaksi baru
    public function create()
    {
        // Mendapatkan data pelanggan dari model PelangganModel
        $data['pelanggan'] = $this->model("PelangganModel")->getAllPelanggan();
        // Mendapatkan data produk yang siap dijual dari model ProdukModel
        $data['produk'] = $this->model("ProdukModel")->getAllReadyProduk();
        $data['judul'] = 'Produk';

        $this->view('templates/header');
        $this->view('transaksi/create', $data);
        $this->view('templates/footer');
    }

    // Method untuk menyimpan data transaksi baru
    public function save()
    {
        // Mendapatkan data detail transaksi yang dikirim melalui POST dan mengubahnya menjadi array
        $_POST['detail_transaksi'] = json_decode($_POST['detail_transaksi']);
        $_POST['id_pelanggan'] = !empty(trim($_POST['id_pelanggan'])) ? $_POST['id_pelanggan'] : NULL;

        // Memeriksa apakah detail transaksi kosong
    
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

    // Method untuk mengubah status transaksi menjadi 'paid'
    //     public function statusPaid($idTransaksi)
    //     {
    //         // Memperbarui status transaksi menjadi 'paid' berdasarkan id transaksi
    //         if ($this->model('TransaksiModel')->updateStatusPaid($idTransaksi) > 0) {
    //             Flasher::setFlash('success', 'Pembayaran Berhasil', 'Pembayaran Berhasil disimpan');
    //             header('Location: ' . APP_URL . '/transaksi');
    //             exit;
    //         } else {
    //             Flasher::setFlash('error', 'Pembayaran Gagal', 'Pembayaran Gagal disimpan');
    //             header('Location: ' . APP_URL . '/transaksi');
    //             exit;
    //         }
    //     }
    // }
    public function cetak($idTransaksi)
    {
        $data['cetak'] = $this->model("DetailTransaksimodel")->getAllDetailByIdTransaksi($idTransaksi);
        $data['judul'] = 'Cetak';

        $this->view('templates/header');
        $this->view('cetak/index', $data);
        $this->view('templates/footer');
    }

    public function convertToPdf($idTransaksi)
    {
        $detailTransaksi = $this->model("DetailTransaksimodel")->getAllDetailByIdTransaksi($idTransaksi);

        $dompdf = new Dompdf();
        $no = 1;
        $totalHarga = 0;
        // Load HTML content
        $html = '<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Nota</title>
            <style>
              body {
                font-family: Arial, sans-serif;
              }
              .container-nota {
                max-width: 700px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ccc;
              }
              .receipt-header {
                text-align: center;
                margin-bottom: 20px;
              }
              .receipt-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
              }
              .receipt-table th,
              .receipt-table td {
                border: 1px solid #ccc;
                padding: 8px;
                text-align: left;
              }
              .receipt-total {
                text-align: right;
                font-weight: bold;
              }
            </style>
          </head>
          <body>
            <div class="container-nota">
                <div class="receipt-header">
                    <h2>'. APP_NAME .'</h2>
                    <p>Rawa Geni, Jl.istiqomah 1 no 57 Ratu Jaya Cipayung <br>081297342612</p>
                </div>
                <div class="row">
                    <label for="nama" class="col-sm-3 col-form-label">Id Transaksi</label>
                    <label for="nama" class="col-sm-9 col-form-label">:' . $detailTransaksi[0]['id_transaksi'] . ' </label>
                </div>
                <div class="row">
                    <label for="nama" class="col-sm-3 col-form-label">Tanggal</label>
                    <label for="nama" class="col-sm-9 col-form-label">:' . $detailTransaksi[0]['tanggal'] . '</label>
                </div>
                <table class="receipt-table">
               <thead>
                   <tr>
                       <th>No.</th>
                       <th>id Produk</th>
                       <th>Nama Produk</th>
                       <th>Harga Satuan</th>
                       <th>Jumlah</th>
                       <th>Sub Total</th>
                   </tr>
               </thead>
               <tbody>';
        foreach ($detailTransaksi as $produk) {
            $totalHarga += $produk['sub_total'];
            $html .= '  <tr>
                   <td>' . $no++ . '</td>
                   <td>' . $produk['id_produk'] . '</td>
                   <td>' . $produk['nama_produk'] . '</td>
                   <td> Rp ' . number_format((float) $produk['harga'], 2, ',', '.') . '</td>
                   <td>' . $produk['jumlah_produk'] . '</td>
                   <td> Rp ' . number_format((float) $produk['sub_total'], 2, ',', '.') . '</td>
               </tr>';
        }
        $totalBayar = (float)$detailTransaksi[0]['bayar'];

        // Calculate the kembalian
        $kembalian = $totalBayar - $totalHarga;

        $html .= '</tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="receipt-total">Total Harga</td>
                        <td class="receipt-total">Rp ' . number_format((float) $totalHarga, 2, ',', '.') . '</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="receipt-total">Total bayar</td>
                        <td class="receipt-total">Rp ' . number_format((float)$totalBayar,  2, ',', '.') . '</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="receipt-total">Kembalian</td>
                        <td class="receipt-total">Rp ' . number_format((float)$kembalian, 2, ',', '.') . '</td>
                    </tr>
                </tfoot>
            </table>
            <p>Terimakasih Atas Pembelian anda!!</p>
        </div>
        </body>
    </html>';

        // Load HTML content into DOMPDF
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (generate)
        $dompdf->render();

        // Output generated PDF to browser
        $dompdf->stream('nota.pdf', array('Attachment' => 0));
    }


    public function laporan()
    {
        if (empty($_POST['tanggal_awal'])) {
            Flasher::setFlash('error', 'Cetak Laporan Gagal', 'Tanggal Awal Belum ditambahkan');
            header('Location: ' . APP_URL);
            exit;
        }
        if (empty($_POST['tanggal_akhir'])) {
            Flasher::setFlash('error', 'Cetak Laporan Gagal', 'Tanggal Akhir Belum ditambahkan');
            header('Location: ' . APP_URL);
            exit;
        }
        
        $laporan = $this->model("TransaksiModel")->tampilTanggal($_POST['tanggal_awal'], $_POST['tanggal_akhir']);
        if (count($laporan) < 1) {
            Flasher::setFlash('error', 'Cetak Laporan Gagal', 'Tidak Terdapat Transaksi pada Tanggal tersebut');
            header('Location: ' . APP_URL);
            exit;
        }

        $data['transaksi'] = $this->model("TransaksiModel")->getAllTransaksi();

        $dompdf = new Dompdf();
        $no = 1;
        $subtotal = 0;
        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Laporan</title>
        </head>
        <body>
         <h1>Laporan Periode '.$_POST['tanggal_awal'].' sampai '.$_POST['tanggal_akhir'].' </h1>
            <table border="1">
                <thead>
                    <tr align="center" class="alert-dark">
                        <th>No.</th>
                        <th>Pelanggan</th>
                        <th>Pegawai</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($data['transaksi'] as $transaksi) {

            $subtotal +=  $transaksi['total_harga'];

            $html .= '<tr align="center">
                    <td>' . $no++ . '</td>
                    <td>' . $transaksi['id_pelanggan'] . ' - ' . $transaksi['nama_pelanggan'] . '</td>
                    <td>' . $transaksi['id_user'] . ' - ' . $transaksi['nama_user'] . '</td>
                    <td>' . $transaksi['tanggal'] . '</td>

                    <td> Rp ' . number_format((float) $transaksi['total_harga'], 2, ',', '.') . '</td>
                </tr>';
        }
        $html .= ' </tbody>
                <tfoot>
                    <tr align="center">
                        <th colspan="4">Subtotal</th>
                        <th> Rp ' . number_format((float)$subtotal, 2, ',', '.') . '</th>
                       
                    </tr>
                </tfoot>
            </table>
        </body>
        </html>';

        // Load HTML content into DOMPDF
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (generate)
        $dompdf->render();

        // Output generated PDF to browser
        $dompdf->stream('nota.pdf', array('Attachment' => 0));
    }
}
