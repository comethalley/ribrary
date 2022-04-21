const viewerCanvas = document.getElementById('viewerCanvas')
const bookCover = document.querySelector('.book-cover')
const bookTitle = document.querySelector('.book-title')
const bookAuthor = document.querySelector('.book-author')
const bookPublisher = document.querySelector('.book-publisher')
const bookIsbn= document.querySelector('.book-isbn')



const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);


class BookContent {
    isbn;

    constructor(isbn) {
        if (urlParams.has(isbn)) {
            this.isbn = urlParams.get('isbn')
        }

    }

    alertNotFound() {
        viewerCanvas.innerHTML = '<h1 class="unable"> Unable to view this book </h1>'
    }

    initialize() {
        const viewer = new google.books.DefaultViewer(viewerCanvas);
        viewer.load(`ISBN:${this.isbn}`, this.alertNotFound);

    }

    loadBooks() {
        console.log(this.isbn);
        google.books.load();
        google.books.setOnLoadCallback(this.initialize.bind(this));
    }

    loadBookDetails(){
        fetch(`https://www.googleapis.com/books/v1/volumes?q=${this.isbn}`)
        .then(response => response.json())
        .then(data =>{
            const book = data.items[0].volumeInfo
            console.log(book)
            bookCover.src = book.imageLinks.smallThumbnail
            bookTitle.innerHTML = book.title
            bookAuthor.innerHTML = `Author: ${book.authors[0]}`
            bookIsbn.innerHTML = `ISBN: ${book.industryIdentifiers[0].identifier}`
            bookPublisher.innerHTML = `Publisher: ${book.publisher}`
        })
    }



}

const book = new BookContent('isbn')
book.loadBooks()
book.loadBookDetails()

