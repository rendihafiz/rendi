<?php require 'koneksi.php'; session_start() ?>

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
                    <h4 class="card-title text-white"><b>HALAMAN LOGIN</b></h4>
                    <p class="card-title text-white"><b>LOGIN AKUN</b></p>
                    <?php
                     //ambil data yang di kirim kan oleh <form> dengan method post
                     $submit=@$_POST['submit'];
                    if($submit=='Login'){
                        $username=$_POST['username'];
                        $password=md5($_POST['password']);
                    //cek apakah username dan password yang di masukan ke dalam <input> ada di database
                    $sql=mysqli_query($conn, "SELECT * FROM user WHERE Username='$username' AND Password='$password' ");
                    $cek=mysqli_num_rows($sql);
                    if ($cek!=0) {
                        //ambil data dari database untuk membuat session
                        $sesi=mysqli_fetch_array($sql);
                        
                        echo 'Login Berhasil!!!';
                        $_SESSION['username']=$sesi['username'];
                        $_SESSION['user_id']=$sesi['userid'];
                        $_SESSION['email']=$sesi['email'];
                        $_SESSION['nama_lengkap']=$sesi['namalengkap'];
                        echo '<meta http-equiv="refresh" content="0.8; url=beranda.php">';
                    }else{
                        echo 'Login Gagal!!!';
                        echo '<meta http-equiv="refresh" content="0.8; url=index.php">';
                    }
                     }
                    ?>
                    <form action="index.php" method="post">
                    <div class="form-group text-white">
                       <b> <label>Username</label>
                        <input type="text" class="bg-transparent form-control text-white" name="username" required>
                    </div>
                    <div class="form-group text-white">
                        <label>Password</label></b>
                        <input type="password" class="bg-transparent form-control text-white" name="password" required>
                    </div>
                    <input type="submit" value="Login" class="btn btn-outline-danger form-control ny-3 mt-3" name="submit">
                    <p class="text-white">Belum Punya Akun? <a href="daftar.php" class="link-danger">Daftar Sekarang</a></p>
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