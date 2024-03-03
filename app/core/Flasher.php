<?php

class Flasher
{
    public static function setFlash($icon, $title, $text)
    {
        $_SESSION['flash'] = [
            'icon' => $icon,
            'title' => $title,
            'text' => $text
        ];
    }

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
            unset($_SESSION['flash']);
        }
    }

    public static function setSwal($icon, $title, $text)
    {
        $_SESSION['swal'] = [
            'icon' => $icon,
            'title' => $title,
            'text' => $text
        ];
    }
    public static function swal()
    {
        if (isset($_SESSION['swal'])) {
            echo '<script>
            Swal.fire({
                icon: "' . $_SESSION['swal']['icon'] . '",
                title: "' . $_SESSION['swal']['title'] . '",
                text: "' . $_SESSION['swal']['text'] . '"
            })
            </script>';
            unset($_SESSION['swal']);
        }
    }
}
