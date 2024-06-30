<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_arsip_ph"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    // echo "Koneksi berhasil!";
}

$base_url = 'localhost/arsip-template-ph/';

// Menutup koneksi
// mysqli_close($conn);
?>
