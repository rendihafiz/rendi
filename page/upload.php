<div class="container">
    <div class="row">
        <div class="col-5">
         <div class="card">
            <div class="card-body">
                <h4>Halaman Upload</h4>
                <?php
                    //ambil data dari <form>
                    $submit=@$_POST['submit'];
                    $fotoid=@$_GET['fotoid'];
                    if ($submit=='Simpan'){
                        $judul_foto=@$_POST['judul_foto'];
                        $deskripsi_foto=@$_POST['deskripsi_foto'];
                        $nama_file=@$_FILES['nama_file']['name'];
                        $tmp_foto=@$_FILES['nama_file']['tmp_name'];
                        $tanggal=date('Y-m-d');
                        $album_id=@$_POST['album_id'];
                        $user_id=@$_SESSION['user_id'];
                        if (move_uploaded_file($tmp_foto, 'uploads/'.$nama_file)); {
                            $insert=mysqli_query($conn, "INSERT INTO foto VALUES ('','$judul_foto','$deskripsi_foto','$tanggal','$nama_file','$album_id','$user_id')");
                            echo 'Gambar Berhasil Di simpan';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        }
                    }elseif(isset($_GET['edit'])) {
                        if ($submit == "Ubah") {
                            $judul_foto = @$_POST['judul_foto'];
                            $deskripsi_foto = @$_POST['deskripsi_foto'];
                            $nama_file = @$_FILES['nama_file']['name'];
                            $tmp_foto = @$_FILES['nama_file']['tmp_name'];
                            $tanggal = date('Y-m-d');
                            $album_id = @$_POST['album_id'];
                            $user_id = @$_SESSION['user_id'];
                            if (strlen($nama_file) == 0) {
                                $update = mysqli_query($conn, "UPDATE foto SET judulfoto='$judul_foto', deskripsifoto='$deskripsi_foto', tanggalunggah='$tanggal', albumid='$album_id' WHERE fotoid='$fotoid'");
                                if ($update) {
                                    echo 'Gambar Berhasil Diubah';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                } else {
                                    echo 'Gambar gagal Diubah';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                }
                            } else {
                                if (move_uploaded_file($tmp_foto, "uploads/" . $nama_file)) {
                                    $update = mysqli_query($conn, "UPDATE foto SET judulfoto='$judul_foto', deskripsifoto='$deskripsi_foto', namafile='$nama_file', tanggalunggah='$tanggal', albumid='$album_id' WHERE fotoid='$fotoid'");
                                    if ($update) {
                                        echo 'Gambar Berhasil Diubah';
                                        echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                    }
                                }
                            }
                        }
                    }elseif(isset($_GET['hapus'])){
                        $delete=mysqli_query($conn, "DELETE FROM foto WHERE fotoid='$fotoid'");
                        if($delete){
                            echo 'Gambar Berhasil Di Hapus';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        }
                    }
                    //mencari data album
                    $album=mysqli_query($conn, "SELECT * FROM album");
                    $val=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM foto WHERE fotoid='$fotoid'"));
                ?>
                <?php if(!isset($_GET['edit'])&& !isset($_GET['hapus'])): ?>
                <form action="?url=upload" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul Foto</label>
                        <input type="text" class="form-control" required name="judul_foto">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Foto</label>
                       <textarea name="deskripsi_foto" class="form-cotrol" required cols="64" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Pilih Gambar</label>
                        <input type="file" name="nama file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Pilih Album</label>
                        <select name="album_id" class="form-select">
                            <?php foreach($album as $albums): ?>
                            <option value="<?= $albums['albumid'] ?>"><?= $albums['namaalbum'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                   <input type="submit" value="Simpan" name="submit" class="btn btn-outline-danger my-3">
                </form>
                <?php elseif(isset($_GET['edit'])): ?>
                <form action="?url=upload&&edit&&fotoid=<?= $val['fotoid'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul Foto</label>
                        <input type="text" class="form-control" value="<?= $val['judulfoto'] ?>" required name="judul_foto">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Foto</label>
                       <textarea name="deskripsi_foto" class="form-cotrol" required cols="64" rows="2"><?= $val['deskripsifoto'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Pilih Gambar</label>
                        <input type="file" name="nama file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Pilih Album</label>
                        <select name="album_id" class="form-select">
                            <?php foreach($album as $albums): ?>
                            <?php if($albums['albumid']==$val['albumid']): ?>
                                <option value="<?= $albums['albumid'] ?>" ><?= $albums['namaalbum'] ?></option>
                            <?php else: ?>
                                <option value="<?= $albums['albumid'] ?>" ><?= $albums['namaalbum'] ?></option>    
                            <?php endif; ?>
                                <?php endforeach; ?>
                        </select>
                    </div>
                   <input type="submit" value="Ubah" name="submit" class="btn btn-outline-warning my-3">
                   <a href="?url=upload" class="btn btn-outline-danger my-3">Batal</a>
                </form>
                <?php endif; ?>
            </div>
         </div>
        </div>
        <div class="col-7">
            <div class="row">
                <?php
                $fotos=mysqli_query($conn, "SELECT * FROM foto WHERE userid='".@$_SESSION['user_id']."'");
                foreach ($fotos as $foto):    
                ?>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card bg-transparent my-3 ">
                          <img src="uploads/<?= $foto['namafile'] ?>" class="object-fit-cover" style="aspect-ratio: 16/9;">
                          <div class="card-body">
                            <p class="small"><?= $foto['judulfoto']?></p>
                          <a href="?url=upload&&edit&&fotoid=<?= $foto['fotoid'] ?>" class="btn btn-outline-warning">Edit</a>
                          <a href="?url=upload&&hapus&&fotoid=<?= $foto['fotoid'] ?>" class="btn btn-outline-danger">Hapus</a>
                         </div>
                       </div>
                     </div>
                  <?php endforeach; ?>
              </div>
         </div>
    </div>
</div>