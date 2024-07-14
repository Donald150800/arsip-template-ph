<?php
// Include file konfigurasi database dan model Auth
include $_SERVER["DOCUMENT_ROOT"] . '/arsip-template-ph/s/config.php';
include 'model/auth.php';

// Membuat instance dari kelas Auth dengan koneksi MySQLi
$auth = new Auth($conn);

// Periksa jika form login telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan autentikasi menggunakan method login dari kelas Auth
    if ($auth->login($username, $password)) {
        // Jika login sukses, redirect ke halaman dashboard
        header("Location: {$base_url}dashboard.php");
        exit();
    } else {
        // Jika login gagal, tampilkan pesan kesalahan
        echo "<script>alert('Username atau password salah'); history.go(-1);</script>";
    }
}
?>
