<?php

class Books {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getBooksDB(): array {
        $sql = "SELECT title, author, genre, sinopsis, year, price, review FROM bookrecords";
        $stmt = mysqli_prepare($this->connection, $sql);

        if (!$stmt) {
            throw new RuntimeException("Query preparation failed.");
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);

        return $books;
    }


    public function loadBooksJSON(): void {
        $filePath ='src/books.json';

        if (!file_exists($filePath)) {
            throw new RuntimeException("books.json not found.");
        }

        $str = file_get_contents($filePath);
        $data = json_decode($str, true);

        if (json_last_error() !== JSON_ERROR_NONE || !isset($data["books"])) {
            throw new RuntimeException("Invalid JSON format.");
        }

        $requiredFields = ["title", "author", "genre", "sinopsis", "year", "price", "review"];

        foreach ($data["books"] as $book) {
            $isValid = true;

            foreach ($requiredFields as $field) {
                if (!isset($book[$field]) || $book[$field] === '') {
                    $isValid = false;
                    break;
                }
            }

            if ($isValid) {
                $this->addBookDB($this->sanitizeBook($book));
            }
        }
    }


    private function sanitizeBook(array $book): array {
        return [
            "title"     => htmlspecialchars(trim($book["title"]),  ENT_QUOTES, 'UTF-8'),
            "author"    => htmlspecialchars(trim($book["author"]), ENT_QUOTES, 'UTF-8'),
            "genre"     => htmlspecialchars(trim($book["genre"]),  ENT_QUOTES, 'UTF-8'),
            "sinopsis"  => htmlspecialchars(trim($book["sinopsis"]),  ENT_QUOTES, 'UTF-8'),
            "year"      => (int) $book["year"],
            "price"     => (float) $book["price"],
            "review"    => htmlspecialchars(trim($book["review"]), ENT_QUOTES, 'UTF-8'),
        ];
    }

    public function addBookDB(array $book): void {
        $sql = "INSERT INTO bookrecords (title, author, genre, sinopsis, year, price, review)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->connection, $sql);

        if (!$stmt) {
            throw new RuntimeException("Insert preparation failed.");
        }

        mysqli_stmt_bind_param($stmt, "ssssids",
            $book["title"],
            $book["author"],
            $book["genre"],
            $book["sinopsis"],
            $book["year"],
            $book["price"],
            $book["review"]
        );

        if (!mysqli_stmt_execute($stmt)) {
            throw new RuntimeException("Insert failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
    }
}