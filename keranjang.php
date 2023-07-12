<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['delete'])){
   $delete_id = $_POST['delete'];
   mysqli_query($conn, "DELETE FROM `keranjang` WHERE id = '$delete_id'") or die('query failed');
   header('location:keranjang.php');
}

if(isset($_POST['delete_all'])){
   mysqli_query($conn, "DELETE FROM `keranjang` WHERE pengguna_id = '$user_id'") or die('query failed');
   header('location:keranjang.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Keranjang</title>
   <link rel="icon" href="images/perpus.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="keranjang">
   <h3>Keranjang</h3>
   <p> <a href="beranda.php">Beranda</a> / Keranjang </p>
</div>

<section class="shopping-cart">

   <h1 class="title">Buku ditambahkan</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `keranjang` WHERE pengguna_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
               $sub_total = $fetch_cart['kuantitas'];
               $grand_total += $sub_total;
      ?>
      <div class="box">
         <form action="" method="post">
            <button type="submit" name="delete" value="<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Hapus ini dari keranjang?');">
               <i class="fas fa-times"></i>
            </button>
            <img src="uploaded_img/<?php echo $fetch_cart['gambar']; ?>" alt="">
            <?php if (isset($fetch_cart['nama'])) { ?>
               <div class="name"><?php echo $fetch_cart['nama']; ?></div>
            <?php } ?>
            <input type="hidden" name="keranjang_id" value="<?php echo $fetch_cart['id']; ?>">
            
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">Keranjang Kosong</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <form action="" method="post">
         <input type="hidden" name="delete_all" value="1">
         <button type="submit" class="delete-btn <?php echo ($grand_total > 0)?'':'disabled'; ?>" onclick="return confirm('Hapus semua buku dikeranjang?');">Hapus Semua</button>
      </form>
   </div>

   <div class="cart-total">
      <p>Total Buku : <span><?php echo $grand_total; ?></span></p>
      <div class="flex">
         <a href="katalog.php" class="option-btn">Cari Buku Lainnya</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 0)?'':'disabled'; ?>">Proses Meminjam</a>
      </div>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
