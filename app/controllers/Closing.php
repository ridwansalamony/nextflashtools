<?php

class Closing extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['session_login'])) {
            Flasher::setFlash('Silahkan <span class"font-semibold">LOGIN</span> ', 'terlebih dahulu', 'red');
            header('Location: ' . BASEURL . 'guest');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Tutupan Ulang';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('home/index');
        $this->view('layouts/footer');
    }

    public function daily()
    {
        $data['title'] = 'Tutupan Ulang';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('closing/daily');
        $this->view('layouts/footer');
    }

    public function update()
    {
        if (isset($_POST['submit'])) {
            date_default_timezone_set('Asia/Jakarta');

            $tanggal_initial = $_POST['tanggal_initial'];
            $tanggal_con = date('Y-m-d', strtotime("$tanggal_initial -1 day", strtotime(date("Y-m-d"))));

            $toko = $this->model('StoreModel')->getStoreByCode();

            if ($toko) {
                $user = DB_USER_TOKO;
                $name = DB_NAME_TOKO;
                if ($_POST['pass'] === 'old') {
                    $pass = DB_PASS_TOKO_OLD;
                } else {
                    $pass = DB_PASS_TOKO_NEW;
                }

                $ip = $toko['induk'];
                $kode = $toko['toko'];
                $nama = $toko['nama'];

                // Eksekusi
                $dsn = "mysql:host=$ip;dbname=$name";
                $option = [
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ];

                try {
                    $conn = new PDO($dsn, $user, $pass, $option);

                    $initial = "SELECT * FROM initial WHERE tanggal = $tanggal_initial ORDER BY station ASC";
                    $stmt1 = $conn->prepare($initial);
                    $stmt1->execute();

                    if ($initial > 0) {
                    } else {
                        Flasher::setFlash("<span class='font-semibold'>TANGGAL INITIAL TIDAK ADA!</span>", "Masukkan tanggal yang valid", 'red');
                        header('Location: ' . BASEURL . 'daily');
                    }

                    $data['status'] = true;
                } catch (PDOException $e) {
                    $data['status'] = false;
                }

                // $result[] = array(
                //     'kode' => $kode,
                //     'nama' => $nama,
                //     'status' => $data['status']
                // );

                // $conn = null;
                // $data['title'] = 'Update Prodmast';
                // $data['user'] = $_SESSION['nama'];
                // $data['result'] = $result;
                // $this->view('layouts/header', $data);
                // $this->view('layouts/navbar', $data);
                // $this->view('prodmast/index', $data);
                // $this->view('layouts/footer');
            } else {
                Flasher::setFlash("<span class='font-semibold'>KODE TOKO TIDAK ADA!</span>", "Silahkan tambah di menu daftar toko", 'red');
                header('Location: ' . BASEURL . 'daily');
            }
        } else {
            header('Location: ' . BASEURL . 'daily');
        }
    }
}
