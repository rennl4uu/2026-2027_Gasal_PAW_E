<?php

require_once 'auth.php';
wajib_owner();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Data User</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Tambah Data Master User Baru</h2>

	<form method="POST" action="simpan_user.php">
		<p>
			Username <br>
			<input type="text" name="username" maxlength="30" required>
		</p>
		<p>
			Password <br>
			<input type="password" name="password" maxlength="30" required>
		</p>
		<p>
			Nama <br>
			<input type="text" name="nama" maxlength="50" required>
		</p>
		<p>
			Alamat <br>
			<input type="text" name="alamat" maxlength="150" required>
		</p>
		<p>
			HP <br>
			<input type="text" name="hp" maxlength="20" required>
		</p>
		<p>
			Level <br>
			<select name="level" required>
				<option value="1">1 - Owner</option>
				<option value="2">2 - Kasir</option>
				<option value="3">3 - Gudang (belum bisa login)</option>
			</select>
		</p>
		<button type="submit">Simpan</button>
		<a href="user.php">Batal</a>
	</form>
</body>
</html>
