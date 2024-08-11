<?php
require_once 'AbstractDatabase.php';

class Contact extends AbstractDatabase{
private $conn2;
private $con_name;
private $con_email;
private $con_message;

function __construct() {
    $this->conn2 = $this->connect();
}
function insert($con_name, $con_email, $con_message) {
    try {
        if (!$this->conn2) {
            throw new Exception("Database connection failed");
        }
        $sql = 'INSERT INTO contact (con_username, con_email, con_message) 
                VALUES (?, ?, ?)';
        $stmt = mysqli_prepare($this->conn2, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $con_name, $con_email, $con_message);
        mysqli_stmt_execute($stmt);
                if (mysqli_stmt_affected_rows($stmt) > 0) {
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