<?php
session_start(); // Mulai sesi
session_unset(); // Menghapus semua sesi
session_destroy(); // Menghancurkan sesi
header("Location: login.php"); // Mengalihkan ke halaman login
exit();
?>