<?php
// Koneksi ke database penjualan
$conn = mysqli_connect("localhost", "root", "", "penjualan");

// Jika koneksi gagal, hentikan program dan tampilkan pesan error
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}