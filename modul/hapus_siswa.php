<?php
include 'C:/AppServ/www/absensi/koneksi.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "DELETE FROM siswa WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirect kembali ke halaman tabel absensi setelah berhasil menghapus
            header("Location: daftar_siswa.php");
            exit();
        } else {
            echo "Error: Gagal menghapus data.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
