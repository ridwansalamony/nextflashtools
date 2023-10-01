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
        header('Location: ' . BASEURL);
    }

    public function reopenpb()
    {
        $data['title'] = 'PB';
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

    public function reopenpbx()
    {
        $data['title'] = 'PB';
        $data['nav'] = 'Reopen Cek';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('pb/reopenpbx');
        $this->view('layouts/footer');
    }

    public function reopenpbxup()
    {
        if (isset($_POST['submit'])) {

            $toko = $this->model('StoreModel')->getStoreByCode();

            $picnot = $_POST['picnot'];
            $docno = $_POST['npb'];

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'pb/reopenpbx');
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

                    $query = "UPDATE dcpbox_plu SET recid='$picnot' WHERE docno='$docno'";

                    $stmt1 = $conn->prepare($query);

                    $stmt1->execute();

                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Silahkan buka ulang Program Cek Barang dan coba lagi", 'blue');
                    header('Location: ' . BASEURL . 'pb/reopenpbx');
                    $conn = null;
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'pb/reopenpbx');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'pb/reopenpbx');
            exit;
        }
    }

    public function errorpbsl()
    {
        $data['title'] = 'Beranda';
        $data['nav'] = 'Error PBSL';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('pb/errorpbsl');
        $this->view('layouts/footer');
    }

    public function errorpbslup()
    {
        if (isset($_POST['submit'])) {

            $tanggal = date("Y-m-d H:i:s");
            $kategori = 'Error PBSL';

            try {
                $toko = $this->model('StoreModel')->getStore();
            } catch (Exception $e) {
                Flasher::setFlash("<span class='font-bold'>FORMAT SALAH!</span> Harap masukkan dengan benar!", "<span class='font-bold'>CONTOH : 'TXXX','FXXX'</span>", 'red');
                header('Location: ' . BASEURL . 'pb/errorpbsl');
                exit;
            }

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'pb/errorpbsl');
                exit;
            } else {
                $user = DB_USER_TOKO;
                $name = DB_NAME_TOKO;
                if ($_POST['pass'] === 'old') {
                    $pass = DB_PASS_TOKO_OLD;
                } else {
                    $pass = DB_PASS_TOKO_NEW;
                }

                foreach ($toko as $item) {
                    $ip = $item['induk'];
                    $kode = $item['toko'];
                    $nama = $item['nama'];

                    // Eksekusi
                    $dsn = "mysql:host=$ip;dbname=$name";
                    $option = [
                        PDO::ATTR_PERSISTENT => true,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ];

                    try {
                        $conn = new PDO($dsn, $user, $pass, $option);
                        $query = "";

                        $stmt1 = $conn->prepare($query);

                        $stmt1->execute();

                        $data['status'] = true;
                    } catch (PDOException $e) {
                        $data['status'] = false;
                    }

                    $this->model('SniperModel')->addSniper($kode, $data['status'], $tanggal, $kategori);

                    $result[] = array(
                        'kode' => $kode,
                        'nama' => $nama,
                        'status' => $data['status']
                    );

                    $conn = null;
                }

                $data['title'] = 'PB';
                $data['nav'] = 'Error PBSL';
                $data['user'] = $_SESSION['nama'];
                $data['result'] = $result;
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('pb/errorpbsl', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'pb/errorpbsl');
            exit;
        }
    }
}
