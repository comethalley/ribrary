const displayBooks = document.querySelector('.display-books-container')
const searchInput = document.querySelector('#searchBooks');
const searchBtn = document.querySelector('#search-button')

const windowUrl = window.location.search;
const url = new URLSearchParams(windowUrl);
let keyword = url.get('keyword')



const render = function (title1) {
  // console.log(`https://www.googleapis.com/books/v1/volumes?q=${title1}`)

  fetch(`https://www.googleapis.com/books/v1/volumes?q=${title1}`)
    .then(response => {
      console.log(response)

      if (!response.ok) {
        throw new Error('Not Found')
      }

      return response.json()

    })
    .then(data => {

      const books = data.items
      const firstBook = data.items.shift()


      let html = `<div class="books-container">
                <div class="book-cover">
                  <img src="${firstBook.volumeInfo.imageLinks.smallThumbnail}" alt="" class="book-image"> 
                </div>
                <p class="book-description" id="title">${firstBook.volumeInfo.title}</p>
                <p class="book-description-author"> Author: <span id="author">${firstBook.volumeInfo.authors[0]}</span> </p>
                <button class="view-book-btn" data-isbn="${firstBook.volumeInfo.industryIdentifiers[0].identifier}"> View book</button>
                
              </div>`

      books.forEach(element => {

        console.log(element);

        if (element.volumeInfo.authors && element.volumeInfo.industryIdentifiers && element.volumeInfo.imageLinks) {
          html += ` <div class="books-container">
                <div class="book-cover">
                  <img src="${element.volumeInfo.imageLinks.smallThumbnail}" alt="" class="book-image"> 
                </div>
                <p class="book-description" id="title">${element.volumeInfo.title}</p>
                <p class="book-description-author"> Author: <span id="author">${element.volumeInfo.authors[0]}</span> </p>
                <button class="view-book-btn" data-isbn="${element.volumeInfo.industryIdentifiers[0].identifier}"> View book</button>
              </div>`

        }

      });
      displayBooks.innerHTML = html

    })
    .catch(error => {
      alert(error)
    })
    .finally(() => {
      // history.replaceState('', '', `?keyword=${title1}`);

      const viewBook = document.querySelectorAll('.view-book-btn')

      viewBook.forEach(element => {
        element.addEventListener('click', function (e) {
          // window.open(`test2.html?isbn=${e.target.dataset.isbn}`)
          // window.location = `test2.html?isbn=${e.target.dataset.isbn}`
          window.location.assign(`book-content.html?isbn=${e.target.dataset.isbn}`)
        })
      })
    })


}

// render();

searchBtn.addEventListener('click', function () {
  const title = searchInput.value
  // console.log(title);
  keyword = title
  render(title)
  if (keyword) {
    console.log("has value")
    window.history.replaceState('', '', `?keyword=${keyword}`);
  }

})

if (!keyword) {
  render('Harry potter and the')
} else {
  render(keyword)
}

