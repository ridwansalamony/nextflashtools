<?php

class Home extends Controller
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
        $data['title'] = 'Beranda';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('home/index');
        $this->view('layouts/footer');
    }
}
