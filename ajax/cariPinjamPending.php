<?php

include "../service/database.php";


$keyword = $_GET["keyword"];

$no = 1;

$pending = mysqli_query($db, "SELECT tp.id_buku, tp.id_pinjam, tm.id_member, tm.nama, tb.judul, tp.tgl_pinjam, tp.tgl_kembali, tp.status FROM tbl_pinjam tp 
JOIN tbl_member tm ON tp.id_member = tm.id_member 
JOIN tbl_buku tb ON tp.id_buku = tb.id_buku WHERE tp.status = 'Pending' 
AND (
    tm.id_member LIKE '%$keyword%' 
    OR tm.nama LIKE '%$keyword%' 
    OR tb.judul LIKE '%$keyword%'
) 
ORDER BY tm.id_member DESC");



?>

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
                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalRejected1<?= $no?>">Rejected</a>
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
                    <form action="service/crud.php" method="post">
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
            <div class="modal fade" id="modalRejected1<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Menolak Peminjaman Buku</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="service/crud.php" method="post">
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
                            <button type="submit" name="tolake" class="btn bg-danger text-white">Tolak</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
                <!-- End Modal Rejected -->

                <?php endwhile; ?>   
        </table>