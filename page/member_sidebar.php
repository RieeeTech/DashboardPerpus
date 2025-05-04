<?php

// Database
include "service/database.php";

// Merubah SESSION Menjadi Variabel
$id_member = $_SESSION['id_member'];

// Query Untuk Mengambil data di Tabel
$dataMember1 = mysqli_query($db, "SELECT * FROM data_diri WHERE id_member = '$id_member'");
$data1 = mysqli_fetch_array($dataMember1);

// Profil, Default
$fotoProfilIsi = $data1['profil'];
$fotoProfilDefault = 'defaultProfil.png';
$fotoProfil = (!empty($fotoProfilIsi)) ? $fotoProfilIsi : $fotoProfilDefault;


?>


<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-3 py-3 m-0 d-flex align-items-center" href="?page=profil">
        <div class="avatar avatar-sm position-relative">
          <img src="images/<?= $fotoProfil;?>" alt="profile_image" class="w-70 border-radius-lg shadow-sm">
        </div>
        <span class="ms-3 text-md text-dark text-capitalize"><?= $_SESSION["nama"] ?></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark" href="?page=daftarBuku">
            <i class="bi bi-book text-sm"></i>
            <span class="nav-link-text ms-1">Daftar Buku</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="?page=memberPinjam">
            <i class="bi bi-calendar text-sm"></i>
            <span class="nav-link-text ms-1">Peminjaman</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">User Pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="?page=profil">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="page/logout.php">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
