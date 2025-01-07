const cardsBtn = document.querySelectorAll('.btn');
const map = document.querySelector('.rightMain');
const mapBack = document.querySelector('.mapBack');

function mapMoveEvent(){
    if(window.innerWidth < 768){
        cardsBtn.forEach((btn)=>{
            btn.addEventListener('click', isMobileMapMove);
        });
            mapBack.addEventListener('click', mapReturn);

    }else{
        cardsBtn.forEach((btn)=>{
            btn.removeEventListener('click', isMobileMapMove);
        });
            mapBack.removeEventListener('clcik', mapReturn);
            map.classList.remove("clicked");
    }

};

const isMobileMapMove = () => {
    map.classList.add("clicked");
    document.body.style.overflow = 'hidden'; //禁止滾動
};

const mapReturn = () => {
    map.classList.remove("clicked");
    document.body.style.overflow = 'auto'; //恢復滾動
};

mapMoveEvent();

window.addEventListener('resize', mapMoveEvent);



const placeNameElements = document.querySelectorAll('.cardsBox h6'); // 選取所有 h6 元素
const iframe = document.querySelector('#map'); // 選取 iframe 元素

cardsBtn.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        // 取得對應 h6 的文字內容
        const newPlaceName = placeNameElements[index].textContent.trim();

        // 取得當前 iframe 的 src
        const currentSRC = iframe.getAttribute('src');

        // 替換 src 中的地點名稱
        const newSRC = currentSRC.replace(/q=([^&]+)/, `q=${newPlaceName}`);

        // 更新 iframe 的 src
        iframe.setAttribute('src', newSRC);
    });
});
