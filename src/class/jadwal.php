<?php
require_once "config/db.php";

class Jadwal {
    private $db;

    // konstruktor
    public function __construct() {
        $database = new Database();
        $this->db = $database->conn;
    }

    // Menampilkan semua data jadwal pertandingan
    public function getAllJadwal() {
        $stmt = $this->db->prepare("SELECT * FROM jadwal ORDER BY tanggal");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menambah jadwal baru
    public function addJadwal($tanggal, $lawan, $tempat) {
        $stmt = $this->db->prepare(
            "INSERT INTO jadwal (tanggal, lawan, tempat) VALUES (?, ?, ?)"
        );
        $stmt->execute([$tanggal, $lawan, $tempat]);
    }

    // Mengubah jadwal berdasarkan ID
    public function updateJadwal($id, $tanggal, $lawan, $tempat) {
        $stmt = $this->db->prepare(
            "UPDATE jadwal SET tanggal=?, lawan=?, tempat=? WHERE id_jadwal=?"
        );
        $stmt->execute([$tanggal, $lawan, $tempat, $id]);
    }

    // Menghapus jadwal berdasarkan ID
    public function deleteJadwal($id) {
        $stmt = $this->db->prepare("DELETE FROM jadwal WHERE id_jadwal=?");
        $stmt->execute([$id]);
    }
}
?>
