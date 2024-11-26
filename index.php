<?php
session_start();
include "koneksi.php";

// Cek apakah session sudah ada
if (!isset($_SESSION['id'])) {
    // Jika session tidak ada, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Pastikan script berhenti setelah redirect
} else {
    // Jika session ada, lakukan query ke database
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->execute();
    
    // Ambil hasil query
    $resultuser = $stmt->fetch(PDO::FETCH_ASSOC);

    // Pastikan data ditemukan, jika tidak, arahkan kembali ke login
    if (!$resultuser) {
        // Data tidak ditemukan, arahkan ke halaman login
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        /* General Styling */
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #333;
        }

        /* Header */
        .header {
            width: 1260px;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            color: #fff;
            text-align: center;
            padding: 20px 10px;
            box-shadow: 0 100px 100px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            text-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }

            .header p {
                margin: 10px 0;
                font-size: 0rem;
                font-weight: 260;
                text-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
            }

        .logout-btn {
            background: #f44336;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
          
        }

        .logout-btn:hover {
            background: #e53935;
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Dashboard Container */
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1200px;
            width: 90%;
            margin: 40px auto;
            margin-top:76px;
        }

        /* Card Style */
        .card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            border-radius: 50%;
            z-index: 0;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: black;
            z-index: 1;
            position: relative;
        }

        .card-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #333;
            z-index: 1;
            position: relative;
        }

        .card-description {
            font-size: 1rem;
            color: #666;
            z-index: 1;
            position: relative;
        }
/* Tombol Pindah Halaman dalam Card */
.btn-card {
    display: inline-block;
    background: linear-gradient(120deg, #89f7fe, #66a6ff);
    color: white;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1rem;
    text-align: center;
    text-decoration: none;
    margin-top: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}

.btn-card:hover {
    background: linear-gradient(120deg, #66a6ff, #89f7fe);
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

/* Efek Animasi untuk Tombol */
.btn-card:active {
    transform: scale(0.98); /* Efek saat tombol ditekan */
}

/* Responsive layout untuk tombol pada mobile */
@media (max-width: 768px) {
    .btn-card {
        width: 100%;
        text-align: center;
        padding: 10px 20px;
    }
}
/* Gaya untuk Logo dalam Card */
.card-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: #333;
    z-index: 1;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card-logo {
    max-width: 70px; /* Sesuaikan ukuran logo */
    max-height: 70px;
    transition: transform 0.3s ease;
    padding:5px;
    margin-left:-150px;
}

/* Responsive layout untuk logo */
@media (max-width: 768px) {
    .card-logo {
        max-width: 60px;
        max-height: 60px;
    }
}


        /* Footer */
        footer {
            margin-top: auto;
            padding: 10px 20px;
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            color: #777;
            font-size: 0.9rem;
            width: 1240px;
            box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.1);
        }

        footer a {
            color: #3f51b5;
            text-decoration: none;
            font-weight: 700;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Selamat Datang,  <?=htmlspecialchars($resultuser['username'])?>!</h1>
        <p>Dashboard ini membantu Anda mengelola data dengan mudah.</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

  <!-- Dashboard -->
<div class="dashboard-container">
    <div class="card">
        <div class="card-title">Tambah Siswa</div>
        <div class="card-value">
            <img src="img/student.png" alt="Logo Siswa" class="card-logo">
        </div>
        <div class="card-description">Siswa Yang Terdaftar.</div>
        <!-- Tombol Pindah Halaman -->
        <a href="modul/input_siswa.php" class="btn-card">Tambah Siswa</a>
    </div>
    <div class="card">
        <div class="card-title">Tambah Absen</div>
        <div class="card-value">
            <img src="img/absence.png" alt="Logo Absen" class="card-logo">
        </div>
        <div class="card-description">Siswa yang hadir pada hari ini.</div>
        <!-- Tombol Pindah Halaman -->
        <a href="modul/input_absen.php" class="btn-card">Tambah Absen</a>
    </div>
    <div class="card">
        <div class="card-title">Daftar Absensi</div>
        <div class="card-value">
            <img src="img/folder.png" alt="Logo Absensi" class="card-logo">
        </div>
        <div class="card-description">Total Absensi Siswa.</div>
        <!-- Tombol Pindah Halaman -->
        <a href="modul/lihat_absensi.php" class="btn-card">Lihat Absensi</a>
    </div>
</div>


    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Sistem Informasi Sekolah | Dibuat dengan Penuh Kesabaran.</p>
    </footer>
</body>
</html>
<?php
}
?>