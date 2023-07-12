<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_image = $_POST['product_image'];
   $product_pdf = $_POST['product_pdf'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `keranjang` WHERE nama = '$product_name' AND pengguna_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'Buku Ditambahkan ke Keranjang!';
   } else {
      mysqli_query($conn, "INSERT INTO `keranjang`(pengguna_id, nama, kuantitas, pdf, gambar) VALUES('$user_id', '$product_name', '1', '$product_pdf', '$product_image')") or die('query failed');
      $message[] = 'Buku Ditambahkan ke Keranjang!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Katalog</title>
   <link rel="icon" href="images/perpus.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="katalog">
   <h3>Katalog</h3>
   <p> <a href="beranda.php">Beranda</a> / Katalog </p>
</div>

<section class="products">

   <h1 class="title">Daftar Buku</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `buku`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['gambar']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['nama']; ?></div>
      <div class="kategori">Kategori : <?php echo $fetch_products['kategori']; ?></div>
      <div class="penulis">Penulis : <?php echo $fetch_products['penulis']; ?></div>
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['nama']; ?>">
      <input type="hidden" name="product_pdf" value="<?php echo $fetch_products['pdf']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['gambar']; ?>">
      <input type="submit" value="Masukkan Keranjang" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">Tidak Ada Buku Yang Ditambahkan!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
