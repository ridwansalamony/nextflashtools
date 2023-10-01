<?php

class Store extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['session_login'])) {
            Flasher::setFlash('Silahkan <span class="font-bold">LOGIN</span> ', 'terlebih dahulu', 'red');
            header('Location: ' . BASEURL . 'guest');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Daftar Toko';
        $data['user'] = $_SESSION['nama'];
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
                Flasher::setFlash('<span class="font-bold">PROSES BERHASIL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span>', 'berhasil ditambahkan!', 'blue');
                header('Location: ' . BASEURL . 'store');
                exit;
            } catch (Exception $e) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span>', 'sudah terdaftar!', 'red');
                header('Location: ' . BASEURL . 'store');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . 'store');
            exit;
        }
    }

    public function delete($toko)
    {
        if (isset($toko)) {
            try {
                $this->model('StoreModel')->deleteStore($toko);
                Flasher::setFlash('<span class="font-bold">PROSES BERHASIL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span>', 'berhasil dihapus!', 'blue');
                header('Location: ' . BASEURL . 'store');
                exit;
            } catch (Exception $e) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span>', 'gagal dihapus!', 'red');
                header('Location: ' . BASEURL . 'store');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . 'store');
            exit;
        }
    }
}
