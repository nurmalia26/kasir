<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->checkAuthentication();
    }


    public function index()
    {
        $data['judul'] = 'Bangun jaya';
        $this->view('templates/header');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    
}
