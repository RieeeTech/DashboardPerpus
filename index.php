<!--
=========================================================
* Material Dashboard 3 - v3.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<?php

// Database
include "service/database.php";

// Memulai SESSION
session_start();

// Status Login, Jika True Maka Masuk
if (isset($_SESSION["is_Login"])) {
  header ("location: dashboard.php");
}

// Login User
if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
}

// Query Untuk Mengambil data di Tabel
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $db->query($sql);

// Jika Tabel-nya Ada isi atau Row Lebih dari 0, Buat SESSION
if ($result->num_rows > 0 ) {
  $data = $result->fetch_assoc();
  $_SESSION["username"] = $data["username"];
  $_SESSION["is_Login"] = true;
  $_SESSION["id_admin"] = $data["id_admin"];
  $_SESSION["id_member"] = $data["id_member"];
  $_SESSION["role"] = $data["role"];


  
  // Merubah SESSION Menjadi Variabel
  $id_member = $_SESSION["id_member"];

  // Query Untuk Mengambil data di Tabel
  $sql1 = "SELECT * FROM tbl_member WHERE id_member = '$id_member'";
  $result1 = $db->query($sql1);

  // Jika Tabel Memiliki Isi, Maka Buat SESSION
  if($result1 -> num_rows > 0){
    $data1 = $result1->fetch_assoc();
    $_SESSION["nama"] = $data1["nama"];
  }



  // Merubah SESSION Menjadi Variabel
  $id_admin = $_SESSION["id_admin"];

  // Query Untuk Mengambil data di Tabel
  $sql2 = "SELECT * FROM tbl_admin WHERE id_admin = '$id_admin'";
  $result2 = $db->query($sql2);

  // Jika Tabel Memiliki Isi, Maka Buat SESSION
  if($result2 -> num_rows > 0){
    $data2 = $result2->fetch_assoc();
    $_SESSION["namaAdmin"] = $data2["nama"];
    
  }

  // Setelah semua Logika Dijalankan, Masuk Ke Dashboard
  header(header: "location: dashboard.php");

}


// Lupa Password
if(isset($_POST["UsernamePassBaru"])){
  $id_member = $_POST["id_memberLupa"];
  $usernameBaru = $_POST["usernameLupa"];
  $passwordBaru = $_POST["passwordLupa"];

  // Query untuk Update Data Tabel
  $update = mysqli_query($db, "UPDATE users SET username = '$usernameBaru', password = '$passwordBaru' WHERE id_member = '$id_member' ");

  if ($update){
    echo "<script>alert('Berhasil Merubah Username dan Password!!');
          document.location='index.php';
          </script>";
  } else{
    echo "<script>alert('Gagal Merubah Username dan Password!!');
          document.location='index.php';
          </script>";
  }
  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Login
  </title>
  <!-- Bootstrap 5 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="bg-gray-200">
  
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-4 mb-4">Sign in</h4>
                  
                </div>
              </div>
              <div class="card-body">
                <form action="index.php" method="post" role="form" class="text-start">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control">
                  </div>
                  <div class="input-group input-group-outline mb-1">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                  </div>
                  <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-link text-underline text-sm" data-bs-toggle="modal" data-bs-target="#modalLupaPassword">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="login" class="btn bg-gradient-dark w-100 my-4 mb-2">Login</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="page/register.php" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>



      <!-- Modal Lupa Password -->
      <div class="modal fade" id="modalLupaPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title font-weight-normal text-white text-center" id="exampleModalLabel">Lupa Password?</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form action="" method="post">
                      <div class="modal-body">
                        <div class="input-group input-group-static mt-2 mb-5">
                          <label class="text-black">Masukkan Id Member Anda :</label>
                          <input type="number" class="form-control" name="id_memberLupa">
                        </div>
                        <div class="input-group input-group-static mt-2 mb-5">
                          <label class="text-black">Masukkan Username Baru Anda :</label>
                          <input type="text" class="form-control" name="usernameLupa">
                        </div>
                        <div class="input-group input-group-static mt-2 mb-4">
                          <label class="text-black">Masukkan Password Baru Anda :</label>
                          <input type="text" class="form-control" name="passwordLupa">
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" name="UsernamePassBaru" class="btn bg-success text-white">Selanjutnya</button>       
                      </div>
                    </form>
                </div>
                </div>
                </div>



      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
              <div class="copyright text-center text-sm text-white text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script> RieeeTech,
                made with <i class="fa fa-heart" aria-hidden="true"></i> template by
                <a href="https://www.creative-tim.com" class="font-weight-bold text-white" target="_blank">Creative Tim</a>
                
              </div>
            </div>
            <div class="col-12 col-md-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-white" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-white" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-white" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-white" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
  <script src="assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>