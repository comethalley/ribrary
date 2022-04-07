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


