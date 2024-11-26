<?php
include 'C:/AppServ/www/absensi/koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    
    $sql = "INSERT INTO siswa (nama, kelas) VALUES (:nama, :kelas)";
    $stmt = $pdo->prepare($sql); // Ganti $conn dengan $pdo
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':kelas', $kelas);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: Gagal menambahkan data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
        }

        .form-container {
            background: #ffffff;
            padding: 40px; /* Memperbesar padding */
            border-radius: 16px; /* Memperbesar radius */
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px; /* Memperbesar lebar */
            animation: fadeIn 0.6s ease;
            overflow: hidden;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px; /* Memperbesar jarak */
            font-size: 2.4em; /* Memperbesar ukuran font */
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 30px; /* Memperbesar jarak antar elemen */
            position: relative;
        }

        .form-group input {
            width: 100%; /* Lebar penuh */
            padding: 18px 20px; /* Memperbesar padding */
            border: 1px solid #ddd;
            border-radius: 12px; /* Memperbesar radius */
            font-size: 1.2em; /* Memperbesar ukuran font */
            outline: none;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
            box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .form-group input:focus {
            border-color: #66a6ff;
            box-shadow: 0 0 12px rgba(102, 166, 255, 0.4);
            background-color: #fff;
        }

        .form-group label {
            position: absolute;
            top: 50%;
            left: 20px; /* Penyesuaian posisi label */
            transform: translateY(-50%);
            color: #aaa;
            font-size: 1.2em; /* Memperbesar ukuran font */
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label {
            top: -12px;
            left: 20px;
            font-size: 1em;
            color: #66a6ff;
            background: #ffffff;
            padding: 0 8px; /* Menyesuaikan jarak */
        }

        .form-group input[type="submit"] {
            width: 100%;
            padding: 18px 20px; /* Memperbesar padding */
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            color: white;
            border: none;
            border-radius: 12px; /* Memperbesar radius */
            font-size: 1.4em; /* Memperbesar ukuran font */
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }

        .form-group input[type="submit"]:hover {
            background: linear-gradient(120deg, #66a6ff, #89f7fe);
            transform: scale(1.05);
            box-shadow: 0 12px 25px rgba(102, 166, 255, 0.4);
        }

        .form-group input[type="submit"]:active {
            transform: scale(0.98);
        }

        /* Animasi Fade In */
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
    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah Siswa</h2>
    <form method="POST" action="input_siswa.php">
        <div class="form-group">
            <input type="text" id="nama" name="nama" required placeholder=" " style="width: 560px;">
            <label for="nama">Nama Siswa</label>
        </div>
        <div class="form-group">
            <input type="text" id="kelas" name="kelas" required placeholder=" " style="width: 560px;">
            <label for="kelas">Kelas</label>
        </div>
        <div class="form-group">
            <input type="submit" value="Tambah Siswa">
        </div>
    </form>
</div>

</body>
</html>

