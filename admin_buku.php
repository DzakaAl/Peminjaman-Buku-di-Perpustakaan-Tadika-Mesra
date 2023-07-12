<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $kategori = $_POST['kategori'];
   $penulis = $_POST['penulis'];
   $pdf = $_POST['pdf'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT * FROM `buku` WHERE nama = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'Buku Sudah Ditambahkan!';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `buku`(nama, kategori, penulis,  pdf, gambar) VALUES('$name', '$kategori', '$penulis', '$pdf', '$image')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'Ukuran gambar terlalu besar!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Buku Sudah Ditambahkan!';
         }
      }else{
         $message[] = 'Buku Tidak Bisa Ditambahkan!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT gambar FROM `buku` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['gambar']);
   mysqli_query($conn, "DELETE FROM `buku` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_buku.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_kategori = $_POST['update_kategori'];
   $update_penulis = $_POST['update_penulis'];
   $update_pdf = $_POST['update_pdf'];
   mysqli_query($conn, "UPDATE `buku` SET nama = '$update_name', kategori = '$update_kategori', penulis = '$update_penulis', pdf = '$update_pdf' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `buku` SET gambar = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_buku.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Penambahan Katalog Buku</title>
   <link rel="icon" href="images/perpus.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="add-products">
   <h1 class="title">Katalog Buku</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <h3>Tambahkan Buku</h3>
      <input type="text" name="name" class="box" placeholder="Masukkan Nama Buku" required>
      <input type="text" name="kategori" class="box" placeholder="Masukkan Kategori Buku" required>
      <input type="text" name="penulis" class="box" placeholder="Masukkan Penulis Buku" required>
      <input type="text" name="pdf" class="box" placeholder="Masukkan Link Buku (PDF)" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="Tambahkan Produk" name="add_product" class="btn">
   </form>
</section>

<section class="show-products">
   <div class="box-container">
      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `buku`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_products['gambar']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['nama']; ?></div>
         <div class="kategori">Kategori : <?php echo $fetch_products['kategori']; ?></div>
         <div class="penulis">Penulis : <?php echo $fetch_products['penulis']; ?></div>
         <a href="admin_buku.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Perbarui</a>
         <a href="admin_buku.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Hapus Buku Ini?');">Hapus</a>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">Tidak Ada Buku Yang Ditambahkan!</p>';
         }
      ?>
   </div>
</section>

<section class="edit-product-form">
   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `buku` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['gambar']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['gambar']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['nama']; ?>" class="box" required placeholder="Masukkan Nama Buku">
      <input type="text" name="update_kategori" value="<?php echo $fetch_update['kategori']; ?>" class="box" required placeholder="Masukkan Kategori Buku">
      <input type="text" name="update_penulis" value="<?php echo $fetch_update['penulis']; ?>" class="box" required placeholder="Masukkan Penulis Buku">
      <input type="text" name="update_pdf" value="<?php echo $fetch_update['pdf']; ?>" class="box" required placeholder="Masukkan Link Buku (PDF)">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="Perbarui" name="update_product" class="btn">
      <input type="reset" value="Batal" id="close-update" class="option-btn">
   </form>
   <?php
            }
         }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>
</section>

<script src="js/admin_script.js"></script>

</body>
</html>
