<?php

class Jutsu extends Controller
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

    public function timeoutedc()
    {
        $data['title'] = 'New Jutsu';
        $data['nav'] = 'Timeout EDC';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('jutsu/timeoutedc');
        $this->view('layouts/footer');
    }

    public function timeoutedcup()
    {
        if (isset($_POST['submit'])) {
            $timeout = $_POST['timeout'];
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "NEW JUTSU";
            $action = "UPDATE CONST DOCNO RKEY 'NEB','NEM','NEN','NET','NER'";

            try {
                $toko = $this->model('StoreModel')->getStore();
            } catch (Exception $e) {
                Flasher::setFlash("<span class='font-bold'>FORMAT SALAH!</span> Harap masukkan dengan benar!", "<span class='font-bold'>CONTOH : 'TXXX','FXXX'</span>", 'red');
                header('Location: ' . BASEURL . 'jutsu/timeoutedc');
                exit;
            }

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'jutsu/timeoutedc');
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

                        $query = "UPDATE const SET docno='$timeout' WHERE rkey IN ('NEB','NEM','NEN','NET','NER')";

                        $stmt1 = $conn->prepare($query);

                        $stmt1->execute();

                        $data['status'] = true;
                    } catch (PDOException $e) {
                        $data['status'] = false;
                    }

                    $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                    $result[] = array(
                        'kode' => $kode,
                        'nama' => $nama,
                        'status' => $data['status']
                    );

                    $conn = null;
                }

                $data['title'] = 'New Jutsu';
                $data['nav'] = 'Timeout EDC';
                $data['user'] = $_SESSION['nama'];
                $data['result'] = $result;
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('jutsu/timeoutedc', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'jutsu/timeoutedc');
            exit;
        }
    }

    public function stationapka()
    {
        $data['title'] = 'New Jutsu';
        $data['nav'] = 'Station APKA';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('jutsu/stationapka');
        $this->view('layouts/footer');
    }

    public function stationapkaup()
    {
        if (isset($_POST['submit'])) {
            $station = $_POST['station'];
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "NEW JUTSU";
            $action = "UPDATE CONST DOCNO RKEY TIP";

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'jutsu/stationapka');
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

                        $tip = "SELECT * FROM const WHERE rkey='TIP'";
                        $stmt1 = $conn->prepare($tip);
                        $stmt1->execute();

                        $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                        if (!$result) {
                            Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Table const rkey=TIP tidak ada!', 'Silahkan load table dahulu', 'red');
                            header('Location: ' . BASEURL . 'jutsu/stationapka');
                            exit;
                        } else {
                            $query = "UPDATE const SET `desc`='$station' WHERE rkey='TIP'";
                            $stmt2 = $conn->prepare($query);
                            $stmt2->execute();

                            $data['status'] = true;

                            Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Close pos kasir lalu coba kembali", 'blue');
                            header('Location: ' . BASEURL . 'jutsu/stationapka');
                        }
                    } catch (PDOException $e) {
                        $data['status'] = false;
                        Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                        header('Location: ' . BASEURL . 'jutsu/stationapka');
                    }

                    $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                    $conn = null;
                }

                $data['title'] = 'New Jutsu';
                $data['nav'] = 'Station APKA';
                $data['user'] = $_SESSION['nama'];
                $data['result'] = $result;
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('jutsu/stationapka', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'jutsu/stationapka');
            exit;
        }
    }
}
