<?php

class Logout
{
    public function __construct()
    {
        if (!isset($_SESSION['session_login'])) {
            Flasher::setFlash('Silahkan <span class"font-semibold">LOGIN</span> ', 'terlebih dahulu', 'red');
            header('Location: ' . BASEURL . 'guest');
            exit;
        }
    }

    public function index()
    {
        session_destroy();
        session_start();
        Flasher::setFlash('Berhasil <span class="font-semibold">LOGOUT</span>', ' Silahkan login kembali', 'green');
        header('Location: ' . BASEURL . 'guest');
    }
}
