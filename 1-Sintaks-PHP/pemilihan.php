<?php
// Inisialisasi variabel
$nilai = 85;

echo "<h2>Hasil Penilaian</h2>";

// Instruksi pemilihan dengan if, else if, dan else
if ($nilai >= 90) {
    echo "<p>Nilai Anda adalah " . $nilai . ". Selamat, Anda mendapatkan nilai A</p>";
} elseif ($nilai >= 80) {
    echo "<p>Nilai Anda adalah " . $nilai . ". Anda mendapatkan nilai B</p>";
} elseif ($nilai >= 70) {
    echo "<p>Nilai Anda adalah " . $nilai . ". Anda mendapatkan nilai C</p>";
} else {
    echo "<p>Nilai Anda adalah " . $nilai . ". Maaf, Anda di DO</p>";
}

// Contoh lain dengan switch case
$hari = "Senin";
echo "<h3>Informasi Hari</h3>";

switch ($hari) {
    case "Senin":
        echo "<p>Hari ini adalah hari Senin</p>";
        break;
    case "Jumat":
        echo "<p>Hari ini adalah hari Jumat</p>";
        break;
    default:
        echo "<p>Hari ini bukan hari Senin atau Jumat</p>";
        break;
}
?>