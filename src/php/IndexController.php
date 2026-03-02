<?php

class IndexController {

    private Auth $auth;

    public function __construct($connection) {
        $this->auth = new Auth($connection);
    }

    public function handle(): void {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->handlePost();
        }
    }

    public function isLoggedIn(): bool {
        return $this->auth->isLoggedIn();
    }

    public function getUsername(): string {
        return $_SESSION["username"] ?? '';
    }

    public function getLoginError(): ?string {
        $error = $_SESSION["loginError"] ?? null;
        unset($_SESSION["loginError"]);
        return $error;
    }

    private function handlePost(): void {
        $action = $_POST["action"] ?? '';

        switch($action){
            case 'login':
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
                $password = $_POST["password"];

                if($this->auth->login($username, $password)){
                    header("Location: " . $_SERVER["PHP_SELF"]);
                    exit();
                } else {
                    $_SESSION["loginError"] = "Wrong username or password.";
                    header("Location: " . $_SERVER["PHP_SELF"]);
                    exit();
                }

            case 'logout':
                $this->auth->logout();
                header("Location: " . $_SERVER["PHP_SELF"]);
                exit();
        }
    }
}


include 'src/classes/database.class.php';
include 'src/classes/Auth.class.php';
session_start();

$controller = new IndexController($connection);
$controller->handle();
?>