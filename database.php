<?php 
class Database {
    public function connect(){
        $db_server = "127.0.0.1";
        $db_user = "root";
        $db_pass = "";
        $db_name = "my_oop";
        $conn = null;
        
        try {
            $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
            if (!$conn) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
                return false;
            }
            
          //  echo "Connected successfully to MySQL." . "<br>";
            return $conn;
        } catch (Exception $e) {
            echo "Could not connect: " . $e->getMessage() . "<br>";
            return false;
        }
    }
}
?>

