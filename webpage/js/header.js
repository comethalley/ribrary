const notification = document.querySelector('#notification');
const notifContainer = document.querySelector('.notif-container')
const notifMessage = document.querySelector('.notif-container')

function updateNotifStatus() {
    fetch('../functions/updateNotifStatus.php')
        .then(response => {
            return response.json()
        })
        .then(data => console.log(data))
}

notification.addEventListener('click', function () {
    notifContainer.classList.toggle('hidden')
    document.querySelector('.notif-count').remove()
    updateNotifStatus();

})

const seeMessage = function (message) {
    Swal.fire(
        'Research Document Declined',
        `${message}`,
        'info'
    )
}
notifMessage.addEventListener('click', function (e) {
    if (e.target.classList.contains('view-message')) {
        const message = e.target.firstElementChild.value;
        seeMessage(message)
    }
})