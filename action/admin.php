
<?php
include "../validation/Errors.php";
include "../validation/validation.php";
require_once '../database.php';
include "../sqldata/admindata.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["username"])&&empty($_POST["password"])){
        $err="Please fill out Details";
        Errors::redirect("../admin.php","error",$err);
    }   
    $username=Validation::clean($_POST["username"]);
    $password=Validation::clean($_POST["password"]);
   // $data="fname=".$fullname."email=".$email;
    // echo"$username"."<br>";
    // echo"$password"."<br>";

    if(!Validation::name($username)) {
        $err="Please Enter your name";
        Errors::redirect("../admin.php","error",$err);
        }
        else if(!Validation::password($password)) {
            $err="Please enter your password";
            Errors::redirect("../admin.php","error",$err);
            }
                else{
                    $db1=new Database();
                    $conn1=$db1->connect();
                    $admin=new Admin($conn1);
                    $auth=$admin->auth($username,$password);
                   try{
                    if($auth){
                        $sm="Logged in!";
                        Errors::redirect("../admindetails.php","Success",$sm);
                        echo"Received successfully";
                       }
                       else{
                            $err="Incorrect Username or Password";
                          Errors::redirect("../admin.php","error",$err)
                       }
                    }
                      catch(mysqli_sql_exception){
                        echo"Already taken";
                      }
 
                    // $auth=$admin->auth($username,$password);
                    // if($auth){
                    //     $user_data=$user->getData();
                    //     $_SESSION['username']=$user_data['username'];
                    //     $_SESSION['password']=$user_data['userpassword'];
                    //     $sm="Logged in!";
                    //     Errors::redirect("../home.php","Success",$sm);
                    // }
                    // else{
                    //     $err="Incorrect Username or Password";
                    //     Errors::redirect("../admin.php","error",$err);

                    // }
                }    
            }  
                    else{
                        $err="Error Occurs";
                        Errors::redirect("../admin.php","error",$err);
                    }
                    $conn1->close();
                        ?>