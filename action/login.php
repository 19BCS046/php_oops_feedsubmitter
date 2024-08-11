<?php
session_start();
include "../validation/validation.php";
include "../sqldata/user.php";
//object handles both validation and error
$validation=new ErrorHandler();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    if(empty($_POST["username"])&&empty($_POST["password"])){
        $err="Please fill out Details";
        $validation->redirect("../index.php","error",$err);
    }
    //remove  unwanted things
    $username=$validation->clean($_POST["username"]);
    $password=$validation->clean($_POST["password"]);

     // validate fields  
     if(!$validation->username($username)) {
            $err="Please enter valid name";
            $validation->redirect("../index.php","error",$err);
            }
                else if(!$validation->password($password)) {
                    $err="Please enter valid password";
                    $validation->redirect("../index.php","error",$err);
                    }
                //all fields are correct then it will authenticate
                        else{
                            $db1=new User();
                            $conn1=$db1->connect();
                            $user=new User($conn1);
                            $sql_table1 = "SELECT * FROM users WHERE user_fullname=$username";
                       
                            try{
                            $result_table1 = $conn1->query($sql_table1);
                            echo"Received successfully";
                           }
  	                    catch(mysqli_sql_exception){
                        echo"Already taken";
                        }
                            $auth=$user->auth($username,$password);                           
                            if($auth){
                                     $sm="admin !";
                                     $validation->redirect("../admin/user.php","Success",$sm);
                            }
                                else if(!$auth){
                                $user_data=$user->getData();
                                $_SESSION['username']=$username;
                                $sm="Logged in!";
                                $validation->redirect("../home.php","Success",$sm);
                                }     
                            
                          
                            else{
                                $err="Incorrect Username or Password";
                                $validation->redirect("../index.php","error",$err);

                            }
                                            }
                
}
else{
    $err="error occurs";
    $validation->redirect("../index.php","error",$err);
}
?>  