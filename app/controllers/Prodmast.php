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
        date_default_timezone_set('Asia/Jakarta');

        $data = $this->model('StoreModel')->getStore();

        foreach ($data as $item) {
            $host = $item['induk'];
            $kode = $item['toko'];
            $user = DB_USER_TOKO;
            $pass = DB_PASS_TOKO;
            $name = DB_NAME_TOKO;

            $conn = mysqli_connect($host, $user, $pass, $name);
            if (!$conn) {
                $data['status'] = 'Gagal' . mysqli_connect_error();
                die;
            } else {
                $data['status'] = 'Berhasil';
                $tahun = substr(date('y'), 1);
                $bulan = $_POST['bulan'];
                $tanggal1 = date('d');
                $tanggal2 = date('Y-m-d');

                $const = mysqli_query($conn, "SELECT * FROM const WHERE rkey in ('dta', 'dt_','tmt')");

                if (mysqli_num_rows($const)) {
                    $query1 = "UPDATE const SET `desc`='$tahun$bulan$tanggal1' WHERE rkey='dta'";
                    $result = mysqli_query($conn, $query1);

                    $query2 = "UPDATE const SET `desc`='$tahun$bulan$tanggal1' WHERE rkey='dt_'";
                    $result = mysqli_query($conn, $query2);

                    $query3 = "UPDATE const SET period='$tanggal2', period1='$tanggal2' WHERE rkey='tmt'";
                    $result = mysqli_query($conn, $query3);

                    if (!$result) {
                        $data['status'] = 'Gagal' . mysqli_connect_error();
                        die;
                    } else {
                        $data['title'] = 'Update Prodmast';
                        $data['user'] = $this->model('UserModel')->getUser();
                        $data['status'] = 'Berhasil';
                        $data['result'] = $kode;
                        $this->view('layouts/header', $data);
                        $this->view('layouts/navbar', $data);
                        $this->view('prodmast/index', $data);
                        $this->view('layouts/footer');
                    }
                }
            }
        }
    }
}
