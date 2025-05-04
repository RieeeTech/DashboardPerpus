<?php

include "service/database.php";


// Merubah SESSION Menjadi Variabel
$id_member = $_SESSION['id_member'];

// Query Untuk Mengambil data di Tabel menggunakan JOIN
$memberPinjam = mysqli_query($db, "SELECT tm.id_member, tp.id_pinjam, tb.id_buku, tb.judul, tb.pengarang, tp.status, tp.tgl_pinjam, tp.tgl_kembali FROM tbl_pinjam tp JOIN tbl_buku tb ON tp.id_buku = tb.id_buku JOIN tbl_member tm ON tp.id_member = tm.id_member WHERE tm.id_member = '$id_member' ORDER BY tp.id_pinjam DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
  <div class="container">
    <h2 class="text-center my-4">Peminjaman Buku</h2>

    <!-- All Status -->
    <div class="card mb-6">
      <div class="text-white text-xxl font-weight-bold card-header bg-dark">Data Peminjaman Buku <span class="text-capitalize"><?= $_SESSION["nama"]?></span></div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                
                <th class="text-black text-center">Id</th>
                <th class="text-black text-center">Id Buku</th>
                
                <th class="text-black text-center">Judul Buku</th>
                <th class="text-black text-center">Pengarang</th>
                <th class="text-black text-center">Status</th>
                <th class="text-black text-center">Tanggal Pinjam</th>
                <th class="text-black text-center">Tanggal Kembali</th>
            </tr>
            <?php
            
            while ($data = mysqli_fetch_array($memberPinjam)) :

            ?>
            <tr>
              
              <th class="font-weight-normal text-center"><?= $data['id_pinjam']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['id_buku']; ?></th>
              
              <th class="font-weight-normal text-center"><?= $data['judul']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['pengarang']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['status']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['tgl_pinjam']; ?></th>
              <th class="font-weight-normal text-center"><?= $data['tgl_kembali']; ?></th>
            </tr>
          <?php endwhile; ?>   
        </table>
      </div>
    </div>
  </div>