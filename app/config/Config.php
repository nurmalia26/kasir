<?php

// Konstanta untuk URL, nama, dan versi aplikasi
define('APP_URL', 'http://localhost/kasir/public'); // menyimpan URL dasar aplikasi. Misalnya, jika aplikasi diakses melalui http://localhost/kasir/public, maka nilai konstanta ini adalah http://localhost/kasir/public.
define('APP_NAME', 'Bangun Jaya');
define('APP_VERSION', '1.0.0');
$config['composer_autoload'] = "libraries/autoload.php";



// Konstanta untuk koneksi database
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','db_kasir');

?>
