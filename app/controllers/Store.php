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
            try {
                $this->model('StoreModel')->addStore($_POST);
                Flasher::setFlash('berhasil', 'ditambahkan ke table', 'green');
                header('Location: ' . BASEURL . 'store');
                exit;
            } catch (Exception $e) {
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
