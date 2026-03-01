

<?php
    include 'classes/database.class.php';
    include 'classes/Auth.class.php';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $_POST["password"]; 

        if(Auth::login($username, $password, $connection)){
            header("Location: booksList.php");
            exit();
        } else {
            echo "Wrong username or password";
        }
    }

    mysqli_close($connection);
?>