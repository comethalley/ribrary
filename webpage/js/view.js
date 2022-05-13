const phpurl =  window.location.search
const newUrlParam = new URLSearchParams(phpurl)
const pdf = newUrlParam.get('file')

console.log(pdf);
const url = `../functions/uploads/${pdf}`;

const zoomFunction = document.querySelector('.zoom-container')
const viewss = document.querySelector('.view');

let pdfDoc = null,
    pageNum = 1,
    pageIsRendering = false,
    pageNumIsPending = null;

let scale = 1.25;
let pageView = 100;
const canvas = document.querySelector('#pdf-render'),
    ctx = canvas.getContext('2d');




//Render page
const renderPage = num => {
    pageIsRendering = true;

    //Get page
    pdfDoc.getPage(num).then(page => {
        //Set scale
        const viewport = page.getViewport({ scale });
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderCtx = {
            canvasContext: ctx,
            viewport
        }


        page.render(renderCtx).promise.then(() => {
            pageIsRendering = false;

            if (pageNumIsPending !== null) {
                renderPage(pageNumIsPending);
                pageNumIsPending = null;
            }
        });

        //Output current page
        document.querySelector('#page-num').textContent = num;
    });
};


//zoom
zoomFunction.addEventListener('click', function (e) {
    if (e.target.classList.contains('zoom')) {
        const view = e.target.classList.contains('in') ? 0.25 : -0.25;
        scale += view
        renderPage(pageNum)

        viewss.innerHTML  = `${pageView * scale}%`
    }
   
})


//Check for pages rendering
const queueRenderPage = num => {
    if (pageIsRendering) {
        pageNumIsPending = num;
    } else {
        renderPage(num);
    }
}

//Show Prev Page
const showPrevPage = () => {
    if (pageNum <= 1) {
        return;
    }
    pageNum--;
    queueRenderPage(pageNum);
}

//Show Next Page
const showNextPage = () => {
    if (pageNum >= pdfDoc.numPages) {
        return;
    }
    pageNum++;
    queueRenderPage(pageNum);
}

//Get Document
pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
    pdfDoc = pdfDoc_;


    document.querySelector('#page-count').textContent = pdfDoc.numPages;

    renderPage(pageNum)
});

//Button Events
document.querySelector('#prev-page').addEventListener('click', showPrevPage);
document.querySelector('#Next-page').addEventListener('click', showNextPage);