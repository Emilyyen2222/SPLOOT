<template>
<MainHeader theme="blue" bgc="blue-1"></MainHeader>
<!-- 主內容 -->
<div class="wrapper">
    
    <!-- 主要功能 -->
    <div class="petFriendBox">
        <!-- 左 地點卡片 -->
        <div class="leftMain"> 
            <!-- 標題 -->
            <div class="title">
                <h3 class="bold">毛孩友善設施</h3>
                <p class="smallText">提供讓毛孩和家長共同享受的設施，包含住宿、餐廳、公園、交通等便捷選項。</p>
            </div>
            <!-- 滑動switch -->
            <div class="switch" id="switch">
                    <input type="radio" id="hospital" name="option" class="switch-input">
                    <input type="radio" id="restaurant" name="option" class="switch-input">
                    <input type="radio" id="park" name="option" class="switch-input">
                    <input type="radio" id="hotel" name="option" class="switch-input">
                    <div class="slider"></div>
                    <div class="labels xsText">
                    <label for="hospital">動物醫院</label>
                    <label for="restaurant">友善餐廳</label>
                    <label for="park">寵物公園</label>
                    <label for="hotel">友善旅館</label>
                </div>
            </div>
            <!-- 地點卡-->
            <ul class="facilityCard">

                <li class="facilityCards" v-for="(card, index) in cardsData" :key="index">
                    <div class="cardsContent">
                        <div class="cardsImg">
                            <img :src="card.imgSrc" :alt="card.imgAlt">
                        </div>
                        <div class="cardsBox">
                            <div class="cardsTypeIcon">
                                <img :src="card.iconSrc" :alt="card.iconAlt">
                                <p class="xsText">{{ card.type }}</p>
                            </div>
                            <h6 class="cardsTitle">{{ card.name }}</h6>
                            <p class="smallText">{{ card.content }}</p>
                        </div>
                    </div>
                    <Btn btnStyle="blue small" @click="isMobileMapMove(card.name)">查看</Btn>
                </li>
   
            </ul>                                                
        </div>
        <!--右 動態地圖-->
        <div class="rightMain" ref="map" :class="{'clicked':mapMove}">
            <div class="mapBack" @click="mapReturn">
                <img src="@/assets/img/icon/return.svg" alt="返回">
            </div>
            <iframe id="map" :src="iframeSrc"></iframe>
        </div>
    </div>        
</div> 
</template>

<script setup>
    import {ref} from "vue";

    import MainHeader from "../components/MainHeader.vue";
    import Btn from '../components/Btn.vue';

    //data
    const cardsData = ref([
        {
            imgSrc: new URL("@/assets/img/pet-friendly/cards1.png", import.meta.url).href,
            imgAlt: "",
            iconSrc: new URL("@/assets/img/pet-friendly/cards1.png", import.meta.url).href,
            iconAlt: "",
            type: "友善餐廳",
            name: "沐 • Moon Street Cafe",
            content: "待填寫",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/cards1.png", import.meta.url).href,
            imgAlt: "",
            iconSrc: new URL("@/assets/img/pet-friendly/cards1.png", import.meta.url).href,
            iconAlt: "",
            type: "友善餐廳",
            name: "中正紀念堂",
            content: "待填寫",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/cards1.png", import.meta.url).href,
            imgAlt: "",
            iconSrc: new URL("@/assets/img/pet-friendly/cards1.png", import.meta.url).href,
            iconAlt: "",
            type: "友善餐廳",
            name: "緯育TibaMe附設台北職訓中心",
            content: "待填寫",
        },
    ])

    const map = ref(null);
     // iframe切換
    const iframeSrc = ref('https://maps.google.com/maps?q=沐 • Moon Street Cafe&z=15&output=embed');

    let mapMove = ref(false);

    // 移動地圖的處理函式
    function isMobileMapMove(placeName){
        // console.log(map.value);
        if(window.innerWidth < 768){
        mapMove.value = !mapMove.value;
        document.body.style.overflow = 'hidden'; // 禁止滾動
        }      
    // 更新地圖 src
        const currentSRC = iframeSrc.value;
        iframeSrc.value = currentSRC.replace(/q=([^&]*)/, `q=${encodeURIComponent(placeName)}`);
    };
    //地圖退回按鈕
    function mapReturn(){
        // console.log(map.value);

        mapMove.value = !mapMove.value;

        document.body.style.overflow = "auto"; //恢復滾動
    }
    
    //畫面大小變化監控＿變大自動關閉地圖
    function mapMoveEvent(){
        if(window.innerWidth > 768){
            mapMove.value = false;

        document.body.style.overflow = "auto"; //恢復滾動
        }
    }
    window.addEventListener('resize', mapMoveEvent);
</script>