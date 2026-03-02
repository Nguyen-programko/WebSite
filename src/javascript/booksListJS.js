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

            <button class="toggle_Btn" id="toggle_Btn">Show more</button>
            <button class="print_Btn" id="print_Btn">Print</button>

            <div class="extra_Info" id="extra_Info" style="display:none;">
                <p><strong>Sinopsis:</strong> ${book.sinopsis}</p>
                <p><strong>Year:</strong> ${book.year}</p>
                <p><strong>Price:</strong> $${book.price}</p>
                <p><strong>Review:</strong> ${book.review} / 5</p>
            </div>
            <hr>
        `;

        container.appendChild(div);

        const toggleBtn = div.querySelector('#toggle_Btn');
        const extraInfo = div.querySelector('#extra_Info');
        const printBtn = div.querySelector('#print_Btn');

        toggleBtn.addEventListener('click', () => {
            const isHidden = extraInfo.style.display === 'none';
            extraInfo.style.display = isHidden ? 'block' : 'none';
            toggleBtn.textContent = isHidden ? 'Show less' : 'Show more';
        });

        printBtn.addEventListener('click', () => {
            const printWindow = window.open('', '_blank');
            
            printWindow.document.head.innerHTML = `<title>${book.title}</title>`;
            printWindow.document.body.innerHTML = `
                <h2>${book.title}</h2>
                <p><strong>Author:</strong> ${book.author}</p>
                <p><strong>Genre:</strong> ${book.genre}</p>
                <p><strong>Year:</strong> ${book.year}</p>
                <p><strong>Sinopsis:</strong> ${book.sinopsis}</p>
                <p><strong>Price:</strong> $${book.price}</p>
                <p><strong>Review:</strong> ${book.review} / 5</p>
            `;

            printWindow.print();
            printWindow.close();
        });
    });
};

document.addEventListener('DOMContentLoaded', loadBooksAsync);