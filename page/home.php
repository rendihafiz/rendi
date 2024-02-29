<div class="container ny-4 p-5 rounded">
    <div class="py-5 text-dark">
        <p class="display-5 fw-bold">Galery Foto Rendi</p>
        <p class="fs-4 col-md-8"><b>SELAMAT DATANG DI APLIKASI GALERY RENDI</b></p>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php 
        $tampil=mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid");
        foreach($tampil as $tampils):
        ?>

        <div class="col-6 col-md-4 col-lg-3">
           <div class="card bg-dark my-3 ">
                <img src="uploads/<?= $tampils['namafile'] ?>" class="object-fit-cover" style="aspect-ratio: 16/9;">
                <div class="card-body">
                    <h4 class="card-title text-white"><?= $tampils['judulfoto'] ?></h4>
                    <p class="card-text text-white">by: <?= $tampils['username'] ?></p>
                <a href="?url=detail&&id=<?= $tampils['fotoid'] ?>" class="btn btn-outline-primary">Detail</a>
             </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<style>
                body{
                    background-image: url('./assets/img/318517023.jpg');
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-size: cover;
                }
            </style>
</div>