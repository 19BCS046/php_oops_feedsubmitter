<?php
include "./validation/validation.php";
?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
   <meta charset="UTF-8">
   <title>Project</title>
 <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
 <section>
<div class="wrapper">
         <div class="title">
            Forgot Password
         </div>
         <?php 
         $validation=new Validation();
        if(isset($_GET['error'])){ ?>
          <p class="error"> <?=$validation->clean($_GET['error'])?></p>
          <?php  } ?>
          <?php 
        if(isset($_GET['success'])){ ?>
          <p class="err2"> <?=$validation->clean($_GET['success'])?></p>
          <?php  } ?>
         <form action="action/sent-password-reset.php" method="POST">
            <div class="field">
               <input class="loguser" type="text" name="email">
               <label>Email <span class="mandatory">*</span></label>
            </div>  
            <div class="field">
               <input type="submit" value="Sent">
            </div>
         </form>
 </section>
</body>
</html>