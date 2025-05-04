<?php 

include "service/database.php";


// Logika Untuk Menambahkan Foto Profil Admin
if(isset($_POST["tambahProfileAdmin"])){
  $id_admin = $_SESSION['id_admin'];


  $img = $_FILES['dataGambar']['name'];
  $tmp = $_FILES['dataGambar']['tmp_name'];

  $timestamp = time();
  $newName = $timestamp."-"."Admin".$img;


  $db->query("UPDATE data_diri SET profil = '$newName' WHERE id_admin = '$id_admin'");
  $location = 'images/'.$newName;
  move_uploaded_file($tmp, $location);
  



}




$id_admin = $_SESSION["id_admin"];

$dataAdmin = mysqli_query($db, "SELECT * FROM tbl_admin WHERE id_admin = '$id_admin'");
$data = mysqli_fetch_array($dataAdmin);

$dataAdmin1 = mysqli_query($db, "SELECT * FROM data_diri WHERE id_admin = '$id_admin'");
$data1 = mysqli_fetch_array($dataAdmin1);


// $riwayat = mysqli_query($db, "SELECT tm.id_member, tp.id_pinjam, tb.id_buku, tb.judul, tb.pengarang, tp.status, tp.tgl_pinjam, tp.tgl_kembali FROM tbl_pinjam tp JOIN tbl_buku tb ON tp.id_buku = tb.id_buku JOIN tbl_member tm ON tp.id_member = tm.id_member ");




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
                <?= $data['id_admin']?> - Admin
              </p>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="row">
            
            <div class="ms-4 col-12 col-xl-7">
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
                  <button type="button" class="btn bg-gradient-info btn-sm " data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Ubah Data
                  </button>
                  <button type="button" class="btn bg-gradient-info btn-sm " data-bs-toggle="modal" data-bs-target="#modalProfileP">
                  Profile
                  </button>
                </div>
              </div>
            </div>
            
            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Conversations</h6>
                </div>
                <div class="card-body p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                      <div class="avatar me-3">
                        <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                      </div>
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Sophie B.</h6>
                        <p class="mb-0 text-xs">Hi! I need more information..</p>
                      </div>
                      <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                      <div class="avatar me-3">
                        <img src="../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                      </div>
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Anne Marie</h6>
                        <p class="mb-0 text-xs">Awesome work, can you..</p>
                      </div>
                      <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                      <div class="avatar me-3">
                        <img src="../assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
                      </div>
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Ivanna</h6>
                        <p class="mb-0 text-xs">About files I can..</p>
                      </div>
                      <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                      <div class="avatar me-3">
                        <img src="../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                      </div>
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Peterson</h6>
                        <p class="mb-0 text-xs">Have a great afternoon..</p>
                      </div>
                      <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0">
                      <div class="avatar me-3">
                        <img src="../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                      </div>
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Nick Daniel</h6>
                        <p class="mb-0 text-xs">Hi! I need more information..</p>
                      </div>
                      <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
             
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Ubah Data Diri</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="service/crud.php" method="post">
                        <div class="modal-body">
                            <div class="input-group input-group-static mb-4">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="dataNama" value="<?= $data['nama']?>">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Nomor Handphone</label>
                                <input type="number" class="form-control" name="dataNo_hp" value="<?= $data['no_hp']?>">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Email</label>
                                <input type="email" class="form-control" name="dataEmail" value="<?= $data['email']?>">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="dataAlamat" value="<?= $data['alamat']?>">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Deskripsi</label>
                                <input type="textarea" class="form-control" name="dataDiri" value="<?= $data1['data']?>">
                            </div>
                            
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="updateData" class="btn bg-gradient-info">Tambah</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>

    <div class="modal fade" id="modalProfileP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Upload Foto Profile</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                            
                            <div class="input-group input-group-static mb-4">
                                <label>Foto Profile</label>
                                <input type="file" class="form-control" name="dataGambar">
                            </div>
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="tambahProfileAdmin" class="btn bg-gradient-info">Tambah</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>