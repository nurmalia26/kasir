<?php

class Flasher
{
    // Method untuk menetapkan pesan flash dengan icon, judul, dan teks yang diberikan
    public static function setFlash($icon, $title, $text)
    {
        $_SESSION['flash'] = [
            'icon' => $icon,
            'title' => $title,
            'text' => $text
        ];
    }

    // Method untuk menampilkan pesan flash jika ada dalam session
    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<script>
            Toast.fire({
                icon: "' . $_SESSION['flash']['icon'] . '",
                title: "' . $_SESSION['flash']['title'] . '",
                text: "' . $_SESSION['flash']['text'] . '"
            })
            </script>';
            unset($_SESSION['flash']); // Menghapus pesan flash setelah ditampilkan
        }
    }

    
}