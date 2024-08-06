<?php
require_once '../database.php';
class User {
    private $conn2;
    private $username;
    private $userpassword;
    private $userfullname;
    private $useremail;
    private $userphonenumber;
    private $userid;
    private $admin;



   
    function __construct($db1_connect) {
        $this->conn2 = $db1_connect;
    }
  //  user_id	user_fullname	user_name	user_email	user_phonenumber	user_password	user_gender	

  function insert($user_fullname, $user_name, $user_email, $user_phonenumber, $user_password, $user_gender) {
    try {
        if (!$this->conn2) {
            throw new Exception("Database connection failed");
        }
        $sql = 'INSERT INTO users (user_fullname, user_name, user_email, user_phonenumber, user_password, user_gender) 
                VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = mysqli_prepare($this->conn2, $sql);        
        mysqli_stmt_bind_param($stmt, 'ssssss', $user_fullname, $user_name, $user_email, $user_phonenumber, $user_password, $user_gender);
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
function is_username_unique($user_name) {
    try {
        if (!$this->conn2) {
            throw new Exception("Database connection failed");
        }
        $sql = 'SELECT user_name FROM users WHERE user_name=?';
        $stmt = mysqli_prepare($this->conn2, $sql);
        mysqli_stmt_bind_param($stmt, 's', $user_name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $row_count = mysqli_stmt_num_rows($stmt);
        if ($row_count > 0) {
            return 0; // Username already exists
        } else {
            return 1; // Username is unique
        }
    } 
    catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function auth($user_name, $user_password) {
    try {
        if (!$this->conn2) {
            throw new Exception("Database connection failed");
        }
        $sql = 'SELECT user_name, user_password, user_id, user_email, user_fullname,admin FROM users WHERE user_name=?';
        $stmt = mysqli_prepare($this->conn2, $sql);
        mysqli_stmt_bind_param($stmt, 's', $user_name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $db_username, $db_password, $db_userid, $db_email, $db_fullname,$db_admin);
            mysqli_stmt_fetch($stmt);
            if (password_verify($user_password, $db_password)) {
                $this->username = $db_username;
                $this->userpassword = $db_password;
                $this->userfullname = $db_fullname;
                $this->useremail = $db_email;
                $this->userid = $db_userid;
                $this->admin = $db_admin;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getData() {
    $data=array('userid'=> $this->userid,
                'username'=> $this->username,
                'userfullname'=> $this->userfullname,
                'useremail'=> $this->useremail,
                 'admin' => $this->admin);
                return $data;
    
  }
  }
?>  