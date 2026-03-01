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

        public static function loadBooks($connection){
            $str = file_get_contents('src/books.json');
            $books = json_decode($str, true);
            $requiredFields = ["title", "author", "genre", "year", "price", "review"];

            foreach($books["books"] as $book){
                $isValid = true;

                foreach($requiredFields as $field){
                    if(!isset($book[$field]) || empty($book[$field])){
                        $isValid = false;
                        echo "Missing field: $field";
                        break;
                    }
                }

                if($isValid){
                    Books::addBookDB($book,$connection);
                }
            }
        }


        private static function addBookDB($book, $connection){

            $sql = "INSERT INTO `bookrecords` (`ID`, `title`, `author`, `genre`, `year`, `price`, `review`)
                     VALUES (NULL, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($connection, $sql);

            mysqli_stmt_bind_param($stmt, "sssids", 
                $book["title"], 
                $book["author"], 
                $book["genre"], 
                $book["year"], 
                $book["price"], 
                $book["review"]
            );
            mysqli_stmt_execute($stmt);
            
        }
    }
?>