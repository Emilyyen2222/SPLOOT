<template>
    <div class="buddyCards" v-for="(card,index) in cardsRawData" :key="index">
        <div class="cardBox">
            <div class="cardsImgBox">                        
                    <img :src="card.imgSrc" alt="" class="cardsImg">                        
            </div>
            <div class="cardText">
                <h6 class="cardsTitle bold">{{ card.title }}</h6>
                <div class="reviews">
                    
                    <ul class="stars">
                        <li v-for="n in 5">
                            <img :src="isStars(n, card.stars)" alt="star" :class="['star', 'star' + n]">
                        </li>
                    </ul>
                    <div class="avgGrade smallText">{{ card.stars }}</div>
                </div>
                <div class="serviceDays">
                    <p class="smallText">服務時段</p>
                    <div class="serviceDaysBox">
                        <p class="smallText">每週</p>
                        <ul class="daysUl">
                            <li v-for="day in card.serviceDays" class="daysItem xsText">{{ day }}</li>
                        </ul>                            
                    </div>
                </div>                
                <div class="serviceTime smallText">{{ card.serviceTimeStart }}-{{ card.serviceTimeEnd }}</div>
            </div>
        </div>
        <!-- <Router-link  to="/sploot-buddy/buddy-post">
            <Btn btnStyle="primary small">查看</Btn>  
        </Router-link> -->
    </div>
</template>

<script setup>
import { ref,computed } from 'vue';

import Btn from '@/components/Btn.vue';

// 小幫手文章的card 的資料
//小幫手卡片
const cardsData = ref([]); //渲染的卡片

//全部卡片資料
const cardsRawData = ref([
{
        imgSrc: new URL("../assets/img/buddy-post/demo.png", import.meta.url).href,
        title: "台北市puppy高速散步",
        serviceDays: ["一", "二"],
        serviceTimeStart: "09:00",
        serviceTimeEnd: "18:00",
        city: "台北市",
        district: "中正區",
        serviceType: "walkies",
        petTypes: ["puppy", "small", "middle", "large", "elder", "kitten", "cat"],
        stars: 2,
    },
    {
        imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
        title: "板橋區cat快速散步去",
        serviceDays: ["一", "二"],
        serviceTimeStart: "09:00",
        serviceTimeEnd: "18:00",
        city: "新北市",
        district: "板橋區",
        serviceType: "walkies",
        petTypes: ["puppy", "cat"],
        stars: 5,
    },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "基隆市kitten基隆陪她走走",
    //     serviceDays: ["一", "四", "六", "日"],
    //     serviceTimeStart: "10:00",
    //     serviceTimeEnd: "20:00",
    //     city: "基隆市",
    //     district: "中正區",
    //     serviceType: "walkies",
    //     petTypes: ["puppy", "small", "kitten"],
    //     stars: 3,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "鳳山區large安心毛孩散步",
    //     serviceDays: ["一", "二", "四", "六", "日"],
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "19:00",
    //     city: "高雄市",
    //     district: "鳳山區",
    //     serviceType: "walkies",
    //     petTypes: ["large", "elder"],
    //     stars: 1,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台中市北屯區elder",
    //     serviceDays: ["一", "二", "三", "四", "五", "六", "日"],
    //     serviceTimeStart: "06:00",
    //     serviceTimeEnd: "18:00",
    //     city: "台中市",
    //     district: "北屯區",
    //     serviceType: "walkies",
    //     petTypes: ["elder", "cat"],
    //     stars: 4,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "桃園市桃園區puppy",
    //     serviceDays: ["一"],
    //     serviceTimeStart: "08:00",
    //     serviceTimeEnd: "19:00",
    //     city: "桃園市",
    //     district: "桃園區",
    //     serviceType: "walkies",
    //     petTypes: ["puppy", "small"],
    //     stars: 5,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "新北市新莊區middle",
    //     serviceDays: ["一", "二", "三", "四", "五", "日"],
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "17:00",
    //     city: "新北市",
    //     district: "新莊區",
    //     serviceType: "walkies",
    //     petTypes: ["middle", "large"],
    //     stars: 2,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "高雄市三民區small",
    //     serviceDays: ["二", "三", "六"],
    //     serviceTimeStart: "06:00",
    //     serviceTimeEnd: "20:00",
    //     city: "高雄市",
    //     district: "三民區",
    //     serviceType: "walkies",
    //     petTypes: ["small", "elder"],
    //     stars: 1,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台南市南區large",
    //     serviceDays: ["六", "日"],
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "19:00",
    //     city: "台南市",
    //     district: "南區",
    //     serviceType: "petDrop",
    //     petTypes: ["middle", "large"],
    //     stars: 2,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台南市安平區middle",
    //     serviceDays: ["一", "二"],
    //     serviceTimeStart: "06:00",
    //     serviceTimeEnd: "18:00",
    //     city: "台南市",
    //     district: "安平區",
    //     serviceType: "petDrop",
    //     petTypes: ["middle", "kitten"],
    //     stars: 4,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "新北市新店區kitten",
    //     serviceTimeStart: "08:00",
    //     serviceTimeEnd: "20:00",
    //     city: "新北市",
    //     district: "新店區",
    //     serviceType: "petDrop",
    //     petTypes: ["large", "kitten"],
    //     stars: 4,
    //     serviceDays: ["一", "二", "六", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "桃園市中壢區puppy",
    //     serviceTimeStart: "10:00",
    //     serviceTimeEnd: "20:00",
    //     city: "桃園市",
    //     district: "中壢區",
    //     serviceType: "petDrop",
    //     petTypes: ["puppy", "large"],
    //     stars: 5,
    //     serviceDays: ["一", "二", "三", "四", "六", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台北市大安區large",
    //     serviceTimeStart: "09:00",
    //     serviceTimeEnd: "18:00",
    //     city: "台北市",
    //     district: "大安區",
    //     serviceType: "petDrop",
    //     petTypes: ["large", "small"],
    //     stars: 2,
    //     serviceDays: ["二", "三", "四", "五", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台中市西屯區small",
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "19:00",
    //     city: "台中市",
    //     district: "西屯區",
    //     serviceType: "petDrop",
    //     petTypes: ["small", "elder"],
    //     stars: 1,
    //     serviceDays: ["日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "前進！前進！為人類奉獻！",
    //     serviceTimeStart: "02:00",
    //     serviceTimeEnd: "10:00",
    //     city: "高雄市",
    //     district: "仁武區",
    //     serviceType: "petDrop",
    //     petTypes: ["cat"],
    //     stars: 5,
    //     serviceDays: ["一", "三", "五", "六", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "高雄市左營區cat",
    //     serviceTimeStart: "08:00",
    //     serviceTimeEnd: "22:00",
    //     city: "高雄市",
    //     district: "左營區",
    //     serviceType: "fostering",
    //     petTypes: ["kitten", "cat"],
    //     stars: 2,
    //     serviceDays: ["一"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台中市puppy提供長期寄宿",
    //     serviceTimeStart: "10:00",
    //     serviceTimeEnd: "20:00",
    //     city: "台中市",
    //     district: "東區",
    //     serviceType: "fostering",
    //     petTypes: ["puppy", "elder"],
    //     stars: 4,
    //     serviceDays: ["二", "五"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "桃園市middle短期安置",
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "17:00",
    //     city: "桃園市",
    //     district: "楊梅區",
    //     serviceType: "fostering",
    //     petTypes: ["middle", "small"],
    //     stars: 4,
    //     serviceDays: ["一", "二", "三", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台中市到府陪伴你的毛孩",
    //     serviceTimeStart: "09:00",
    //     serviceTimeEnd: "17:00",
    //     city: "台中市",
    //     district: "西區",
    //     serviceType: "homeCare",
    //     petTypes: ["small", "elder"],
    //     stars: 5,
    //     serviceDays: ["四", "五"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "新北市elder個人化照顧",
    //     serviceTimeStart: "08:00",
    //     serviceTimeEnd: "21:00",
    //     city: "新北市",
    //     district: "淡水區",
    //     serviceType: "homeCare",
    //     petTypes: ["elder", "cat"],
    //     stars: 2,
    //     serviceDays: ["一", "二", "三", "四", "五", "六", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台南市kitten寵物照顧專家",
    //     serviceTimeStart: "06:00",
    //     serviceTimeEnd: "16:00",
    //     city: "台南市",
    //     district: "永康區",
    //     serviceType: "homeCare",
    //     petTypes: ["small", "kitten"],
    //     stars: 1,
    //     serviceDays: ["一", "二", "三", "四", "五", "六", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台北市cat安心寵物照顧",
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "17:00",
    //     city: "台北市",
    //     district: "大同區",
    //     serviceType: "homeCare",
    //     petTypes: ["cat", "middle"],
    //     stars: 2,
    //     serviceDays: ["一", "二", "三", "四", "五", "六", "日"],
    // },
]);


//評分星星計算

const isStars = (n, stars) => {
    if(stars < 1){
        stars = 1;  //最少要有一顆星
    };

    if(n <= stars){
        return new URL('@/assets/img/icon/star-full.svg', import.meta.url).href
    }else{
        return new URL('@/assets/img/icon/star-line.svg', import.meta.url).href
    }
}; 

// 卡片查看更多
    const visbleCount = ref(6); //預設顯示6個

    const visibleCards = computed(() => {
        return cardsData.value.slice(0, visbleCount.value);
  });
</script>
