<?php
include "../validation/validation.php";
include "../sqldata/feedbackdata.php";
require_once '../sqldata/user.php';

//validate and error shows
$validation=new ErrorHandler();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["delivery"])&&empty($_POST["comments"])&&empty($_POST["subject"])){
        $err="Please fill out Details";
        $validation->redirect("../feedback.php","error",$err);
    }
    $username=$validation->clean($_POST["username"]);
    $delivery_num=$validation->clean($_POST["delivery"]);
    $comments=$validation->clean($_POST["comments"]);
    $rating=$validation->clean($_POST["rating"]);
    $feedback_pro=$validation->clean($_POST["subject"]);

    // validate the fields
    if(!$validation->name($username)) {
        $err="Enter your name";
        $validation->redirect("../feedback.php","error",$err);
        }
        else if($delivery_num==""){
            $err="Enter your Delivery number";
            $validation->redirect("../feedback.php","error",$err);
         }
        else if(!$validation->name($comments)) {
            $err="Please provide your comments";
            $validation->redirect("../feedback.php","error",$err);
            }
                        else if($rating==""){
                           $err="Please provide your ratings";
                           $validation->redirect("../feedback.php","error",$err);
                        }
                        else if(!$validation->name($feedback_pro)) {
                            $err="Please provide your feedback";
                            $validation->redirect("../feedback.php","error",$err);
                            }
                            else {
                                //database connection
                                $db1 = new User();
                                $conn1 = $db1->connect();
                                $feedback = new Feedback($conn1);
                                $result = $feedback->insert($username, $delivery_num, $comments, $rating, $feedback_pro);
                                    if ($result) {
                                        $er = "Successfully Submitted";
                                        echo $er;
                                        $validation->redirect("../feedback.php", "success", $er);
                                    } else {
                                        $err = "Failed to submit feedback.";
                                        $validation->redirect("../feedback.php", "error", $err);
                                    }
}
}
else{
    $err="error occurs";
    $validation->redirect("../feedback.php","error",$err);
}
?>
