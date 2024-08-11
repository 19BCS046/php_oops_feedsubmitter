<?php
include "../validation/validation.php";
include "../sqldata/condata.php";
require_once '../sqldata/user.php';

//Objects for Validating
$validation=new Validation();
$error=new ErrorHandler();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["con_name"])&&empty($_POST["con_email"])&&empty($_POST["con_message"])){
        $err="Please fill out Details";
        $error->redirect("../contact.php","error",$err);
    }
    $fullname=$error->clean($_POST["con_name"]);
    $email=$error->clean($_POST["con_email"]);
    $message=$error->clean($_POST["con_message"]);
    $data="fname=".$fullname."email=".$email;
   
    if(!$error->name($fullname)) {
        $err="Please Enter your name";
        $error->redirect("../contact.php","error",$err);
        }
        
    // if(!Validation::name($message)) {
    //     $err="Type your queries";
    //     Errors::redirect("../contact.php","error",$err);
    //     }
            else if(!$error->email($email)) {
                $err="Please Enter valid email";
                $error->redirect("../contact.php","error",$err);
                }
                else{
                    //databases connection
                    $db1=new User();
                    $conn1=$db1->connect();
                    $contact=new Contact($conn1);
                    $result=$contact->insert($fullname,$email,$message);
                            if($result){
                                $er="Successfully Submitted your details";
                                $error->redirect("../contact.php","success",$er);
                            }
                            else{
                                $err="Not Submitted";
                                $error->redirect("../contact.php","error",$err);
                            }

                }    
            } 
                    else{
                        $err="Error Occurs";
                        $error->redirect("../contact.php","error",$err);
                    }

                        ?>