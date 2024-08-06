<?php
include "./validation/validation.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="index.css">

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
  <section class="about">
    <div class="container">
    <h2 class="hc">Contact Us</h2>
    <?php 
    $validation=new Validation();
        if(isset($_GET['error'])){ ?>
          <p class="err1"> <?=$validation->clean($_GET['error'])?></p>
          <?php  } ?>
          <?php 
        if(isset($_GET['success'])){ ?>
          <p class="err2"> <?=$validation->clean($_GET['success'])?></p>
          <?php  } ?>
    
    <form action="action/contact.php" method="POST">
        <div class="form-group">
            <label for="name">Name: <span class="mandatory">*</span></label>
            <input type="text" id="name" name="con_name">
        </div>
        <div class="form-group">
            <label for="email">Email: <span class="mandatory">*</span></label>
            <input type="email" id="email" name="con_email">
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="con_message"></textarea>
        </div>
        <div class="form-group conbutton">
            <input type="submit" value="Submit">
        </div>
    </form>
</div>
  </section>
</body>
</html>