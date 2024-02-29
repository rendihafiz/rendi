<?php require 'koneksi.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKK 2024 | Website Galeri Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-danger">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-5">
               <div class="card bg-transparent">
                <div class="card-body">
                    <h4 class="card-title text-white">Halaman Daftar</h4>
                    <p class="card-title text-white">Daftar Akun</p>
                    <?php
                    //ambil data yang di kirim kan oleh <form> dengan method post
                    $submit=@$_POST['submit'];
                    if ($submit=='Daftar') {
                        $username=@$_POST['username'];
                        $password=md5(@$_POST['password']);
                        $email=@$_POST['email'];
                        $nama_lengkap=@$_POST['nama_lengkap'];
                        $alamat=@$_POST['alamat'];
                        //cek apakah ada username dan email yang sama
                        //jika ada yang sama maka daftar akan gagal karena username atau email sudah di pakai orang lain
                        $cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE Username='$username' OR Email='$email' "));
                        if($cek==0){
                            mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password', '$email', '$nama_lengkap', '$alamat')");
                            echo 'Daftar Berhasil, Silahkan Login !!';
                            echo '<meta http-equiv="refresh" content="0.8; url=index.php">';
                        }else{
                            echo 'Maaf Akun Sudah Ada';
                            echo '<meta http-equiv="refresh" content="0.8; url=daftar.php">';
                        }
                    }
                    ?>

                <form action="daftar.php" method="post">
                    <div class="form-group text-white">
                        <label>Username</label>
                        <input type="text" class="text-white bg-transparent form-control" name="username" required>
                    </div>
                    <div class="form-group text-white">
                        <label>Password</label>
                        <input type="password" class="text-white bg-transparent form-control" name="password" required>
                    </div>
                    <div class="form-group text-white">
                        <label>Email</label>
                        <input type="email" class="text-white bg-transparent form-control" name="email" required>
                    </div>
                    <div class="form-group text-white">
                        <label>Nama Lengkap</label>
                        <input type="text" class="text-white bg-transparent form-control" name="nama_lengkap" required>
                    </div>
                    <div class="form-group text-white">
                        <label>Alamat</label>
                        <input type="text" class="text-white bg-transparent form-control" name="alamat" required>
                    </div>
                    <input type="submit" value="Daftar" class="btn btn-outline-danger form-control ny-3 mt-3" name="submit">
                    <p class="text-white">Sudah Punya Akun? <a href="index.php" class="link-danger">Login Sekarang</a></p>
                </form>
                </div>
               </div>
            </div>
            <style>
                body{
                    background-image: url('./assets/img/448944.jpg');
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-size: cover;
                }
            </style>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>