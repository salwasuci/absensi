<?php
include 'C:/AppServ/www/absensi/koneksi.php'; 

// Menangani pengiriman formulir untuk tanggal tertentu
$date_filter = isset($_GET['date_filter']) ? $_GET['date_filter'] : ''; // Mengambil tanggal yang dipilih

// Membuat query SQL untuk memilih absensi berdasarkan tanggal tertentu atau urutkan berdasarkan tanggal input
if ($date_filter) {
    // Query jika ada filter tanggal
    $sql = "SELECT absensi.id, siswa.nama, siswa.kelas, absensi.tanggal, absensi.status
            FROM absensi
            JOIN siswa ON absensi.id_siswa = siswa.id
            WHERE absensi.tanggal = :date_filter
            ORDER BY absensi.id ASC";  // Mengurutkan berdasarkan ID ascending
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':date_filter', $date_filter);
} else {
    // Query tanpa filter tanggal, urutkan berdasarkan ID ascending
    $sql = "SELECT absensi.id, siswa.nama, siswa.kelas, absensi.tanggal, absensi.status
            FROM absensi
            JOIN siswa ON absensi.id_siswa = siswa.id
            ORDER BY absensi.id ASC"; // Mengurutkan berdasarkan ID ascending
    $stmt = $pdo->prepare($sql);
}

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            margin: 0;
            padding: 20px;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .table-container {
            width: 90%;
            max-width: 1000px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8em;
            color: #555;
        }

        .filter-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .filter-container form {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .filter-container input[type="date"] {
            padding: 10px;
            font-size: 14px;
            border: 2px solid #ddd;
            border-radius: 5px;
            width: 180px;
            transition: border-color 0.3s ease;
        }

        .filter-container input[type="date"]:focus {
            border-color: #66a6ff;
            outline: none;
        }

        .filter-container button {
            padding: 10px 20px;
            background: #66a6ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }

        .filter-container button:hover {
            background: #89f7fe;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            color: white;
            font-weight: 600;
        }

        tr:nth-child(odd) {
            background: #f9f9f9;
        }

        tr:nth-child(even) {
            background: #fff;
        }

        tr:hover {
            background: #eaf6ff;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 0 5px;
            font-size: 12px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn-edit {
            background: #66a6ff;
        }

        .btn-edit:hover {
            background: #89f7fe;
        }

        .btn-delete {
            background: #ff6666;
        }

        .btn-delete:hover {
            background: #ff4d4d;
        }

        .btn-back {
            display: inline-block;
            padding: 12px 20px;
            background: #66a6ff;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #89f7fe;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            th, td {
                padding: 10px;
                font-size: 12px;
            }

            h2 {
                font-size: 1.5em;
            }

            .filter-container input[type="date"] {
                width: 150px;
            }
        }
    </style>
</head>
<body>

<div class="table-container">
    <h2>Laporan Absensi Siswa</h2>

    <!-- Formulir untuk memilih tanggal tertentu -->
    <div class="filter-container">
        <form method="GET" action="">
            <label for="date_filter">Pilih Tanggal:</label>
            <input type="date" id="date_filter" name="date_filter" value="<?= $date_filter ?>" required>
            <button type="submit">Filter</button>
        </form>
    </div>

    <!-- Tabel Data Absensi -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['kelas']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td>
                        <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-edit">Update</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-delete">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Tombol Kembali ke Dashboard -->
    <a href="../index.php" class="btn-back">Kembali ke Dashboard</a>
    <a href="input_absen.php" class="btn-back">Tambah Absen</a>
</div>

</body>
</html>
