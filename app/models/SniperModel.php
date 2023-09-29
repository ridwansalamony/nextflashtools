<?php

class SniperModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addSniper($kode, $stat, $tanggal, $kategori)
    {
        if (!$stat) {
            $stat = 'GAGAL';
        } else {
            $stat = 'BERHASIL';
        }

        $query = "INSERT INTO sniper VALUES ('', :kode, :stat, :tanggal, :kategori)";

        $this->db->query($query);
        $this->db->bind('kode', $kode);
        $this->db->bind('stat', $stat);
        $this->db->bind('tanggal', $tanggal);
        $this->db->bind('kategori', $kategori);

        $this->db->execute();
    }
}
