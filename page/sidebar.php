<?php 

// Database
include "service/database.php";

// Merubah SESSION Menjadi Variabel
$id_admin = $_SESSION["id_admin"];

// Query Untuk Mengambil data di Tabel
$dataAdmin1 = mysqli_query($db, "SELECT * FROM data_diri WHERE id_admin = '$id_admin'");
$data1 = mysqli_fetch_array($dataAdmin1);

?>


<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-3 py-3 m-0 d-flex align-items-center" href="?page=profilAdmin">
        <div class="avatar avatar-sm position-relative">
          <img src="images/<?= $data1['profil']?>" alt="profile_image" class="w-70 border-radius-lg shadow-sm">
        </div>
        <span class="ms-3 text-md text-dark text-capitalize"><?= $_SESSION["namaAdmin"] ?></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark" href="?page=home">
            <i class="bi bi-house-door text-sm"></i>
            <span class="nav-link-text ms-2">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="?page=content">
            <i class="bi bi-book text-sm"></i>
            <span class="nav-link-text ms-2">Data Buku</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="?page=member">
            <i class="bi bi-people text-sm"></i>
            <span class="nav-link-text ms-2">Data Member</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="?page=pinjam">
            <i class="bi bi-calendar text-sm"></i>
            <span class="nav-link-text ms-2">Data Peminjaman</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">User Pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="?page=user">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-2">Daftar Admin</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="page/logout.php">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-2">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>