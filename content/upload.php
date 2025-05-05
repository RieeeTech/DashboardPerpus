<?php
include "service/database.php";

if(isset($_GET['id'])){ //jika nilai id nya ada
$id = $_GET['id'];
//query tampil
$tampil = mysqli_query($db, "SELECT * FROM tbl_buku WHERE id_buku = '$id'");
$data = mysqli_fetch_array($tampil);


}
//jika tombol diklik
if(isset($_POST['proses'])){
    //simpan nilai inputan pada variable
    $cover = $_FILES['cover'];
    $namafile = $_FILES['cover']['name'];
    $ukuran = $_FILES['cover']['size'];
    $tipe = $_FILES['cover']['type'];
    $ext = explode('.',$namafile);
    $ext_file = strtolower(end($ext));
    $extensi_diizinkan = ['jpg','png','jpeg','webp'];

    //jika file belum dipilih
    if(isset($_FILES['cover']) && $_FILES['cover']['error']===UPLOAD_ERR_OK){
        //jika ekstensi file sudah sesuai
        if (in_array($ext_file, $extensi_diizinkan)){
            //jika ukuran file sudah sesuai
            if($ukuran < 1024000){
                //proses upload
                $filecover = $id.'_'.$namafile;
                move_uploaded_file($_FILES['cover']
                ['tmp_name'],'upload/'.$filecover);
                $query=mysqli_query($db, "UPDATE tbl_buku SET cover = '$filecover' WHERE id_buku = '$id'");
                echo "<script>alert('Upload Berhasil!');
                location.href='dashboard.php?page=content&id= ".$id."';</script>";
            }else{
                echo "<script>alert('Upload Gagal!, Ukuran File terlalu Besar');
                location.href='dashboard.php?page=content&id= ".$id."';</script>";
            }
        }else{
            echo "<script>alert('Upload Gagal!, Tipe Data Tidak Sesuai');
            location.href='dashboard.php?page=content&id= ".$id."';</script>";
        }


        }else{
        echo "<script>alert('Upload Gagal!, Anda Belum Memilih File Untuk Di Upload');
        location.href='dashboard.php?page=content&id= ".$id."';</script>";
        }
    
}
?>

<div class="row">
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
            <a href="?page=content" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Lihat Data</a>
        </div>
    <div class="card-body">
    <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="judul">Judul Buku</label>
                       <h3><?= $data ['judul']?></h3>
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover Buku</label>
                        <input type="file" class="form-control" id="cover" name="cover"placeholder="Pilih file cover" required>
                    </div>
                    <button type="submit" name="proses" class="btn btn-primary">Simpan</button>
                    <a href="?page=content" class="btn btn-secondary">Batal</a>
                </form>
     </div>
        </div>
    </div>
            </div>