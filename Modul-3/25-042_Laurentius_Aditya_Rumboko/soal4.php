<?php
// ===== 4.1 =====
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

// tambah 5 data baru
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

// tampilkan isi array 
echo "height = (";
foreach ($height as $nama => $tinggi) {
    echo $nama . "=>" . $tinggi . ", ";
}
echo ")<br><br>";

// tampilkan seluruh data dengan perulangan
foreach ($height as $nama => $tinggi) {
    echo $nama . " is " . $tinggi . " cm tall.<br>";
}

echo "<br>";

// ===== 4.2 =====
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

// tampilkan seluruh data dengan perulangan for
$keys = array_keys($weight);

for ($i = 0; $i < count($keys); $i++) {
    $nama = $keys[$i];
    echo $nama . " is " . $weight[$nama] . " kg.<br>";
}
?>