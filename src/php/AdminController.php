<?php

class AdminController {

    private Auth $auth;
    private Books $books;

    public function __construct($connection) {
        $this->auth  = new Auth($connection);
        $this->books = new Books($connection);
    }

    public function handle(): void {
        if($_SERVER["REQUEST_METHOD"] == "GET" || $_SERVER["REQUEST_METHOD"] == "POST"){
            $this->handleGet();
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->handlePost();
        }
    }

    private function handleGet(): void {
        if(!$this->auth->isLoggedIn()){
            header("Location: index.php");
            exit();
        }
    }

    public function getFlash(): array {
        $errors  = $_SESSION["errors"]  ?? [];
        $success = $_SESSION["success"] ?? null;
        unset($_SESSION["errors"], $_SESSION["success"]);

        return compact('errors', 'success');
    }

    private function handlePost(): void {
        $action = $_POST["action"] ?? '';
        $errors = [];

        switch($action){
            case 'add_From_Form':
                $errors = $this->validateBook();

                if(empty($errors)){
                    $this->books->addBookDB([
                        "title"     => filter_input(INPUT_POST, "title",  FILTER_SANITIZE_SPECIAL_CHARS),
                        "author"    => filter_input(INPUT_POST, "author", FILTER_SANITIZE_SPECIAL_CHARS),
                        "genre"     => filter_input(INPUT_POST, "genre",  FILTER_SANITIZE_SPECIAL_CHARS),
                        "sinopsis"  => filter_input(INPUT_POST, "sinopsis",  FILTER_SANITIZE_SPECIAL_CHARS),
                        "year"      => filter_input(INPUT_POST, "year",   FILTER_VALIDATE_INT),
                        "price"     => filter_input(INPUT_POST, "price",  FILTER_VALIDATE_FLOAT),
                        "review"    => filter_input(INPUT_POST, "review", FILTER_VALIDATE_FLOAT),
                    ]);
                    $_SESSION["success"] = "Book added successfully!";
                } else {
                    $_SESSION["errors"] = $errors;
                }

                header("Location: " . $_SERVER["PHP_SELF"]);
                exit();

            case 'add_From_JSON':
                $this->books->loadBooksJSON();
                $_SESSION["success"] = "Books loaded from JSON!";
                header("Location: " . $_SERVER["PHP_SELF"]);
                exit();
        }
    }

    private function validateBook(): array {
        $errors = [];

        $title      = filter_input(INPUT_POST, "title",  FILTER_SANITIZE_SPECIAL_CHARS);
        $author     = filter_input(INPUT_POST, "author", FILTER_SANITIZE_SPECIAL_CHARS);
        $genre      = filter_input(INPUT_POST, "genre",  FILTER_SANITIZE_SPECIAL_CHARS);
        $sinopsis  = filter_input(INPUT_POST, "sinopsis",  FILTER_SANITIZE_SPECIAL_CHARS);
        $year       = filter_input(INPUT_POST, "year",   FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 9999]]);
        $price      = filter_input(INPUT_POST, "price",  FILTER_VALIDATE_FLOAT, ["options" => ["min_range" => 0]]);
        $review     = filter_input(INPUT_POST, "review", FILTER_VALIDATE_FLOAT, ["options" => ["min_range" => 0, "max_range" => 5]]);

        if(empty($title))          $errors[] = "Title is required.";
        if(empty($author))         $errors[] = "Author is required.";
        if(empty($genre))          $errors[] = "Genre is required.";
        if(enpty($sinopsis))       $errors[] = "Sinopsis is required.";
        if($year === false)        $errors[] = "Year must be between 0 and 9999.";
        if($price === false)       $errors[] = "Price must be a positive number.";
        if($review === false)      $errors[] = "Review must be between 0 and 5.";

        return $errors;
    }
}

    include 'src/classes/database.class.php';
    include 'src/classes/Books.class.php';
    include 'src/classes/auth.class.php';
    session_start();

    $controller = new AdminController($connection);
    $controller->handle();
    $flash = $controller->getFlash();

    $errors  = $flash['errors'];
    $success = $flash['success'];
?>