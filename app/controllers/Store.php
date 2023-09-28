<?php

class Store extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Toko';
        $data['user'] = $this->model('UserModel')->getUser();
        $data['store'] = $this->model('StoreModel')->getAllStore();
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('store/index', $data);
        $this->view('layouts/footer');
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            if ($this->model('StoreModel')->addStore($_POST) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan ke table', 'green');
                header('Location: ' . BASEURL . 'store');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan ke table', 'red');
                header('Location: ' . BASEURL . 'store');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . 'store');
            exit;
        }
    }
}
