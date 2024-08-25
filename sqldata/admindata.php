<?php
// Unneccesary file
require_once '../database.php';

class Admin {
    private $conn2;

    function __construct($db1_connect) {
        $this->conn2 = $db1_connect;
    }

    function auth($user_name, $user_password) {
        try {
            if (!$this->conn2) {
                throw new Exception("Database connection failed");
            }
            $sql = 'SELECT * FROM admin';
            $result = $this->conn2->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = $row["admin_username"];
                    $pass = $row["admin_password"];
                }
            } else {
                echo "0 results";
                return false;
            }
            if ($user_name == $name) {
                return true;
            } 
            elseif(password_verify($user_password, $pass)){
                return true; 
            }
            else {
                return false;
            }
        
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
