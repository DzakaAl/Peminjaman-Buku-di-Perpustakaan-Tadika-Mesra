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
   <title>Riwayat</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Riwayat</h3>
   <p> <a href="beranda.php">Beranda</a> / Riwayat </p>
</div>

<section class="placed-orders">

   <h1 class="title">Riwayat Buku</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> Nama : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Nomor Telepon : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Alamat : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Buku yang dipinjam : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Tanggal Pinjam : <span><?php echo $fetch_orders['tanggalpinjam']; ?></span> </p>
         <p> Batas Peminjaman : <span><?php echo $fetch_orders['tanggalkembali']; ?></span> </p>
         <p> Kode Peminjaman : <span><?php echo $fetch_orders['Kodepeminjaman']; ?></span> </p>
         <p> Link Buku : <span><?php echo $fetch_orders['link_pdf']; ?></span> </p>
         <p> Status peminjaman : <span style="color:<?php if($fetch_orders['payment_status'] == 'Buku Melewati Batas'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">Tidak ada riwayat buku</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>