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
        header("Location: input_siswa.php");
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
        background: #fff;
        padding: 20px; /* Lebih kecil dari sebelumnya */
        border-radius: 8px;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 320px; /* Ukuran maksimal form dikecilkan */
        animation: slideIn 0.5s ease;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 15px; /* Mengurangi jarak heading ke bawah */
        font-size: 1.5em; /* Ukuran font lebih kecil */
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 15px; /* Mengurangi jarak antar input */
        position: relative;
    }

    .form-group label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        background: #fff;
        padding: 0 5px;
        color: #888;
        font-size: 12px; /* Label lebih kecil */
        transition: 0.3s;
        pointer-events: none;
    }

    .form-group input {
        width: 100%;
        padding: 10px; /* Mengurangi padding input */
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px; /* Ukuran teks lebih kecil */
        outline: none;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-group input:focus {
        border-color: #66a6ff;
        box-shadow: 0 0 6px rgba(102, 166, 255, 0.4);
    }

    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label {
        top: -10px;
        left: 10px;
        color: #66a6ff;
        font-size: 10px; /* Ukuran font lebih kecil saat floating */
    }

    .form-group input[type="submit"] {
        background: linear-gradient(120deg, #89f7fe, #66a6ff);
        color: #fff;
        border: none;
        font-size: 14px; /* Ukuran teks tombol lebih kecil */
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }

    .form-group input[type="submit"]:hover {
        background: linear-gradient(120deg, #66a6ff, #89f7fe);
    }
</style>

</head>
<body>

<div class="form-container">
    <h2>Tambah Siswa</h2>
    <form method="POST" action="input_siswa.php">
        <div class="form-group">
            <input type="text" id="nama" name="nama" required placeholder=" ">
            <label for="nama">Nama Siswa</label>
        </div>
        <div class="form-group">
            <input type="text" id="kelas" name="kelas" required placeholder=" ">
            <label for="kelas">Kelas</label>
        </div>
        <div class="form-group">
            <input type="submit" value="Tambah Siswa">
        </div>
    </form>
</div>

</body>
</html>
