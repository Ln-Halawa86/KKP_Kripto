<?php
session_start();
include 'koneksi.php';

// Periksa apakah file yang akan diunduh ada di sesi
if (isset($_SESSION['download']) && file_exists($_SESSION['download'])) {
    $file = $_SESSION['download'];

    // Hapus file dari sesi
    unset($_SESSION['download']);

    // Atur header untuk unduh file
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    
    // Baca file dan kirim ke output
    readfile($file);
    exit;
} else {
    echo "File tidak ditemukan atau tidak ada file untuk diunduh.";
}
?>
