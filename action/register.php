
<?php
//  use PHPMailer\PHPMailer\PHPMailer;
//  use PHPMailer\PHPMailer\SMTP;
//  use PHPMailer\PHPMailer\Exception;
//  require 'vendor/autoload.php';
 

include "../validation/Errors.php";
include "../validation/validation.php";
require_once '../database.php';
include "../sqldata/user.php";
$validation=new Validation();
$error=new Errors();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["fullname"])&&empty($_POST["username"])&&empty($_POST["email"])&&empty($_POST["phonenumber"])
    &&empty($_POST["password"])&&empty($_POST["confirmpassword"])&&empty($_POST["gender"])){
        $err="Please fill out Details";
        $error->redirect("../register.php","error",$err);
    }
    $fullname=$validation->clean($_POST["fullname"]);
    $username=$validation->clean($_POST["username"]);
    $email=$validation->clean($_POST["email"]);
    $phonenumber=$validation->clean($_POST["phonenumber"]);
    $password=$validation->clean($_POST["password"]);
    $confirmpassword=$validation->clean($_POST["confirmpassword"]);
    $gender=$validation->clean($_POST["gender"]);
    $data="fname=".$fullname."uname=".$username."email=".$email;
    // echo"$fullname"."<br>";
    // echo"$username"."<br>";
    // echo"$email"."<br>";
    // echo"$password"."<br>";
    // echo"$gender"."<br>";
    // echo"$phonenumber"."<br>";
    // echo"$confirmpassword"."<br>";
    if(!$validation->name($fullname)) {
        $err="Invalid  Fullname";
        $error->redirect("../register.php","error",$err);
        }
        else if(!$validation->username($username)) {
            $err="please enter username above 8 characters";
            $error->redirect("../register.php","error",$err);
            }
            else if(!$validation->email($email)) {
                $err="Invalid email";
                $error->redirect("../register.php","error",$err);
                }
                else if(!$validation->phonenumber($phonenumber)) {
                    $err="Please enter a 10 digits number";
                    $error->redirect("../register.php","error",$err);
                    }
                else if(!$validation->password($password)) {
                    $err="Please enter above 8 characters and make strong password include(@,$,1-9,A-Z,a-Z)";
                    $error->redirect("../register.php","error",$err);
                    }
                    else if(!$validation->confirmpassword($password,$confirmpassword)) {
                        $err="Password and Confirm Password does not match";
                        $error->redirect("../register.php","error",$err);
                        }
                        else if($gender==""){
                           $err="Please choose your gender";
                           $error->redirect("../register.php","error",$err);
                        }
                        else{
                        //     $err="Database is Connected successfully ";
                        //    Errors::redirect("../register.php","error",$err);

                        $db1=new Database();
                        $conn1=$db1->connect();
                        $user=new User($conn1);
                        if($user->is_username_unique($username)){
                            $password=password_hash($password,PASSWORD_DEFAULT);
                            //  user_id	user_fullname	user_name	user_email	user_phonenumber	user_password	user_gender	
                            // $user_data=[$fullname,$username,$email,$phonenumber,$password,$gender];
                            $result=$user->insert($fullname,$username,$email,$phonenumber,$password,$gender);
                            if($result){
                                $er="Successfully Registered";

// //Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);

// try {
//     //Server settings
//    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'perumalshanmugam2002@gmail.com';                     //SMTP username
//     $mail->Password   = 'vaymkmnqwgcdhxvq';                               //SMTP password
//    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipients
//     $mail->setFrom('perumalshanmugam2002@gmail.com', 'Perumal');
//     $mail->addAddress($email,$username);     //Add a recipient
//   //  $mail->addAddress('ellen@example.com');               //Name is optional
//   //  $mail->addReplyTo('info@example.com', 'Information');
//   //  $mail->addCC('cc@example.com');
//   //  $mail->addBCC('bcc@example.com');

//     //Attachments
//    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'Your Name and Password';
//     $mail->Body    = 'Name : '.$username.'<br>'.'Password :'.$password;
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//   //  echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }
                                $error->redirect("../register.php","success",$er);
                            }
                            else{
                                $err="Not Registered";
                                $error->redirect("../register.php","error",$err);
                            }
                        }
                        else{
                            $err="This Username ($username) is already taken";
                            $error->redirect("../register.php","error",$err);
                        }
                       
                        }
                
}
else{
    $err="error occurs";
    $error->redirect("../register.php","error",$err);
}

mysqli_close($conn);
?>