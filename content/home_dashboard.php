<?php
  include "service/database.php";
?>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h5><marquee>Hallo <span class="text-capitalize"><?= $_SESSION["username"] ?></span>!!! Selamat Datang di Halaman Utama RieeeTech. Library</marquee></h5>
      <h3 class="mt-5">Admin Dashboard RieeeTech. Library</h3>  
      <hr>
    </div>
  </div>
  
  <div class="row">
    <!-- Dashboard: Member -->
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="card" style="width: 16rem;">
        <div class="card-body">
          <h5 class="card-title text-center text-xl text-info" style="font-size: xx-large;"><i class="bi bi-people"></i></h5>


          <b><?php
            $member = mysqli_query($db,"SELECT * FROM users WHERE role = 'member'");
            $jml_member = mysqli_num_rows($member);

            ?>
            <h5 class="card-subtitle mb-4 mt-2 text-body-secondary text-center"><?= $jml_member ?> Member</h5>
          </b>


          

          <h6 class="text-center font-weight-normal text-underline "><a href="?page=member" class="card-link">Lihat Detail</a></h6>
        </div>
      </div>
    </div>

    <!-- Dashboard: Buku -->
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="card" style="width: 16rem;">
        <div class="card-body">
          <h5 class="card-title text-center text-xl text-info" style="font-size: xx-large;"><i class="bi bi-book"></i></h5>


          <b><?php
            $buku = mysqli_query($db,"SELECT * FROM tbl_buku");
            $jml_buku = mysqli_num_rows($buku);

            ?>
            <h5 class="card-subtitle mb-4 mt-2 text-body-secondary text-center"><?= $jml_buku ?> Buku</h5>
          </b>


          

          <h6 class="text-center font-weight-normal text-underline "><a href="?page=content" class="card-link">Lihat Detail</a></h6>
        </div>
      </div>
    </div>
    

    <!-- Dashboard: Peminjaman-->
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="card" style="width: 16rem;">
        <div class="card-body">
          <h5 class="card-title text-center text-xl text-info" style="font-size: xx-large;"><i class="bi bi-calendar"></i></i></h5>


          <b><?php
            $user = mysqli_query($db,"SELECT * FROM tbl_pinjam");
            $jml_user = mysqli_num_rows($user);

            ?>
            <h5 class="card-subtitle mb-4 mt-2 text-body-secondary text-center"><?= $jml_user ?> Peminjaman</h5>
          </b>


          

          <h6 class="text-center font-weight-normal text-underline "><a href="?page=pinjam" class="card-link">Lihat Detail</a></h6>
        </div>
      </div>
    </div>
    <!-- Dashboard: User Admin -->
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="card" style="width: 16rem;">
        <div class="card-body">
          <h5 class="card-title text-center text-xl text-info" style="font-size: xx-large;"><i class="bi bi-person-circle"></i></i></h5>


          <b><?php
            $user = mysqli_query($db,"SELECT * FROM users WHERE role = 'admin'");
            $jml_user = mysqli_num_rows($user);

            ?>
            <h5 class="card-subtitle mb-4 mt-2 text-body-secondary text-center"><?= $jml_user ?> Admin User</h5>
          </b>


          

          <h6 class="text-center font-weight-normal text-underline "><a href="?page=user" class="card-link">Lihat Detail</a></h6>
        </div>
      </div>
    </div>
  </div>
  
</div>