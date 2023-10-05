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
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "PB";
            $action = "UPDATE PICNOT DI TABLE NPB_H";

            $toko = $this->model('StoreModel')->getStoreByCode($_POST['kode_toko']);

            $picnot = $_POST['picnot'];
            $docno = $_POST['npb'];

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-warning font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
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

                    $select = "SELECT * FROM npb_h WHERE docno='$docno'";

                    $stmt1 = $conn->prepare($select);

                    $stmt1->execute();

                    $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    if (!$data) {
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> DOCNO tersebut tidak ada / belum di proses!', 'Masukkan DOCNO yang valid', 'red');
                        header('Location: ' . BASEURL . 'pb/reopenpb');
                        exit;
                    } else {
                        $update = "UPDATE npb_h SET picnot='$picnot' WHERE docno='$docno'";

                        $stmt2 = $conn->prepare($update);

                        $stmt2->execute();

                        $data['status'] = true;
                        Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL!</span> <span class='font-bold text-warning uppercase'>$kode</span>", "Silahkan buka ulang program", 'blue');
                    }
                } catch (PDOException $e) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL!</span>", "Koneksi <span class='font-bold text-warning uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                }
                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                header('Location: ' . BASEURL . 'pb/reopenpb');
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
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "PB";
            $action = "UPDATE RECID DI TABLE DCPBOX_PLO";

            $toko = $this->model('StoreModel')->getStoreByCode($_POST['kode_toko']);

            $picnot = $_POST['picnot'];
            $docno = $_POST['npb'];

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-warning font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
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

                    $select = "SELECT * FROM dcpbox_plu WHERE docno='$docno'";

                    $stmt1 = $conn->prepare($select);

                    $stmt1->execute();

                    $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    if (!$data) {
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> DOCNO tersebut tidak ada / belum di proses!', 'Masukkan DOCNO yang valid', 'red');
                        header('Location: ' . BASEURL . 'pb/reopenpbx');
                        exit;
                    } else {
                        $update = "UPDATE dcpbox_plu SET recid='$picnot' WHERE docno='$docno'";

                        $stmt2 = $conn->prepare($update);

                        $stmt2->execute();
                        $data['status'] = true;
                        Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL!</span> <span class='font-bold text-warning uppercase'>$kode</span>", "Silahkan proses ulang PB", 'blue');
                    }
                } catch (PDOException $e) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL!</span>", "Koneksi <span class='font-bold text-warning uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                }
                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                header('Location: ' . BASEURL . 'pb/reopenpb');
            }
        } else {
            header('Location: ' . BASEURL . 'pb/reopenpbx');
            exit;
        }
    }
}
