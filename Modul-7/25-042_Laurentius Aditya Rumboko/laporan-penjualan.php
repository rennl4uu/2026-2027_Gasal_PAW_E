<?php

require_once 'koneksi.php';

// Validasi format tanggal Y-m-d
function cek_tanggal($nilai)
{
	$d = DateTime::createFromFormat('Y-m-d', (string) $nilai);
	return ($d && $d->format('Y-m-d') === $nilai) ? $nilai : '';
}

$mulai = cek_tanggal($_GET['tanggal_mulai'] ?? '');
$selesai = cek_tanggal($_GET['tanggal_selesai'] ?? '');

$rekap = [];
$ringkasan = ['pelanggan' => 0, 'pendapatan' => 0];

if ($mulai && $selesai) {
	// Jika tanggal terbalik, tukar
	if ($mulai > $selesai) {
		[$mulai, $selesai] = [$selesai, $mulai];
	}

	// Total pendapatan per hari
	$q = $DBH->prepare("
			SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian
			FROM transaksi
			WHERE DATE(waktu_transaksi) BETWEEN ? AND ?
			GROUP BY DATE(waktu_transaksi)
			ORDER BY tgl ASC
		");
	$q->execute([$mulai, $selesai]);
	$rekap = $q->fetchAll();

	// Jumlah pelanggan unik dan total pendapatan keseluruhan
	$s = $DBH->prepare("
			SELECT COUNT(DISTINCT pelanggan_id) AS pelanggan, COALESCE(SUM(total), 0) AS pendapatan
			FROM transaksi
			WHERE DATE(waktu_transaksi) BETWEEN ? AND ?
		");
	$s->execute([$mulai, $selesai]);
	$ringkasan = $s->fetch();
}

$labels = array_column($rekap, 'tgl');
$data_total = array_map('intval', array_column($rekap, 'total_harian'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan Penjualan</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
	<style>
		.chart-box { width: 700px; max-width: 100%; }
		.card { display: inline-block; border: 1px solid #000; padding: 10px 20px; margin-right: 10px; }
		.card b { display: block; margin-bottom: 5px; }

		/* Form filter, tombol cetak, dan tombol excel tidak ikut tercetak */
		@media print {
			.no-print { display: none !important; }
		}
	</style>
</head>
<body>
	<div class="no-print">
		<?php include 'menu.php'; ?>
	</div>

	<h2>Rekap Laporan Penjualan
		<?php if ($mulai && $selesai): ?>
			<small><?php echo $mulai ?> sampai <?php echo $selesai ?></small>
		<?php endif; ?>
	</h2>

	<div class="no-print">
		<form method="GET">
			Tanggal mulai
			<input type="date" name="tanggal_mulai" value="<?php echo $mulai ?>" required>
			Tanggal selesai
			<input type="date" name="tanggal_selesai" value="<?php echo $selesai ?>" required>
			<button type="submit">Tampilkan</button>
		</form>

		<?php if ($rekap): ?>
			<br>
			<button type="button" onclick="window.print()">Cetak</button>
			<a href="export-excel.php?tanggal_mulai=<?php echo $mulai ?>&tanggal_selesai=<?php echo $selesai ?>"><button type="button">Excel</button></a>
		<?php endif; ?>
	</div>

	<?php if ($mulai && $selesai && !$rekap): ?>
		<p>Tidak ada transaksi pada rentang tanggal tersebut.</p>
	<?php endif; ?>

	<?php if ($rekap): ?>
		<h3>Grafik Penjualan</h3>
		<div class="chart-box"><canvas id="myChart"></canvas></div>
		<script>
			new Chart(document.getElementById('myChart'), {
				type: 'bar',
				data: {
					labels: <?php echo json_encode($labels) ?>,
					datasets: [{ label: 'Total Pendapatan', data: <?php echo json_encode($data_total) ?> }]
				},
				options: {
					scales: {
						x: { title: { display: true, text: 'Tanggal Transaksi' } },
						y: { beginAtZero: true, title: { display: true, text: 'Total Pendapatan (Rp)' } }
					}
				}
			});
		</script>

		<h3>Rekapitulasi</h3>
		<table border="1" cellspacing="0" cellpadding="5">
			<tr>
				<th>No</th>
				<th>Total Pendapatan</th>
				<th>Tanggal Transaksi</th>
			</tr>
			<?php $no = 1; ?>
			<?php foreach ($rekap as $row): ?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td>Rp. <?php echo number_format($row['total_harian'], 0, ',', '.') ?></td>
					<td><?php echo $row['tgl'] ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		<br>

		<div class="card"><b>Jumlah Pelanggan</b><?php echo $ringkasan['pelanggan'] ?> Orang</div>
		<div class="card"><b>Jumlah Pendapatan</b>Rp. <?php echo number_format($ringkasan['pendapatan'], 0, ',', '.') ?></div>
	<?php endif; ?>
</body>
</html>
