<?php 

include "service/database.php";




$no = 1;

$pinjam = mysqli_query($db, "SELECT tp.id_pinjam, tm.id_member, tm.nama, tb.judul, tp.tgl_pinjam, tp.tgl_kembali, tp.status FROM tbl_pinjam tp 
JOIN tbl_member tm ON tp.id_member = tm.id_member 
JOIN tbl_buku tb ON tp.id_buku = tb.id_buku ORDER BY id_pinjam DESC");

  




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
            <input type="text" class="form-control" name="keyword" id="keyword">
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
    


    <!-- All Status -->
    <div class="card mb-6">
      <div class="text-white text-xxl font-weight-bold card-header bg-dark">Data Peminjaman Buku</div>
      <div class="card-body" id="container">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th class="text-black text-center">No</th>
                <th class="text-black text-center">Id Member</th>
                <th class="text-black text-center">Id Peminjaman</th>
                <th class="text-black text-center">Nama</th>
                <th class="text-black text-center">Judul Buku</th>
                <th class="text-black text-center">Status</th>
                <th class="text-black text-center">Tanggal Pinjam</th>
                <th class="text-black text-center">Tanggal Kembali</th>
            </tr>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($pinjam)) :

            ?>
            <tr>
              <th class="font-weight-normal text-center"><?=$no++?></th>
              <th class="font-weight-normal text-center"><?= $data['id_member']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['id_pinjam']; ?></th>
              <th class="font-weight-normal "><?= $data['nama']; ?></th>
              <th class="font-weight-normal "><?= $data['judul']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['status']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['tgl_pinjam']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['tgl_kembali']; ?></th>
            </tr>
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

// Elemen-elemen DOM
var keyword = document.getElementById("keyword");
var container = document.getElementById("container");

// Event listener untuk elemen keyword
keyword.addEventListener("keyup", function () {
  createXHRRequest("ajax/cariPinjam.php?keyword=", container, keyword.value);
});
</script>
</body>
</html>