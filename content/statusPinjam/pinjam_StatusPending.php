<?php

include "service/database.php";


if(isset($_POST["setuju"])){
  $setuju = mysqli_query($db, "UPDATE tbl_pinjam SET status = 'Approved' WHERE id_pinjam = '$_POST[id_pinjam]'");


  if($setuju){
    echo "<script>alert('Berhasil');
    
    </script>";
  } else {
    echo "<script>alert('Gagal');
    
    </script>";
  }
}




if(isset($_POST["tolak"])){
  $tolak = mysqli_query($db, "UPDATE tbl_pinjam SET status = 'Rejected' WHERE id_pinjam = '$_POST[id_pinjam]'");

  $id_buku = $_POST['id_buku'];
  $updateStok = mysqli_query($db, "UPDATE tbl_buku SET stok = stok + 1 WHERE id_buku = $id_buku");

  if($tolak){
    echo "<script>alert('Berhasil');
    
    </script>";
  } else {
    echo "<script>alert('Gagal');
    
    </script>";
  }
}




$no = 1;

// Status : Pending
$pending = mysqli_query($db, "SELECT tb.id_buku, tp.id_pinjam, tm.id_member, tm.nama, tb.judul, tp.tgl_pinjam, tp.tgl_kembali, tp.status FROM tbl_pinjam tp 
JOIN tbl_member tm ON tp.id_member = tm.id_member 
JOIN tbl_buku tb ON tp.id_buku = tb.id_buku WHERE tp.status = 'Pending' ORDER BY id_pinjam ASC ");

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
    <div class="d-flex justify-content-between align-center">
        <form action="" method="post" class="w-35 ms-2">
          <div class="input-group input-group-outline my-0 me-6 ms-0 ">
            <label class="form-label">Masukkan Id Member, Nama Atau Judul Buku </label>
            <input type="text" class="form-control" name="keyword" id="pendingCari">
            <!-- <button type="button" name="cari" class="btn btn-info">Cari</button> -->
          </div>
        </form>
      <div>
        <a href="?page=pinjam" class="btn btn-dark btn-sm me-2" >All Status</a>
        <a href="?page=pinjam_pending" class="btn btn-warning btn-sm me-2" >Pending</a>
        <a href="?page=pinjam_approved" class="btn btn-success btn-sm me-2" >Approved</a>
        <a href="?page=pinjam_rejected" class="btn btn-danger btn-sm me-2" >Rejected</a>
        <a href="?page=pinjam_done" class="btn btn-info btn-sm me-4" >Done</a>
      </div>
    </div>

<!-- Status : Pending -->
    <div class="card mb-6">
      <div class="text-black text-xxl font-weight-bold card-header bg-warning">Status : Pending</div>
      <div class="card-body" id="hasilPending">
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
            while ($data = mysqli_fetch_array($pending)) :

            ?>
            <tr class="align-middle">
              <th class="font-weight-normal text-center"><?=$no++?></th>
              <th class="font-weight-normal text-center"><?= $data['id_member']; ?></th>
              <th class="font-weight-normal "><?= $data['nama']; ?></th>
              <th class="font-weight-normal "><?= $data['judul']; ?></th>
              
              <th class="font-weight-normal text-center"><?= $data['tgl_pinjam']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['tgl_kembali']; ?></th>
              <th class="text-center">
                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalApproved<?= $no?>">Approved</a>
                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalRejected<?= $no?>">Rejected</a>
              </th>
            </tr>

            <!-- Modal Approved -->
            <div class="modal fade" id="modalApproved<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Menyetujui Peminjaman Buku</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_pinjam" value="<?= $data['id_pinjam']?>">
                        <div class="modal-body">
                            
                            <h5 class="text-center">Apa anda yakin ingin menyetujui peminjaman Buku ini?<br>
                                <span class="text-success"><?= $data['id_member']?> - <?= $data['nama']?></span><br> Judul Buku :
                                <span class="text-success"><?= $data['judul']?></span>
                            </h5>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="setuju" class="btn bg-success text-white">Setuju</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
                <!-- End Modal Approved -->


                <!-- Modal Rejected -->
            <div class="modal fade" id="modalRejected<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Menolak Peminjaman Buku</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_pinjam" value="<?= $data['id_pinjam']?>">
                        <input type="hidden" name="id_buku" value="<?= $data['id_buku']?>">
                        <div class="modal-body">
                            
                            <h5 class="text-center">Apa anda yakin ingin menolak peminjaman Buku ini?<br>
                                <span class="text-danger"><?= $data['id_member']?> - <?= $data['nama']?></span><br> Judul Buku :
                                <span class="text-danger"><?= $data['judul']?></span>
                            </h5>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="tolak" class="btn bg-danger text-white">Tolak</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
                <!-- End Modal Rejected -->

                <?php endwhile; ?>   
        </table>
      </div>
    </div>
  </div>

  
  <script>
    function createXHRRequest(url, targetContainer, keywordValue) {
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
            targetContainer.innerHTML = xhr.responseText;
            }
        };

        xhr.open("GET", url + keywordValue, true);
        xhr.send();
    }

    var container1 = document.getElementById("hasilPending");
    var keyword1 = document.getElementById("pendingCari");

    keyword1.addEventListener("keyup", function () {
        createXHRRequest(
            "ajax/cariPinjamPending.php?keyword=",
            container1,
            keyword1.value
        );
        });
  </script>
</body>
</html>