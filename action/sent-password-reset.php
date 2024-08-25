<?php
session_start();
include "../validation/validation.php";
include "../sqldata/user.php";

//mail config
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader   
require '../vendor/autoload.php';

function sent_password_reset($get_name, $get_email, $token) {
    $mail = new PHPMailer(true);
    $error = new ErrorHandler();

    try {
        // Server settings
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'perumalshanmugam2002@gmail.com'; // SMTP username
        $mail->Password = 'lpdmmbfhuytnqmxw'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port = 465; // TCP port to connect to

        // Recipients
        $mail->setFrom('perumalshanmugam2002@gmail.com', 'Perumal');
        $mail->addAddress($get_email, $get_name); // Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Reset Password Notification';
        $email_template = "
            <h2>Hello!</h2>
            <h3>You are receiving this email because we received a password reset request for your account.</h3>
            <br>
            <a href='http://localhost/oops/reset-password.php?token=$token&email=$get_email'>Click Here</a>
        ";
        $mail->Body = $email_template;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Validate email
    $validation = new Validation();
    if (!$validation->email($email)) {
        $err = "Please enter a valid email";
        $error = new ErrorHandler();
        $error->redirect("../forgotpassword.php", "error", $err);
    }
    // Connect the database
    $db = new User();
    $conn = $db->connect();
    $error = new ErrorHandler();


    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result);
        $get_name = $row['user_name'];
        $get_email = $row['user_email'];

        $token = bin2hex(random_bytes(50));
       // $expTime = date("Y-m-d H:i:s", time() + 60 * 30);

        // Insert token into the database
        $stmt = $conn->prepare("UPDATE users SET reset_token_hash = ? WHERE user_email = ?");
         $stmt->bind_param("ss", $token, $get_email);
        $update_token = $stmt->execute();
        if ($update_token) {
            sent_password_reset($get_name, $get_email, $token);
            $err = "We emailed you a password reset link";
            $error->redirect("../forgotpassword.php", "success", $err);
        } else {
            $err = "Something went wrong!";
            $error->redirect("../forgotpassword.php", "error", $err);
        }
    } else {
        $err = "No user found with that email address";
        $error->redirect("../forgotpassword.php", "error", $err);
    }
} else {
    $err = "Invalid request method!";
    $error->redirect("../forgotpassword.php", "error", $err);
}
?>
