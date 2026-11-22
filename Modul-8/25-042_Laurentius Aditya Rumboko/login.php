<?php

require_once 'koneksi.php';
require_once 'auth.php';

// User yang sudah login tidak boleh membuka halaman login lagi
if (isset($_SESSION['id_user'])) {
	header('Location: index.php');
	exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = trim($_POST['username'] ?? '');
	$password = $_POST['password'] ?? '';

	// Password di tabel user disimpan dalam bentuk MD5
	$cek = $DBH->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
	$cek->execute([$username, md5($password)]);
	$user = $cek->fetch();

	if (!$user) {
		$error = 'Username atau password salah';
	} elseif (!in_array((int) $user['level'], [1, 2])) {
		// Hanya level 1 (owner) dan level 2 (kasir) yang boleh login
		$error = 'Level user ini tidak boleh login';
	} else {
		// Login berhasil: set session
		session_regenerate_id(true);
		$_SESSION['id_user'] = $user['id_user'];
		$_SESSION['nama'] = $user['nama'];
		$_SESSION['level'] = (int) $user['level'];
		header('Location: index.php');
		exit;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="login-box">
	<h2>Login Sistem Penjualan</h2>

	<?php if ($error): ?>
		<p><b><?php echo htmlspecialchars($error) ?></b></p>
	<?php endif; ?>

	<form method="POST">
		<p>
			Username <br>
			<input type="text" name="username" required>
		</p>
		<p>
			Password <br>
			<input type="password" name="password" required>
		</p>
		<button type="submit">Login</button>
	</form>
	</div>
</body>
</html>
