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

// Handle delete request
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['nim'])) {
    $nimToDelete = $_GET['nim'];
    $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE nim = ?");
    $stmt->bind_param("s", $nimToDelete);
    if ($stmt->execute()) {
        header("Location: index.php"); // Redirect back to the main page after deletion
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data.');</script>";
    }
    $stmt->close();
}

// Handle search request
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT nim, nama, umur FROM mahasiswa";
$params = [];
$types = '';

if (!empty($search)) {
    $sql .= " WHERE nama LIKE ? OR nim LIKE ?";
    $search_param = '%' . $search . '%';
    $params[] = $search_param;
    $params[] = $search_param;
    $types = 'ss';
}

$sql .= " ORDER BY nim ASC";

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        .search-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 20px;
            width: 250px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .search-container input[type="text"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-links a {
            text-decoration: none;
            color: #fff;
            padding: 6px 12px;
            border-radius: 5px;
            margin-right: 5px;
            transition: background-color 0.3s;
        }

        .action-links .view-btn {
            background-color: #3498db;
        }

        .action-links .view-btn:hover {
            background-color: #2980b9;
        }

        .action-links .delete-btn {
            background-color: #e74c3c;
        }

        .action-links .delete-btn:hover {
            background-color: #c0392b;
        }

        .no-data {
            text-align: center;
            color: #777;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Daftar Mahasiswa</h2>
        <div class="search-container">
            <form action="" method="get">
                <input type="text" name="search" placeholder="Cari nama atau NIM..."
                    value="<?= htmlspecialchars($search); ?>">
            </form>
        </div>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nim']); ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['umur']); ?></td>
                            <td class="action-links">
                                <a href="detail_mahasiswa.php?nim=<?= urlencode($row['nim']); ?>" class="view-btn">View
                                    Detail</a>
                                <a href="index.php?action=delete&nim=<?= urlencode($row['nim']); ?>" class="delete-btn"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">Tidak ada data mahasiswa</p>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>