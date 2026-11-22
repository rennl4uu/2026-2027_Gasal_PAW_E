<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$id_user = $_POST['id_user'];
$username = trim($_POST['username']);
$password = $_POST['password'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$hp = $_POST['hp'];
$level = $_POST['level'];

// Username tidak boleh kembar dengan user lain
$cek = $DBH->prepare("SELECT COUNT(*) FROM user WHERE username = ? AND id_user != ?");
$cek->execute([$username, $id_user]);

if ($cek->fetchColumn() > 0) {
	header('Location: user.php?pesan=' . urlencode('Username sudah dipakai'));
	exit;
}

if ($password === '') {
	// Password tidak diganti
	$update = $DBH->prepare("
			UPDATE user
				SET username = ?, nama = ?, alamat = ?, hp = ?, level = ?
			WHERE id_user = ?
		");
	$update->execute([$username, $nama, $alamat, $hp, $level, $id_user]);
} else {
	// Password diganti (simpan MD5)
	$update = $DBH->prepare("
			UPDATE user
				SET username = ?, password = ?, nama = ?, alamat = ?, hp = ?, level = ?
			WHERE id_user = ?
		");
	$update->execute([$username, md5($password), $nama, $alamat, $hp, $level, $id_user]);
}

// Jika yang diubah adalah akun yang sedang login, samakan isi session-nya
if ($id_user == $_SESSION['id_user']) {
	$_SESSION['nama'] = $nama;
	$_SESSION['level'] = (int) $level;
}

header('Location: user.php?pesan=' . urlencode('Data berhasil diubah'));
?>
