<?php
session_start();
include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dekripsi</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <style>
        body {
            background: url(yayasan3.jpg) no-repeat center center fixed;
            background-size: cover;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 8px solid black;
            border-color: #ddd;
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
        table tr:hover {
            background: #ddd;
        }
        .number-column {
            width: 50px;
            text-align: center;
        }
        .reset-button {
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <h2>Data Enkripsi Rumah Yatim</h2>
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
            <div class="header">SELAMAT DATANG DI ENKRIPSI DATA BERBASIS WEB RUMAH YATIM BAITURROHIM!</div>  
            <div class="info">
                

                
                
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" style="color: black">
                            <table id="file" class="table striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama File</th>
                                        <th>Lokasi File Enkripsi</th>
                                        <th>Keterangan</th>
                                        <th>Ukuran File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $query = mysqli_query($connect, "SELECT * FROM files WHERE status = 1");
                                    while ($data = mysqli_fetch_array($query)) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($data['file_name'], ENT_QUOTES); ?></td>
                                            <td><?php echo htmlspecialchars($data['file_path'], ENT_QUOTES); ?></td>
                                            <td><?php echo htmlspecialchars($data['description'], ENT_QUOTES); ?></td>
                                            <td><?php echo htmlspecialchars($data['file_size'], ENT_QUOTES); ?> KB</td>
                                            <td>
                                                <?php
                                                $a = $data['id'];
                                                echo '<a href="dekrip_file.php?id=' . $a . '" class="btn btn-primary">Dekripsi File</a>';
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
