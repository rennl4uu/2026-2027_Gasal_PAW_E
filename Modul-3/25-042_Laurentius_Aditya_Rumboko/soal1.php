<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// 1.1 tambah 5 data baru
$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

echo "fruits = (";
foreach ($fruits as $f) {
    echo $f . ", ";
}
echo ")<br>";

$tertinggi = $fruits[count($fruits) - 1];
echo "Nilai dengan indeks tertinggi: " . $tertinggi . "<br><br>";

// 1.2 hapus satu data
unset($fruits[1]); // hapus Blueberry
$fruits = array_values($fruits);

echo "Data Blueberry dihapus.<br>";
echo "fruits = (";
foreach ($fruits as $f) {
    echo $f . ", ";
}
echo ")<br>";

$tertinggi = $fruits[count($fruits) - 1];
echo "Nilai dengan indeks tertinggi: " . $tertinggi;
?>