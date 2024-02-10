<?php

class Home extends Controller
{
    public function index($judul = "HOME")
    {
        $data['judul'] = 'kasir';
        $this->view('templates/header');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
