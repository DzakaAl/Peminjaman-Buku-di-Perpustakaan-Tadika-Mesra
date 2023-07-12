<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `kritikdansaran` WHERE nama = '$name' AND email = '$email' AND telp = '$number' AND pesan = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Pesan telah terikim!';
   }else{
      mysqli_query($conn, "INSERT INTO `kritikdansaran`(pengguna_id, nama, email, telp, pesan) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Pesan telah terikim!';
   }

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

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Kritik dan Saran</h3>
   <p> <a href="beranda.php">Beranda</a> / Kritik dan Saran </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Berikan Pendapatmu!</h3>
      <input type="text" name="name" required placeholder="Nasukkan Nama Anda" class="box">
      <input type="email" name="email" required placeholder="Masukkan E-Mail Anda" class="box">
      <input type="number" name="number" required placeholder="Masukkan Nomer Telpon Anda" class="box">
      <textarea name="message" class="box" placeholder="Masukkan Kritik ataupun Saran Anda" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Kirim pesan" name="send" class="btn">
   </form>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
