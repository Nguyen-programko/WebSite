    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book database</title>
    </head>
    <?php include 'src/layout/header.html'; ?>

    <body>
        <div class="admin_Container">
            <a href="adminSite.php">Add books</a>
        </div>
        <hr>
        <div class="books_Container" id="books_Container">

        </div>
    </body>


    <?php include 'src/layout/footer.html'; ?>
    </html>

    <?php include 'src/php/booksListPHP.php' ?>
    <script src="src/javascript/booksListJS.js"></script>