<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$id = $_GET['id'];
$pelanggan = $DBH->prepare("SELECT * FROM pelanggan WHERE id = ?");
$pelanggan->execute([$id]);
$data = $pelanggan->fetch();

// Jika data tidak ditemukan
if (!$data) {
	header('Location: pelanggan.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Data Pelanggan</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Edit Data Master Pelanggan</h2>

	<form method="POST" action="update-pelanggan.php">
		<input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
		<p>
			ID Pelanggan <br>
			<input type="text" value="<?= htmlspecialchars($data['id']) ?>" disabled>
		</p>
		<p>
			Nama <br>
			<input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" maxlength="100" required>
		</p>
		<p>
			Jenis Kelamin <br>
			<select name="jenis_kelamin" required>
				<option value="L" <?php if ($data['jenis_kelamin'] == 'L') echo 'selected' ?>>Laki-laki</option>
				<option value="P" <?php if ($data['jenis_kelamin'] == 'P') echo 'selected' ?>>Perempuan</option>
			</select>
		</p>
		<p>
			Telp <br>
			<input type="text" name="telp" value="<?= htmlspecialchars($data['telp']) ?>" maxlength="12" required>
		</p>
		<p>
			Alamat <br>
			<input type="text" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" required>
		</p>
		<button type="submit">Update</button>
		<a href="pelanggan.php">Batal</a>
	</form>
</body>
</html>
