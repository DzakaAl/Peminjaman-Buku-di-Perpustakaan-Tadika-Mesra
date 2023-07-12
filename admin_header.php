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

<header class="header">

   <div class="flex">
      <div class="logo">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="admin_dashboard.php" class="logo">Panel<span> Admin</span></a>
      </div>

      <nav class="navbar">
         <a href="admin_dashboard.php">Dashboard</a>
         <a href="admin_buku.php">Buku</a>
         <a href="admin_riwayat.php">Riwayat</a>
         <a href="admin_users.php">Akun Pengguna</a>
         <a href="admin_kritikdansaran.php">Kritik dan Saran</a>
      </nav>

      <div class="icons">
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['admin_nama']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">Logout</a>
      </div>

   </div>

</header>
