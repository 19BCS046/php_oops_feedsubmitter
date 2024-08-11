<?php
session_start();
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
            Reset Password
        </div>
        <?php 
        $validation = new Validation();
        if (isset($_SESSION['error'])) { ?>
            <p class="error"><?= $validation->clean($_SESSION['error']) ?></p>
            <?php unset($_SESSION['error']); // Clear the error after displaying it ?>
        <?php } ?>
        <?php 
        if (isset($_SESSION['success'])) { ?>
            <p class="err2"><?= $validation->clean($_SESSION['success']) ?></p>
            <?php unset($_SESSION['success']); // Clear the success message after displaying it ?>
        <?php } ?>
        <form action="action/reset-password-handler.php" method="POST">
            <input type="hidden" name="password_token" value="<?php if (isset($_GET['token'])) { echo $_GET['token']; } ?>">

            <div class="field">
                <input class="loguser" type="email" name="email" value="<?php if (isset($_GET['email'])) { echo $_GET['email']; } ?>">
                <label>Email <span class="mandatory">*</span></label> 
            </div>
            <div class="field">
                <input class="logpass" type="password" name="password">
                <label>New Password <span class="mandatory">*</span></label>
            </div>      
            <div class="field">
                <input class="logpass" type="password" name="con_password">
                <label>Confirm Password <span class="mandatory">*</span></label>
            </div> 
            <div class="field">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</section>
</body>
</html>
