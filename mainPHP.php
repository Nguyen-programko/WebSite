<?php

    include 'src/database.php';
?>


<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if(!empty($username) && !empty($password)){
            

            $sqlLogIn = "SELECT * FROM users WHERE username = ?";
            
            $stmt = mysqli_prepare($connection, $sqlLogIn);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) > 0){
                $record = mysqli_fetch_assoc($result);
                
                if(password_verify($password, $record["password"])){
                    echo $record["username"]; // login success
                } else {
                    echo "Wrong password";
                }
            } else {
                echo "User not found";
            }
}
    }

?>


<?php 
    mysqli_close($connection);
?> 