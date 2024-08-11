<?php
require_once 'AbstractDatabase.php';

class Feedback extends AbstractDatabase{
private $conn2;
private $feedback_username;
private $feedback_deliverynum;
private $feedback_comments;
private $feedback_rating;
private $product_feedback;


public function __construct() {
    $this->conn = $this->connect();
}

function insert($feeback_username, $feedback_deliverynum, $feedback_comments, $feedback_rating, $product_feedback) {
    try {
        if (!$this->conn) {
            throw new Exception("Database connection failed");
        }
        $sql = "INSERT INTO feedbacks (feeback_username, feedback_deliverynum, feedback_comments, feedback_rating, product_feedback) 
                VALUES ('$feeback_username', '$feedback_deliverynum', '$feedback_comments', '$feedback_rating', '$product_feedback')";
        
        mysqli_query($this->conn,$sql);
        $affected_rows = mysqli_affected_rows($this->conn);
        
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