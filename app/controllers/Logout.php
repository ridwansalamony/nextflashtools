<?php

class Logout
{
    public function __construct()
    {
        if ($_SESSION['session_login'] != 'login') {
            Flasher::setFlash('Silahkan Login terlebih dahulu', '', 'red');
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
