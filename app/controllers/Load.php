<?php

class Load extends Controller
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

    public function prodmast()
    {
        $data['title'] = 'Load Data';
        $data['nav'] = 'Prodmast';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('load/prodmast', $data);
        $this->view('layouts/footer');
    }

    public function prodmastup()
    {
        if (isset($_POST['submit'])) {
            $tahun = substr(date('y'), 1);
            $bulan = $_POST['bulan'];
            $bln = date('m');
            $tanggal1 = date('d');
            $tanggal2 = date('Y-m-d');
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "LOAD DATA";
            $action = "UPDATE DTA,DT_,TMT DAN TRPR (LOG_MONITOR)";

            try {
                $toko = $this->model('StoreModel')->getStore();
            } catch (Exception $e) {
                Flasher::setFlash("<span class='font-bold'>FORMAT SALAH!</span> Harap masukkan dengan benar!", "<span class='font-bold'>CONTOH : 'TXXX','FXXX'</span>", 'red');
                header('Location: ' . BASEURL . 'load/prodmast');
                exit;
            }

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'load/prodmast');
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

                    $at1 = 'TrPr' . $kode . '';
                    $at2 = '[TrPr' . $kode . '' . $tanggal1 . $bln . $tahun . '.csv]';

                    // Eksekusi
                    $dsn = "mysql:host=$ip;dbname=$name";
                    $option = [
                        PDO::ATTR_PERSISTENT => true,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ];

                    try {
                        $conn = new PDO($dsn, $user, $pass, $option);
                        $querydt = "UPDATE const SET `desc`='$tahun$bulan$tanggal1' WHERE rkey IN ('dta','dt_')";
                        $querytmt = "UPDATE const SET `period`='$tanggal2', period1='$tanggal2' WHERE rkey='tmt'";
                        $querytrpr1 = "DELETE FROM log_monitor WHERE jenis=7 AND waktureport LIKE '$tanggal2%'";
                        $querytrpr2 = "INSERT INTO log_monitor VALUES ('$tanggal_action','7','Monitoring : $at1$tanggal1$bln$tahun$at2')";


                        $stmt1 = $conn->prepare($querydt);
                        $stmt2 = $conn->prepare($querytmt);
                        $stmt3 = $conn->prepare($querytrpr1);
                        $stmt4 = $conn->prepare($querytrpr2);

                        $stmt1->execute();
                        $stmt2->execute();
                        $stmt3->execute();
                        $stmt4->execute();
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

                $data['title'] = 'Load Data';
                $data['nav'] = 'Prodmast';
                $data['user'] = $_SESSION['nama'];
                $data['result'] = $result;
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('load/prodmast', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'load/prodmast');
            exit;
        }
    }

    public function virbacaprod()
    {
        $data['title'] = 'Load Data';
        $data['nav'] = 'Virbacaprod';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('load/virbacaprod', $data);
        $this->view('layouts/footer');
    }

    public function virbacaprodup()
    {
        if (isset($_POST['submit'])) {
            // $array = array(
            //     array("toko" => "TOSD", "nama" => "NAMA", "induk" => "10.56.34.21"),
            //     array("toko" => "TXDS", "nama" => "NAMA", "induk" => "10.56.34.22"),
            // );
            // $file = fopen("d:\\ridwan\\virbacaprod.csv", "w");
            // foreach ($array as $tes) {
            //     fputcsv($file, $tes, '|');
            // }
            // exit;
            $tanggal_action = date("Y-m-d H:i:s");
            $kategori = "LOAD DATA";
            $action = "LOAD ULANG TABLE VIRBACAPROD";

            $toko = $this->model('StoreModel')->getStoreByCode($_POST['kode_toko']);
            $t9t7 = $this->model('StoreModel')->getStoreByCode('T9T7');

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold ">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'load/virbacaprod');
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
                $t9t7_ip = $t9t7['induk'];
                $t9t7_kode = $t9t7['toko'];

                $dsn = "mysql:host=$ip;dbname=$name";

                $option = [
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_LOCAL_INFILE_DIRECTORY => true,
                    PDO::MYSQL_ATTR_LOCAL_INFILE => true
                ];

                try {
                    // Koneksi ke toko sumber data
                    $t9t7_conn = new PDO("mysql:host=$t9t7_ip;dbname=$name", $user, DB_PASS_TOKO_OLD, $option);

                    $queryget = "SELECT * FROM vir_bacaprod";

                    $stmt1 = $t9t7_conn->prepare($queryget);

                    $stmt1->execute();

                    $virbacaprod = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    $file = fopen("d:/ridwan/virbacaprod.csv", "w");

                    foreach ($virbacaprod as $vir) {
                        fputcsv($file, $vir);
                    }
                    fclose($file);
                } catch (PDOException $e1) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL!</span> Koneksi ke toko sumber <span class='font-bold text-info uppercase'>$t9t7_kode</span> GAGAL!", "Periksa koneksi toko / IP toko di daftar toko", "red");
                    header('Location: ' . BASEURL . 'load/virbacaprod');
                    exit;
                }

                try {
                    $conn = new mysqli($ip, $user, $pass, $name);

                    $insert = "LOAD DATA LOCAL INFILE 'd:/ridwan/virbacaprod.csv' INTO TABLE vir_bacaprod FIELDS TERMINATED BY ',' ENCLOSED BY '\"'";

                    $conn->query($insert);

                    $data['status'] = true;

                    Flasher::setFlash("<span class='font-bold'>PROSES BERHASIL!</span> <span class='font-bold text-info uppercase'>$kode</span>", "Load ulang virbacaprod sukses!", 'blue');
                } catch (PDOException $e2) {
                    $data['status'] = false;
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                }

                $this->model('SniperModel')->addSniper($kode, $kategori, $action, $tanggal_action, $data['status']);

                $conn = null;

                $data['title'] = 'Load Data';
                $data['nav'] = 'Virbacaprod';
                $data['user'] = $_SESSION['nama'];
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('load/virbacaprod', $data);
                $this->view('layouts/footer');
            }
        } else {
            header('Location: ' . BASEURL . 'load/virbacaprod');
            exit;
        }
    }
}
