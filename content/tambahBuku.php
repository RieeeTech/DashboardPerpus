<?php

include "service/database.php";


if(isset($_POST["tambah"])){
  $simpan = mysqli_query($db, "INSERT INTO tbl_buku (judul, pengarang, thn_terbit, stok) VALUES ('$_POST[judul]','$_POST[pengarang]','$_POST[thn_terbit]','$_POST[stok]')");


  if($simpan){
    echo "<script>alert('Berhasil Menambahkan Data!!');
    location.href='dashboard.php?page=content';
    </script>";
  } else {
    echo "<script>alert('Gagal Menambahkan Data!!');
    location.href='dashboard.php?page=content';
    </script>";
  }
}


?>


<div class="container">
  <h2>Tambah Data Buku</h2>
  <div class="card">
    <div class="card-header bg-dark text-light">
      Tambah
    </div>
    <form action="" method="post">
      <div class="card-body">
        <div class="input-group input-group-static mb-4">
          <label>Judul</label>
          <input type="text" class="form-control" name="judul">
        </div>
        <div class="input-group input-group-static mb-4">
          <label>Pengarang</label>
          <input type="text" class="form-control" name="pengarang">
        </div>
        <div class="input-group input-group-static mb-4">
          <label>Tahun Terbit</label>
          <input type="text" class="form-control" name="thn_terbit">
        </div>
        <div class="input-group input-group-static mb-4">
          <label>Stok</label>
          <input type="text" class="form-control" name="stok">
        </div>
      </div>
      <div class="card-footer">
        <a href="?page=content" class="btn bg-gradient-secondary">Kembali</a>
        <button type="submit" name="tambah" class="btn bg-gradient-info">Tambah Data</button>
      </div>
    </form>
  </div>
</div>