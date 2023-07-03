<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_name = $_POST['product_kategori'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Buku Ditambahkan ke Keranjang!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, quantity, image) VALUES('$user_id', '$product_name', '$product_quantity', '$product_image')") or die('query failed');
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
   <title>beranda</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Menemukan Harta Karun Dalam Setiap Halaman, Menerangi Pikiran Menuju Pengetahuan Abadi</h3>
      <p>Di Tadika Mesra, Kami Memupuk Cinta akan Buku dan Menyemai Bijak dalam Setiap Kata, Membuka Pintu Keajaiban, Menggugah Imajinasi, dan Menerangi Jiwa dengan Ilmu Pengetahuan yang Tiada Tara, Sebab di Sini, Perpustakaan adalah Tempat Di Mana Kata-kata Menari, Pikiran Berkembang, dan Dunia Terbuka Sepenuhnya, Membawa Kita ke Pelataran Pengetahuan yang Tak Terbatas dan Menuntun Kita ke Arus Masa Depan yang Gemilang.</p>
   </div>

</section>

<section class="products">

   <h1 class="title">buku terbaru</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="kategori"><?php echo $fetch_products['kategori']; ?></div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_kategori" value="<?php echo $fetch_products['kategori']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="hidden" name="product_pdf" value="<?php echo $fetch_products['pdf']; ?>">
      <input type="submit" value="masukkan keranjang" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>tentang kami</h3>
         <p>Perpustakaan Tadika Mesra menyediakan berbagai koleksi buku untuk kebutuhan literasi masyarakat.</p>
         <a href="tentang.php" class="btn">Lebih lengkapnya...</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>kritik dan saran</h3>
      <p>Jika ada kekurangan yang terdapat diwebsite kami silahkan berikan kritik dan saran anda?</p>
      <a href="kritik&saran.php" class="white-btn">kritik & saran</a>
   </div>

</section>





<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>