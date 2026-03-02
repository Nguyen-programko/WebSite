

<?php
    include 'src/classes/database.class.php';
    include 'src/classes/Auth.class.php';
    session_start();

    $auth = new Auth($connection);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $action = $_POST["action"] ?? '';

        switch($action){
            case 'login':
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
                $password = $_POST["password"];
                
                if($auth->login($username, $password)){
                    header("Location: " . $_SERVER["PHP_SELF"]);
                    exit();
                } else {
                    $loginError = "Wrong username or password.";
                }
                break;

            case 'logout':
                $auth->logout();
                header("Location: " . $_SERVER["PHP_SELF"]);
                exit();
                break;
        }
    }
    if($connection instanceof mysqli){
        mysqli_close($connection);
    }
?>