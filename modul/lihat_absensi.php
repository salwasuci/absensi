<?php
include 'C:/AppServ/www/absensi/koneksi.php'; 
$sql = "SELECT absensi.id, siswa.nama, siswa.kelas, absensi.tanggal, absensi.status
FROM absensi
JOIN siswa ON absensi.id_siswa = siswa.id
ORDER BY absensi.tanggal DESC, absensi.id DESC
"; // Mengurutkan berdasarkan id terbaru
$data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
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

        table {
            width: 100%;
            border-collapse: collapse;
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

        @media (max-width: 768px) {
            th, td {
                padding: 10px;
                font-size: 12px;
            }

            h2 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>

<div class="table-container">
    <h2>Data Absensi</h2>
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
</div>

</body>
</html>

