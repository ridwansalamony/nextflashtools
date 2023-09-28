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

    public function getStore()
    {
        $kode = $_POST['kode_toko'];

        $query = "SELECT * FROM daftar_toko WHERE toko in ($kode)";
        $this->db->query($query);
        return $this->db->result();
    }

    public function addStore($data)
    {
        $query = "INSERT INTO daftar_toko VALUES (:toko, :nama, :induk)";

        $this->db->query($query);
        $this->db->bind('toko', $data['kode_toko']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('induk', $data['induk']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteStore($toko)
    {
        $query = "DELETE FROM daftar_toko WHERE toko = :toko";

        $this->db->query($query);
        $this->db->bind('toko', $toko);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
