<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tentang kami</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Tentang Kami</h3></h3>
   <p> <a href="beranda.php">Beranda</a> / Tentang Kami </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>Tentang Kami</h3>
         <p>Perpustakaan Tadika Mesra adalah tempat yang menyediakan berbagai koleksi buku yang lengkap untuk memenuhi kebutuhan literasi masyarakat. Di sini, kami memupuk cinta terhadap buku dan menyemai kebijaksanaan dalam setiap kata. Perpustakaan ini bukan hanya sekadar tempat untuk meminjam buku, tetapi juga menjadi pintu gerbang menuju keajaiban, menggugah imajinasi, dan menerangi jiwa dengan ilmu pengetahuan yang tak terbatas. Kami percaya bahwa perpustakaan adalah tempat di mana kata-kata menari, pikiran berkembang, dan dunia terbuka sepenuhnya. Dengan koleksi buku yang beragam, kami membawa Anda ke pelataran pengetahuan yang tak terbatas dan menuntun Anda menuju arus masa depan yang gemilang.</p>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">Pembuat</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/author.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>2200018051</h3>
         <h3>Aqief Idlan Hakimi</h3>
      </div>

      <div class="box">
         <img src="images/author.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>2200018055</h3>
         <h3>M. Dzaky Naufal</h3>
      </div>

      <div class="box">
         <img src="images/author.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>2200018057</h3>
         <h3>M. Dzaka Al Fikri</h3>
      </div>

      <div class="box">
         <img src="images/author.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>2200018061</h3>
         <h3>Farrel Zacky A.R</h3>
      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>