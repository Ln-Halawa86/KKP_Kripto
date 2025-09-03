<?php
include('koneksi.php');
include 'AES.php'; // Pastikan file AES.php sudah ada di direktori yang sama

if (isset($_POST['encrypt_now'])) {
    $file = $_FILES['file'];
    $password = $_POST['pwdfile'];
    $desc = $_POST['desc'];
    $uploadDir = 'encrypted_files/';

    // Buat direktori jika belum ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Periksa apakah file diunggah tanpa kesalahan
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileName = basename($file['name']);
        $fileSize = $file['size'];

      // Ambil ekstensi file
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
      // Daftar ekstensi yang diperbolehkan
      $allowedExtensions = ['docx', 'pptx', 'xlsx', 'pdf'];

      // Validasi ekstensi file
      if (!in_array($fileExtension, $allowedExtensions)) {
        echo("<script language='javascript'>
         
        window.location.href='home.php';
        window.alert('Ekstensi file tidak diizinkan. Hanya file dengan ekstensi docx, pptx, xlsx, dan pdf yang diperbolehkan.');
        </script>
    ");
          
      }

      // Validasi ukuran file (maks 10MB)
      if ($fileSize > 10 * 1024 * 1024) {
        echo("<script language='javascript'>
         
        window.location.href='home.php';
        window.alert('Ekstensi file tidak diizinkan. Hanya file dengan ekstensi docx, pptx, xlsx, dan pdf yang diperbolehkan.');
        </script>
    ");
      }  

        // Baca konten file
        $fileContent = file_get_contents($fileTmpPath);

        // Enkripsi konten file
        $aes = new AES($password); // Gunakan password yang diinputkan pengguna
        $encryptedContent = $aes->encrypt($fileContent);

        // Simpan file terenkripsi
        $encryptedFileName = basename($fileName) . '.enc';
        $encryptedFilePath = $uploadDir . $encryptedFileName;
        if (file_put_contents($encryptedFilePath, $encryptedContent)) {

            // Path URL relatif dari root direktori web
            $fileUrl = 'encrypted_files/' . $encryptedFileName;

            // Simpan informasi file ke database
            $status = 1; // status untuk terenkripsi
            $stmt = $connect->prepare("INSERT INTO files (file_name, file_path, description, status, password, file_url, file_size) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssissi", $fileName, $encryptedFilePath, $desc, $status, $password, $fileUrl, $fileSize);
            if ($stmt->execute()) {
                echo("<script language='javascript'>
         
        window.location.href='home.php';
        window.alert('Berhasil mendekripsi file.');
        </script>
    ");
            } else {
                echo "Error saat menyimpan informasi file ke database: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error saat menyimpan file terenkripsi.";
        }
    } else {
        echo "Error saat mengunggah file: " . $file['error'];
    }
}
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Enkripsi</title>
        <link rel="stylesheet" href="styles.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
        <style>
            body {
                background: url(yayasan3.jpg) no-repeat center center fixed;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table, th, td {
                border: 8px black #ddd;
            }
            table th, table td {
                padding: 12px;
                text-align: center;
            }
            table th {
                background: #007514;
                color: #fff;
            }
            table tr {
                background: #f2f2f2;
            }
            /*table tr:nth-child(even) {
                background: #f2f2f2;
            }*/
            table tr:hover {
                background: #ddd;
            }
            .number-column {
            width: 50px; /* Adjust the width as needed */
            text-align: center;
        }

        </style>
    </head>
    
    <body>
        <div class="wrapper">
            <div class="sidebar">
                <h2>Web Enkripsi dan Deskripsi </h2>
                <ul>
                    <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li> <!-- Added -->
                    <li><a href="enkrip.php"><i class="fas fa-lock"></i> Enkripsi</a></li> <!-- Updated -->
                    <li><a href="dekrip.php"><i class="fas fa-lock-open"></i> Dekripsi</a></li> 
                    <li><a href="Menu_Status.php"><i class="fas fa-sync"></i> Status File</a></li>
                </ul>
                <div class="social_media">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/@baiturrohim_ciledug"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.instagram.com/baiturrohim_ciledug"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="main_content">
                <div class="header">SELAMAT DATANG DI ENKRIPSI DATA BERBASIS WEB RUMAH YATIM BAITURROHIM!.</div>  
                <div class="info">

                   

                   
                    
                    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Form Enkripsi</h3>
            </div>
            <div class="card-body">
                <form action="enkrip.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="file">File:</label>
                        <input type="file" class="form-control-file" name="file" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="pwdfile" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="desc" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="encrypt_now">Encrypt File</button>
                </form>
            </div>
        </div>
                    


                </div>
            </div>
        </div>
    </body>
</html>