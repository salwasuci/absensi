<?php
include 'C:/AppServ/www/absensi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_siswa = $_POST['id_siswa'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    $sql = "INSERT INTO absensi (id_siswa, tanggal, status) VALUES (:id_siswa, :tanggal, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_siswa' => $id_siswa, 'tanggal' => $tanggal, 'status' => $status]);

    // Redirect ke halaman lihat_absensi.php setelah berhasil
    header("Location: lihat_absensi.php");
    exit();
}

// Ambil data siswa untuk ditampilkan di dropdown
$siswa = $pdo->query("SELECT * FROM siswa")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
            width: 100%;
            max-width: 420px;
            animation: fadeIn 1s ease-in-out;
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

        h2 {
            text-align: center;
            font-size: 1.8em;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        input, select, button {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #66a6ff;
            box-shadow: 0 0 5px rgba(102, 166, 255, 0.5);
        }

        select {
            background: #f9f9f9;
        }

        button {
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: bold;
            transition: transform 0.2s ease, background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(120deg, #66a6ff, #89f7fe);
            transform: translateY(-2px);
        }

        .form-container select option {
            background: #fff;
            color: #333;
        }

        .icon {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 2em;
            color: #66a6ff;
            justify-content: center;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9em;
            color: #555;
        }

        .footer a {
            color: #66a6ff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="form-container">
    <div class="icon">
        📋
    </div>
    <h2>Form Absensi</h2>
    <form action="" method="POST">
        <label for="id_siswa">Nama Siswa:</label>
        <select name="id_siswa" id="id_siswa" required>
            <?php foreach ($siswa as $row): ?>
                <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" required>

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alfa">alfa</option>
        </select>

        <button type="submit">Simpan Absensi</button>
    </form>
</div>
</body>
</html>
