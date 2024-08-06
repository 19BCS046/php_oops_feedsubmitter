<?php
include "./validation/validation.php";
include "./database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords
    $validation = new Validation();
    if ($password !== $confirm_password) {
        header("Location: reset_password.php?token=$token&error=Passwords do not match");
        exit();
    }
    if (!$validation->password($password)) {
        header("Location: reset_password.php?token=$token&error=Invalid password");
        exit();
    }

    // Check if the token is valid
    $db = new Database();
    $conn = $db->connect();
    $stmt = $conn->prepare("SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resetRequest = $result->fetch_assoc();
        $email = $resetRequest['email'];

        // Update the user's password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();

        // Delete the token
        $stmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();

        header("Location: login.php?success=Your password has been reset successfully");
    } else {
        header("Location: reset_password.php?error=Invalid or expired token");
    }
}
?>
