const loadBooksAsync = async () => {
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
        div.classList.add('book_Card');
        div.innerHTML = `
            <p><strong>Title:</strong> ${book.title}</p>
            <p><strong>Author:</strong> ${book.author}</p>
            <p><strong>Genre:</strong> ${book.genre}</p>

            <button class="toggle_Btn">Show more</button>

            <div class="extra_Info" style="display:none;">
                <p><strong>Year:</strong> ${book.year}</p>
                <p><strong>Price:</strong> $${book.price}</p>
                <p><strong>Review:</strong> ${book.review} / 5</p>
            </div>
            <hr>
        `;

        container.appendChild(div);

        const toggleBtn = div.querySelector('.toggle_Btn');
        const extraInfo = div.querySelector('.extra_Info');

        toggleBtn.addEventListener('click', () => {
            const isHidden = extraInfo.style.display === 'none';
            extraInfo.style.display = isHidden ? 'block' : 'none';
            toggleBtn.textContent = isHidden ? 'Show less' : 'Show more';
        });
    });
};

document.addEventListener('DOMContentLoaded', loadBooksAsync);