<?php
// 1. array_push
$arr = array("A");
array_push($arr, "B");
echo "Array awal: (A)<br>";
echo "Hasil array_push: ";
foreach ($arr as $v) {
    echo $v . " ";
}
echo "<br><br>";

// 2. array_merge
$arr1 = array("A", "B");
$arr2 = array("C");
$merge = array_merge($arr1, $arr2);
echo "Array awal: (A, B) digabung dengan (C)<br>";
echo "Hasil array_merge: ";
foreach ($merge as $v) {
    echo $v . " ";
}
echo "<br><br>";

// 3. array_values
$assoc = array("x" => 1, "y" => 2);
$values = array_values($assoc);
echo "Array awal: (x=>1, y=>2)<br>";
echo "Hasil array_values: ";
foreach ($values as $v) {
    echo $v . " ";
}
echo "<br><br>";

// 4. array_search
$arr = array("A", "B", "C");
$hasil = array_search("B", $arr);
echo "Mencari B pada array: (A, B, C)<br>";
echo "Hasil array_search: " . $hasil . "<br><br>";

// 5. array_filter
$arr = array(0, 1, false, 2, " ", 3, "array");
$filter = array_filter($arr);
echo "Array awal: (0, 1, false, 2, ' ', 3, 'array')<br>";
echo "Hasil array_filter: ";
foreach ($filter as $v) {
    echo $v . " ";
}
echo "<br><br>";

// 6. sort dan rsort
$arr = array(3, 1, 2);
$sort = $arr;
sort($sort);
$rsort = $arr;
rsort($rsort);
echo "Array awal: (3, 1, 2)<br>";
echo "Hasil sort: ";
foreach ($sort as $v) {
    echo $v . " ";
}
echo "<br>";
echo "Hasil rsort: ";
foreach ($rsort as $v) {
    echo $v . " ";
}
echo "<br><br>";

// 7. asort, ksort, arsort, krsort
$assoc = array("Peter" => 35, "Ben" => 37, "Joe" => 43);

$asort = $assoc;
asort($asort);

$ksort = $assoc;
ksort($ksort);

$arsort = $assoc;
arsort($arsort);

$krsort = $assoc;
krsort($krsort);

echo "Array awal: (Peter=>35, Ben=>37, Joe=>43)<br>";

echo "Hasil asort: ";
foreach ($asort as $k => $v) {
    echo $k . "=> " . $v . ", ";
}
echo "<br>";

echo "Hasil ksort: ";
foreach ($ksort as $k => $v) {
    echo $k . "=> " . $v . ", ";
}
echo "<br>";

echo "Hasil arsort: ";
foreach ($arsort as $k => $v) {
    echo $k . "=> " . $v . ", ";
}
echo "<br>";

echo "Hasil krsort: ";
foreach ($krsort as $k => $v) {
    echo $k . "=> " . $v . ", ";
}
?>