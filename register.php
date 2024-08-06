<?php
include "./validation/validation.php";
// $fname=$uname=$email="";  
// if(isset($_GET["fname"])){
//   $fname=$_GET["fname"];
// }
// if(isset($_GET["uname"])){
//   $uname=$_GET["uname"];
// }
// if(isset($_GET["email"])){
//   $email=$_GET["email"];
// }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
   <meta charset="UTF-8">
   <title>Project</title>
 <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <section>
<div class="container"> 
    <div class="title">Registration</div>
    <?php 
         $validation=new Validation();
        if(isset($_GET['error'])){ ?>
          <p class="err1"> <?=$validation->clean($_GET['error'])?></p>
          <?php  } ?>
          <?php 
        if(isset($_GET['success'])){ ?>
          <p class="err2"> <?=$validation->clean($_GET['success'])?></p>
          <?php  } ?>
    <div class="content">
      <form action="action/register.php" method="POST">
        <div class="user-details">
          <div class="input-box"> 
            <span class="details">Full Name <span class="mandatory">*</span></span>
            <input type="text" placeholder="Enter your name" name="fullname">
          </div>
          <div class="input-box">
            <span class="details">Username <span class="mandatory">*</span></span>
            <input type="text" placeholder="Enter your username" name="username">
          </div>
          <div class="input-box">
            <span class="details">Email <span class="mandatory">*</span></span>
            <input type="text" placeholder="Enter your email" name="email">
          </div>
          <div class="input-box">
            <span class="details">Phone Number <span class="mandatory">*</span></span>
            <input type="text" placeholder="Enter your number" name="phonenumber">
          </div>
          <div class="input-box">
            <span class="details">Password <span class="mandatory">*</span></span>
            <input type="password" placeholder="Enter your password" name="password">
          </div>
          <div class="input-box">
            <span class="details">Confirm Password <span class="mandatory">*</span></span>
            <input type="password" placeholder="Confirm your password" name="confirmpassword">
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" id="dot-1" value="male">
          <input type="radio" name="gender" id="dot-2" value="female">
          <input type="radio" name="gender" id="dot-3" value="prefer not to say">
          <span class="gender-title">Gender <span class="mandatory">*</span></span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Register">
        </div>
        <div class="signup-link">
               Back to Login? <a href="index.php">Login now</a>
            </div>
      </form>
    </div>
  </div>
  </section>
</body>
</html>