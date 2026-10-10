<?php
// 3.1
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = (";
foreach ($height as $nama => $tinggi) {
    echo $nama . "=>" . $tinggi . ", ";
}
echo ")<br>";

echo "Nilai dengan indeks terakhir: " . end($height) . " cm tall<br><br>";

unset($height["Barry"]);
echo "Data Barry dihapus . <br>";

echo "height = (";
foreach ($height as $nama => $tinggi) {
    echo $nama . "=>" . $tinggi . ", ";
}
echo ")<br>";

echo "Nilai dengan indeks terakhir setelah dihapus: " . end($height) . "<br><br>";

// 3.2
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

echo "weight = (";
foreach ($weight as $nama => $w) {
    echo $nama . "=>" . $w . ", ";
}
echo ")<br>";

$data = array_values($weight);
echo "Data kedua: " . $data[1];
?>