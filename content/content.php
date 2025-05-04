<?php

include "service/database.php";


// CRUD ubah
if(isset($_POST["ubah"])){
  $ubah = mysqli_query($db, "UPDATE tbl_buku SET judul = '$_POST[judul]',
                                                                  pengarang = '$_POST[pengarang]',
                                                                  thn_terbit = '$_POST[thn_terbit]', 
                                                                  stok = '$_POST[stok]'
                                                                  WHERE id_buku = '$_POST[id_buku]'
                                                                  ");
  if($ubah){
    echo "<script>alert('Berhasil Mengubah Data!!');
    document.location='dashboard.php?page=content';
    </script>";
  } else {
    echo "<script>alert('Gagal Mengubah Data!!');
    document.location='dashboard.php?page=content';
    </script>";
  }
}



// CRUD hapus
if(isset($_POST["hapus"])){
  $hapus = mysqli_query($db, "DELETE FROM tbl_buku WHERE id_buku = '$_POST[id_buku]' ");


  if($hapus){
    echo "<script>alert('Berhasil Menghapus Data!!');
    document.location='dashboard.php?page=content';
    </script>";
  } else {
    echo "<script>alert('Gagal Menghapus Data!!');
    document.location='dashboard.php?page=content';
    </script>";
  }
}

?>


<div class="container">
    <h2 class="text-center mt-3 mb-3">Manajemen Data Buku</h2>
    <div class="card">
        <div class="card-header bg-dark text-white">
            Data Buku
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th class="text-black text-center">Id Buku</th>
                    <th class="text-black text-center">Judul</th>
                    <th class="text-black text-center">Pengarang</th>
                    <th class="text-black text-center">Stok</th>
                    <th class="text-black text-center">Tahun Terbit</th>
                    <th class="text-black text-center">Aksi</th>
                </tr>

                <?php
                $no = 1;
                $tampil = mysqli_query($db, "SELECT * FROM tbl_buku ORDER BY id_buku ASC");

                while ($data = mysqli_fetch_array($tampil)) :

                
                ?>

                <tr class="align-middle">
                    <th class="text-center text-sm font-weight-bold text-wrap"><?= $no++ ?></th>
                    <th class="text-capitalize text-sm font-weight-normal text-wrap"><?= $data['judul']?></th>
                    <th class="text-capitalize text-sm font-weight-normal text-wrap"><?= $data['pengarang']?></th>
                    <th class="text-center text-sm font-weight-normal text-wrap"><?= $data['stok']?></th>
                    <th class="text-center text-sm font-weight-normal text-wrap"><?= $data['thn_terbit']?></th>
                    <th class="text-center">
                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $no?>">Ubah</a>
                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no?>">Hapus</a>
                    </th>
                </tr>

                <!-- Awal Modal Ubah -->
                <div class="modal fade" id="modalUbah<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Form Ubah Data Buku</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_buku" value="<?= $data['id_buku']?>">
                        <div class="modal-body">
                            <div class="input-group input-group-static mb-4">
                                <label>Judul Buku</label>
                                <input type="text" class="form-control" name="judul" value="<?= $data['judul']?>">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Pengarang</label>
                                <input type="text" class="form-control" name="pengarang" value="<?= $data['pengarang']?>">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Stok</label>
                                <input type="text" class="form-control" name="stok" value="<?= $data['stok']?>">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Tahun Terbit</label>
                                <input type="number" lenght="4" class="form-control" name="thn_terbit" value="<?= $data['thn_terbit']?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="ubah" class="btn bg-warning text-white" id="show-alert">Ubah</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
                <!-- Akhir Modal Ubah -->

                <!-- Awal Modal Hapus -->
                <div class="modal fade" id="modalHapus<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Hapus Data Buku</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_buku" value="<?= $data['id_buku']?>">
                        <div class="modal-body">
                            
                            <h5 class="text-center">Apa anda yakin ingin menghapus data buku ini?<br>
                                <span class="text-danger"><?= $data['judul']?> - <?= $data['pengarang']?></span>
                            </h5>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="hapus" class="btn bg-danger text-white">Hapus</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
                <!-- Akhir Modal Hapus -->
                <?php endwhile; ?>
            </table>

            <!-- Button trigger modal -->
            
            <a href="?page=tambahBuku" class="btn bg-gradient-info">Tambah Buku</a>
            <!-- <button type="button" class="btn bg-gradient-info toast-btn" data-target="successToast">
            Tambah
            </button> -->

            
                </div>
        </div>
    </div>

    
    
</div>