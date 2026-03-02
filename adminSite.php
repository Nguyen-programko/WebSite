    <?php include 'src/php/adminSitePHP.php'?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit books</title>
    </head>
    <?php include 'src/layout/header.html'; ?>

    <body>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <h2>Add a book</h2>
            <label for="title">Book's title</label><br>
            <input type="text" name="title" required><br>

            <label for="author">Name of the author</label><br>
            <input type="text" name="author" required><br>

            <label for="genre">Book's genre</label><br>
            <input type="text" name="genre" required><br>

            <label for="year">Year of release</label><br>
            <input type="number" name="year" min="0" max="9999"  required><br>

            <label for="price">Book's price (Amazon)</label><br>
            <input type="number" name="price" min="0" required><br>

            <label for="review">Book's review - out of 5 (Amazon)</label><br>
            <input type="number" name="review" max="5" step="any" required><br>


            <button type="submit" name="action" value="add_From_Form">Add book</button>

            <?php if(!empty($errors)): ?>
                <div class="errors">
                    <?php foreach($errors as $error): ?>
                        <p style="color:red"><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if(isset($success)): ?>
                <p style="color:green"><?= $success ?></p>
            <?php endif; ?>
        </form>



        <div class="add_Books_JSON_Container">

            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post"">

                <h2>With this button you can add books from 'src/books.json' file</h2>
                <button type="submit" name="action" value="add_From_JSON">Add from JSON</button>

            </form>

        </div>
    </body>


    <?php include 'src/layout/footer.html'; ?>
    </html>

    <script src="src/javascript/adminSiteJS.js"></script>