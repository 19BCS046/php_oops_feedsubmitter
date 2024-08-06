<?php
include "../validation/Errors.php";
include "../validation/validation.php";
require_once '../database.php';
include "../sqldata/feedbackdata.php";
$validation=new Validation();
$error=new Errors();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["delivery"])&&empty($_POST["comments"])&&empty($_POST["subject"])){
        $err="Please fill out Details";
        $error->redirect("../feedback.php","error",$err);
    }
    $username=$validation->clean($_POST["username"]);
    $delivery_num=$validation->clean($_POST["delivery"]);
    $comments=$validation->clean($_POST["comments"]);
    $rating=$validation->clean($_POST["rating"]);
    $feedback_pro=$validation->clean($_POST["subject"]);
    // echo"$username"."<br>";
    // echo"$delivery_num"."<br>";
    // echo"$comments"."<br>";
    // echo"$rating"."<br>";
    // echo"$feedback_pro"."<br>";
    if(!$validation->name($username)) {
        $err="Enter your name";
        $error->redirect("../feedback.php","error",$err);
        }
        else if($delivery_num==""){
            $err="Enter your Delivery number";
            $error->redirect("../feedback.php","error",$err);
         }
        else if(!$validation->name($comments)) {
            $err="Please provide your comments";
            $error->redirect("../feedback.php","error",$err);
            }
                        else if($rating==""){
                           $err="Please provide your ratings";
                           $error->redirect("../feedback.php","error",$err);
                        }
                        else if(!$validation->name($feedback_pro)) {
                            $err="Please provide your feedback";
                            $error->redirect("../feedback.php","error",$err);
                            }
                            else {
                                $db1 = new Database();
                                $conn1 = $db1->connect();
                                $feedback = new Feedback($conn1);
                                $result = $feedback->insert($username, $delivery_num, $comments, $rating, $feedback_pro);
                                //echo"$result";
                                    if ($result) {
                                        $er = "Successfully Submitted";
                                        echo $er;
                                        $error->redirect("../feedback.php", "success", $er);
                                    } else {
                                        $err = "Failed to submit feedback.";
                                        $error->redirect("../feedback.php", "error", $err);
                                    }
}
}
else{
    $err="error occurs";
    $error->redirect("../feedback.php","error",$err);
}
?>
