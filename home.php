<?php
session_start();
include "./validation/Errors.php";
if(isset($_SESSION['username'])&&(isset($_SESSION['userid'])));
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
<div class="wrapper1">
         <div class="title1">
               <h2 class="wel">
                Welcome
                <p class="name"><?=$_SESSION['username'].'!'?></p> 
                </h2>
               <!-- <form action="./logout.php" method="GET">
               <div class="f1">
               <input class="f2" type="submit" value="Logout">
            </div>
         </form> -->
         </div>
         
            
         
 </section>
</body>
</html>