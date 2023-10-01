<?php

class Pb extends Controller
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
        $data['title'] = 'Beranda';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('home/index');
        $this->view('layouts/footer');
    }

    public function reopenpb()
    {
        $data['title'] = 'Beranda';
        $data['nav'] = 'Reopen PB';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('pb/reopenpb');
        $this->view('layouts/footer');
    }

    public function reopenpbup()
    {
        if (isset($_POST['submit'])) {

            $toko = $this->model('StoreModel')->getStoreByCode();

            $picnot = $_POST['picnot'];
            $docno = $_POST['npb'];

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'pb/reopenpb');
                exit;
            } else {
                $user = DB_USER_TOKO;
                $name = DB_NAME_TOKO;
                if ($_POST['pass'] === 'old') {
                    $pass = DB_PASS_TOKO_OLD;
                } else {
                    $pass = DB_PASS_TOKO_NEW;
                }

                $ip = $toko['induk'];
                $kode = $toko['toko'];

                // Eksekusi
                $dsn = "mysql:host=$ip;dbname=$name";
                $option = [
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ];

                try {
                    $conn = new PDO($dsn, $user, $pass, $option);

                    $query = "UPDATE npb_h SET picnot='$picnot' WHERE docno='$docno'";

                    $stmt1 = $conn->prepare($query);

                    $stmt1->execute();

                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Silahkan proses ulang PB", 'blue');
                    header('Location: ' . BASEURL . 'pb/reopenpb');
                    $conn = null;
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'pb/reopenpb');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'pb/reopenpb');
            exit;
        }
    }
}
