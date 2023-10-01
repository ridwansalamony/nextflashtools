<?php

class SniperModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addSniper($kode, $kategori, $action, $tanggal, $stat)
    {
        if (!$stat) {
            $stat = 'GAGAL';
        } else {
            $stat = 'BERHASIL';
        }

        $query = "INSERT INTO sniper VALUES ('', :kode, :kategori, :action, :tanggal, :stat)";

        $this->db->query($query);
        $this->db->bind('kode', $kode);
        $this->db->bind('kategori', $kategori);
        $this->db->bind('action', $action);
        $this->db->bind('tanggal', $tanggal);
        $this->db->bind('stat', $stat);

        $this->db->execute();
    }
}
