<?php
abstract class AbstractDatabase {
    protected $conn;
    public function connect() {
        $db_server = "127.0.0.1";
        $db_user = "root";
        $db_pass = "";
        $db_name = "my_oop";
        $this->conn = null;
        try {
            $this->conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
            if (!$this->conn) {
                throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
            }
            return $this->conn;
        } catch (Exception $e) {
            echo "Could not connect: " . $e->getMessage() . "<br>";
            return false;
        }
    }
    //abstract protected function getDatabaseName(): string;

}
?>
