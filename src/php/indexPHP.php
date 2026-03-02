

<?php
    include 'src/classes/database.class.php';
    include 'src/classes/Auth.class.php';
    session_start();

    $auth = new Auth($connection);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $_POST["password"]; 

        if($auth->login($username, $password)){
            header("Location: booksList.php");
            exit();
        } else {
            echo "Wrong username or password";
        }
    }

    if($connection instanceof mysqli){
        mysqli_close($connection);
    }
?>