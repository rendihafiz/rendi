<?php
$details=mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid WHERE foto.fotoid='$_GET[id]'");
$data=mysqli_fetch_array($details);
$likes=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$_GET[id]'"));
$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$_GET[id]' AND userid='$_SESSION[user_id]'"));
?>
<div class="container">
    <div class="row">
        <div class="col-6">
        <div class="card">
            <img src="uploads/<?= $data['namafile'] ?>" alt="<?= $data['judulfoto'] ?>" class="object-fit-cover">
            <div class="card-body">
                <h3 class="card-title mb-0"><?= $data['judulfoto'] ?> <a href="<?php if(isset($_SESSION['user_id'])) {echo '?url=like&&id='.$data['fotoid'].'';}else{echo 'index.php';} ?>" class="btn btn-sm <?php if($cek==0){echo "text-secondary";}else{echo "text-danger";} ?>"><i class="fa-solid fa-fw fa-heart"></i><?= $likes ?></a> </h3>
                <small class="text-muted mb-3">by:<?= $data['username'] ?>, <?= $data['tanggalunggah'] ?></small>
                <p><?= $data['deskripsifoto'] ?></p>
                <?php
                //ambil data komentar
                $submit=@$_POST['submit'];
                if ($submit=='kirim'){
                    $komentar=@$_POST['komentar'];
                    $foto_id=@$_POST['foto_id'];
                    $user_id=@$_SESSION['user_id'];
                    $tanggal=date('Y-m-d');
                    $komen=mysqli_query($conn, "INSERT INTO komentar VALUES('','$foto_id','$user_id','$komentar','$tanggal')");
                    header("Location: ?url=detail&&id=$foto_id");
                }
                ?>
                <form action="?url=detail" method="post">
                    <div class="form-group d-flex flex-row">
                        <input type="hidden" name="foto_id" value="<?= $data['fotoid'] ?>">
                        <a href="?url=home" class="btn btn-secondary mx-2">Kembali</a>
                        <?php if(isset($_SESSION['user_id'])): ?>
                        <input type="text" name="komentar" class="form-control" placeholder="Masukan Komentar...">
                        <input type="submit" value="kirim" name="submit" class="btn btn-secondary mx-2">
                   <?php endif;?>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div class="col-6">
            <?php
            $komen=mysqli_query($conn, "SELECT * FROM komentar INNER JOIN user ON komentar.userid=user.userid INNER JOIN foto ON komentar.fotoid=foto.fotoid WHERE komentar.fotoid='$_GET[id]'");
            foreach($komen as $komens):
            ?>
            <p class="mb-0 fw-bold"><?= $komens['username'] ?></p>
            <p class="mb-1"><?= $komens['isikomentar'] ?></p>
            <p class="text-muted small mb-0"><?= $komens['tanggalkomentar'] ?></p>
            <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>