<?php
session_start();
include('koneksi.php');
include 'AES.php'; // Pastikan file AES.php sudah ada dan berfungsi dengan baik

// Periksa apakah data dikirim melalui POST
if (isset($_POST['id']) && isset($_POST['pwdfile'])) {
    $id = intval($_POST['id']);
    $password = $_POST['pwdfile'];

    // Sanitasi input untuk keamanan
    $password = mysqli_real_escape_string($connect, $password);

    // Dapatkan data file dari database
    $query = "SELECT * FROM files WHERE id='$id'";
    $result = mysqli_query($connect, $query);
    
    if (!$result) {
        die("Query error: " . mysqli_error($connect));
    }

    $data = mysqli_fetch_assoc($result);
    if (!$data) {
        die("File tidak ditemukan");
    }

    $file_path = $data['file_path'];
    $stored_password = $data['password']; // Password yang disimpan di database

    // Validasi file path
    if (!file_exists($file_path)) {
        die("File tidak ditemukan. Path: $file_path");
    }

    // Validasi password
    if ($password !== $stored_password) {
        die("Password salah.");
    }

    $file_size = filesize($file_path);
    $file_name = $data['file_name'];
    $cache = "decrypted_files/$file_name";

    // Buat direktori jika belum ada
    if (!is_dir('decrypted_files')) {
        mkdir('decrypted_files', 0777, true);
    }

    // Inisialisasi Kelas AES
    $aes = new AES($password);

    // Ambil encrypted content dari file
    $encryptedContent = file_get_contents($file_path);

    // Dekripsi konten file
    $decryptedContent = $aes->decrypt($encryptedContent);

    // Simpan hasil dekripsi ke file
    file_put_contents($cache, $decryptedContent);

    // Update status file di database
    $updateQuery = "UPDATE files SET status=2 WHERE id='$id'";
    if (mysqli_query($connect, $updateQuery)) {
        echo "File berhasil didekripsi.";
    } else {
        echo "Gagal mengupdate status file: " . mysqli_error($connect);
    }

    // Simpan path file yang didekripsi ke sesi untuk diunduh
    $_SESSION["download"] = $cache;

    // Redirect ke halaman home dan buka halaman download di tab baru
    echo("<script language='javascript'>
         window.open('download.php', '_blank');
         window.location.href='home.php';
         window.alert('Berhasil mendekripsi file.');
        </script>
    ");
} else {
    die("Data ID atau Password tidak dikirim.");
}
?>
