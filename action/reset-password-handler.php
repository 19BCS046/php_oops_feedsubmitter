<?php
session_start(); 

require_once "../validation/validation.php";
require_once "../sqldata/user.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['con_password'];
    $token = $_POST['password_token'];
    
    //database connection
    $db = new User();
    $conn = $db->connect();
    $error = new ErrorHandler();

    //check token and update new password
    if (!empty($token)) {
        if (!empty($email) && !empty($password) && !empty($confirm_password)) {
            $validation = new Validation();

            // if (!$validation->email($email)) {
            //     $_SESSION['error'] = "Please enter a valid email";
            //     header("Location: ../reset-password.php?token=$token&email=$email");
            //     exit();
            // }
            if (!$validation->password($password)) {
                $_SESSION['error'] = "Please enter a valid password";
                header("Location: ../reset-password.php?token=$token&email=$email");
                exit();
            }
            if (!$validation->password($confirm_password)) {
                $_SESSION['error'] = "Please enter a valid confirm password";
                header("Location: ../reset-password.php?token=$token&email=$email");
                exit();
            }

            $check_token = "SELECT reset_token_hash FROM users WHERE reset_token_hash='$token' LIMIT 1";
            $check_token_execute = mysqli_query($conn, $check_token);

            if (mysqli_num_rows($check_token_execute) <= 0) {
                if ($password == $confirm_password) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $update_password = "UPDATE users SET user_password='$hashed_password' WHERE reset_token_hash='$token' LIMIT 1";
                    $update_password_execute = mysqli_query($conn, $update_password);

                    if ($update_password_execute) {
                        // $new_token = bin2hex(random_bytes(50));
                        // $update_to_new_token="SELECT reset_token_hash='$new_token' FROM users WHERE reset_token_hash='$token' LIMIT 1 ";
                        // $check_to_new_token_execute= mysqli_query($conn,$check_token);

                        $err = "New Password Updated Successfully!";
                        $error->redirect("../index.php", "success", $err);
                    } else {
                        $_SESSION['error'] = "Did not Update Password! Try Again";
                        header("Location: ../reset-password.php?token=$token&email=$email");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "Passwords do not match";
                    header("Location: ../reset-password.php?token=$token&email=$email");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Invalid Token!";
                header("Location: ../reset-password.php?token=$token&email=$email");
                exit();
                        }
        } else {
            $_SESSION['error'] = "All Fields are Mandatory";
            header("Location: ../reset-password.php?token=$token&email=$email");
            exit();
        }
    } else {
        $_SESSION['error'] = "No Token Available!";
        header("Location: ../reset-password.php?token=$token&email=$email");
        exit();
    }
}
?>