<?php

class Home extends Controller
{
    public function index()
    {
        $data['title'] = 'Beranda';

        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('home/index');
        $this->view('layouts/footer');
    }
}
