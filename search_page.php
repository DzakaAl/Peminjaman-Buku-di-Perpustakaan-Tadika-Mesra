<?php
include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
   header('location:login.php');
   exit();
}

if (isset($_POST['add_to_cart'])) {
   $product_name = $_POST['product_name'];
   $product_image = $_POST['product_image'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `keranjang` WHERE nama = '$product_name' AND pengguna_id = '{$_SESSION['user_id']}'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'Buku Ditambahkan ke Keranjang!';
   } else {
      mysqli_query($conn, "INSERT INTO `keranjang`(pengguna_id, nama, kuantitas, gambar) VALUES('{$_SESSION['user_id']}', '$product_name', '1', '$product_image')") or die('query failed');
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
   <title>Pencarian</title>
   <link rel="icon" href="images/perpus.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="pencarian">
   <h3>Pencarian</h3>
   <p><a href="beranda.php">Beranda</a> / Pencarian Buku</p>
</div>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="Cari buku..." class="box">
      <input type="submit" name="submit" value="Search" class="btn">
   </form>
</section>

<section class="search" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if (isset($_POST['submit'])) {
         $search_item = $_POST['search'];

         $search_query = "SELECT * FROM `buku` WHERE nama LIKE '%$search_item%' OR kategori LIKE '%$search_item%' OR penulis LIKE '%$search_item%'";
         $select_products = mysqli_query($conn, $search_query) or die('query failed');

         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_product = mysqli_fetch_assoc($select_products)) {
   ?>
      <form action="" method="post" class="box">
            <img class="image" src="uploaded_img/<?php echo $fetch_product['gambar']; ?>" alt="">
            <div class="name"><?php echo $fetch_product['nama']; ?></div>
            <div class="kategori">Kategori: <?php echo $fetch_product['kategori']; ?></div>
            <div class="penulis">Penulis: <?php echo $fetch_product['penulis']; ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['nama']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['gambar']; ?>">
            <input type="submit" value="Masukkan Keranjang" name="add_to_cart" class="btn">
      </form>
   <?php
            }
         } else {
            echo '<p class="empty">Buku Tidak Ditemukan!</p>';
         }
      } else {
         echo '<p class="empty">Belum ada buku yang dicari</p>';
      }
   ?>
   </div>
  

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
