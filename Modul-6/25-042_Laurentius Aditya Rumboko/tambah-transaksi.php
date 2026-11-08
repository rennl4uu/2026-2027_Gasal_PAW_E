<?php

require_once 'koneksi.php';

// Ambil data pelanggan untuk dropdown
$pelanggan = $DBH->prepare("SELECT id, nama FROM pelanggan ORDER BY nama");
$pelanggan->execute();
$data = $pelanggan->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Transaksi</title>
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Tambah Data Transaksi Baru</h2>

	<form method="POST" action="simpan_transaksi.php">
		<p>
			Tanggal <br>
			<input type="date" name="waktu_transaksi" value="<?php echo date('Y-m-d') ?>" required>
		</p>
		<p>
			Pelanggan <br>
			<select name="pelanggan_id" required>
				<?php foreach ($data as $row): ?>
					<option value="<?php echo $row['id'] ?>"><?php echo htmlspecialchars($row['nama']) ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			Keterangan <br>
			<input type="text" name="keterangan" placeholder="keterangan">
		</p>
		<button type="submit">Simpan</button>
		<a href="transaksi.php">Batal</a>
	</form>
</body>
</html>
