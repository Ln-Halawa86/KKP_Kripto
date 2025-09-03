<?php
session_start(); // Mulai sesi
session_unset(); // Hapus semua data sesi
session_destroy(); // Hapus sesi

// Arahkan pengguna ke halaman login setelah logout
header("Location: index.php");
exit();
?>
