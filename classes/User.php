<?php
include_once 'Database.php';
class User {
    private $conn;
    private $table_name = "users"; 

    public $id;
    public $username;
    public $password;

    public function __construct() {
        $this->conn = new Database();
    }

    public function login() {

        $sql = "SELECT * FROM users WHERE username = ?";
        $user = $this->conn->fetchOne($sql, [$this->username], 's');
        
        if ($user) {
            if (password_verify($this->password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
}
?>
