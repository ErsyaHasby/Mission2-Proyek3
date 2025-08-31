<?php
echo "<h2>Daftar Angka Menggunakan Loop</h2>";
echo "<h3>Loop For</h3>";
for ($i = 1; $i <= 5; $i++) {
    echo "Ini adalah perulangan ke-" . $i . "<br>";
}

echo "<h3>Loop While</h3>";
$j = 1;
while ($j <= 3) {
    echo "Ini adalah perulangan ke-" . $j . "<br>";
    $j++;
}
echo "<h3>Loop Foreach</h3>";
$daftar_buah = ["Apel", "Jeruk", "Mangga", "Pisang"];
foreach ($daftar_buah as $buah) {
    echo "<li>" . $buah . "</li>";
}
?>