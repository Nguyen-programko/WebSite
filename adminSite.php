<?php include 'src/php/AdminController.php'; ?>
<?php include 'src/layout/header.html'; ?>

<div class="admin-page">

    <!-- Add Book Form -->
    <form class="book-form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <h2 class="book-form__title">Add a book</h2>

        <label class="book-form__label" for="title">Book's title</label>
        <input class="book-form__input" type="text" name="title" required>

        <label class="book-form__label" for="author">Name of the author</label>
        <input class="book-form__input" type="text" name="author" required>

        <label class="book-form__label" for="genre">Book's genre</label>
        <input class="book-form__input" type="text" name="genre" required>

        <label class="book-form__label" for="sinopsis">Book's sinopsis</label>
        <input class="book-form__input" type="text" name="sinopsis" required>

        <label class="book-form__label" for="year">Year of release</label>
        <input class="book-form__input" type="number" name="year" min="0" max="9999" required>

        <label class="book-form__label" for="price">Book's price in $USD</label>
        <input class="book-form__input" type="number" name="price" min="0" required>

        <label class="book-form__label" for="review">Book's review - out of 5</label>
        <input class="book-form__input" type="number" name="review" max="5" step="any" required>

        <button class="book-form__button" type="submit" name="action" value="add_From_Form">Add book</button>

        <?php if(!empty($errors)): ?>
            <div class="book-form__errors">
                <?php foreach($errors as $error): ?>
                    <p class="book-form__error"><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($success)): ?>
            <p class="book-form__success"><?= $success ?></p>
        <?php endif; ?>
    </form>

    <!-- Add from JSON -->
    <div class="json-add">
        <form class="json-add__form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h2 class="json-add__title">Add books from 'src/books.json'</h2>
            <button class="json-add__button" type="submit" name="action" value="add_From_JSON">Add from JSON</button>
        </form>
    </div>

</div>

<?php include 'src/layout/footer.html'; ?>
<script src="src/javascript/adminSiteJS.js"></script>