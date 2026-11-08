<?php

require_once 'koneksi.php';

$id = $_GET['id'];
$supplier = $DBH->prepare("SELECT * FROM supplier WHERE id = ?");
$supplier->execute([$id]);
$data = $supplier->fetch();

// Jika data tidak ditemukan
if (!$data) {
	header('Location: index.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Data Supplier</title>
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Edit Data Master Supplier</h2>

	<form method="POST" action="update-supplier.php">
		<input type="hidden" name="id" value="<?= $data['id'] ?>">
		<p>
			Nama <br>
			<input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
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
		<a href="index.php">Batal</a>
	</form>
</body>
</html>
