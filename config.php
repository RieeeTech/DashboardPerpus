<?php

$page = '';
if ( isset($_GET['page']) ){
  $page = $_GET['page'];
}

switch ( $page ){
  case 'home':
    $pageJudul = "Dashboard";
    $page = "include('content/home_dashboard.php');";
    break;

  case 'profil':
    $pageJudul = "Profil Member";
    $page = "include('content/profilMember.php');";
    break;

  case 'pinjam_pending':
    $pageJudul = "Status Peminjaman : Pending";
    $page = "include('content/statusPinjam/pinjam_StatusPending.php');";
    break;

  case 'pinjam_approved':
    $pageJudul = "Status Peminjaman : Approved";
    $page = "include('content/statusPinjam/pinjam_StatusApproved.php');";
    break;

  case 'pinjam_rejected':
    $pageJudul = "Status Peminjaman : Rejected";
    $page = "include('content/statusPinjam/pinjam_StatusRejected.php');";
    break;

  case 'pinjam_done':
    $pageJudul = "Status Peminjaman : Done";
    $page = "include('content/statusPinjam/pinjam_StatusDone.php');";
    break;

  case 'profilAdmin':
    $pageJudul = "Profil Admin";
    $page = "include('content/profilAdmin.php');";
    break;

  case 'pinjam':
    $pageJudul = "Data Peminjaman";
    $page = "include('content/pinjam.php');";
    break;

  case 'memberPinjam':
    $pageJudul = "Peminjaman";
    $page = "include('content/member_pinjam.php');";
    break;

  case 'member':
    $pageJudul = "Manajemen Member Perpustakaan";
    $page = "include('content/member.php');";
    break;

  case 'user':
    $pageJudul = "User Admin";
    $page = "include('content/user_admin.php');";
    break;

  case 'A_profilMember':
    $pageJudul = "Profil Member";
    $page = "include('content/A_profilMember.php');";
    break;

  case 'content':
    $pageJudul = "Manajemen Data Buku";
    $page = "include('content/content.php');";
    break;

  case 'daftarBuku':
    $pageJudul = "Daftar Buku";
    $page = "include('content/daftarBuku.php');";
    break;

  case 'cariPinjam':
    $pageJudul = "";
    $page = "include('ajax/cariPinjam.php');";
    break;

  case 'tambahBuku':
    $pageJudul = "Tambah Data Buku";
    $page = "include('content/tambahBuku.php');";
    break;

  default:
    $pageJudul = "Home";
    $page = "include('content/defaultContent.php');";
    break;
}

$main = $page;
?>