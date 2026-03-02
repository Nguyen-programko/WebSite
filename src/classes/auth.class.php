<?php

class Auth {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function login($username, $password) {
        if(empty($username) || empty($password)){
            return false;
        }

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0){
            $record = mysqli_fetch_assoc($result);

            if(password_verify($password, $record["password"])){
                $_SESSION["username"] = $record["username"];
                $_SESSION["loggedIn"] = true;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isLoggedIn() {
        return isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true;
    }

    public function logout() {
        session_destroy();
    }
}