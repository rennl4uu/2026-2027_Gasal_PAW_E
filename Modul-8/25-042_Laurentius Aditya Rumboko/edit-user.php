<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$id = $_GET['id'];
$user = $DBH->prepare("SELECT * FROM user WHERE id_user = ?");
$user->execute([$id]);
$data = $user->fetch();

// Jika data tidak ditemukan
if (!$data) {
	header('Location: user.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Data User</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Edit Data Master User</h2>

	<form method="POST" action="update-user.php">
		<input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
		<p>
			Username <br>
			<input type="text" name="username" value="<?= htmlspecialchars($data['username']) ?>" maxlength="30" required>
		</p>
		<p>
			Password <br>
			<input type="password" name="password" maxlength="30">
			<br><small>Kosongkan jika password tidak diganti</small>
		</p>
		<p>
			Nama <br>
			<input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" maxlength="50" required>
		</p>
		<p>
			Alamat <br>
			<input type="text" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" maxlength="150" required>
		</p>
		<p>
			HP <br>
			<input type="text" name="hp" value="<?= htmlspecialchars($data['hp']) ?>" maxlength="20" required>
		</p>
		<p>
			Level <br>
			<select name="level" required>
				<option value="1" <?php if ($data['level'] == 1) echo 'selected' ?>>1 - Owner</option>
				<option value="2" <?php if ($data['level'] == 2) echo 'selected' ?>>2 - Kasir</option>
				<option value="3" <?php if ($data['level'] == 3) echo 'selected' ?>>3 - Gudang (belum bisa login)</option>
			</select>
		</p>
		<button type="submit">Update</button>
		<a href="user.php">Batal</a>
	</form>
</body>
</html>
