<?php


session_start();
include "../service/database.php";

// Jika SESSION Login Sudah Dijalankan, Masuk Ke Dashboard
if ( isset($_SESSION["is_Login"])) {
  header ("location: ../dashboard.php");
}

// Jika SESSION Sudah Ada atau Dijalankan, Lanjut Regist Akun User
if(isset($_SESSION["id_member"])){
  header("location: registerAkun.php");
}

// POST Sekaligus Buat SESSION Untuk Daftar Akun
if ( isset($_POST['register'])){
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_hp = $_POST['no_hp'];
  
  // Query Untuk Memasukkan Data Dari POST
  $sql = mysqli_query($db, "INSERT INTO tbl_member (nama, alamat, no_hp) VALUES ('$nama','$alamat','$no_hp')");

  // Query Untuk Mengambil data di Tabel
  $sesId = mysqli_query($db, "SELECT * FROM tbl_member WHERE nama = '$nama'");
  $data = mysqli_fetch_array($sesId);

  // Membuat SESSION
  $_SESSION["id_member"] = $data["id_member"];
  $_SESSION["nama"] = $nama;

  
  // Jika SESSION Sudah Ada atau Dijalankan, Lanjut Regist Akun User
  if(isset($_SESSION["id_member"])){
  header("location: registerAkun.php");
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Register
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="">
  
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Daftar</h4>
                  <p class="mb-0">Masukkan Data Diri Anda Dibawah Sini.</p>
                </div>
                <div class="card-body">
                  <form action="register.php" method="post" role="form">
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Alamat</label>
                      <input type="textarea" name="alamat" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Nomor Handphone</label>
                      <input type="number" name="no_hp" class="form-control">
                    </div>
                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" name="register" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Register</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Sudah Daftar Diri?
                    <a href="registerAkun.php" class="text-primary text-gradient font-weight-bold">Daftar Akun</a>
                  </p>
                  <p class="mb-2 text-sm mx-auto">
                    Sudah Memiliki Akun?
                    <a href="../index.php" class="text-primary text-gradient font-weight-bold">Login</a>
                  </p>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modalHapus<?= $no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title font-weight-normal text-white" id="exampleModalLabel">Hapus Data Buku</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        
                        </button>
                    </div>
                    <form action="../service/crud.php" method="post">
                        <input type="hidden" name="id_buku" value="<?= $data['id_buku']?>">
                        <div class="modal-body">
                            
                            <h5 class="text-center">Apa anda yakin ingin menghapus data buku ini?<br>
                                <span class="text-danger"><?= $data['judul']?> - <?= $data['pengarang']?></span>
                            </h5>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="hapus" class="btn bg-danger text-white">Hapus</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>