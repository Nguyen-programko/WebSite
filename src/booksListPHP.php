<?php
    include 'database.class.php';
    include 'books.class.php';

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        Books::loadBooks();

    }
?>