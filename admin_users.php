<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `pengguna` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Akun Pengguna</title>
   <link rel="icon" href="images/perpus.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title"> Akun Pengguna</h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `pengguna`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> user id : <span><?php echo $fetch_users['id']; ?></span> </p>
         <p> username : <span><?php echo $fetch_users['nama']; ?></span> </p>
         <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
         <p> user type : <span style="color:<?php if($fetch_users['tipe_pengguna'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['tipe_pengguna']; ?></span> </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Hapus Akun Ini?');" class="delete-btn">Hapus Akun</a>
      </div>
      <?php
         };
      ?>
   </div>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
