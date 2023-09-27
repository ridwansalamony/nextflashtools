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

            $data['store'] = $this->model('StoreModel')->getStore();

            if ($data['store'] > 0) {
                foreach ($data['store'] as $item) {
                    $host = $item['induk'];
                    $user = DB_USER_TOKO;
                    $pass = $_POST['pass'];
                    $name = DB_NAME_TOKO;

                    $tahun = substr(date('y'), 1);
                    $bulan = $_POST['bulan'];
                    $tanggal1 = date('d');
                    $tanggal2 = date('Y-m-d');

                    $conn = new mysqli($host, $user, $pass, $name);

                    $dt = $conn->query("UPDATE const SET `desc`='$tahun$bulan$tanggal1' WHERE rkey IN ('dta','dt_')");
                    $tmt = $conn->query("UPDATE const SET period='$tanggal2', period1='$tanggal2' WHERE rkey='tmt'");

                    if (!$dt && !$tmt) {
                        $data['status'] = false;
                    }

                    $data['status'] = true;
                    $data['title'] = 'Update Prodmast';
                    $data['user'] = $this->model('UserModel')->getUser();
                    $this->view('layouts/header', $data);
                    $this->view('layouts/navbar', $data);
                    $this->view('prodmast/index', $data);
                    $this->view('layouts/footer');
                }
            }
        }

        header('Location: ' . BASEURL . 'prodmast');
    }
}
