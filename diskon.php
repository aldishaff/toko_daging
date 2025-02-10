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
   <title>diskon</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Diskon Hari Raya Idul Fitri!</h3>
   <p class="small-text">Jangan lewatkan kesempatan ini!</p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/idulfitri.jpg" alt="">
      </div>

      <div class="content">
         <h3>DISCOUNT HARI RAYA!</h3>
         <p>Selamat Hari Raya Idul Fitri! Kami berbagi kebahagiaan dengan memberikan potongan harga <strong>70%</strong> untuk pembelian minimal Rp 200.000.
         Jangan lewatkan kesempatan ini untuk mendapatkan produk favorit Anda dengan harga terbaik. Segera belanja dan rasakan kemeriahannya bersama kami! 🎉✨
         Promo berlaku selama periode Hari Raya Idul Fitri.
         Ayo, manfaatkan penawaran istimewa ini sekarang juga!</p>
         <p></p>
         <a href="shop.php" class="btn">Belanja Sekarang</a>
      </div>

   </div>

</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>