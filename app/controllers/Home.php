<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->checkAuthentication();
    }

    public function index()
    {
        $data['transaksi'] = $this->model("TransaksiModel")->getAllTransaksi();
        $data['judul'] = 'Bangun jaya';    
        $this->view('templates/header');  
        $this->view('home/index', $data); 
        $this->view('templates/footer'); 
    }

    
        // // Tampilkan halaman untuk memilih tanggal
        // public function show_transactions() {
        //     // Ambil data tanggal dari form
        //     $tanggalAwal = $this->model('TransaksiModel')->tampilTanggal($_POST['tanggalAwal']);
        //     $tanggalAkhir = $this->model('TransaksiModel')->tampilTanggal($_POST['tanggalAkhir']);

            
        //     // Panggil model untuk mendapatkan data transaksi berdasarkan tanggal
        //     $data['transactions'] = $this->TransaksiModel->get_transactions_by_date_range($start_date, $end_date);
            
        //     // Tampilkan hasilnya
        //     $this->load->view('transaction_list', $data);
        // }
    

    
}
