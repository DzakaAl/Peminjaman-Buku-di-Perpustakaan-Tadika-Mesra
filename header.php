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
            <a href="beranda.php" class="logo">
               <img src="images/perpus.png"/>
               <span>Tadika Mesra</span>
            </a>
         </div>
      
         <nav class="navbar">
            <a href="beranda.php">Beranda</a>
            <a href="katalog.php">Katalog</a>
            <a href="riwayat.php">Riwayat</a>
            <a href="tentang.php">Tentang Kami</a>
         </nav>
      
         <div class="icons">
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `keranjang` WHERE pengguna_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="keranjang.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>
         
         <div class="user-box">
            <p>Username : <span><?php echo $_SESSION['user_nama']; ?></span></p>
            <p>E-mail : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>

</header>
