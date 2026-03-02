<?php 
    include 'classes/books.class.php';
    include 'classes/database.class.php';

    $books = new Books($connection);

    header('Content-Type: application/json');
    echo json_encode($books->getBooksDB());
?>