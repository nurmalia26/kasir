<?php

class App
{
    // Property untuk menyimpan nama controller, method, dan parameter default
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    // Method constructor yang akan dijalankan saat objek App dibuat
    public function __construct()
    {
        // Mendapatkan URL yang telah di-parse
        $url = $this->parseURL();

        // Mengatur controller jika ada di URL dan file controller tersebut ada di direktori controllers
        if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // Require controller yang telah ditentukan
        require_once '../app/controllers/' . $this->controller . '.php';

        // Membuat objek dari controller yang telah ditentukan
        $this->controller = new $this->controller;

        // Mengatur method jika ada di URL dan method tersebut ada di dalam controller
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Mengatur parameter jika ada
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // Menjalankan method pada controller dengan parameter yang telah ditentukan\
        //pelanggan/create/123" (dengan "123" sebagai ID pelanggan)
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Method untuk mem-parse URL menjadi array
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
