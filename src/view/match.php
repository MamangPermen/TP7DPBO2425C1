<?php
require_once 'class/Jadwal.php';
$jadwal = new Jadwal();

// Hapus
if (isset($_GET['delete_id'])) {
    $jadwal->deleteJadwal($_GET['delete_id']);
    header("Location: index.php?page=match");
    exit;
}

// Tambah / Update
if (isset($_POST['save'])) {
    if (!empty($_POST['id_jadwal'])) {
        $jadwal->updateJadwal($_POST['id_jadwal'], $_POST['tanggal'], $_POST['lawan'], $_POST['tempat']);
    } else {
        $jadwal->addJadwal($_POST['tanggal'], $_POST['lawan'], $_POST['tempat']);
    }
    header("Location: index.php?page=match");
    exit;
}

// Ambil data edit
$edit_data = null;
if (isset($_GET['edit_id'])) {
    foreach ($jadwal->getAllJadwal() as $j) {
        if ($j['id_jadwal'] == $_GET['edit_id']) {
            $edit_data = $j;
            break;
        }
    }
}

$data = $jadwal->getAllJadwal();
?>

<h3><?= $edit_data ? "Edit Jadwal" : "Tambah Jadwal Baru" ?></h3>

<!-- Form Tambah/ edit -->
<form method="post">
    <?php if ($edit_data): ?>
        <input type="hidden" name="id_jadwal" value="<?= $edit_data['id_jadwal'] ?>">
    <?php endif; ?>
    <input type="date" name="tanggal" value="<?= $edit_data['tanggal'] ?? '' ?>" required>
    <input type="text" name="lawan" placeholder="Lawan" value="<?= $edit_data['lawan'] ?? '' ?>" required>
    <input type="text" name="tempat" placeholder="Tempat" value="<?= $edit_data['tempat'] ?? '' ?>" required>
    <button type="submit" name="save"><?= $edit_data ? "Update" : "Tambah" ?></button>
    <?php if ($edit_data): ?><a href="index.php?page=match">Batal</a><?php endif; ?>
</form>

<!-- Tabel -->
<h3>Daftar Jadwal Pertandingan</h3>
<table border="1" cellpadding="6">
  <tr>
    <th>No</th><th>Tanggal</th><th>Lawan</th><th>Tempat</th><th>Aksi</th>
  </tr>
  <?php $no = 1; foreach ($data as $j): ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= $j['tanggal'] ?></td>
    <td><?= htmlspecialchars($j['lawan']) ?></td>
    <td><?= htmlspecialchars($j['tempat']) ?></td>
    <td>
      <a href="index.php?page=match&edit_id=<?= $j['id_jadwal'] ?>">Edit</a> |
      <a href="index.php?page=match&delete_id=<?= $j['id_jadwal'] ?>" onclick="return confirm('Hapus jadwal ini?')">Hapus</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
