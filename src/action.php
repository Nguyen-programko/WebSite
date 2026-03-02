<?php 
    include 'classes/books.class.php';
    include 'classes/database.class.php';

    header('Content-Type: application/json');
    echo json_encode(Books::getBooksDB($connection));
?>