<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<section>
    <div class="wrapper">
        <div class="title">
            Reset Password
        </div>
        <form action="action/reset-password-handler.php" method="POST">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <div class="field">
                <input class="loguser" type="password" name="password" required>
                <label>New Password <span class="mandatory">*</span></label>
            </div>
            <div class="field">
                <input class="loguser" type="password" name="confirm_password" required>
                <label>Confirm Password <span class="mandatory">*</span></label>
            </div>
            <div class="field">
                <input type="submit" value="Reset Password">
            </div>
        </form>
    </div>
</section>
</body>
</html>
