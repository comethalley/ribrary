const navigation = document.querySelector('ul');

navigation.addEventListener('mouseover',function(e){

    if(e.target.classList.contains('list')){
      

       
        e.target.children[0].classList.add('addBg');
        e.target.classList.add('addRightBorder')
        
    }else if(e.target.classList.contains('link')){
        e.target.classList.add('addBg');
        e.target.parentElement.classList.add('addRightBorder')
    }
})

navigation.addEventListener('mouseout',function(e){
    if(e.target.classList.contains('list')){
        e.target.children[0].classList.remove('addBg');
        e.target.classList.remove('addRightBorder')
       
    }else if(e.target.classList.contains('link')){
        e.target.classList.remove('addBg');
        e.target.parentElement.classList.remove('addRightBorder')
        // document.querySelector('addBg').classList.remove('addBg')
    }
})