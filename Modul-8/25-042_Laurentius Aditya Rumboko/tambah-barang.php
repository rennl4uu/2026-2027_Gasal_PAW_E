<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

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
	<title>Tambah Data Barang</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Tambah Data Master Barang Baru</h2>

	<form method="POST" action="simpan_barang.php">
		<p>
			Kode Barang <br>
			<input type="text" name="kode_barang" maxlength="10" required>
		</p>
		<p>
			Nama Barang <br>
			<input type="text" name="nama_barang" maxlength="100" required>
		</p>
		<p>
			Harga <br>
			<input type="number" name="harga" min="0" required>
		</p>
		<p>
			Stok <br>
			<input type="number" name="stok" min="0" required>
		</p>
		<p>
			Supplier <br>
			<select name="supplier_id">
				<option value="">-- Tanpa supplier --</option>
				<?php foreach ($data_supplier as $row): ?>
					<option value="<?php echo $row['id'] ?>"><?php echo htmlspecialchars($row['nama']) ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<button type="submit">Simpan</button>
		<a href="barang.php">Batal</a>
	</form>
</body>
</html>
