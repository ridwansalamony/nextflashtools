<?php

class Manual extends Controller
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

    public function all()
    {
        $data['title'] = 'Manual Query';
        $data['nav'] = 'All Toko';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('manual/all');
        $this->view('layouts/footer');
    }

    public function allup()
    {
        if (isset($_POST['submit'])) {
            $query = $_POST['query'];
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "MANUAL QUERY ALL TOKO";
            $action = "QUERY MANUAL UNTUK SEMUA TOKO YANG DI INPUT USER";

            $toko = $this->model('StoreModel')->getAllStore();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko tidak ada di Daftar Toko!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'manual/all');
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

                        $stmt1 = $conn->prepare($query);

                        $stmt1->execute();

                        $data['status'] = true;
                    } catch (PDOException $e) {
                        $data['status'] = false;
                    }

                    $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                    $conn = null;

                    $result[] = array(
                        'kode' => $kode,
                        'nama' => $nama,
                        'status' => $data['status']
                    );

                    $conn = null;
                }

                $data['title'] = 'Manual Query';
                $data['nav'] = 'All Toko';
                $data['user'] = $_SESSION['nama'];
                $data['result'] = $result;
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('manual/all', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'manual/all');
            exit;
        }
    }

    public function part()
    {
        $data['title'] = 'Manual Query';
        $data['nav'] = 'Part Toko';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('manual/part');
        $this->view('layouts/footer');
    }

    public function partup()
    {
        if (isset($_POST['submit'])) {
            $query = $_POST['query'];
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "MANUAL QUERY PART TOKO";
            $action = "QUERY MANUAL UNTUK BEBERAPA TOKO YANG DI INPUT USER";

            try {
                $toko = $this->model('StoreModel')->getStore();
            } catch (Exception $e) {
                Flasher::setFlash("<span class='font-bold'>FORMAT SALAH!</span> Harap masukkan dengan benar!", "<span class='font-bold'>CONTOH : 'TXXX','FXXX'</span>", 'red');
                header('Location: ' . BASEURL . 'prodmast');
                exit;
            }

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'manual/part');
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

                        $stmt1 = $conn->prepare($query);

                        $stmt1->execute();

                        $data['status'] = true;
                    } catch (PDOException $e) {
                        $data['status'] = false;
                    }

                    $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                    $conn = null;

                    $result[] = array(
                        'kode' => $kode,
                        'nama' => $nama,
                        'status' => $data['status']
                    );

                    $conn = null;
                }

                $data['title'] = 'Manual Query';
                $data['nav'] = 'Part Toko';
                $data['user'] = $_SESSION['nama'];
                $data['result'] = $result;
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('manual/part', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'manual/part');
            exit;
        }
    }
}
