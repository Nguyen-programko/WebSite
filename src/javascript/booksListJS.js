const loadBooksAsync = async () => {
    const res = await fetch('src/action.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'getBooksDB' })
    });

    const books = await res.json();
    const container = document.getElementById('books');
    container.innerHTML = '';

    books.forEach(book => {
        const div = document.createElement("div");
        div.className = "book";

        div.innerHTML = `
            <p class="book__title"><strong>Title:</strong> ${book.title}</p>
            <p class="book__author"><strong>Author:</strong> ${book.author}</p>
            <p class="book__year"><strong>Year of release:</strong> ${book.year}</p>

            <button class="book__toggle-btn">Show more</button>
            <button class="book__print-btn">Print</button>

            <div class="book__extra" style="display:none;">
                <p><strong>Sinopsis:</strong> ${book.sinopsis}</p>
                <p><strong>Genre:</strong> ${book.genre}</p>
                <p><strong>Price:</strong> $${book.price}</p>
                <p><strong>Review:</strong> ${book.review} / 5</p>
            </div>

            <hr>
        `;

        container.appendChild(div);


        const toggleBtn = div.querySelector('.book__toggle-btn');
        const extraInfo = div.querySelector('.book__extra');
        const printBtn = div.querySelector('.book__print-btn');

        toggleBtn.addEventListener('click', () => {
            const isHidden = extraInfo.style.display === 'none';
            extraInfo.style.display = isHidden ? 'block' : 'none';
            toggleBtn.textContent = isHidden ? 'Show less' : 'Show more';
        });

        printBtn.addEventListener('click', () => {
            const printWindow = window.open('', '_blank');

            printWindow.document.head.innerHTML = `
                <title>${book.title}</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f9f9f9;
                        color: #222;
                        margin: 2rem;
                    }
                    .print-book {
                        background-color: #fff;
                        padding: 1rem 1.5rem;
                        border-radius: 6px;
                        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
                        margin-bottom: 1rem;
                        display: flex;
                        flex-direction: column;
                        gap: 0.4rem;
                    }
                    .print-book__title {
                        color: #2c3e50;
                        font-size: 1.8rem;
                        margin-bottom: 0.5rem;
                    }
                    .print-book__info {
                        margin: 0;
                        line-height: 1.4;
                    }
                    .print-book__info strong {
                        color: #2c3e50;
                    }
                </style>
            `;

            printWindow.document.body.innerHTML = `
                <div class="print-book">
                    <h2 class="print-book__title">${book.title}</h2>
                    <p class="print-book__info"><strong>Author:</strong> ${book.author}</p>
                    <p class="print-book__info"><strong>Genre:</strong> ${book.genre}</p>
                    <p class="print-book__info"><strong>Year:</strong> ${book.year}</p>
                    <p class="print-book__info"><strong>Sinopsis:</strong> ${book.sinopsis}</p>
                </div>
            `;

            printWindow.print();
            printWindow.close();
        });
    });
};

document.addEventListener('DOMContentLoaded', loadBooksAsync);