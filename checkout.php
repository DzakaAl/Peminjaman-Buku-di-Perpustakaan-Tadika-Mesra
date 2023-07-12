<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit(); 
}

$message = []; 

if (isset($_POST['order_btn'])) {

   function generateRandomCode($length)
   {
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $code = '';

      for ($i = 0; $i < $length; $i++) {
         $index = rand(0, strlen($characters) - 1);
         $code .= $characters[$index];
      }

      return $code;
   }

   $kodepinjam = generateRandomCode(8);
   $name = mysqli_real_escape_string($conn, $_POST['nama']);
   $number = $_POST['telp'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $tanggalpinjam = $_POST['tanggalpinjam'];
   $address = mysqli_real_escape_string($conn, $_POST['blogs'] . ', ' . $_POST['jalan'] . ', ' . $_POST['kota'] . ', ' . $_POST['provinsi'] . ', ' . $_POST['negara']);
   $tanggalkembali = date('Y-m-d', strtotime($tanggalpinjam . '+7 days'));
   $cart_total = 0;
   $cart_pdf = array();
   $cart_products = array();

   $cart_query = mysqli_query($conn, "SELECT * FROM `keranjang` WHERE pengguna_id = '$user_id'") or die('query failed');
   if (mysqli_num_rows($cart_query) > 0) {
      while ($cart_item = mysqli_fetch_assoc($cart_query)) {
         $cart_products[] = $cart_item['nama'] . ' (' . $cart_item['kuantitas'] . ') ';
         $sub_total = $cart_item['kuantitas'];
         $cart_total += $sub_total;
         $cart_pdf[] = $cart_item['pdf'];
      }
   }

   $total_products = implode(', ', $cart_products);
   $link_pdf = implode(', ', $cart_pdf);
   $order_query = mysqli_query($conn, "SELECT * FROM `riwayat` WHERE nama = '$name' AND telp = '$number' AND email = '$email' AND alamat = '$address' AND total_buku = '$total_products' AND tanggalpinjam = '$tanggalpinjam' AND tanggalkembali = '$tanggalkembali' AND kodepinjam = '$kodepinjam' AND link_pdf = '$link_pdf'") or die('query failed');

   if ($cart_total == 0) {
      $message[] = 'Keranjang kosong';
   } else {
      if (mysqli_num_rows($order_query) > 0) {
         $message[] = 'Peminjaman Sudah Dilakukan!';
      } else {
         mysqli_query($conn, "INSERT INTO `riwayat`(pengguna_id, nama, telp, email, alamat, total_buku, tanggalpinjam, tanggalkembali, kodepinjam, link_pdf) VALUES('$user_id', '$name', '$number', '$email', '$address', '$total_products', '$tanggalpinjam', '$tanggalkembali', '$kodepinjam', '$link_pdf')") or die('query failed');
         $message[] = 'Peminjaman Sudah Dilakukan!';
         mysqli_query($conn, "DELETE FROM `keranjang` WHERE pengguna_id = '$user_id'") or die('query failed');
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pinjam</title>
   <link rel="icon" href="images/perpus.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Pinjam</h3>
      <p><a href="beranda.php">Beranda</a> / Pinjam</p>
   </div>

   <section class="display-order">

      <?php
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `keranjang` WHERE pengguna_id = '$user_id'") or die('query failed');
      if (mysqli_num_rows($select_cart) > 0) {
         while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $total_price = $fetch_cart['kuantitas'];
            $grand_total += $total_price;
            ?>
            <p><?php echo $fetch_cart['nama']; ?></p>
      <?php
         }
      } else {
         echo '<p class="empty">Keranjang Kosong</p>';
      }
      ?>
      <div class="grand-total"> Total Buku : <span><?php echo $grand_total; ?></span> </div>

   </section>

   <section class="checkout">

      <form action="" method="post">
         <h3>Data Diri</h3>
         <div class="flex">
            <div class="inputBox">
               <span>Nama :</span>
               <input type="text" name="nama" required placeholder="Masukan Nama">
            </div>
            <div class="inputBox">
               <span>Nomor Telepon :</span>
               <input type="text" name="telp" required placeholder="Masukan Nomor">
            </div>
            <div class="inputBox">
               <span>Email :</span>
               <input type="email" name="email" required placeholder="Masukan Email">
            </div>
            <div class="inputBox">
               <span>Tanggal Peminjaman :</span>
               <input type="date" name="tanggalpinjam" required placeholder="Masukan Tanggal">
            </div>
            <div class="inputBox">
               <span>Alamat :</span>
               <input type="text" name="blogs" required placeholder="contoh: Nama Jalan, Gedung, No. Rumah">
            </div>
            <div class="inputBox">
               <span>Alamat Lengkap :</span>
               <input type="text" name="jalan" required placeholder="contoh: blok, no.unit, patokan">
            </div>
            <div class="inputBox">
               <span>Kota :</span>
               <input type="text" name="kota" required placeholder="contoh: bantul">
            </div>
            <div class="inputBox">
               <span>Provinsi :</span>
               <input type="text" name="provinsi" required placeholder="contoh: yogyakarta">
            </div>
            <div class="inputBox">
               <span>Negara :</span>
               <input type="text" name="negara" required placeholder="contoh: indonesia">
            </div>
         </div>
         <input type="submit" value="Pinjam" class="btn" name="order_btn">
      </form>

   </section>

   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>
