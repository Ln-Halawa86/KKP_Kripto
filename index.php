<?php
include('koneksi.php'); // Pastikan koneksi diinisialisasi dengan benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Menggunakan prepared statement untuk menghindari SQL Injection
        $stmt = $connect->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: home.php");
            exit(); // Pastikan untuk berhenti setelah redirect
        } else {
            echo("<script language='javascript'>
         
        window.location.href='index.php';
        window.alert('Email Dan Password Salah');
        </script>
    ");
        }
    } else {
        echo "<center><h1>Data tidak valid. Silahkan coba lagi.</h1></center>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./design/login.css">
</head>
<body>
<div class="input">
    <h1>LOGIN</h1>
    <form action="index.php" method="POST">
        <div class="box-input">
            <i class="fas fa-envelope-open-text"></i>
            <input type="text" name="email" placeholder="Email" required>
        </div>
        <div class="box-input">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
      
        <button type="submit" name="login" class="btn-input">Login</button>
    </form>
</div>
</body>
</html>
