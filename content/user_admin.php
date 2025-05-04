<?php
  include "service/database.php";
?>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4 text-center">User Admin</h2>  
      <hr>
    </div>
  </div>
  
  <div class="row">
    <!-- Dashboard: Member -->
    <?php
            $user = mysqli_query($db,"SELECT * FROM users WHERE role = 'admin'");
            while ($data = mysqli_fetch_array($user)) :


            ?>

    <!-- Dashboard: User Admin -->
    <div class="col-md-3 col-sm-6 col-xs-6 mt-3">
      <div class="card" style="width: 16rem;">
        <div class="card-body">
          <h5 class="card-title text-center text-xl text-info" style="font-size: 40px;"><i class="bi bi-person-circle"></i></i></h5>


          <b>
            <h5 class="card-subtitle mb-4 mt-3 text-danger text-center text-capitalize">Admin - <?= $data['username'] ?></h5>
          </b>


          

        </div>
      </div>
    </div>
    <?php endwhile ?>
  </div>
    
</div>