<?php
include "./validation/validation.php";
include "./database.php";
include "./send_email.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Validate email
    $validation = new Validation();
    if (!$validation->email($email)) {
        header("Location: forgotpassword.php?error=Invalid email address");
        exit();
    }

    $db = new Database();
    $conn = $db->connect();

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50));
        $expTime = date("Y-m-d H:i:s", time()+60*30);

        // Insert token into the database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expires_at = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expTime, $email);
        $stmt->execute();

        // Send the reset link to the user's email
        $resetLink = "http://yourdomain.com/reset_password.php?token=" . $token;
        $subject = "Password Reset Request";
        $message = "Hi, click on this link to reset your password: <a href='" . $resetLink . "'>" . $resetLink . "</a>";

        $mailer = new Mailer();
        if ($mailer->send($email, $subject, $message)) {
            header("Location: forgotpassword.php?success=Password reset link has been sent to your email");
        } else {
            header("Location: forgotpassword.php?error=Failed to send email");
        }
    } else {
        header("Location: forgotpassword.php?error=No user found with that email address");
    }
}
?>
