<?php

include "service/database.php";

$no = 1;

// Status : Rejected
$rejected = mysqli_query($db, "SELECT tp.id_pinjam, tm.id_member, tm.nama, tb.judul, tp.tgl_pinjam, tp.tgl_kembali, tp.status FROM tbl_pinjam tp 
JOIN tbl_member tm ON tp.id_member = tm.id_member 
JOIN tbl_buku tb ON tp.id_buku = tb.id_buku WHERE tp.status = 'Rejected'");

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

<!-- Status : Rejected -->
    <div class="card mb-6">
      <div class="text-black text-xxl font-weight-bold card-header bg-danger">Status : Rejected</div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th class="text-black text-center">No</th>
                <th class="text-black text-center">Id Member</th>
                <th class="text-black text-center">Nama</th>
                <th class="text-black text-center">Judul Buku</th>
                <th class="text-black text-center">Status</th>
                <th class="text-black text-center">Tanggal Pinjam</th>
                <th class="text-black text-center">Tanggal Kembali</th>
            </tr>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($rejected)) :

            ?>
            <tr>
              <th class="font-weight-normal text-center"><?=$no++?></th>
              <th class="font-weight-normal text-center"><?= $data['id_member']; ?></th>
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


</body>
</html>