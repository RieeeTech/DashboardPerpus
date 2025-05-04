<?php

include "../service/database.php";

$keyword = $_GET["keyword"];

$no = 1;

$pinjam = mysqli_query($db, "SELECT tp.id_pinjam, tm.id_member, tm.nama, tb.judul, tp.tgl_pinjam, tp.tgl_kembali, tp.status FROM tbl_pinjam tp 
JOIN tbl_member tm ON tp.id_member = tm.id_member 
JOIN tbl_buku tb ON tp.id_buku = tb.id_buku WHERE tm.id_member LIKE '%$keyword%' OR tm.nama LIKE '%$keyword%' OR tb.judul LIKE '%$keyword%' OR tp.id_pinjam LIKE '%$keyword%' ORDER BY id_pinjam DESC");



?>

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