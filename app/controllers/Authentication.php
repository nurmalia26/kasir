<?php

class Authentication extends Controller
{
    public function index()
    {
        // Jika pengguna sudah terautentikasi, arahkan ke halaman utama
        if (isset($_SESSION['user']) && $_SESSION['user']) {
            header("Location: " . APP_URL);
            exit;
        }
        $this->view('auth/login');
    }

    public function login()
    {
        $user = $this->model('PegawaiModel')->cekLogin($_POST);

        if (empty(trim($_POST['username'])) && empty(trim($_POST['password']))) {
            Flasher::setFlash('error', 'Login Gagal', 'Username dan Password wajib diisi');
            header("Location: " . APP_URL . '/authentication');
            exit;
        }

        if (empty(trim($_POST['username']))) {
            Flasher::setFlash('error', 'Login Gagal', 'Username wajib diisi');
            header("Location: " . APP_URL . '/authentication');
            exit;
        }

        if (empty(trim($_POST['password']))) {
            Flasher::setFlash('error', 'Login Gagal', 'Password wajib diisi');
            header("Location: " . APP_URL . '/authentication');
            exit;
        }

        // Jika pengguna berhasil login
        if ($user) {
            $_SESSION['user'] = $user;
            Flasher::setFlash('success', 'Login Berhasil', "Hi, " . $_SESSION['user']['nama']);
            header("Location: " . APP_URL);
            exit;
        } else {
            Flasher::setFlash('error', 'Login Gagal', 'Username atau Password salah');
            header("Location: " . APP_URL . '/authentication');
            exit;
        }
    }

    public function logout()
    {
        // Menghapus semua data sesi dan mengarahkan pengguna kembali ke halaman login
        $_SESSION = [];
        session_unset();
        session_destroy();
        header("Location: " . APP_URL . '/authentication');
        exit;
    }
}

?>
