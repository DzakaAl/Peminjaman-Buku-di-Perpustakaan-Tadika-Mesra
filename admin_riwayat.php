<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'Status Peminjaman Sudah Diupdate!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_riwayat.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Riwayat</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">
   <h1 class="title">Riwayat Peminjaman</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if (mysqli_num_rows($select_orders) > 0) {
         while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
            <div class="box">
               <p> user id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
               <p> nama : <span><?php echo $fetch_orders['name']; ?></span> </p>
               <p> No. Tlp : <span><?php echo $fetch_orders['number']; ?></span> </p>
               <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
               <p> Alamat : <span><?php echo $fetch_orders['address']; ?></span> </p>
               <p> Tanggal Pinjam : <span><?php echo $fetch_orders['tanggalpinjam']; ?></span> </p>
               <p> Batas Peminjaman : <span><?php echo $fetch_orders['tanggalkembali']; ?></span> </p>
               <p> Buku yang dipinjam : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
               <p> Kode Peminjaman : <span><?php echo $fetch_orders['kodepinjam']; ?></span> </p>
               <form action="" method="post">
                  <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                  <select name="update_payment">
                     <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                     <option value="Buku Belum Dipinjam">Buku Belum Dipinjam</option>
                     <option value="Buku Telah Dipinjam">Buku Telah Dipinjam</option>
                     <option value="Buku Telah Dikembalikan">Buku Telah Dikembalikan</option>
                     <option value="Buku Melewati Batas">Buku Melewati Batas</option>
                  </select>
                  <input type="submit" value="Perbarui" name="update_order" class="option-btn">
                  <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Hapus Riwayat ini?');" class="delete-btn">Hapus</a>
               </form>
            </div>
            <?php
         }
      } else {
         echo '<p class="empty">Tidak Ada Peminjaman!</p>';
      }
      ?>
   </div>
</section>

<!-- custom admin js file link -->
<script src="js/admin_script.js"></script>

</body>
</html>
