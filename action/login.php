<?php
session_start();
include "../validation/Errors.php";
include "../validation/validation.php";
require_once '../database.php';
include "../sqldata/user.php";
$validation=new Validation();
$error=new Errors();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["username"])&&empty($_POST["password"])){
        $err="Please fill out Details";
        $error->redirect("../index.php","error",$err);
    }
    $username=$validation->clean($_POST["username"]);
    $password=$validation->clean($_POST["password"]);
    // echo"$username"."<br>";
    // echo"$password"."<br>";
    
 
     if(!$validation->username($username)) {
            $err="Please enter valid name";
            $error->redirect("../index.php","error",$err);
            }
                else if(!$validation->password($password)) {
                    $err="Please enter valid password";
                    $error->redirect("../index.php","error",$err);
                    }
                
                        else{
                            $db1=new Database();
                            $conn1=$db1->connect();
                            $user=new User($conn1);
                            $sql_table1 = "SELECT * FROM users WHERE user_id=7";
                        try{
                            $result_table1 = $conn1->query($sql_table1);
                            echo"Received successfully";
                            if ($result_table1->num_rows > 0) {
                                while ($row = $result_table1->fetch_assoc()) {
                                    $adminpanel=$row["admin"];
                                }
                            }
                            //echo$adminpanel;
                           }
  	                    catch(mysqli_sql_exception){
                        echo"Already taken";
                        echo$sql_table1;
                        echo$row["admin"];
                        }
                            $auth=$user->auth($username,$password);                           
                            if($auth){
                                if($adminpanel=="admin" && $username=="perumal")
                                { 
                                     $sm="admin !";
                                     $error->redirect("../admin/user.php","Success",$sm);
                                    //  echo"logged in admin";
                                }
                                else{
                                $user_data=$user->getData();
                                $_SESSION['username']=$user_data['username'];
                                $_SESSION['password']=$user_data['userpassword'];
                                $sm="Logged in!";
                                
                                $error->redirect("../home.php","Success",$sm);
                                // echo"login";
                                }     
                            }
                          
                            else{
                                $err="Incorrect Username or Password";
                                $error->redirect("../index.php","error",$err);

                            }
                                            }
                
}
else{
    $err="error occurs";
    $error->redirect("../index.php","error",$err);
}
?>