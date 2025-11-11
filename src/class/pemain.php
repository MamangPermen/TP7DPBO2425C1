<?php
require_once "config/db.php";

class Pemain {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function getAllPemain() {
        $stmt = $this->db->prepare("SELECT * FROM pemain");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPemain($nama, $posisi, $no_punggung, $usia, $asal) {
        $stmt = $this->db->prepare(
            "INSERT INTO pemain (nama, posisi, no_punggung, usia, asal)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$nama, $posisi, $no_punggung, $usia, $asal]);
    }

    public function updatePemain($id, $nama, $posisi, $no_punggung, $usia, $asal) {
        $stmt = $this->db->prepare(
            "UPDATE pemain
             SET nama=?, posisi=?, no_punggung=?, usia=?, asal=?
             WHERE id_pemain=?"
        );
        $stmt->execute([$nama, $posisi, $no_punggung, $usia, $asal, $id]);
    }

    public function deletePemain($id) {
        $stmt = $this->db->prepare("DELETE FROM pemain WHERE id_pemain=?");
        $stmt->execute([$id]);
    }
}
?>
