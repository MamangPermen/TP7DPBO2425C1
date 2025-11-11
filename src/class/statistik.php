<?php
require_once "config/db.php";

class Statistik {
    private $db;

    // konstruktor
    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Ambil semua statistik per pemain
    public function getAllStat() {
        $stmt = $this->db->prepare("
            SELECT s.*, p.nama AS nama_pemain, p.posisi, p.no_punggung
            FROM statistik s
            JOIN pemain p ON s.id_pemain = p.id_pemain
            ORDER BY s.id_stat ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambah atau update statistik pemain (1 pemain = 1 baris)
    public function addOrUpdateStat($id_pemain, $penampilan, $gol, $assist, $kuning, $merah) {
        // Cek apakah pemain sudah punya data
        $check = $this->db->prepare("SELECT id_stat FROM statistik WHERE id_pemain = ?");
        $check->execute([$id_pemain]);
        $existing = $check->fetchColumn();

        if ($existing) { // Jika sudah ada, lakukan update
            $stmt = $this->db->prepare(
                "UPDATE statistik SET penampilan=?, gol=?, assist=?, kartu_kuning=?, kartu_merah=? WHERE id_pemain=?"
            );
            return $stmt->execute([$penampilan, $gol, $assist, $kuning, $merah, $id_pemain]);
        } else { // Jika belum ada, lakukan insert baru
            $stmt = $this->db->prepare(
                "INSERT INTO statistik (id_pemain, penampilan, gol, assist, kartu_kuning, kartu_merah)
                 VALUES (?, ?, ?, ?, ?, ?)"
            );
            return $stmt->execute([$id_pemain, $penampilan, $gol, $assist, $kuning, $merah]);
        }
    }

    // Menghapus data statistik berdasarkan ID
    public function deleteStat($id) {
        $stmt = $this->db->prepare("DELETE FROM statistik WHERE id_stat=?");
        return $stmt->execute([$id]);
    }
}
?>
