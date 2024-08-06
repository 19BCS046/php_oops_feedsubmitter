<?php
require_once '../database.php';
class Feedback{
private $conn2;
private $feedback_username;
private $feedback_deliverynum;
private $feedback_comments;
private $feedback_rating;
private $product_feedback;


function __construct($db1_connect) {
    $this->conn2 = $db1_connect;
}
// 	feeback_username	feedback_deliverynum	feedback_comments	feedback_rating	product_feedback	feedback_id	
//feedback_id	feedback_username	feedback_deliverynum	feedback_comments	feedback_rating	product_feedback	
function insert($feeback_username, $feedback_deliverynum, $feedback_comments, $feedback_rating, $product_feedback) {
    try {
        if (!$this->conn2) {
            throw new Exception("Database connection failed");
        }
        $sql = "INSERT INTO feedbacks (feeback_username, feedback_deliverynum, feedback_comments, feedback_rating, product_feedback) 
                VALUES ('$feeback_username', '$feedback_deliverynum', '$feedback_comments', '$feedback_rating', '$product_feedback')";
        
        mysqli_query($this->conn2,$sql);
        $affected_rows = mysqli_affected_rows($this->conn2);
        
        if ($affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    } 
    catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
}
?>