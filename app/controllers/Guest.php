<?php

class Guest extends Controller
{
    public function index()
    {
        session_destroy();
        $data['title'] = 'Login';
        $this->view('guest/login', $data);
    }

    public function login()
    {
        if (isset($_POST['submit'])) {
            $user = $this->model('LoginModel')->checkUser($_POST);
            if ($user > 0) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['session_login'] = 'login';

                header('Location: ' . BASEURL);
                exit;
            } else {
                Flasher::setFlash('NIK / Password <span class="font-semibold">SALAH</span>,', ' Silahkan coba lagi', 'red');
                header('Location: ' . BASEURL . 'guest');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . 'guest');
            exit;
        }
    }
}
