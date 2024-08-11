<?php
include "../validation/validation.php";
include "../sqldata/user.php";

//Smtp mail configuration
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader   
require '../vendor/autoload.php';

//object handles both validation and error
$validation=new ErrorHandler();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["fullname"])&&empty($_POST["username"])&&empty($_POST["email"])&&empty($_POST["phonenumber"])
    &&empty($_POST["password"])&&empty($_POST["confirmpassword"])&&empty($_POST["gender"])){
        $err="Please fill out Details";
        $validation->redirect("../register.php","error",$err);
    }
    $fullname=$validation->clean($_POST["fullname"]);
    $username=$validation->clean($_POST["username"]);
    $email=$validation->clean($_POST["email"]);
    $phonenumber=$validation->clean($_POST["phonenumber"]);
    $password=$validation->clean($_POST["password"]);
    $confirmpassword=$validation->clean($_POST["confirmpassword"]);
    $gender=$validation->clean($_POST["gender"]);
    $data="fname=".$fullname."uname=".$username."email=".$email;
    //validate the fields
    if(!$validation->name($fullname)) {
        $err="Invalid  Fullname";
        $validation->redirect("../register.php","error",$err);
        }
        else if(!$validation->username($username)) {
            $err="please enter username above 8 characters";
            $validation->redirect("../register.php","error",$err);
            }
            else if(!$validation->email($email)) {
                $err="Invalid email";
                $validation->redirect("../register.php","error",$err);
                }
                else if(!$validation->phonenumber($phonenumber)) {
                    $err="Please enter a 10 digits number";
                    $validation->redirect("../register.php","error",$err);
                    }
                else if(!$validation->password($password)) {
                    $err="Please enter above 8 characters and make strong password include(@,$,1-9,A-Z,a-Z)";
                    $validation->redirect("../register.php","error",$err);
                    }
                    else if(!$validation->confirmpassword($password,$confirmpassword)) {
                        $err="Password and Confirm Password does not match";
                        $validation->redirect("../register.php","error",$err);
                        }
                        else if($gender==""){
                           $err="Please choose your gender";
                           $validation->redirect("../register.php","error",$err);
                        }
                        else{
                        //     $err="Database is Connected successfully ";
                        //    Errors::redirect("../register.php","error",$err);

                        // All fields are correct then go to stored in database users table
                        $db1=new User();
                        $conn1=$db1->connect();
                        $user=new User($conn1);
                        if($user->is_username_unique($username)){
                            $password=password_hash($password,PASSWORD_DEFAULT);
                            $result=$user->insert($fullname,$username,$email,$phonenumber,$password,$gender);

                            if($result){
                                $er="Successfully Registered";
                                 //Goes successful mail to registered email
                                $mail = new PHPMailer(true);
                                try {
                                   
                                    $mail->isSMTP(); // Send using SMTP
                                    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                                    $mail->SMTPAuth = true; // Enable SMTP authentication
                                    $mail->Username = 'perumalshanmugam2002@gmail.com'; // SMTP username
                                    $mail->Password = 'uoeojckedywgrhmv'; // SMTP password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
                                    $mail->Port = 465; // TCP port to connect to
                            
                                    // Recipients
                                    $mail->setFrom('perumalshanmugam2002@gmail.com', 'Perumal');
                                    $mail->addAddress($email, $username); // Add a recipient
                                    $mail->addReplyTo('info@example.com', 'Information');
                                    // Content
                                    $mail->isHTML(true); // Set email format to HTML
                                    $mail->Subject = 'Registered Successfull';
                                    $email_template = "
                                        <h2>Hello, {$username}!</h2>
                                        <h3>Thank you for joining us on FeedSubmitter. Your account has been successfully created.</h3>
                                        <br>
                                    ";
                                    $mail->Body = $email_template;
                                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                            
                                    $mail->send();
                                } catch (Exception $e) {
                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                }
                                $validation->redirect("../register.php","success",$er);
                            }
                            else{
                                $err="Not Registered";
                                $validation->redirect("../register.php","error",$err);
                            }
                        }
                        else{
                            $err="This Username ($username) is already taken";
                            $validation->redirect("../register.php","error",$err);
                        }
                       
                        }
                
}
else{
    $err="error occurs";
    $validation->redirect("../register.php","error",$err);
}

mysqli_close($conn);
?>