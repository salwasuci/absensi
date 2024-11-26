<?php
session_start();
include 'koneksi.php'; // Memasukkan koneksi ke database


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $sql = "INSERT INTO user (username, email) VALUES (:username, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        // Jika data berhasil ditambahkan, arahkan ke halaman daftar antrian
        header("Location: index.php");
        exit(); // Penting untuk menghentikan eksekusi lebih lanjut setelah header
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
    <title>Login</title>
    <style>
        /* Font and Background */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Login Container */
        .login-container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: scale(1.05); /* Slight hover effect */
        }

        h2 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
        }

        /* Input Fields */
        .input-field {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .input-field:focus {
            border-color: #2575fc;
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-btn:hover {
            background: linear-gradient(120deg, #66a6ff, #89f7fe);
        }

        /* Error Message */
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        /* Links */
        .link {
            margin-top: 20px;
            font-size: 14px;
        }

        .link a {
            color: #2575fc;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                width: 90%;
                padding: 30px;
            }

            h2 {
                font-size: 24px;
            }

            .input-field {
                font-size: 15px;
            }

            .login-btn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Buat Akun</h2>

    <?php if (isset($error_message)): ?>
        <div class="error-message"><?= $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="email" name="email" class="input-field" placeholder="Email" required style="width:335px;">
        <input type="text" name="username" class="input-field" placeholder="Username" required style="width:335px;">
        <button type="submit" name="login" class="login-btn">Login</button>
    </form>
</div>

</body>
</html>
