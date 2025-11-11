<?php
require_once "config/db.php";

class Pemain {
    private $db;

    // konstruktor
    public function __construct() {
        $database = new Database();
        $this->db = $database->conn;
    }

    // // Mengambil semua data pemain dari tabel
    public function getAllPemain() {
        $stmt = $this->db->prepare("SELECT * FROM pemain");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menambahkan pemain baru ke database
    public function addPemain($nama, $posisi, $no_punggung, $usia, $asal) {
        $stmt = $this->db->prepare(
            "INSERT INTO pemain (nama, posisi, no_punggung, usia, asal)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$nama, $posisi, $no_punggung, $usia, $asal]);
    }

    // Memperbarui data pemain berdasarkan ID
    public function updatePemain($id, $nama, $posisi, $no_punggung, $usia, $asal) {
        $stmt = $this->db->prepare(
            "UPDATE pemain
             SET nama=?, posisi=?, no_punggung=?, usia=?, asal=?
             WHERE id_pemain=?"
        );
        $stmt->execute([$nama, $posisi, $no_punggung, $usia, $asal, $id]);
    }

    // Menghapus data pemain berdasarkan ID
    public function deletePemain($id) {
        $stmt = $this->db->prepare("DELETE FROM pemain WHERE id_pemain=?");
        $stmt->execute([$id]);
    }
}
?>
