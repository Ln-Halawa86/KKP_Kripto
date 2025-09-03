<?php
include('koneksi.php'); // Pastikan file koneksi di-include di sini

// Periksa apakah 'id' ada dalam URL dan valid
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitasi input untuk keamanan
} else {
    die("ID file tidak disertakan dalam permintaan");
}

// Jalankan query untuk mendapatkan data file
$query = mysqli_query($connect, "SELECT * FROM files WHERE id='$id'");
if (!$query) {
    die("Query error: " . mysqli_error($connect));
}

$data2 = mysqli_fetch_array($query);
if (!$data2) {
    die("File tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dekripsi File</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url(yayasan3.jpg) no-repeat center center fixed;
        }
        .breadcome-list {
            margin-top: 20px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }
        .form-control {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <section class="breadcome-list">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center" style="color:black;">
                                Dekripsi File <i style="color:red"><?php echo htmlspecialchars($data2['file_name'], ENT_QUOTES, 'UTF-8'); ?></i>
                            </h3>
                            <br>
                            <form class="form-horizontal" method="post" action="dekrip_proses.php">
                                <div class="table-responsive">
                                    <table class="table table-striped" style="color:black;">
                                        <tr>
                                            <td>Nama File Sumber</td>
                                            <td>:</td>
                                            <td><?php echo htmlspecialchars($data2['file_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama File Enkripsi</td>
                                            <td>:</td>
                                            <td><?php echo htmlspecialchars($data2['file_path'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ukuran File</td>
                                            <td>:</td>
                                            <td><?php echo htmlspecialchars($data2['file_size'], ENT_QUOTES); ?> KB</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Enkripsi</td>
                                            <td>:</td>
                                            <td><?php echo htmlspecialchars($data2['upload_time'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>:</td>
                                            <td><?php echo htmlspecialchars($data2['description'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Masukkan Password Untuk Mendekrip</td>
                                            <td></td>
                                            <td>
                                                <div class="col-md-6">
                                                    <!-- Menggunakan 'id' sebagai nama input hidden -->
                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($data2['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="pwdfile" required><br>
                                                    <input type="submit" name="decrypt_now" value="Dekripsi File" class="form-control btn btn-primary">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

