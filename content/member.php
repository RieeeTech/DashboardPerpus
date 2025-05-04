<?php

include "service/database.php";


// Edit Member
if(isset($_POST["editMember"])){
  $edit = mysqli_query($db, "UPDATE tbl_member SET nama = '$_POST[nama]',
                                                                  alamat = '$_POST[alamat]',
                                                                  no_hp = '$_POST[no_hp]',
                                                                  status = '$_POST[status]' 
                                                                  WHERE id_member = '$_POST[id_member]'
                                                                  ");
  if($edit){
    echo "<script>alert('Berhasil Mengedit Data!!');
    document.location='dashboard.php?page=member';
    </script>";
  } else {
    echo "<script>alert('Gagal Mengedit Data!!');
    document.location='dashboard.php?page=member';
    </script>";
  }
}



// Untuk Melihat Profil Member menggunakan SESSION yang di POST
if(isset($_POST["profilMember"])){

$id_member = $_POST['id_member'];
$_SESSION['profil_member'] = $id_member;



echo "<script>
    document.location='dashboard.php?page=A_profilMember';
    </script>";

}


?>


<div class="container">
    <h2 class="text-center mt-3 mb-3">Manajemen Data Member</h2>
    <div class="card mb-5">
        <div class="card-header bg-dark text-white">
            Data Member Perpustakaan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th class="text-dark text-center">No</th>
                    <th class="text-dark text-center">Id Member</th>
                    <th class="text-dark text-center">Nama</th>
                    <th class="text-dark text-center">Alamat</th>
                    <th class="text-dark text-center">No. Handphone</th>
                    <th class="text-dark text-center">Status Member</th>
                    <th class="text-dark text-center">Waktu Daftar</th>
                    <th class="text-dark text-center">Aksi</th>
                </tr>

                <?php
                $no = 1;
                // $tampil_member = mysqli_query($db, "SELECT tm.id_member, tm.nama, tm.alamat, tm.no_hp, tm.status, tm.tgl_daftar FROM users u JOIN tbl_member tm ON u.id_member = tm.id_member WHERE role = 'member' ");
                $tampil_member = mysqli_query($db, "SELECT * FROM tbl_member ");

                while ($data = mysqli_fetch_array($tampil_member)) :

                ?>

                <tr class="align-middle"> 
                    <th class="text-center text-sm font-weight-normal text-wrap"><?= $no++ ?></th>
                    <th class="text-center text-sm font-weight-normal text-wrap"><?= $data['id_member'] ?></th>
                    <th class="text-center text-sm font-weight-normal text-wrap text-capitalize"><?= $data['nama']?></th>
                    <th class="text-center text-sm font-weight-normal text-wrap text-capitalize"><?= $data['alamat']?></th>
                    <th class="text-center text-sm font-weight-normal text-wrap"><?= $data['no_hp']?></th>
                    <th class="text-center text-sm font-weight-normal text-wrap"><?= $data['status']?></th>
                    <th class="text-center text-sm font-weight-normal text-wrap"><?= $data['tgl_daftar']?></th>
                    <th class="text-center">
                        <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalInfo<?= $no?>">Info</a>
                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $no?>">Edit</a>
                    </th>
                </tr>

                <!-- Awal Modal Ubah -->
                <div class="modal fade" id="modalUbah<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Form Ubah Data Member</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_member" value="<?= $data['id_member']?>">
                        <div class="modal-body">
                            <div class="input-group input-group-static mb-4">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $data['nama']?>">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="<?= $data['alamat']?>">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>No Handphone</label>
                                <input type="text" class="form-control" name="no_hp" value="<?= $data['no_hp']?>">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label for="exampleFormControlSelect1" class="ms-0">Status</label>
                                <select name="status" class="form-control" id="exampleFormControlSelect1">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="editMember" class="btn bg-warning text-white">Edit</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
                <!-- Akhir Modal Ubah -->




                <!-- Awal Modal Info -->
                <div class="modal fade" id="modalInfo<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Detail Member</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_member" value="<?= $data['id_member']?>">
                        <div class="modal-body">
                          <p class="mb-2"><h6>ID Member : </h6><?= $data['id_member']?></p>
                          <p class="mb-4"><h6>Nama : </h6><?= $data['nama']?></p>
                          <p class="mb-4"><h6>Alamat : </h6><?= $data['alamat']?></p>
                          <p class="mb-4"><h6>Nomor Handphone : </h6><?= $data['no_hp']?></p>
                          
                          <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="profilMember" class="btn bg-info text-white">Lihat Profil</button>
                        </div>
                            
                            

                        </div>
                        
                    </form>
                </div>
                </div>
                </div>
                <!-- Akhir Modal Detail -->



                

                <?php endwhile; ?>
            </table>

            <!-- Button trigger modal
            <button type="button" class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
            </button> -->

            
        </div>
    </div>
</div>