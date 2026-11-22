<?php

// Mulai session. File ini di-require di setiap halaman
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// Halaman wajib login. Jika belum login, arahkan ke login.php
function wajib_login()
{
	if (!isset($_SESSION['id_user'])) {
		header('Location: login.php');
		exit;
	}
}

// Halaman khusus level 1 (owner), yaitu semua Data Master
function wajib_owner()
{
	wajib_login();
	if ($_SESSION['level'] != 1) {
		header('Location: index.php?pesan=' . urlencode('Anda tidak punya akses ke halaman tersebut'));
		exit;
	}
}
