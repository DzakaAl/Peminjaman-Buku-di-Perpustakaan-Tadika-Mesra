<?php

include 'config.php';

if(isset($_POST['submit'])){

   $nama = mysqli_real_escape_string($conn, $_POST['nama']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $tipe_pengguna = $_POST['tipe_pengguna'];

   $select_users = mysqli_query($conn, "SELECT * FROM `pengguna` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'Username Tidak Tersedia!';
   }else{
      if($pass != $cpass){
         $message[] = 'Password Tidak Sama!';
      }else{
         mysqli_query($conn, "INSERT INTO `pengguna`(nama, email, password, tipe_pengguna) VALUES('$nama', '$email', '$cpass', '$tipe_pengguna')") or die('query failed');
         $message[] = 'Daftar Berhasil!';
         header('location:login.php');
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
   <title>Daftar</title>
   <link rel="icon" href="images/perpus.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Buat Akun</h3>
      <input type="text" name="nama" placeholder="Masukkan Nama" required class="box">
      <input type="email" name="email" placeholder="Masukkan Email" required class="box">
      <input type="password" name="password" placeholder="Masukkan Password" required class="box">
      <input type="password" name="cpassword" placeholder="Ulangi Password" required class="box">
      <select name="tipe_pengguna" class="box">
         <option value="pengguna">Pengguna</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="Daftar" class="btn">
      <p>Apakah Anda sudah memiliki akun ? <a href="login.php">Login</a></p>
   </form>

</div>

</body>
</html>
