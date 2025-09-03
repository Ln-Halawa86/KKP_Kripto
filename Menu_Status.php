<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connect, "SELECT * FROM files WHERE id='$id'");
    $data2 = mysqli_fetch_array($query);
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

        .btn-logout {
    background-color: lightblue; /* Warna latar belakang merah */
    color: white; /* Warna teks putih */
    padding: 10px 20px; /* Padding untuk tombol */
    border: none; /* Menghapus border */
    border-radius: 5px; /* Membuat sudut tombol melengkung */
    text-decoration: none; /* Menghapus garis bawah */
    font-size: 16px; /* Ukuran font */
    position: absolute; /* Memungkinkan posisikan dengan tepat */
    top: 20px; /* Jarak dari atas */
    right: 20px; /* Jarak dari kanan */
    z-index: 1000; /* Memastikan tombol di atas konten lainnya */
}

.btn-logout:hover {
    background-color: #c82333; /* Warna latar belakang saat hover */
    text-decoration: none;
}

/* Pastikan elemen pembungkus memiliki posisi relatif */
.main_content {
    position: relative;
}


        </style>
    </head>
    
    <body>
        <div class="wrapper">
            <div class="sidebar">
                <h2>Web Enkripsi dan Deskripsi </h2>
                <ul>
                    <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li> 
                    <li><a href="enkrip.php"><i class="fas fa-lock"></i> Enkripsi</a></li> 
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
                 <!-- Tombol logout -->
                  <a href="logout.php" class="btn-logout">logout</a>
                <div class="header">SELAMAT DATANG DI ENKRIPSI DATA BERBASIS WEB RUMAH YATIM BAITURROHIM!.</div>  
                <div class="info">

                   

                   
                    </script>
                    
                    <div class="card">
            <div class="card-body">
              <div class="table-responsive" style="color: black">
                <table id="file" class="table striped">
                  <thead>
                      <tr>
                        <!-- <td style="color:#fff;"><strong>ID File</strong></td> -->
                        <td style="color:black;"><strong>Nama File</strong></td>
                        <td style="color:black;"><strong>Lokasi File</strong></td>
                        <td style="color:black;"><strong>Keterangan</strong></td>
                        <td style="color:black;"><strong>Ukuran File</strong></td>
                        <td style="color:black;"><strong>Tanggal</strong></td>
                        <td style="color:black;"><strong>Status</strong></td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php

                // Koneksi ke database
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                $query = mysqli_query($conn, "SELECT * FROM files");
                while ($data = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <!-- <td><?php echo $data['id']; ?></td> -->
                        <td><?php echo $data['file_name']; ?></td>
                        <td><?php echo $data['file_path']; ?></td>
                        <td><?php echo $data['description']; ?></td>
                        <td><?php echo round(filesize($data['file_path']) / 1024, 2); ?> KB</td>
                        <td><?php echo $data['upload_time']; ?></td>
                        <td><?php
                            if ($data['status'] == 1) {
                                echo '<a href="dekrip.php" class="btn btn-danger">Terenkripsi</a>';
                            } elseif ($data['status'] == 2) {
                                echo "<span class='btn btn-success'>Sudah Didekripsi</span>";
                            } else {
                                echo "<span class='btn btn-warning'>Status Tidak Diketahui</span>";
                            }
                            ?></td>
                    </tr>
                <?php } ?>
                  </tbody>
                </table>
            </div>
                    


                </div>
            </div>
        </div>
    </body>
</html>
