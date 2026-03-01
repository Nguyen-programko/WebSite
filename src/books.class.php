<?php 

    class Books{

        public static function getBooks($connection){
            $sql = "SELECT * FROM bookrecords";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $record = mysqli_fetch_assoc($result);

            echo $record["name"];
        }

        public static function loadBooks(){
            $str = file_get_contents("books.json");
            $books = json_decode($str, true); 
        }
    }
?>