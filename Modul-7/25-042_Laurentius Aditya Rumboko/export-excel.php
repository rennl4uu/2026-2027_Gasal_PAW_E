<?php

require_once 'koneksi.php';

function cek_tanggal($nilai)
{
	$d = DateTime::createFromFormat('Y-m-d', (string) $nilai);
	return ($d && $d->format('Y-m-d') === $nilai) ? $nilai : '';
}

$mulai = cek_tanggal($_GET['tanggal_mulai'] ?? '');
$selesai = cek_tanggal($_GET['tanggal_selesai'] ?? '');

if (!$mulai || !$selesai) {
	header('Location: laporan-penjualan.php');
	exit;
}

if ($mulai > $selesai) {
	[$mulai, $selesai] = [$selesai, $mulai];
}

$q = $DBH->prepare("
		SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian
		FROM transaksi
		WHERE DATE(waktu_transaksi) BETWEEN ? AND ?
		GROUP BY DATE(waktu_transaksi)
		ORDER BY tgl ASC
	");
$q->execute([$mulai, $selesai]);
$rekap = $q->fetchAll();

$s = $DBH->prepare("
		SELECT COUNT(DISTINCT pelanggan_id) AS pelanggan, COALESCE(SUM(total), 0) AS pendapatan
		FROM transaksi
		WHERE DATE(waktu_transaksi) BETWEEN ? AND ?
	");
$s->execute([$mulai, $selesai]);
$ringkasan = $s->fetch();

// browser diminta mengunduh sebagai file Excel
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename=laporan_penjualan_' . $mulai . '_sampai_' . $selesai . '.xls');
header('Pragma: no-cache');
header('Expires: 0');
?>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<h3>Rekap Laporan Penjualan</h3>
	<p>Periode: <?php echo $mulai ?> sampai <?php echo $selesai ?></p>

	<table border="1">
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

	<table border="1">
		<tr>
			<th>Jumlah Pelanggan</th>
			<th>Jumlah Pendapatan</th>
		</tr>
		<tr>
			<td><?php echo $ringkasan['pelanggan'] ?> Orang</td>
			<td>Rp. <?php echo number_format($ringkasan['pendapatan'], 0, ',', '.') ?></td>
		</tr>
	</table>
</body>
</html>
