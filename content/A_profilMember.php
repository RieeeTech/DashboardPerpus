<?php 

include "service/database.php";


// Untuk Melihat Profil Member Yang Dipilih
if(isset($_POST["profilMember"])){

$id_member = $_POST['id_member'];
$_SESSION['profil_member'] = $id_member;



echo "<script>
    document.location='dashboard.php?page=A_profilMember';
    </script>";

}


// Merubah SESSION Menjadi Variabel
$profilMember = $_SESSION['profil_member'];


// Query Untuk Mengambil data di Tabel
$dataMember = mysqli_query($db, "SELECT * FROM tbl_member WHERE id_member = '$profilMember'");
$data = mysqli_fetch_array($dataMember);


// Query Untuk Mengambil data di Tabel
$gambar = mysqli_query($db, "SELECT * FROM data_diri WHERE id_member = '$profilMember'");
$data1 = mysqli_fetch_array($gambar);


// Query Untuk Mengambil data di Tabel
$dataMemberLain = mysqli_query($db, "SELECT * FROM tbl_member WHERE id_member != '$profilMember'");


// Query Untuk Mengambil data di Tabel
$gambarMemberLain = mysqli_query($db, "SELECT * FROM data_diri WHERE id_member != '$profilMember'");

// Query Untuk Mengambil data di Tabel menggunakan JOIN
$riwayat = mysqli_query($db, "SELECT tm.id_member, tp.id_pinjam, tb.id_buku, tb.judul, tb.pengarang, tp.status, tp.tgl_pinjam, tp.tgl_kembali FROM tbl_pinjam tp JOIN tbl_buku tb ON tp.id_buku = tb.id_buku JOIN tbl_member tm ON tp.id_member = tm.id_member WHERE tm.id_member = '$profilMember' ");

?>







<div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-dark  opacity-6"></span>
      </div>
      <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="images/<?= $data1['profil']?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?= $data['nama']?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                <?= $data['id_member']?> - Member
              </p>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="row">
            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Platform Settings</h6>
                </div>
                <div class="card-body p-3">
                  <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
                  <ul class="list-group">
                    <li class="list-group-item border-0 px-0">
                      <div class="form-check form-switch ps-0">
                        <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Email me when someone follows me</label>
                      </div>
                    </li>
                    <li class="list-group-item border-0 px-0">
                      <div class="form-check form-switch ps-0">
                        <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Email me when someone answers on my post</label>
                      </div>
                    </li>
                    <li class="list-group-item border-0 px-0">
                      <div class="form-check form-switch ps-0">
                        <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked>
                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                      </div>
                    </li>
                  </ul>
                  <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
                  <ul class="list-group">
                    <li class="list-group-item border-0 px-0">
                      <div class="form-check form-switch ps-0">
                        <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">New launches and projects</label>
                      </div>
                    </li>
                    <li class="list-group-item border-0 px-0">
                      <div class="form-check form-switch ps-0">
                        <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault4" checked>
                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault4">Monthly product updates</label>
                      </div>
                    </li>
                    <li class="list-group-item border-0 px-0 pb-0">
                      <div class="form-check form-switch ps-0">
                        <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault5">
                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                      <h6 class="mb-0">Profile Information</h6>
                    </div>
                    <div class="col-md-4 text-end">
                      <a href="javascript:;">
                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <hr class="horizontal gray-dark mt-2">
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nama :</strong> <?= $data['nama']?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Nomor Handphone :</strong> <?= $data['no_hp']?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email :</strong> <?= $data['email']?></li>
                    <li class="list-group-item border-0 ps-0 text-sm text-capitalize"><strong class="text-dark">Alamat :</strong> <?= $data['alamat']?></li>
                    <li class="list-group-item border-0 ps-0 pb-0">
                      <strong class="text-dark text-sm">Deskripsi :</strong> 
                    </li>                
                  </ul>
                  <p class="text-sm mt-1 mb-5">
                    <?= $data1['data']?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-1">Member Lainnya</h6>
                </div>
                <div class="card-body p-3">
                  <ul class="list-group">
                    <?php 
                    while (($dataMemLain = mysqli_fetch_array($dataMemberLain)) && ($gambarMemLain = mysqli_fetch_array($gambarMemberLain))):
                    ?>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-3 pt-0">
                      <div class="avatar me-3">
                        <img src="images/<?= $gambarMemLain['profil']?>" alt="kal" class="border-radius-lg shadow">
                      </div>
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm"><?= $dataMemLain['nama']?></h6>
                        <p class="mb-0 text-xs"><?= $dataMemLain['id_member']?></p>
                      </div>
                      <form action="" method="post" class="pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto">
                        <input type="hidden" name="id_member" value="<?= $dataMemLain['id_member']?>">
                        <button type="submit" name="profilMember" class="btn btn-hidden">Profil</button>
                      </form>
                      
                    </li>
                    <?php endwhile; ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card card-plain h-100 mt-5">
              <h5 class="text-center">Riwayat Peminjaman</h5>
              <table class="table table-bordered table-striped table-hover mt-3">
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
              
                while ($dataB = mysqli_fetch_array($riwayat)) :

                ?>
                <tr>
                
                  <th class="font-weight-normal text-center"><?= $dataB['id_pinjam']; ?></th>
                  <th class="font-weight-normal text-center"><?= $dataB['id_buku']; ?></th>
                  
                  <th class="font-weight-normal text-center"><?= $dataB['judul']; ?></th>
                  <th class="font-weight-normal text-center"><?= $dataB['pengarang']; ?></th>
                  <th class="font-weight-normal text-center"><?= $dataB['status']; ?></th>
                  <th class="font-weight-normal text-center"><?= $dataB['tgl_pinjam']; ?></th>
                  <th class="font-weight-normal text-center"><?= $dataB['tgl_kembali']; ?></th>
                </tr>
                <?php endwhile; ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>