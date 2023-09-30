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
            $tanggal = $_POST['tanggal_proses'];

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
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

                    $mstran = "SELECT * FROM mstran WHERE prdcd LIKE '%$plu%' AND invno LIKE '%$npb%' AND bukti_tgl LIKE '%$tanggal%' ORDER BY bukti_tgl DESC";

                    $stmt = $conn->prepare($mstran);

                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!$result) {
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data mstran tidak ada!', 'Masukkan data yang valid', 'red');
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

    public function mtran()
    {
        $data['title'] = 'Check Data';
        $data['nav'] = 'Mtran';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('check/mtran');
        $this->view('layouts/footer');
    }

    public function mtranup()
    {
        if (isset($_POST['submit'])) {
            $plu = $_POST['plu'];
            $shift = $_POST['shift'];
            $station = $_POST['station'];
            $struk = $_POST['struk'];
            $tanggal = $_POST['tanggal_proses'];

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'check/mtran');
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

                    $mstran = "SELECT * FROM mtran WHERE plu LIKE '%$plu%' AND docnoenc LIKE '%$struk%' AND shift LIKE '%$shift%' AND station LIKE '%$station%' AND tanggal LIKE '%$tanggal%' ORDER BY tanggal DESC";

                    $stmt = $conn->prepare($mstran);

                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!$result) {
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data mtran tidak ada!', 'Masukkan data yang valid', 'red');
                        header('Location: ' . BASEURL . 'check/mtran');
                        exit;
                    } else {
                        foreach ($result as $item) {
                            $plu = $item['PLU'];
                            $shift = $item['SHIFT'];
                            $station = $item['STATION'];
                            $struk = $item['DOCNOENC'];
                            $qty = $item['QTY'];
                            $price = $item['PRICE'];
                            $gross = $item['GROSS'];
                            $tanggal = $item['TANGGAL'];
                            $jam = $item['JAM'];

                            $result[] = array(
                                'plu' => $plu,
                                'shift' => $shift,
                                'station' => $station,
                                'struk' => $struk,
                                'qty' => $qty,
                                'price' => $price,
                                'gross' => $gross,
                                'tanggal' => $tanggal,
                                'jam' => $jam,
                            );
                            $conn = null;
                        }

                        $data['title'] = 'Check Data';
                        $data['nav'] = 'Mtran';
                        $data['user'] = $_SESSION['nama'];
                        $data['result'] = $result;
                        $this->view('layouts/header', $data);
                        $this->view('layouts/navbar', $data);
                        $this->view('check/mtran', $data);
                        $this->view('layouts/footer');
                    }
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'check/mtran');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'check/mtran');
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
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
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
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> PLU tersebut tidak ada!', 'Masukkan PLU yang valid', 'red');
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
