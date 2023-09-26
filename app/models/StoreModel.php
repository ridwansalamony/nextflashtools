<?php

class StoreModel
{
    private $table = 'daftar_toko';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllStore()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->result();
    }
}
