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
   <title>Tentang Kami</title>
   <link rel="icon" href="images/perpus.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="tentang">
   <h3>Tentang Kami</h3></h3>
   <p> <a href="beranda.php">Beranda</a> / Tentang Kami </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/kami.png" alt="">
      </div>

      <div class="content">
         <h3>Tentang Kami</h3>
         <p>Perpustakaan Tadika Mesra adalah tempat yang menyediakan berbagai koleksi buku yang lengkap untuk memenuhi kebutuhan literasi masyarakat. Di sini, kami memupuk cinta terhadap buku dan menyemai kebijaksanaan dalam setiap kata. Perpustakaan ini bukan hanya sekadar tempat untuk meminjam buku, tetapi juga menjadi pintu gerbang menuju keajaiban, menggugah imajinasi, dan menerangi jiwa dengan ilmu pengetahuan yang tak terbatas. Kami percaya bahwa perpustakaan adalah tempat di mana kata-kata menari, pikiran berkembang, dan dunia terbuka sepenuhnya. Dengan koleksi buku yang beragam, kami membawa Anda ke pelataran pengetahuan yang tak terbatas dan menuntun Anda menuju arus masa depan yang gemilang. Sambutlah kami, generasi muda.</p>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">Pengembang</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/aqip.jpg" alt="Aqip">
         <div class="share">
            <a href="https://wa.me/6285156846659" class="fab fa-whatsapp"></a>
            <a href="https://twitter.com/@garismirekel" class="fab fa-twitter"></a>
            <a href="https://instagram.com/qifhak_" class="fab fa-instagram"></a>
            <a href="https://github.com/qifhak" class="fab fa-github"></a>
         </div>
         <h3>2200018051</h3>
         <h3>Aqief Idlan Hakimi</h3>
      </div>

      <div class="box">
         <img src="images/nopal.jpg" alt="Nopal">
         <div class="share">
            <a href="https:/wa.me/6289602756444" class="fab fa-whatsapp"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="https://instagram.com/dzkyy_yy" class="fab fa-instagram"></a>
            <a href="https://github.com/MuhammadNaufalD" class="fab fa-github"></a>
         </div>
         <h3>2200018055</h3>
         <h3>M. Dzaky Naufal</h3>
      </div>

      <div class="box">
         <img src="images/jaka.jpg" alt="jaka">
         <div class="share">
            <a href="https:/wa.me/6285385137095" class="fab fa-whatsapp"></a>
            <a href="https://twitter.com/@MoreDzl" class="fab fa-twitter"></a>
            <a href="https://instagram.com/moredzl" class="fab fa-instagram"></a>
            <a href="https://github.com/DzakaAl" class="fab fa-github"></a>
         </div>
         <h3>2200018057</h3>
         <h3>M. Dzaka Al Fikri</h3>
      </div>

      <div class="box">
         <img src="images/farel.jpg" alt="parel">
         <div class="share">
            <a href="https:/wa.me/6281809652503" class="fab fa-whatsapp"></a>
            <a href="https://twitter.com/@VlaHasya_473" class="fab fa-twitter"></a>
            <a href="https://instagram.com/farrel_zackyyy" class="fab fa-instagram"></a>
            <a href="https://github.com/Farellramadhan" class="fab fa-github"></a>
         </div>
         <h3>2200018061</h3>
         <h3>Farrel Zacky A.R</h3>
      </div>

   </div>

</section>

<section class="authors">
   <h1 class="title">Pendukung</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/adi.jpg" alt="Adi">
         <div class="share">
            <a href="https:/wa.me/6281387472963" class="fab fa-whatsapp"></a>
            <a href="https://twitter.com/@AdiTara15" class="fab fa-twitter"></a>
            <a href="https://instagram.com/adi__tara" class="fab fa-instagram"></a>
            <a href="https://github.com/adisuswiantara123" class="fab fa-github"></a>
         </div>
         <h3>Support Sistem Kami</h3>
         <h3>Adi Keren</h3>
      </div>
   </div>
</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
