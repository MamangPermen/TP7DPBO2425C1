<?php
require_once 'class/Statistik.php';
require_once 'class/Pemain.php';

$stat = new Statistik();
$pemain = new Pemain();

// Hapus data statistik
if (isset($_GET['delete_id'])) {
    $stat->deleteStat($_GET['delete_id']);
    header("Location: index.php?page=stat");
    exit;
}

// Tambah atau update data total pemain
if (isset($_POST['save'])) {
    $stat->addOrUpdateStat(
        $_POST['id_pemain'],
        $_POST['penampilan'],
        $_POST['gol'],
        $_POST['assist'],
        $_POST['kartu_kuning'],
        $_POST['kartu_merah']
    );
    header("Location: index.php?page=stat");
    exit;
}

// Ambil data edit (jika ada)
$edit_data = null;
if (isset($_GET['edit_id'])) {
    foreach ($stat->getAllStat() as $row) {
        if ($row['id_stat'] == $_GET['edit_id']) {
            $edit_data = $row;
            break;
        }
    }
}

$data = $stat->getAllStat();
$listPemain = $pemain->getAllPemain();
?>

<h3><?= $edit_data ? "Edit Statistik Pemain" : "Tambah Statistik Pemain" ?></h3>
<form method="post">
    <select name="id_pemain" required <?= $edit_data ? 'disabled' : '' ?>>
        <option value="">Pilih Pemain</option>
        <?php foreach ($listPemain as $p): ?>
            <option value="<?= $p['id_pemain'] ?>"
                <?= ($edit_data && $edit_data['id_pemain'] == $p['id_pemain']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="number" name="penampilan" placeholder="Penampilan" value="<?= $edit_data['penampilan'] ?? '' ?>" required>
    <input type="number" name="gol" placeholder="Gol" value="<?= $edit_data['gol'] ?? '' ?>" required>
    <input type="number" name="assist" placeholder="Assist" value="<?= $edit_data['assist'] ?? '' ?>" required>
    <input type="number" name="kartu_kuning" placeholder="Kartu Kuning" value="<?= $edit_data['kartu_kuning'] ?? '' ?>" required>
    <input type="number" name="kartu_merah" placeholder="Kartu Merah" value="<?= $edit_data['kartu_merah'] ?? '' ?>" required>

    <?php if ($edit_data): ?>
        <input type="hidden" name="id_pemain" value="<?= $edit_data['id_pemain'] ?>">
    <?php endif; ?>

    <button type="submit" name="save"><?= $edit_data ? "Update" : "Simpan" ?></button>
    <?php if ($edit_data): ?>
        <a href="index.php?page=stat">Batal</a>
    <?php endif; ?>
</form>

<h3>Daftar Statistik Pemain Musim Ini (Liga)</h3>

<!-- Input cari pemain -->
<input type="text" id="searchStat" placeholder="Cari pemain...">

<table border="1" cellpadding="6">
  <tr>
    <th>No</th><th>Nama</th><th>Posisi</th><th>No Punggung</th>
    <th>Penampilan</th><th>Gol</th><th>Assist</th><th>Kartu Kuning</th><th>Kartu Merah</th><th>Aksi</th>
  </tr>
  <?php $no = 1; foreach ($data as $s): ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($s['nama_pemain']) ?></td>
    <td><?= htmlspecialchars($s['posisi']) ?></td>
    <td><?= $s['no_punggung'] ?></td>
    <td><?= $s['penampilan'] ?></td>
    <td><?= $s['gol'] ?></td>
    <td><?= $s['assist'] ?></td>
    <td><?= $s['kartu_kuning'] ?></td>
    <td><?= $s['kartu_merah'] ?></td>
    <td>
      <a href="index.php?page=stat&edit_id=<?= $s['id_stat'] ?>">Edit</a> |
      <a href="index.php?page=stat&delete_id=<?= $s['id_stat'] ?>" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

<script>
document.getElementById('searchStat').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('table tr');
    rows.forEach((row, index) => {
        if (index === 0) return; // skip header
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>
