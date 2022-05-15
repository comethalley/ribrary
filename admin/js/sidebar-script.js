const navigation = document.querySelector('ul');

navigation.addEventListener('mouseover', function (e) {
    const target = e.target.closest('.list')

    if (e.target.closest('.list')) {

        target.children[0].classList.add('addBg');

        target.classList.add('addRightBorder')
    }

})

navigation.addEventListener('mouseout', function (e) {
    const target = e.target.closest('.list')

    if (e.target.closest('.list')) {

        target.children[0].classList.remove('addBg');

        target.classList.remove('addRightBorder')
    }
})

navigation.addEventListener('click', function (e) {
    e.preventDefault()
    if (e.target.classList.contains('logout')) {
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Log me out',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // e.target.href
                window.location.href = `${e.target.href}`

            }
        })
    } else if(e.target.classList.contains('link')){
        window.location.href = `${e.target.href}`;
    }
})


