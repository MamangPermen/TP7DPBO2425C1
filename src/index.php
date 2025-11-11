<?php
// Panggil class utama
require_once 'class/pemain.php';
require_once 'class/jadwal.php';
require_once 'class/statistik.php';

// Inisialisasi objek
$pemain = new Pemain();
$jadwal = new Jadwal();
$statistik = new Statistik();

// Langsung ke halaman pemain sebagai default
$page = isset($_GET['page']) ? $_GET['page'] : 'player';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KING PERSIB</title>
    <link rel="stylesheet" href="style.css">
    <h1>Manajemen Pemain KING PERSIB BANDUNG</h1>
</head>
<body>
    <main>
        <h2>Sistem Manajemen KING PERSIB</h2>

        <!-- Navigasi antar halaman -->
        <nav>
            <a href="index.php?page=player">Pemain</a> |
            <a href="index.php?page=match">Jadwal</a> |
            <a href="index.php?page=stat">Statistik</a>
        </nav>

        <!-- Menentukan halaman yang ditampilkan -->
        <section style="margin-top: 20px;">
            <?php
            switch ($page) {
                case 'player':
                    include 'view/player.php';
                    break;
                case 'match':
                    include 'view/match.php';
                    break;
                case 'stat':
                    include 'view/stat.php';
                    break;
                default:
                    // Kalau page gak dikenali, langsung fallback ke pemain
                    include 'view/player.php';
                    break;
            }
            ?>
        </section>
    </main>
</body>
<footer>
    <p>&copy; 2025 KING PERSIB</p>
</footer>

</html>
