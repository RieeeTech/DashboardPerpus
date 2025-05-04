<?php

include "service/database.php";


// Untuk Mengecek Apakah Stok Buku Tersedia
$stmt = mysqli_query($db, "SELECT * FROM tbl_buku WHERE stok > 0");


// Logika Untuk Menjalankan Peminjaman
if(isset($_POST["pinjam"])){
  $id_buku = $_POST['id_buku'];
  $id_member = $_SESSION['id_member'];
  $tgl_kembali = $_POST['tgl_kembali'];

  
  $pinjam = mysqli_query($db, "INSERT INTO tbl_pinjam(id_buku, id_member, tgl_kembali) VALUES ('$id_buku', '$id_member', '$tgl_kembali')");


  $stok = mysqli_query($db, "UPDATE tbl_buku SET stok = stok - 1 WHERE id_buku = $id_buku");

 
  if($pinjam){
    echo "<script>alert('Berhasil Meminjam Buku !!');
    </script>";
  } else {
    echo "<script>alert('Gagal Meminjam Buku!!');
    </script>";
  }
}



?>


<div class="container">
    <h2 class="text-center mt-3 mb-3">List Buku</h2>
    <div class="card mb-6">
        <div class="card-header bg-dark text-white">
            Daftar Buku
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th class="text-black text-center">No</th>
                    <th class="text-black text-center">Judul</th>
                    <th class="text-black text-center">Pengarang</th>
                    <th class="text-black text-center">Tahun Terbit</th>
                    <th class="text-black text-center">Available</th>
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
                    <th class="text-center text-capitalize text-sm font-weight-normal text-wrap"><?= $data['pengarang']?></th>
                    <th class="text-center text-sm font-weight-normal text-wrap"><?= $data['thn_terbit']?></th>
                    <th class="text-center text-sm font-weight-normal text-wrap"><?= $data['stok']?></th>
                    <th class="text-center">
                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $no?>">Detail</a>
                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalPinjam<?= $no?>">Pinjam</a>
                    </th>
                </tr>

                <!-- Awal Modal Detail -->
                <div class="modal fade" id="modalDetail<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Detail Buku</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_buku" value="<?= $data['id_buku']?>">
                        <div class="modal-body">
                          <p class="mb-4"><h6>ID Buku : </h6><?= $data['id_buku']?></p>
                          <p class="mb-4"><h6>Judul Buku : </h6><?= $data['judul']?></p>
                          <p class="mb-4"><h6>Pengarang Buku : </h6><?= $data['pengarang']?></p>
                          <p class="mb-4"><h6>Tahun Terbit Buku : </h6><?= $data['thn_terbit']?></p>

                            
                            

                        </div>
                        
                    </form>
                </div>
                </div>
                </div>
                <!-- Akhir Modal Detail -->

                <!-- Awal Modal Pinjam -->
                <div class="modal fade" id="modalPinjam<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Pinjam Buku</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_buku" value="<?= $data['id_buku']?>">
                        
                        <div class="modal-body">
                            
                            <h5 class="text-center">Apa anda yakin ingin meminjam buku ini?<br>
                                <span class="text-success"><?= $data['judul']?> - <?= $data['pengarang']?></span>
                            </h5>
                            
                            <div class="input-group input-group-static mt-6 mb-4">
                                <label class="font-weight-bold text-black">Masukkan Tanggal Pengembalian</label>
                                <input type="date" class="form-control" name="tgl_kembali">
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="pinjam" class="btn bg-success text-white">Ya, Pinjam</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
                <!-- Akhir Modal Pinjam -->
                <?php endwhile; ?>
            </table>

            
            

    <!-- Notification -->
    
</div>