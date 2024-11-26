<?php
include 'C:/AppServ/www/absensi/koneksi.php';

// Periksa apakah ID diberikan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data absensi berdasarkan ID
    $sql = "SELECT * FROM absensi WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $absensi = $stmt->fetch(PDO::FETCH_ASSOC);

    // Jika data tidak ditemukan
    if (!$absensi) {
        die("Data dengan ID $id tidak ditemukan.");
    }
} else {
    die("ID tidak diberikan.");
}

// Jika form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    // Update data di database
    $sql = "UPDATE absensi SET tanggal = :tanggal, status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':tanggal', $tanggal);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect ke halaman data absensi setelah berhasil
        header("Location: lihat_absensi.php");
        exit();
    } else {
        echo "Error: Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Absensi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8em;
            color: #555;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            background: #66a6ff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #89f7fe;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Update Data Absensi</h2>
    <form method="POST">
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="<?= $absensi['tanggal']; ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
    <option value="Hadir" <?= $absensi['status'] == 'Hadir' ? 'selected' : ''; ?>>Hadir</option>
    <option value="Alfa" <?= $absensi['status'] == 'Alfa' ? 'selected' : ''; ?>>Alfa</option>
    <option value="Izin" <?= $absensi['status'] == 'Izin' ? 'selected' : ''; ?>>Izin</option>
    <option value="Sakit" <?= $absensi['status'] == 'Sakit' ? 'selected' : ''; ?>>Sakit</option>
</select>

        </div>
        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>
