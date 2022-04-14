const displayBooks = document.querySelector('.display-books-container')
const searchInput = document.querySelector('#searchBooks');
const searchBtn = document.querySelector('#search-button')



const render = function (title1 = 'harrypotter') {
    fetch(`https://www.googleapis.com/books/v1/volumes?q=${title1}`)
        .then(response => {
            console.log(response)
            return response.json()
        })
        .then(data => {

            const books = data.items
            const firstBook = data.items.shift()


            let html = `<div class="books-container">
                <div class="book-cover">
                  <img src="${firstBook.volumeInfo.imageLinks.thumbnail}" alt="" class="book-image"> 
                </div>
                <p class="book-description" id="title">${firstBook.volumeInfo.title}</p>
                <p class="book-description-author"> Author: <span id="author">${data.items[0].volumeInfo.authors[0]}</span> </p>

                <button id="view-book-btn">View book</button>
              </div>`

            books.forEach(element => {

                console.log(element);

                if (element.volumeInfo.authors) {
                    html += ` <div class="books-container">
                <div class="book-cover">
                  <img src="${element.volumeInfo.imageLinks.thumbnail}" alt="" class="book-image"> 
                </div>
                <p class="book-description" id="title">${element.volumeInfo.title}</p>
                <p class="book-description-author"> Author: <span id="author">${element.volumeInfo.authors[0]}</span> </p>
        
                <button id="view-book-btn">View book</button>
              </div>`

                }

            });
            displayBooks.innerHTML = html
        })
        .catch(error => alert(error))

}
render();

searchBtn.addEventListener('click', function () {
    const title = searchInput.value.replace(/\s/g, "")
    console.log(title);
    render(title)

    searchInput.value = ""
})

