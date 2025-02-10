<?php

include 'config.php';

// Set email dan password admin
$admin_email = 'admin@gmail.com';
$fixed_admin_password = md5('admin123'); // Password tetap untuk admin

if (isset($_POST['submit'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   if ($email === $admin_email) {
      if ($pass !== $fixed_admin_password) {
         $message[] = 'Incorrect admin password!';
      } else {
         $user_type = 'admin';
         mysqli_query($conn, "INSERT INTO users(name, email, password, user_type) VALUES('$name', '$email', '$fixed_admin_password', '$user_type')") or die('query failed');
         $message[] = 'Admin registered successfully!';
         header('location:admin_page.php'); // Halaman admin
      }
   } else {
      $user_type = 'user';

      $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('query failed');

      if (mysqli_num_rows($select_users) > 0) {
         $message[] = 'User already exists!';
      } else {
         if ($pass != $cpass) {
            $message[] = 'Confirm password not matched!';
         } else {
            mysqli_query($conn, "INSERT INTO users(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
            $message[] = 'Registered successfully!';
            header('location:about.php'); // Halaman user
         }
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
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<div class="form-container">

   <form action="" method="post">
      <h3>Register</h3>
      <input type="text" name="name" placeholder="Enter your name" required class="box">
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="password" placeholder="Enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">
      <input type="submit" name="submit" value="Register" class="btn">
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </form>

</div>

</body>
</html>