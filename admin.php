<?php
include "./validation/validation.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <nav>
    <div class="navbar">
      <div class="logo"><a href="#">Feedaback submitter</a></div>
      <ul class="menu">
        <li><a href="home.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="contact.php">Contact</a></li>
        <!-- <li><a href="admin.php">Admin</a></li> -->
        <li>  
        <form class="logout" action="./logout.php" method="GET">
               <input class="f2" type="submit" value="Logout">
         </form>
        </li>
      </ul>
    </div>
  </nav>
  <section>
  <div class="login-container">
    <h2>Admin Login</h2>
    <form action="action/admin.php" method="POST">
      <div class="input-group">
      <?php 
      $validation=new Validation();
        if(isset($_GET['error'])){ ?>
          <p class="err1"> <?=$validation->clean($_GET['error'])?></p>
          <?php  } ?>
          <?php 
        if(isset($_GET['success'])){ ?>
          <p class="err2"> <?=$validation->clean($_GET['success'])?></p>
          <?php  } ?>
        <label for="username">Username <span class="mandatory">*</span></label>
        <input type="text" id="username" name="username">
      </div>
      <div class="input-group">
        <label for="password">Password <span class="mandatory">*</span></label>
        <input type="password" id="password" name="password">
      </div>
      <button type="submit">Login</button>
    </form>
  </div> 
 </section>
</body>
</html>