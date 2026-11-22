<?php

require_once 'auth.php';
wajib_owner();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Data Pelanggan</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Tambah Data Master Pelanggan Baru</h2>

	<form method="POST" action="simpan_pelanggan.php">
		<p>
			ID Pelanggan <br>
			<input type="text" name="id" placeholder="contoh: PLG006" maxlength="20" required>
		</p>
		<p>
			Nama <br>
			<input type="text" name="nama" maxlength="100" required>
		</p>
		<p>
			Jenis Kelamin <br>
			<select name="jenis_kelamin" required>
				<option value="L">Laki-laki</option>
				<option value="P">Perempuan</option>
			</select>
		</p>
		<p>
			Telp <br>
			<input type="text" name="telp" maxlength="12" required>
		</p>
		<p>
			Alamat <br>
			<input type="text" name="alamat" required>
		</p>
		<button type="submit">Simpan</button>
		<a href="pelanggan.php">Batal</a>
	</form>
</body>
</html>
