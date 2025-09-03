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
             body{
                background-image: url(yayasan3.jpg);
                background-size: 50% ;
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

        .main_content .header {
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.7), rgba(0, 123, 255, 0.9));
            width: 750px;
            color: #fff;
            padding: 30px;
            text-align: center;
            font-size: 28px;
            margin-top: 400px ;
            margin-left: 305px;
        
            border: solid 2px #007bff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
        
        .btn-logout {
            background-color: #ff4757;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        .btn-logout:hover {
            background-color: #e84118;
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
                <h2>Web Enkripsi Dan Dekripsi </h2>
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
                  <div class="header">SELAMAT DATANG DI ENKRIPSI DAN DEKRIPSI DATA  BERBASIS WEB <br>RUMAH YATIM BAITURROHIM!</div>  
                  
                  

                    
                    


                </div>
            </div>
        </div>
    </body>
</html>
