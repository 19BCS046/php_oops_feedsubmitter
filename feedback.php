<?php
session_start();
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
        <li><a href="#Feedback">Feedback</a></li>
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
  <div class="container2">
    <h3 class="head">Feedback</h3>
    <?php 
    $validation=new Validation();
        if(isset($_GET['error'])){ ?>
          <p class="err1"> <?=$validation->clean($_GET['error'])?></p>
          <?php  } ?>
          <?php 
        if(isset($_GET['success'])){ ?>
          <p class="err2"> <?=$validation->clean($_GET['success'])?></p>
          <?php  } ?>
  <form action="action/feedback.php" method="POST">
  <label for="fname">Username</label>
    <input type="text" id="delivery" name="username" placeholder="Username" value="<?=$_SESSION['username']?>">

    <label for="fname">Delivery Number <span class="mandatory">*</span></label>
    <input type="text" id="delivery" name="delivery" placeholder="Your deliverynumber..">

    <label for="comments">Product name <span class="mandatory">*</span></label>
    <input type="text" id="comments" name="comments" placeholder="Your comments..">

    <label for="rating">Rating <span class="mandatory">*</span></label>
    <select id="rating" name="rating">
      <option value=""></option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
	  <option value="4">4</option>
	  <option value="5">5</option>
    </select>
    <label for="subject">Feedback <span class="mandatory">*</span></label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:150px"></textarea>
    <input type="submit" value="Submit">
  </form>
</div>
  </section>
</body>
</html>