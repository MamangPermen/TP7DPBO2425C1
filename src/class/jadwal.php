<?php
require_once "config/db.php";

class Jadwal {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function getAllJadwal() {
        $stmt = $this->db->prepare("SELECT * FROM jadwal ORDER BY tanggal");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addJadwal($tanggal, $lawan, $tempat) {
        $stmt = $this->db->prepare(
            "INSERT INTO jadwal (tanggal, lawan, tempat) VALUES (?, ?, ?)"
        );
        $stmt->execute([$tanggal, $lawan, $tempat]);
    }

    public function updateJadwal($id, $tanggal, $lawan, $tempat) {
        $stmt = $this->db->prepare(
            "UPDATE jadwal SET tanggal=?, lawan=?, tempat=? WHERE id_jadwal=?"
        );
        $stmt->execute([$tanggal, $lawan, $tempat, $id]);
    }

    public function deleteJadwal($id) {
        $stmt = $this->db->prepare("DELETE FROM jadwal WHERE id_jadwal=?");
        $stmt->execute([$id]);
    }
}
?>
