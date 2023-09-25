<?php

class Store extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Toko';

        $this->view('layouts/header', $data);
        $this->view('layouts/navbar', $data);
        $this->view('store/index');
        $this->view('layouts/footer');
    }
}
