<?php
require 'koneksi.php'; // Pastikan file ini menginisialisasi variabel $koneksi


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['password'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Siapkan query SQL untuk mencegah injeksi SQL
        $query_sql = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";

        if (mysqli_query($connect, $query_sql)) {
            header("Location: home.php");
            exit();
        } else {
            echo "Pendaftaran Gagal: " . mysqli_error($connect);
        }
    } else {
        echo "Semua kolom harus diisi.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css" media="screen" title="no title">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Register Page</title>
</head>

<body>
    <div class="input">
        <h1>REGISTER</h1>
        <form action="register.php" method="POST">
    <div class="box-input">
        <i class="fas fa-user"></i>
        <input type="text" name="nama" placeholder="Full Name" required>
    </div>
    <div class="box-input">
        <i class="fas fa-envelope-open-text"></i>
        <input type="email" name="email" placeholder="Email" required>
    </div>
    <div class="box-input">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit" name="register" class="btn-input">Register</button>
</form>

    </div>
</body>

</html>
