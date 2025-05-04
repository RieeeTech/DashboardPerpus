<?php

include "service/database.php";



if(isset($_POST["selesai"])){
  $selesai = mysqli_query($db, "UPDATE tbl_pinjam SET status = 'Done' WHERE id_pinjam = '$_POST[id_pinjam]'");


  $id_buku = $_POST['id_buku'];
  $updateStok = mysqli_query($db, "UPDATE tbl_buku SET stok = stok + 1 WHERE id_buku = $id_buku");

  if($selesai){
    echo "<script>alert('Berhasil');
    
    </script>";
  } else {
    echo "<script>alert('Gagal');
    
    </script>";
  }
}



$no = 1;
// Status : Approved
$approved = mysqli_query($db, "SELECT tb.id_buku, tp.id_pinjam, tm.id_member, tm.nama, tb.judul, tp.tgl_pinjam, tp.tgl_kembali, tp.status FROM tbl_pinjam tp 
JOIN tbl_member tm ON tp.id_member = tm.id_member 
JOIN tbl_buku tb ON tp.id_buku = tb.id_buku WHERE tp.status = 'Approved'");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
  <div class="container">
    <h2 class="text-center mb-5 mt-4">Data Peminjaman Buku</h2>
    <div class=" d-flex justify-content-end">
      <a href="?page=pinjam" class="btn btn-dark btn-sm me-2" >All Status</a>
      <a href="?page=pinjam_pending" class="btn btn-warning btn-sm me-2" >Pending</a>
      <a href="?page=pinjam_approved" class="btn btn-success btn-sm me-2" >Approved</a>
      <a href="?page=pinjam_rejected" class="btn btn-danger btn-sm me-2" >Rejected</a>
      <a href="?page=pinjam_done" class="btn btn-info btn-sm me-4" >Done</a>
    </div>

<!-- Status : Approved -->
    <div class="card mb-6">
      <div class="text-black text-xxl font-weight-bold card-header bg-success">Status : Approved</div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th class="text-black text-center">No</th>
                <th class="text-black text-center">Id Member</th>
                <th class="text-black text-center">Nama</th>
                <th class="text-black text-center">Judul Buku</th>
                
                <th class="text-black text-center">Tanggal Pinjam</th>
                <th class="text-black text-center">Tanggal Kembali</th>
                <th class="text-black text-center">Aksi</th>
                
            </tr>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($approved)) :

            ?>
            <tr>
              <th class="font-weight-normal text-center"><?=$no++?></th>
              <th class="font-weight-normal text-center"><?= $data['id_member']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['nama']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['judul']; ?></th>
              
              <th class="font-weight-normal text-center"><?= $data['tgl_pinjam']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['tgl_kembali']; ?></th>
              <th class="text-center">
                <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDone<?= $no?>">Done</a>
                
              </th>
            </tr>

            <!-- Modal Done -->
            <div class="modal fade" id="modalDone<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Selesai Meminjaman Buku</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_pinjam" value="<?= $data['id_pinjam']?>">
                        <input type="hidden" name="id_buku" value="<?= $data['id_buku']?>">
                        <div class="modal-body">
                            
                            <h5 class="text-center">Apa anda yakin ingin mengakhiri peminjaman Buku ini?<br>
                                <span class="text-info"><?= $data['id_member']?> - <?= $data['nama']?></span><br> Judul Buku :
                                <span class="text-info"><?= $data['judul']?></span>
                            </h5>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="selesai" class="btn bg-info text-white">Done</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
                <!-- End Modal Done -->

                

            <?php endwhile; ?>   
        </table>
      </div>
    </div>

  </div>


</body>
</html>

