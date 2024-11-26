<?php
include 'C:/AppServ/www/absensi/koneksi.php'; 

// Query untuk mengambil data siswa
$sql = "SELECT id, nama, kelas FROM siswa";
$stmt = $pdo->prepare($sql); // Menggunakan $pdo
$stmt->execute();
$siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            padding: 20px;
        }

        .table-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
            animation: fadeIn 0.6s ease;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 2em;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 1em;
        }

        table th {
            background: linear-gradient(120deg, #66a6ff, #89f7fe);
            color: #fff;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background: #f9f9f9;
        }

        table tr:hover {
            background: rgba(102, 166, 255, 0.2);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons a {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.9em;
            font-weight: bold;
            text-align: center;
            transition: all 0.3s ease;
        }

        .action-buttons a:first-child {
            background: #66a6ff;
            color: white;
        }

        .action-buttons a:first-child:hover {
            background: #89f7fe;
            transform: scale(1.05);
        }

        .action-buttons a:last-child {
            background: #ff6b6b;
            color: white;
        }

        .action-buttons a:last-child:hover {
            background: #ff4a4a;
            transform: scale(1.05);
        }

        .button-container {
            text-align: center;
        }

        .button-container a {
            display: inline-block;
            padding: 12px 20px;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .button-container a:hover {
            background: linear-gradient(120deg, #66a6ff, #89f7fe);
            transform: scale(1.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsif */
        @media (max-width: 768px) {
            .table-container {
                padding: 15px;
            }

            h2 {
                font-size: 1.5em;
            }

            table th, table td {
                padding: 10px;
                font-size: 0.9em;
            }

            .action-buttons a {
                font-size: 0.8em;
                padding: 6px 10px;
            }

            .button-container a {
                font-size: 0.9em;
                padding: 10px 16px;
            }
        }
    </style>
</head>
<body>

<div class="table-container">
    <h2>Daftar Siswa</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($siswa) > 0): ?>
                <?php foreach ($siswa as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="edit_siswa.php?id=<?php echo $row['id']; ?>">Update</a>
                                <a href="hapus_siswa.php?id=<?php echo $row['id']; ?>">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data siswa.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="button-container">
        <a href="input_siswa.php">Tambah Siswa Baru</a>
        <a href="../index.php">Kembali ke Dashboard</a> 
    </div>
</div>

</body>
</html>
