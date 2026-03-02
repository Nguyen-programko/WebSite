async function loadBooksAsync() {
    const res = await fetch('src/action.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'getBooksDB' })
    });

    const books = await res.json();
    const container = document.getElementById('books_Container');
    container.innerHTML = '';

    books.forEach(book => {
        const div = document.createElement('div');
        div.innerHTML = `
            <p><strong>Title:</strong> ${book.title}</p>
            <p><strong>Author:</strong> ${book.author}</p>
            <p><strong>Genre:</strong> ${book.genre}</p>
            <p><strong>Year:</strong> ${book.year}</p>
            <p><strong>Price:</strong> ${book.price}</p>
            <p><strong>Review:</strong> ${book.review}</p>
            <hr>
        `;
        container.appendChild(div);
    });
    
}

document.addEventListener('DOMContentLoaded', loadBooksAsync);