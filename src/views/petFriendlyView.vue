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
                    <input type="radio" id="hospital" name="option" class="switch-input" @change="setActive('hospital')">
                    <input type="radio" id="restaurant" name="option" class="switch-input" @change="setActive('restaurant')">
                    <input type="radio" id="park" name="option" class="switch-input" @change="setActive('park')">
                    <input type="radio" id="hotel" name="option" class="switch-input" @change="setActive('hotel')">
                    <div class="slider"></div>
                    <div class="labels xsText">
                    <label for="hospital"><img src="../assets/img/icon/hospital.svg" alt="hospital">動物醫院</label>
                    <label for="restaurant"><img src="../assets/img/icon/restaurant.svg" alt="restaurant">友善餐廳</label>
                    <label for="park"><img src="../assets/img/icon/park.svg" alt="park">寵物公園</label>
                    <label for="hotel"><img src="../assets/img/icon/hotel.svg" alt=" hotel">友善旅館</label>
                </div>
            </div>
            <!-- 地點卡-->
            <ul class="facilityCard">

                <li class="facilityCards" v-for="(card, index) in filterData" :key="index">
                    <div class="cardsContent">
                        <div class="cardsImg">
                            <img :src="card.imgSrc" :alt="card.imgAlt">
                        </div>
                        <div class="cardsBox">
                            <div class="cardsTypeIcon">
                                <img :src="card.iconSrc" :alt="card.iconAlt">
                                <p class="bold">{{ card.name }}</p>
                            </div>
                            <p class="smallText">{{ card.content }}</p>
                        </div>
                    </div>
                    <Btn btnStyle="primary small" @click="isMobileMapMove(card.name)">查看</Btn>
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
<MainFooter></MainFooter>
</template>

<script setup>
    import {ref, computed} from "vue";

    import MainHeader from "@/components/MainHeader.vue";
    import Btn from '@/components/Btn.vue';
    import MainFooter from '@/components/MainFooter.vue'

    //data
    const type = ref(
        {
        hospital: {
            icon: new URL("@/assets/img/icon/hospital.svg", import.meta.url).href
        },
        restaurant: {
            icon: new URL("@/assets/img/icon/restaurant.svg", import.meta.url).href
        },
        park: {
            icon: new URL("@/assets/img/icon/park.svg", import.meta.url).href
        },
        hotel: {
            icon: new URL("@/assets/img/icon/hotel.svg", import.meta.url).href
        },
    }
    )

    const rawCardsData = ref([

        //醫院
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hospital-1.jpg", import.meta.url).href,
            type: "hospital",  //和type產生關聯
            name: "愛達司動物醫院",
            content: "新店的動物醫療服務，關心每隻毛孩的健康，讓愛犬愛貓安心療養。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hospital-2.jpg", import.meta.url).href,
            type: "hospital",
            name: "人人愛動物醫院",
            content: "致力於提供高品質的動物醫療照護，專業診療，讓寵物重獲健康快樂。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hospital-3.jpg", import.meta.url).href,
            type: "hospital",
            name: "王樣動物醫院",
            content: "永康街上的動物醫院，醫療品質好，專精於小動物及癱瘓治療。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hospital-4.jpg", import.meta.url).href,
            type: "hospital",
            name: "梅西動物醫療中心",
            content: "位於高雄的綜合性動物醫療服務，設備齊全，關愛每個毛孩的健康需求。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hospital-3.jpg", import.meta.url).href,
            type: "hospital",
            name: "王樣動物醫院",
            content: "永康街上的動物醫院，醫療品質好，專精於小動物及癱瘓治療。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hospital-4.jpg", import.meta.url).href,
            type: "hospital",
            name: "梅西動物醫療中心",
            content: "位於高雄的綜合性動物醫療服務，設備齊全，關愛每個毛孩的健康需求。",
        },

        //餐廳
        {
            imgSrc: new URL("@/assets/img/pet-friendly/restaurant-1.jpg", import.meta.url).href,
            type: "restaurant",  //和type產生關聯
            name: "象園咖啡內湖店",
            content: "附設露台和遊樂場的休閒親子餐廳，供應異國佳餚。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/restaurant-2.jpg", import.meta.url).href,
            type: "restaurant",
            name: `大稻埕貴賓 寵物友善餐廳`,
            content: "建築古色古香，還有店狗與顧客互動，料理評價也高。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/restaurant-3.jpg", import.meta.url).href,
            type: "restaurant",
            name: "哈time貓咪咖啡",
            content: "寵物友善咖啡廳，本店全採預約制，近菜寮捷運站2號出口。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/restaurant-4.jpg", import.meta.url).href,
            type: "restaurant",
            name: "沐 • Moon Street Cafe",
            content: "寵物可落地可上椅，有提供寵物餐點，環境舒服，是假日放鬆好去處。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/restaurant-3.jpg", import.meta.url).href,
            type: "restaurant",
            name: "哈time貓咪咖啡",
            content: "寵物友善咖啡廳，本店全採預約制，近菜寮捷運站2號出口。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/restaurant-4.jpg", import.meta.url).href,
            type: "restaurant",
            name: "沐 • Moon Street Cafe",
            content: "寵物可落地可上椅，有提供寵物餐點，環境舒服，是假日放鬆好去處。",
        },

        //公園
        {
            imgSrc: new URL("@/assets/img/pet-friendly/park-1.jpg", import.meta.url).href,
            type: "park",  //和type產生關聯
            name: "迎風狗運動公園",
            content: "設有安全圍籬的草地，遊客可欣賞市區摩天大樓景色，讓狗狗自由活動。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/park-2.jpg", import.meta.url).href,
            type: "park",
            name: "大佳河濱公園",
            content: "面積廣大的公園，附設河畔自行車道與運動場，是從事活動的熱門去處。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/park-3.jpg", import.meta.url).href,
            type: "park",
            name: "竹東狗狗公園",
            content: "環境地點佳，停車方便，夜幕來臨時公園裡的燈光優美，適合親子共遊。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/park-4.jpg", import.meta.url).href,
            type: "park",
            name: "高屏溪河濱寵物公園",
            content: "設備完善，場地空曠好停車，十分適合家庭帶毛小孩來玩耍的好地方",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/park-3.jpg", import.meta.url).href,
            type: "park",
            name: "竹東狗狗公園",
            content: "環境地點佳，停車方便，夜幕來臨時公園裡的燈光優美，適合親子共遊。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/park-4.jpg", import.meta.url).href,
            type: "park",
            name: "高屏溪河濱寵物公園",
            content: "設備完善，場地空曠好停車，十分適合家庭帶毛小孩來玩耍的好地方",
        },

        //旅館
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hotel-1.jpg", import.meta.url).href,
            type: "hotel",  //和type產生關聯
            name: "里萊行旅",
            content: "可與毛孩一同入住，距離桃園夜市3公里，距離景福寺和桃園火車站4公里。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hotel-2.jpg", import.meta.url).href,
            type: "hotel",
            name: "太陽慢慢走",
            content: "公寓住宅區，距離台南火車站2公里，以及有一群店狗守護著貴賓們。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hotel-3.jpg", import.meta.url).href,
            type: "hotel",
            name: "月亮慢慢走",
            content: "自助式check in，旅館內會有店貓不時出來巡邏與陪玩陪睡。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hotel-4.jpg", import.meta.url).href,
            type: "hotel",
            name: "牠的足跡寵物友善民宿",
            content: "環境溫馨，傢俱與佈置對寵物相當友善，旁邊有大公園讓毛孩散步。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hotel-3.jpg", import.meta.url).href,
            type: "hotel",
            name: "月亮慢慢走",
            content: "自助式check in，旅館內會有店貓不時出來巡邏與陪玩陪睡。",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/hotel-4.jpg", import.meta.url).href,
            type: "hotel",
            name: "牠的足跡寵物友善民宿",
            content: "環境溫馨，傢俱與佈置對寵物相當友善，旁邊有大公園讓毛孩散步。",
        },
        
    ])

    //用type匯入對應icon
    const cardsData = computed(() =>
    rawCardsData.value.map((card) => ({
    ...card,
    iconSrc: type.value[card.type]?.icon || "", // 根據 type 動態取出 icon
  }))
);

//-----------------------------過濾器---------------------------------------

const activeCard = ref();

//change事件 
function setActive(cardtType){
    activeCard.value = cardtType;
} 

const filterData = computed(()=>{

    //如果都不選 顯示醫院
    if(!activeCard.value){
        return cardsData.value.filter((card) => card.type === 'hospital');
    }
    //回傳過濾點選後的值
    return cardsData.value.filter((card) => card.type === activeCard.value);
})


//------------------------------------地圖部分----------------------------------
    const map = ref(null);
     // iframe切換
    const iframeSrc = ref('https://maps.google.com/maps?q=愛達司動物醫院&z=15&output=embed');

    let mapMove = ref(false);

    // 移動地圖的處理函式
    function isMobileMapMove(placeName){
        
        setTimeout(() => {
            if(window.innerWidth < 768){
            mapMove.value = !mapMove.value;
            document.body.style.overflow = 'hidden'; // 禁止滾動
            }            
        }, 300);
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