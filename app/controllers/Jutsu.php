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

    public function settingedc()
    {
        $data['title'] = 'New Jutsu';
        $data['nav'] = 'Setting EDC';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('jutsu/settingedc');
        $this->view('layouts/footer');
    }

    public function settingedcup()
    {
        if (isset($_POST['submit'])) {
            $status = $_POST['status'];
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "NEW JUTSU";
            $action = "UPDATE JENIS DI TABLE CONST DESC EDC";

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'jutsu/settingedc');
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

                    if ($status == 'Y') {
                        $const = "UPDATE const SET jenis='$status' WHERE `desc` LIKE '%edc%'";
                        $prog = "UPDATE program_setting SET nilai='$status' WHERE program LIKE '%edc%' AND jenis LIKE '%bca%'";
                        $vir = "UPDATE vir_bacaprod SET filter='3' WHERE jenis='BTSPURONLINE'";
                    } else {
                        $const = "UPDATE const SET jenis='$status' WHERE `desc` LIKE '%edc%'";
                        $prog = "UPDATE program_setting SET nilai='$status' WHERE program LIKE '%edc%' AND jenis LIKE '%bca%'";
                        $vir = "UPDATE vir_bacaprod SET filter='50' WHERE jenis='BTSPURONLINE'";
                    }

                    $stmt1 = $conn->prepare($const);
                    $stmt2 = $conn->prepare($prog);
                    $stmt3 = $conn->prepare($vir);

                    $stmt1->execute();
                    $stmt2->execute();
                    $stmt3->execute();

                    $data['status'] = true;
                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Close pos kasir dan coba kembali", 'blue');
                    header('Location: ' . BASEURL . 'jutsu/settingedc');
                } catch (PDOException $e) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'jutsu/settingedc');
                }

                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                $data['title'] = 'New Jutsu';
                $data['nav'] = 'Setting EDC';
                $data['user'] = $_SESSION['nama'];
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('jutsu/settingedc', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'jutsu/settingedc');
            exit;
        }
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

            $toko = $this->model('StoreModel')->getStoreByCode();

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

                    $query = "UPDATE const SET docno='$timeout' WHERE rkey IN ('NEB','NEM','NEN','NET','NER')";

                    $stmt1 = $conn->prepare($query);

                    $stmt1->execute();

                    $data['status'] = true;
                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Close pos kasir dan coba kembali", 'blue');
                    header('Location: ' . BASEURL . 'jutsu/timeoutedc');
                } catch (PDOException $e) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'jutsu/timeoutedc');
                }

                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                $data['title'] = 'New Jutsu';
                $data['nav'] = 'Timeout EDC';
                $data['user'] = $_SESSION['nama'];
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

    public function beritaacara()
    {
        $data['title'] = 'New Jutsu';
        $data['nav'] = 'Berita Acara';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('jutsu/beritaacara');
        $this->view('layouts/footer');
    }

    public function beritaacaraup()
    {
        if (isset($_POST['submit'])) {
            $year = date('Y');
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "NEW JUTSU";
            $action = "DROP TABLE BCK_BERITAACARA JIKA ADA, CREATE TABLE BACKUP BERITA ACARA, DELETE TABLE BERITA ACARA DIBAWAH TAHUN $year";

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'jutsu/beritaacara');
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

                    $drop = "DROP TABLE TABLE IF EXIST bck_beritaacara";
                    $create = "CREATE TABLE bck_beritaacara SELECT * FROM beritaacara";
                    $delete = "DELETE FROM beritaacara WHERE YEAR(tglba) < $year";

                    $stmt1 = $conn->prepare($drop);
                    $stmt2 = $conn->prepare($create);
                    $stmt3 = $conn->prepare($delete);

                    $stmt1->execute();
                    $stmt2->execute();
                    $stmt3->execute();

                    $data['status'] = true;

                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Berita acara sudah dihapus", 'blue');
                    header('Location: ' . BASEURL . 'jutsu/beritaacara');
                } catch (PDOException $e) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'jutsu/beritaacara');
                }

                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                $data['title'] = 'New Jutsu';
                $data['nav'] = 'Berita Acara';
                $data['user'] = $_SESSION['nama'];
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('jutsu/beritaacara', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'jutsu/beritaacara');
            exit;
        }
    }

    public function addnik()
    {
        $data['title'] = 'New Jutsu';
        $data['nav'] = 'Tambah NIK';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('jutsu/addnik');
        $this->view('layouts/footer');
    }

    public function addnikup()
    {
        if (isset($_POST['submit'])) {
            $nik = $_POST['nik'];
            $nama = $_POST['nama'];
            $password = $_POST['password'];
            $initial = $_POST['initial'];
            $jabatan = $_POST['jabatan'];
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "NEW JUTSU";
            $action = "INSERT NIK BARU DI TABLE PASSTOKO";

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'jutsu/addnik');
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

                    $insert = "INSERT INTO passtoko (nik,nama,pass,jabatan,initial) VALUES ('$nik','$nama','$password','$jabatan','$initial')";

                    $stmt = $conn->prepare($insert);

                    $stmt->execute();

                    $data['status'] = true;

                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Data toko sudah ditambahkan di passtoko", 'blue');
                    header('Location: ' . BASEURL . 'jutsu/addnik');
                } catch (PDOException $e) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'jutsu/addnik');
                }

                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                $data['title'] = 'New Jutsu';
                $data['nav'] = 'Tambah NIK';
                $data['user'] = $_SESSION['nama'];
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('jutsu/addnik', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'jutsu/addnik');
            exit;
        }
    }

    public function openbkl()
    {
        $data['title'] = 'New Jutsu';
        $data['nav'] = 'Open BKL';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('jutsu/openbkl');
        $this->view('layouts/footer');
    }

    public function openbklup()
    {
        if (isset($_POST['submit'])) {
            $kode_supplier = $_POST['kode_supplier'];
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "NEW JUTSU";
            $action = "UPDATE DATANG, JADWAL, PB OTO, NEW BKL DI TABLE SUPMAST";

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'jutsu/openbkl');
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

                    $supmast = "SELECT * FROM supmast WHERE supco='$kode_supplier'";

                    $stmt1 = $conn->prepare($supmast);

                    $stmt1->execute();

                    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    if (!$result) {
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> SUPPLIER tersebut tidak ada!', 'Masukkan SUPPLIER yang valid', 'red');
                        header('Location: ' . BASEURL . 'check/supmast');
                        exit;
                    } else {
                        $update = "UPDATE supmast SET datang='YYYYYYY', jadwal='YYYYYYY', pb_oto='', new_bkl='' WHERE supco='$kode_supplier'";
                        $stmt1 = $conn->prepare($update);
                        $stmt1->execute();

                        $data['status'] = true;

                        Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode_supplier</span>", "Sudah di open, silahkan proses", 'blue');
                        header('Location: ' . BASEURL . 'jutsu/openbkl');
                    }
                } catch (PDOException $e) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'jutsu/openbkl');
                }

                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                $data['title'] = 'New Jutsu';
                $data['nav'] = 'Open BKL';
                $data['user'] = $_SESSION['nama'];
                $data['result'] = $result;
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('jutsu/openbkl', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'jutsu/openbkl');
            exit;
        }
    }

    public function recalculate()
    {
        $data['title'] = 'New Jutsu';
        $data['nav'] = 'Hitung Ulang Stock';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('jutsu/recalculate');
        $this->view('layouts/footer');
    }

    public function recalculateup()
    {
        if (isset($_POST['submit'])) {
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "NEW JUTSU";
            $action = "UPDATE REDOCNO 0 CONST RKEY HUM";

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'jutsu/recalculate');
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

                    $update = "UPDATE const SET rdocno='0' WHERE rkey='HUM'";

                    $stmt1 = $conn->prepare($update);

                    $stmt1->execute();

                    $data['status'] = true;

                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Close program lalu coba kembali hitung ulang stock", 'blue');
                    header('Location: ' . BASEURL . 'jutsu/recalculate');
                } catch (PDOException $e) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'jutsu/recalculate');
                }

                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                $data['title'] = 'New Jutsu';
                $data['nav'] = 'Hitung Ulang Stock';
                $data['user'] = $_SESSION['nama'];
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('jutsu/recalculate', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'jutsu/recalculate');
            exit;
        }
    }

    public function setting24()
    {
        $data['title'] = 'New Jutsu';
        $data['nav'] = 'Setting 24';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('jutsu/setting24');
        $this->view('layouts/footer');
    }

    public function setting24up()
    {
        if (isset($_POST['submit'])) {
            $setting = $_POST['setting'];
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "NEW JUTSU";
            $action = "UPDATE TOK24 DI TABLE TOKO";

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'jutsu/setting24');
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

                    $update = "UPDATE toko SET tok24='$setting', hari24='YYYYYYY'";

                    $stmt1 = $conn->prepare($update);

                    $stmt1->execute();

                    $data['status'] = true;

                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Sudah diupdate tok24 dan hari24", 'blue');
                    header('Location: ' . BASEURL . 'jutsu/setting24');
                } catch (PDOException $e) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'jutsu/setting24');
                }

                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                $data['title'] = 'New Jutsu';
                $data['nav'] = 'Setting 24';
                $data['user'] = $_SESSION['nama'];
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('jutsu/setting24', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'jutsu/setting24');
            exit;
        }
    }

    public function custdisplay()
    {
        $data['title'] = 'New Jutsu';
        $data['nav'] = 'Customer Display';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('jutsu/custdisplay');
        $this->view('layouts/footer');
    }

    public function custdisplayup()
    {
        if (isset($_POST['submit'])) {
            $setting = $_POST['setting'];
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "NEW JUTSU";
            $action = "UPDATE DOCNO DAN RDOCNO DI TABLE CONST";

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'jutsu/custdisplay');
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

                    $update = "UPDATE const SET docno='$setting', rdocno='$setting' WHERE rkey='CCD'";

                    $stmt1 = $conn->prepare($update);

                    $stmt1->execute();

                    $data['status'] = true;

                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL</span> <span class='font-bold text-info uppercase'>$kode</span>", "Close pos kasir coba kembali", 'blue');
                    header('Location: ' . BASEURL . 'jutsu/custdisplay');
                } catch (PDOException $e) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'jutsu/custdisplay');
                }

                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                $data['title'] = 'New Jutsu';
                $data['nav'] = 'Customer Display';
                $data['user'] = $_SESSION['nama'];
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('jutsu/custdisplay', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'jutsu/custdisplay');
            exit;
        }
    }
}
