const header = document.querySelector('header');
let lastScrollTop = 0;

window.addEventListener('scroll',()=>{
    const scrollY = window.scrollY;

    if(scrollY > lastScrollTop){
        header.classList.add("scroll");
    }else{
        header.classList.remove("scroll");

    };

    if (scrollY <= 0) {
        lastScrollTop = 0;  // 如果 scrollY 小於或等於 0，設置 lastScrollTop 為 0
    } else {
        lastScrollTop = scrollY;  // 否則，將 lastScrollTop 設為當前的 scrollY
    }
});