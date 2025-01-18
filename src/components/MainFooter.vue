<!-- Ian -->
<template>    
    <footer>
        <div class="footerTop">
            <div class="footerBox">
                <div class="imgBox">
                    <img :src="currentSrc" alt="Logo-footer">
                </div>
                <div class="footerList">
                    <div class="leftList">
                        <Btn btnStyle="text small" class="leftItem">關於我們</Btn>
                        <Btn btnStyle="text small" class="leftItem">認識新毛友</Btn>
                        <Btn btnStyle="text small" class="leftItem">訂閱寵物盒</Btn>
                        <Btn btnStyle="text small" class="leftItem">尋找小幫手</Btn>
                        <Btn btnStyle="text small" class="leftItem">毛孩日曆</Btn>
                        <Btn btnStyle="text small" class="leftItem">友善設施</Btn>
                    </div>
                    <div class="rightList">
                        <Btn btnStyle="text small" class="rightItem">INSTAGRAM</Btn>
                        <Btn btnStyle="text small" class="rightItem">FACEBOOK</Btn>
                        <Btn btnStyle="text small" class="rightItem"></Btn>
                        <Btn btnStyle="text small" class="rightItem">隱私權政策</Btn>
                        <Btn btnStyle="text small" class="rightItem">服務條款</Btn>
                        <Btn btnStyle="text small" class="rightItem"></Btn>
                    </div>
                 </div>

            </div>
        </div>
        <div class="footerBottom">
            <p class="xsText">本網站為緯育TibaMe [第94期]前端工程師專業技術養成班學員作品，僅供學習、展示之用途。</p>
        </div>
    </footer>

</template>

<script setup>
import {ref} from 'vue';

import Btn from '@/components/Btn.vue'

const logoSrc = {
    red: new URL('../assets/img/footer-red.svg', import.meta.url).href,
    blue: new URL('../assets/img/footer-blue.svg', import.meta.url).href,
}

let currentSrc = "";


    const bodyBlue = document.body.classList.contains('blueTheme');
    const bodyRed = document.body.classList.contains('redTheme');

    if(bodyBlue){
        currentSrc = logoSrc.blue;
    }else if(bodyRed){
        currentSrc = logoSrc.red;
    }


</script>

