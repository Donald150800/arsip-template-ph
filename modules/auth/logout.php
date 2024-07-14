<?php

session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login atau halaman utama aplikasi setelah logout
header("Location: ../../login.php");// Redirect ke halaman login jika belum login
exit();
?>