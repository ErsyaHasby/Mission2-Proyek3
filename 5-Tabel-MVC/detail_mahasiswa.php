<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "akademik_db";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil NIM dari parameter URL
$nim = isset($_GET['nim']) ? $_GET['nim'] : '';

if (empty($nim)) {
    die("NIM tidak ditemukan.");
}

// Query ambil data mahasiswa berdasarkan NIM
$stmt = $conn->prepare("SELECT nim, nama, umur FROM mahasiswa WHERE nim = ?");
$stmt->bind_param("s", $nim);
$stmt->execute();
$result = $stmt->get_result();
$mahasiswa = $result->fetch_assoc();

if (!$mahasiswa) {
    die("Data mahasiswa tidak ditemukan.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-item strong {
            color: #555;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #388E3C;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Detail Mahasiswa: <?= htmlspecialchars($mahasiswa['nama']); ?></h2>
        <div class="detail-item">
            <strong>NIM:</strong>
            <span><?= htmlspecialchars($mahasiswa['nim']); ?></span>
        </div>
        <div class="detail-item">
            <strong>Nama:</strong>
            <span><?= htmlspecialchars($mahasiswa['nama']); ?></span>
        </div>
        <div class="detail-item">
            <strong>Umur:</strong>
            <span><?= htmlspecialchars($mahasiswa['umur']); ?></span>
        </div>
        <a href="index.php" class="back-link">Kembali ke Daftar Mahasiswa</a>
    </div>
</body>

</html>