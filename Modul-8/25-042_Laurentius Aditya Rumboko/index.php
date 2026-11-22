<?php

require_once 'auth.php';
wajib_login();

$nama_level = $_SESSION['level'] == 1 ? 'Owner' : 'Kasir';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Home</h2>
	<p>Selamat datang, <b><?php echo htmlspecialchars($_SESSION['nama']) ?></b>.</p>
	<p>Anda login sebagai <?php echo $nama_level ?> (level <?php echo $_SESSION['level'] ?>).</p>
</body>
</html>
