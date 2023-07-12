<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `kritikdansaran` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_kritikdansaran.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kritik dan Saran</title>
   <link rel="icon" href="images/perpus.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title"> Pesan </h1>

   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `kritikdansaran`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
   <div class="box">
      <p> ID Pengguna : <span><?php echo $fetch_message['pengguna_id']; ?></span> </p>
      <p> Nama : <span><?php echo $fetch_message['nama']; ?></span> </p>
      <p> Nomer Telpon : <span><?php echo $fetch_message['telp']; ?></span> </p>
      <p> E-Mail : <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> Kritik dan Saran : <span><?php echo $fetch_message['pesan']; ?></span> </p>
      <a href="admin_kritikdansaran.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Hapus Pesan ini?');" class="delete-btn">Hapus</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">Tidak Ada kritik dan Saran!</p>';
   }
   ?>
   </div>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
