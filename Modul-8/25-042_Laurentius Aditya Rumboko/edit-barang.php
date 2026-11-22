<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$id = $_GET['id'];
$barang = $DBH->prepare("SELECT * FROM barang WHERE id = ?");
$barang->execute([$id]);
$data = $barang->fetch();

// Jika data tidak ditemukan
if (!$data) {
	header('Location: barang.php');
	exit;
}

// Ambil data supplier untuk dropdown
$supplier = $DBH->prepare("SELECT id, nama FROM supplier ORDER BY nama");
$supplier->execute();
$data_supplier = $supplier->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Data Barang</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Edit Data Master Barang</h2>

	<form method="POST" action="update-barang.php">
		<input type="hidden" name="id" value="<?= $data['id'] ?>">
		<p>
			Kode Barang <br>
			<input type="text" name="kode_barang" value="<?= htmlspecialchars($data['kode_barang']) ?>" maxlength="10" required>
		</p>
		<p>
			Nama Barang <br>
			<input type="text" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang']) ?>" maxlength="100" required>
		</p>
		<p>
			Harga <br>
			<input type="number" name="harga" value="<?= $data['harga'] ?>" min="0" required>
		</p>
		<p>
			Stok <br>
			<input type="number" name="stok" value="<?= $data['stok'] ?>" min="0" required>
		</p>
		<p>
			Supplier <br>
			<select name="supplier_id">
				<option value="">-- Tanpa supplier --</option>
				<?php foreach ($data_supplier as $row): ?>
					<option value="<?php echo $row['id'] ?>"
						<?php if ($row['id'] == $data['supplier_id']) echo 'selected' ?>>
						<?php echo htmlspecialchars($row['nama']) ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<button type="submit">Update</button>
		<a href="barang.php">Batal</a>
	</form>
</body>
</html>
