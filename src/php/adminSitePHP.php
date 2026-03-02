<?php
    include 'src/classes/database.class.php';
    include 'src/classes/Books.class.php';

    $books = new Books($connection);
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $action = $_POST["action"] ?? '';
        echo $action;

        switch($action){
            case 'add_From_Form':
                $title  = filter_input(INPUT_POST, "title",  FILTER_SANITIZE_SPECIAL_CHARS);
                $author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_SPECIAL_CHARS);
                $genre  = filter_input(INPUT_POST, "genre",  FILTER_SANITIZE_SPECIAL_CHARS);
                $year   = filter_input(INPUT_POST, "year",   FILTER_VALIDATE_INT);
                $price  = filter_input(INPUT_POST, "price",  FILTER_VALIDATE_FLOAT);
                $review = filter_input(INPUT_POST, "review", FILTER_VALIDATE_FLOAT);

                // Validate
                if(empty($title))          $errors[] = "Title is required.";
                if(empty($author))         $errors[] = "Author is required.";
                if(empty($genre))          $errors[] = "Genre is required.";
                if(empty($year))        $errors[] = "Year is required.";
                if(empty($price))       $errors[] = "Price is required.";
                if(empty($review))      $errors[] = "Review is required.";

                if(empty($errors)){
                    $book = [
                        "title"  => $title,
                        "author" => $author,
                        "genre"  => $genre,
                        "year"   => $year,
                        "price"  => $price,
                        "review" => $review,
                    ];
                    $books->addBookDB($book);
                    $success = "Book added successfully!";
                }

                else{
                    foreach ($errors as $error){
                        echo $error . "<br>";
                    }
                }
                break;

            case 'add_From_JSON':
                $books->loadBooksJSON();
                $success = "Books loaded from JSON!";
                break;
        }
    }
?>