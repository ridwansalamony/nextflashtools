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
        header('Location: ' . BASEURL);
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
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
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
                        }

                        $conn = null;

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
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
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
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
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

                    $mtran = "SELECT * FROM mtran WHERE plu LIKE '%$plu%' AND docnoenc LIKE '%$struk%' AND shift LIKE '%$shift%' AND station LIKE '%$station%' AND tanggal LIKE '%$tanggal%' ORDER BY tanggal DESC";

                    $stmt = $conn->prepare($mtran);

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
                        }

                        $conn = null;

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
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'check/mtran');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'check/mtran');
        }
    }

    public function prodmast()
    {
        $data['title'] = 'Check Data';
        $data['nav'] = 'Prodmast';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('check/prodmast');
        $this->view('layouts/footer');
    }

    public function prodmastup()
    {
        if (isset($_POST['submit'])) {
            $plu = $_POST['plu'];

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'check/prodmast');
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

                    $prodmast = "SELECT * FROM prodmast WHERE prdcd in ($plu)";

                    $stmt = $conn->prepare($prodmast);

                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!$result) {
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> PLU tersebut tidak ada!', 'Masukkan PLU yang valid', 'red');
                        header('Location: ' . BASEURL . 'check/prodmast');
                        exit;
                    } else {
                        foreach ($result as $item) {
                            $recid = $item['RECID'];
                            $ket = $item['KET'];
                            $cat = $item['CAT_COD'];
                            $prdcd = $item['PRDCD'];
                            $merk = $item['MERK'];
                            $nama = $item['NAMA'];
                            $size = $item['SIZE'];
                            $acost = $item['ACOST'];
                            $lcost = $item['LCOST'];
                            $rcost = $item['RCOST'];
                            $price = $item['PRICE'];
                            $ctgr = $item['CTGR'];
                            $supco = $item['SUPCO'];
                            $reorder = $item['REORDER'];
                            $flagprod = $item['FLAGPROD'];
                            $status = $item['STATUS_RETUR'];

                            $result[] = array(
                                'recid' => $recid,
                                'ket' => $ket,
                                'cat' => $cat,
                                'prdcd' => $prdcd,
                                'merk' => $merk,
                                'nama' => $nama,
                                'size' => $size,
                                'acost' => $acost,
                                'lcost' => $lcost,
                                'rcost' => $rcost,
                                'price' => $price,
                                'ctgr' => $ctgr,
                                'supco' => $supco,
                                'reorder' => $reorder,
                                'flagprod' => $flagprod,
                                'status' => $status,
                            );
                        }

                        $conn = null;

                        $data['title'] = 'Check Data';
                        $data['nav'] = 'Prodmast';
                        $data['user'] = $_SESSION['nama'];
                        $data['result'] = $result;
                        $this->view('layouts/header', $data);
                        $this->view('layouts/navbar', $data);
                        $this->view('check/prodmast', $data);
                        $this->view('layouts/footer');
                    }
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'check/prodmast');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'check/prodmast');
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
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
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
                        }

                        $conn = null;

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
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'check/stmast');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'check/stmast');
        }
    }

    public function supmast()
    {
        $data['title'] = 'Check Data';
        $data['nav'] = 'Supmast';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('check/supmast');
        $this->view('layouts/footer');
    }

    public function supmastup()
    {
        if (isset($_POST['submit'])) {
            $kode_supplier = $_POST['kode_supplier'];

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'check/supmast');
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

                    $supmast = "SELECT * FROM supmast WHERE supco in ('$kode_supplier')";

                    $stmt = $conn->prepare($supmast);

                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!$result) {
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> SUPPLIER tersebut tidak ada!', 'Masukkan SUPPLIER yang valid', 'red');
                        header('Location: ' . BASEURL . 'check/supmast');
                        exit;
                    } else {
                        foreach ($result as $item) {
                            $supco = $item['SUPCO'];
                            $nama = $item['NAMA'];
                            $jadwal = $item['JADWAL'];
                            $datang = $item['DATANG'];
                            $pb_oto = $item['PB_OTO'];
                            $new_bkl = $item['NEW_BKL'];

                            $result[] = array(
                                'supco' => $supco,
                                'nama' => $nama,
                                'jadwal' => $jadwal,
                                'datang' => $datang,
                                'pb_oto' => $pb_oto,
                                'new_bkl' => $new_bkl,
                            );
                        }

                        $conn = null;

                        $data['title'] = 'Check Data';
                        $data['nav'] = 'Supmast';
                        $data['user'] = $_SESSION['nama'];
                        $data['result'] = $result;
                        $this->view('layouts/header', $data);
                        $this->view('layouts/navbar', $data);
                        $this->view('check/supmast', $data);
                        $this->view('layouts/footer');
                    }
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'check/supmast');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'check/supmast');
        }
    }

    public function passtoko()
    {
        $data['title'] = 'Check Data';
        $data['nav'] = 'Passtoko';
        $data['user'] = $_SESSION['nama'];
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('check/passtoko');
        $this->view('layouts/footer');
    }

    public function passtokoup()
    {
        if (isset($_POST['submit'])) {
            $nik = $_POST['nik'];

            $toko = $this->model('StoreModel')->getStoreByCode();

            if (!$toko) {
                Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> Data toko <span class="text-info font-bold uppercase">' . $_POST['kode_toko'] . '</span> tidak ada!', 'Silahkan tambah di menu Daftar Toko', 'red');
                header('Location: ' . BASEURL . 'check/passtoko');
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

                    $supmast = "SELECT * FROM passtoko WHERE nik in ($nik)";

                    $stmt = $conn->prepare($supmast);

                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!$result) {
                        Flasher::setFlash('<span class="font-bold">PROSES GAGAL!</span> NIK tersebut tidak ada!', 'Masukkan NIK yang valid / Tambah NIK di menu Jutsu', 'red');
                        header('Location: ' . BASEURL . 'check/passtoko');
                        exit;
                    } else {
                        foreach ($result as $item) {
                            $nik = $item['NIK'];
                            $nama = $item['NAMA'];
                            $jabatan = $item['JABATAN'];
                            $password = $item['PASS'];

                            $result[] = array(
                                'nik' => $nik,
                                'nama' => $nama,
                                'jabatan' => $jabatan,
                                'password' => $password,
                            );
                        }

                        $conn = null;

                        $data['title'] = 'Check Data';
                        $data['nav'] = 'Passtoko';
                        $data['user'] = $_SESSION['nama'];
                        $data['result'] = $result;
                        $this->view('layouts/header', $data);
                        $this->view('layouts/navbar', $data);
                        $this->view('check/passtoko', $data);
                        $this->view('layouts/footer');
                    }
                } catch (PDOException $e) {
                    Flasher::setFlash("<span class='font-bold'>PROSES GAGAL</span>", "Koneksi <span class='font-bold text-info uppercase'>$kode</span> down / Pass SQL Salah!", 'red');
                    header('Location: ' . BASEURL . 'check/passtoko');
                }
            }
        } else {
            header('Location: ' . BASEURL . 'check/passtoko');
        }
    }
}
