<?php
require_once 'class/Pemain.php';
$pemain = new Pemain();

// Hapus
if (isset($_GET['delete_id'])) {
    $pemain->deletePemain($_GET['delete_id']);
    header("Location: index.php?page=player");
    exit;
}

// Tambah / Update
if (isset($_POST['save'])) {
    if (!empty($_POST['id_pemain'])) {
        $pemain->updatePemain(
            $_POST['id_pemain'],
            $_POST['nama'],
            $_POST['posisi'],
            $_POST['no_punggung'],
            $_POST['usia'],
            $_POST['asal']
        );
    } else {
        $pemain->addPemain(
            $_POST['nama'],
            $_POST['posisi'],
            $_POST['no_punggung'],
            $_POST['usia'],
            $_POST['asal']
        );
    }
    header("Location: index.php?page=player");
    exit;
}

// Ambil data edit
$edit_data = null;
if (isset($_GET['edit_id'])) {
    foreach ($pemain->getAllPemain() as $p) {
        if ($p['id_pemain'] == $_GET['edit_id']) {
            $edit_data = $p;
            break;
        }
    }
}

$data = $pemain->getAllPemain();
?>

<h3><?= $edit_data ? "Edit Pemain" : "Tambah Pemain Baru" ?></h3>
<form method="post">
    <?php if ($edit_data): ?>
        <input type="hidden" name="id_pemain" value="<?= $edit_data['id_pemain'] ?>">
    <?php endif; ?>

    <input type="text" name="nama" placeholder="Nama" value="<?= $edit_data['nama'] ?? '' ?>" required>

    <!-- Dropdown posisi -->
    <select name="posisi" required>
        <option value="">Pilih Posisi</option>
        <?php
        $posisiList = ["GK", "LB", "RB", "CB", "CM", "CAM", "CDM", "RW", "LW", "CF"];
        foreach ($posisiList as $pos) {
            $selected = ($edit_data && $edit_data['posisi'] == $pos) ? 'selected' : '';
            echo "<option value='$pos' $selected>$pos</option>";
        }
        ?>
    </select>

    <input type="number" name="no_punggung" placeholder="No Punggung" value="<?= $edit_data['no_punggung'] ?? '' ?>" required>
    <input type="number" name="usia" placeholder="Usia" value="<?= $edit_data['usia'] ?? '' ?>" required>
    <input type="text" name="asal" placeholder="Asal" value="<?= $edit_data['asal'] ?? '' ?>" required>

    <button type="submit" name="save"><?= $edit_data ? "Update" : "Tambah" ?></button>
    <?php if ($edit_data): ?><a href="index.php?page=player">Batal</a><?php endif; ?>
</form>

<h3>Daftar Pemain</h3>

<!-- Input cari pemain -->
<input type="text" id="searchPlayer" placeholder="Cari pemain...">

<table border="1" cellpadding="6">
  <tr>
    <th>No</th><th>Nama</th><th>Posisi</th><th>No Punggung</th><th>Usia</th><th>Asal</th><th>Aksi</th>
  </tr>
  <?php $no = 1; foreach ($data as $p): ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($p['nama']) ?></td>
    <td><?= htmlspecialchars($p['posisi']) ?></td>
    <td><?= $p['no_punggung'] ?></td>
    <td><?= $p['usia'] ?></td>
    <td><?= htmlspecialchars($p['asal']) ?></td>
    <td>
      <a href="index.php?page=player&edit_id=<?= $p['id_pemain'] ?>">Edit</a> |
      <a href="index.php?page=player&delete_id=<?= $p['id_pemain'] ?>" onclick="return confirm('Yakin hapus pemain ini?')">Hapus</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

<script>
document.getElementById('searchPlayer').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('table tr');
    rows.forEach((row, index) => {
        if (index === 0) return; // skip header
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>