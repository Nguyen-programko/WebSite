<?php
    include 'classes/database.class.php';
    include 'classes/books.class.php';

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        Books::loadBooks($connection);

    }
?>