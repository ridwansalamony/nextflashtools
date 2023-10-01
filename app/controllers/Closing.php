<?php

class Closing extends Controller
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

    public function daily()
    {
        $data['title'] = 'Tutupan Ulang';
        $data['nav'] = 'Tutupan Harian';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('closing/daily');
        $this->view('layouts/footer');
    }

    public function dailyup()
    {
        if (isset($_POST['submit'])) {
            $tanggal_initial = $_POST['tanggal_initial'];
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "TUTUPAN HARIAN ULANG";
            $action = "UPDATE INITIAL RECID P DAN UPDATE CONST PERIOD1 RKEY CON";
            $tanggal_con = date('Y-m-d', strtotime("$tanggal_initial -1 day", strtotime(date("Y-m-d"))));

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'closing/daily');
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

                    $initial = "SELECT * FROM initial WHERE tanggal='$tanggal_initial' ORDER BY station ASC";
                    $stmt1 = $conn->prepare($initial);
                    $stmt1->execute();

                    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    if (!$result) {
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Tanggal initial tidak ada!', 'Masukkan tanggal yang valid', 'red');
                        header('Location: ' . BASEURL . 'closing/daily');
                        exit;
                    } else {
                        foreach ($result as $item) {
                            $kas_aktual = $item['KAS_AKTUAL'];
                            $shift = $item['SHIFT'];
                            $station = $item['STATION'];

                            if ($kas_aktual > 0) {
                                // Update recid P
                                $recid = "UPDATE initial SET recid='P' WHERE tanggal='$tanggal_initial' AND kas_aktual > -1";

                                // Update const rkey con
                                $const = "UPDATE const SET period1='$tanggal_con' WHERE rkey='con'";

                                $stmt2 = $conn->prepare($recid);
                                $stmt3 = $conn->prepare($const);

                                $stmt2->execute();
                                $stmt3->execute();

                                $data['status'] = true;
                            } else {
                                Flasher::setFlash("Station <span class='font-bold'>$station</span> Shift <span class='font-bold'>$shift</span> ", "Belum tutupan shift / aktual kas", 'red');
                                header('Location: ' . BASEURL . 'closing/daily');
                                exit;
                            }
                        }
                        Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Silahkan tutupan harian ulang", 'blue');
                        header('Location: ' . BASEURL . 'closing/daily');
                        $conn = null;
                    }
                    $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", 'Koneksi <span class="font-bold text-info uppercase">' . $kode . '</span> down / Pass SQL Salah!', 'red');
                    header('Location: ' . BASEURL . 'closing/daily');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'closing/daily');
            exit;
        }
    }

    public function monthly()
    {
        $data['title'] = 'Tutupan Ulang';
        $data['nav'] = 'Tutupan Bulanan';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('closing/monthly');
        $this->view('layouts/footer');
    }

    public function monthlyup()
    {
        if (isset($_POST['submit'])) {
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "TUTUPAN BULANAN ULANG";
            $action = "DROP TABLE KODETOKO+PERIODE, UPDATE CONST DOCNO O RKEY LPB, UPDATE CONST DOCNO RKEY PRD";
            $periode = $_POST['periode'];
            $prd = date('Ym') - 1;

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'closing/monthly');
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

                    $drop = "DROP TABLE $kode$periode";
                    $update1 = "UPDATE const SET docno='0',rdocno='0' WHERE rkey='LPB'";
                    $update2 = "UPDATE const SET docno='$prd' WHERE rkey='PRD'";

                    $stmt1 = $conn->prepare($drop);
                    $stmt2 = $conn->prepare($update1);
                    $stmt3 = $conn->prepare($update2);

                    $stmt1->execute();
                    $stmt2->execute();
                    $stmt3->execute();

                    $data['status'] = true;

                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Silahkan tutupan bulanan ulang", 'blue');
                    header('Location: ' . BASEURL . 'closing/monthly');
                    $conn = null;
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'closing/monthly');
                }
                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);
            }
        } else {
            header('Location: ' . BASEURL . 'closing/monthly');
            exit;
        }
    }

    public function initial()
    {
        $data['title'] = 'Tutupan Ulang';
        $data['nav'] = 'Initial C';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('closing/initial');
        $this->view('layouts/footer');
    }

    public function initialup()
    {
        if (isset($_POST['submit'])) {

            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "INITIAL C";
            $action = "UPDATE INITIAL RECID C";
            $tanggal_initial = $_POST['tanggal_initial'];

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'closing/initial');
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

                    $initial = "SELECT * FROM initial WHERE tanggal='$tanggal_initial'";
                    $stmt1 = $conn->prepare($initial);
                    $stmt1->execute();

                    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    if (!$result) {
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Tanggal initial tidak ada!', 'Masukkan tanggal yang valid', 'red');
                        header('Location: ' . BASEURL . 'closing/initial');
                        exit;
                    } else {
                        // Update recid C
                        $recid = "UPDATE initial SET recid='C' WHERE tanggal='$tanggal_initial'";

                        $stmt2 = $conn->prepare($recid);

                        $stmt2->execute();

                        $data['status'] = true;
                    }
                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Update recid C initial", 'blue');
                    header('Location: ' . BASEURL . 'closing/initial');
                    $conn = null;
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'closing/initial');
                }
                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);
            }
        } else {
            header('Location: ' . BASEURL . 'closing/initial');
            exit;
        }
    }
}
