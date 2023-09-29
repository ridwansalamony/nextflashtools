<?php

class Check extends Controller
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

    public function mstran()
    {
        $data['title'] = 'Check Data';
        $data['nav'] = 'Mstran';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('check/mstran');
        $this->view('layouts/footer');
    }

    public function mstranup()
    {
        if (isset($_POST['submit'])) {
            $plu = $_POST['plu'];
            $npb = $_POST['npb'];
            $tanggal_proses = $_POST['tanggal_proses'];

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash("<span class='font-bold'>KODE TOKO TIDAK ADA!</span>", "Silahkan tambah di menu daftar toko", 'red');
                header('Location: ' . BASEURL . 'check/mstran');
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

                    $mstran = "SELECT * FROM mstran WHERE prdcd LIKE '%$plu%' AND invno LIKE '%$npb%' AND bukti_tgl LIKE '%$tanggal_proses%' ORDER BY bukti_tgl DESC";

                    $stmt = $conn->prepare($mstran);

                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!$result) {
                        Flasher::setFlash("<span class='font-bold'>DATA TIDAK ADA!</span>", "Masukkan DATA yang valid", 'red');
                        header('Location: ' . BASEURL . 'check/mstran');
                        exit;
                    } else {
                        foreach ($result as $item) {
                            $npb = $item['INVNO'];
                            $prdcd = $item['PRDCD'];
                            $rtype = $item['RTYPE'];
                            $keter = $item['KETER'];
                            $bukti = $item['BUKTI_NO'];
                            $tanggal = $item['BUKTI_TGL'];

                            $result[] = array(
                                'npb' => $npb,
                                'prdcd' => $prdcd,
                                'rtype' => $rtype,
                                'keter' => $keter,
                                'bukti' => $bukti,
                                'tanggal' => $tanggal,
                            );
                            $conn = null;
                        }

                        $data['title'] = 'Check Data';
                        $data['nav'] = 'Mstran';
                        $data['user'] = $_SESSION['nama'];
                        $data['result'] = $result;
                        $this->view('layouts/header', $data);
                        $this->view('layouts/navbar', $data);
                        $this->view('check/mstran', $data);
                        $this->view('layouts/footer');
                    }
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'check/mstran');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'check/mstran');
        }
    }

    public function stmast()
    {
        $data['title'] = 'Check Data';
        $data['nav'] = 'Stmast';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('check/stmast');
        $this->view('layouts/footer');
    }

    public function stmastup()
    {
        if (isset($_POST['submit'])) {
            $plu = $_POST['plu'];

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash("<span class='font-bold'>KODE TOKO TIDAK ADA!</span>", "Silahkan tambah di menu daftar toko", 'red');
                header('Location: ' . BASEURL . 'check/stmast');
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

                    $stmast = "SELECT * FROM stmast WHERE prdcd in ($plu)";

                    $stmt = $conn->prepare($stmast);

                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!$result) {
                        Flasher::setFlash("<span class='font-bold'>PLU TERSEBUT TIDAK ADA!</span>", "Masukkan PLU yang valid", 'red');
                        header('Location: ' . BASEURL . 'check/stmast');
                        exit;
                    } else {
                        foreach ($result as $item) {
                            $recid = $item['RECID'];
                            $prdcd = $item['PRDCD'];
                            $qty = $item['QTY'];
                            $min = $item['MIN'];
                            $max = $item['MAX'];
                            $begbal = $item['BEGBAL'];
                            $lcost = $item['LCOST'];
                            $spd = $item['SPD'];

                            $result[] = array(
                                'recid' => $recid,
                                'prdcd' => $prdcd,
                                'qty' => $qty,
                                'min' => $min,
                                'max' => $max,
                                'begbal' => $begbal,
                                'lcost' => $lcost,
                                'spd' => $spd,
                            );
                            $conn = null;
                        }

                        $data['title'] = 'Check Data';
                        $data['nav'] = 'Stmast';
                        $data['user'] = $_SESSION['nama'];
                        $data['result'] = $result;
                        $this->view('layouts/header', $data);
                        $this->view('layouts/navbar', $data);
                        $this->view('check/stmast', $data);
                        $this->view('layouts/footer');
                    }
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'check/stmast');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'check/stmast');
        }
    }
}
