<?php

class Prodmast extends Controller
{
    public function index()
    {
        $data['title'] = 'Update Prodmast';
        $data['user'] = $this->model('UserModel')->getUser();
        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('prodmast/index');
        $this->view('layouts/footer');
    }

    public function update()
    {
        if (isset($_POST['submit'])) {
            date_default_timezone_set('Asia/Jakarta');

            try {
                $toko = $this->model('StoreModel')->getStore();
            } catch (Exception $e) {
                Flasher::setFlash("<span class='font-semibold'>FORMAT SALAH</span>, Harap masukkan dengan benar!", "<span class='font-semibold'>CONTOH : 'TXXX','FXXX'</span>", 'red');
                header('Location: ' . BASEURL . 'prodmast');
                exit;
            }

            if ($toko) {
                $user = DB_USER_TOKO;
                $name = DB_NAME_TOKO;
                if ($_POST['pass'] === 'old') {
                    $pass = DB_PASS_TOKO_OLD;
                } else {
                    $pass = DB_PASS_TOKO_NEW;
                }

                $tahun = substr(date('y'), 1);
                $bulan = $_POST['bulan'];
                $tanggal1 = date('d');
                $tanggal2 = date('Y-m-d');

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
                        $querydt = "UPDATE const SET `desc`='$tahun$bulan$tanggal1' WHERE rkey IN ('dta','dt_')";
                        $querytmt = "UPDATE const SET `period`='$tanggal2', period1='$tanggal2' WHERE rkey='tmt'";

                        $stmt1 = $conn->prepare($querydt);

                        $stmt2 = $conn->prepare($querytmt);

                        $stmt1->execute();
                        $stmt2->execute();
                        $data['status'] = true;
                    } catch (PDOException $e) {
                        $data['status'] = false;
                    }

                    $result[] = array(
                        'kode' => $kode,
                        'nama' => $nama,
                        'status' => $data['status']
                    );
                }
                $conn = null;
                $data['title'] = 'Update Prodmast';
                $data['user'] = $this->model('UserModel')->getUser();
                $data['result'] = $result;
                $this->view('layouts/header', $data);
                $this->view('layouts/navbar', $data);
                $this->view('prodmast/index', $data);
                $this->view('layouts/footer');
            } else {
                Flasher::setFlash("<span class='font-semibold'>KODE TOKO TIDAK ADA!</span>", "Silahkan tambah di menu daftar toko", 'red');
                header('Location: ' . BASEURL . 'prodmast');
            }
        } else {
            header('Location: ' . BASEURL . 'prodmast');
        }
    }
}
