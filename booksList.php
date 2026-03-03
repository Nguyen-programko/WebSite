    <?php include 'src/layout/header.html'; ?>

        <div class="admin-panel">
            <a href="adminSite.php" class="admin-panel__link">Add books</a>
        </div>

        <div class="books" id="books">
            
        </div>


    <?php include 'src/layout/footer.html'; ?>

    <?php include 'src/php/BooksListController.php' ?>
    <script src="src/javascript/booksListJS.js"></script>