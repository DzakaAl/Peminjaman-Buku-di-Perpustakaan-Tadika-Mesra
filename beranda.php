<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['tambahkan_keranjang'])) {

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
   <title>Beranda</title>
   <link rel="icon" href="images/perpus.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <section class="home">

      <div class="content">
         <h3>Temukan Harta Karun Dalam Setiap Halaman, Terangi Pikiran dengan Indahnya Pengetahuan</h3>
         <p>Selamat datang di Surganya ilmu pengetahuan, Perpustakaan Tadika Mesra. Di Tadika Mesra kami memberikan perhatian sepenuh hati kami kepada calon pembaca. Di Tadika Mesra, Kami hadirkan buku-buku dengan kualitas tinggi, serta mutu yang terjamin. Perpustakaan kami siap menjawab pertanyaan-pertanyaan anda 24/7 dengan admin spesial kami, Naufal Dzaky. Kami juga sangat menerima kritik dan saran yang membangun agar senantiasa dapat menjadi perpustakaan yang memiliki sistem terbaik di bidang literasi.</p>
      </div>

   </section>

   <section class="products">

      <h1 class="title">buku terbaru</h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `buku` LIMIT 6") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <form action="" method="post" class="box">
                  <img class="image" src="uploaded_img/<?php echo $fetch_products['gambar']; ?>" alt="">
                  <div class="name"><?php echo $fetch_products['nama']; ?></div>
                  <div class="kategori">Kategori : <?php echo $fetch_products['kategori']; ?></div>
                  <div class="penulis">Penulis : <?php echo $fetch_products['penulis']; ?></div>
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['nama']; ?>">
                  <input type="hidden" name="product_pdf" value="<?php echo $fetch_products['pdf']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['gambar']; ?>">
                  <input type="submit" value="Masukkan Keranjang" name="tambahkan_keranjang" class="btn">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">Belum ada buku yang diinput!</p>';
         }
         ?>
      </div>

   </section>

   <section class="about">

      <div class="flex">

         <div class="image">
            <img src="images/kami.png" alt="">
         </div>

         <div class="content">
            <h3>Tentang Kami</h3>
            <p>Perpustakaan Tadika Mesra menyediakan berbagai koleksi buku untuk kebutuhan literasi masyarakat...</p>
            <a href="tentang.php" class="btn">Selengkapnya</a>
         </div>

      </div>

   </section>

   <section class="home-contact">

      <div class="content">
         <h3>Kritik dan Saran</h3>
         <p>Apabila anda merasa terdapat kekurangan pada website kami, kami mohon untuk meluangkan waktu anda sejenak untuk memberikan kritik dan saran yang membangun. Terima Kasih, hormat kami, Tim Sukses Perpustakaan Tadika Mesra.</p>
         <a href="kritikdansaran.php" class="white-btn">Kritik & Saran</a>
      </div>

   </section>

   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>
