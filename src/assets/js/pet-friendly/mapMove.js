const cardsBtn = document.querySelectorAll('.btn');
const map = document.querySelector('.rightMain');
const mapBack = document.querySelector('.mapBack')


window.addEventListener('resize', ()=>{
    if(window.innerWidth > 768){
        map.classList.remove("clicked");
    }
});

if(window.innerWidth < 768){
    cardsBtn.forEach((btn)=>{
        btn.addEventListener('click',()=>{
            map.classList.add("clicked");
            document.body.style.overflow = 'hidden'; //禁止滾動
        });
        
        mapBack.addEventListener('click',()=>{
            map.classList.remove("clicked");
            document.body.style.overflow = 'auto'; //恢復滾動
        });
    })
};