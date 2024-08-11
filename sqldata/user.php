<?php
require_once 'AbstractDatabase.php';

class User extends AbstractDatabase {
    private $username;
    private $userpassword;
    private $userfullname;
    private $useremail;
    private $userphonenumber;
    private $userid;
    private $admin;

    public function __construct() {
        $this->conn = $this->connect();
    }

    public function insert($user_fullname, $user_name, $user_email, $user_phonenumber, $user_password, $user_gender) {
        try {
            if (!$this->conn) {
                throw new Exception("Database connection failed");
            }
            $sql = 'INSERT INTO users (user_fullname, user_name, user_email, user_phonenumber, user_password, user_gender) 
                    VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssss', $user_fullname, $user_name, $user_email, $user_phonenumber, $user_password, $user_gender);
            mysqli_stmt_execute($stmt);
            return mysqli_stmt_affected_rows($stmt) > 0;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function is_username_unique($user_name) {
        try {
            if (!$this->conn) {
                throw new Exception("Database connection failed");
            }
            $sql = 'SELECT user_name FROM users WHERE user_name=?';
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $user_name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            return mysqli_stmt_num_rows($stmt) == 0;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function auth($user_name, $user_password) {
        try {
            if (!$this->conn) {
                throw new Exception("Database connection failed");
            }
            $sql = 'SELECT user_name, user_password, user_id, user_email, user_fullname, admin FROM users WHERE user_name=?';
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $user_name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $db_username, $db_password, $db_userid, $db_email, $db_fullname, $db_admin);
                mysqli_stmt_fetch($stmt);
    
                // Check if the username and password match and if the user is an admin
                if ($user_name === $db_username && password_verify($user_password, $db_password) && $db_admin === 'admin') {
                    // $this->username = $db_username;
                    // $this->userpassword = $db_password;
                    // $this->userfullname = $db_fullname;
                    // $this->useremail = $db_email;
                    // $this->userid = $db_userid;
                    // $this->admin = $db_admin;
                    return true;
                }
            }
            return false;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    public function getData() {
        return [
            'userid' => $this->userid,
            'username' => $this->username,
            'userfullname' => $this->userfullname,
            'useremail' => $this->useremail,
            'admin' => $this->admin
        ];
    }
}
?>
