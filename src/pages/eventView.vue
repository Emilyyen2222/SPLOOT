<template>
<MainHeader theme="blue" bgc="yellow-1"></MainHeader>
<!-- 主內容 -->
<div class="wrapper">
<!-- 主要功能 -->
    <div class="petCalendarBox">
            <!-- 上 標題＋日曆 -->
        <div class="topMain">
                <!-- 上左 -->
                <div class="topLeft">
                    <div class="topLeftBox">
                        <!-- 標題 -->
                        <div class="title">
                            <h3 class="bold">打造你的專屬毛孩日曆</h3>
                            <p>掌握官方活動資訊與家長分享毛孩的精彩時刻。</p>
                        </div>
                        <!-- 滑動switch -->
                        <div class="switch" id="switch">
                            <input type="radio" id="officialEvent" name="option" class="switch-input">
                            <input type="radio" id="splooter" name="option" class="switch-input">
                            <div class="slider"></div>
                            <div class="labels xsText">
                            <label for="officialEvent">官方活動</label>
                            <label for="splooter">Splooter</label>
                            </div>
                        </div>
                    </div>
                </div>  
                <!-- 上右 行程日曆 -->
                <div class="topRight">
                    <div class="calendar">
                         <Calendar></Calendar>
                    </div>
                </div>
        </div>
                <!-- 行程按鈕 -->
                <div class="scheduleBtnBox">
                    <div class="scheduleBtn">
                        <img src="@/assets/img/icon/add-schedule.svg" alt="" class="scheduleIcon">
                        <p class="xsText">新增行程</p>
                    </div>
                </div>
            <!-- 下 日曆活動內容 -->
            <div class="bottomMain">
                <!-- 活動卡片 -->
                <ul class="scheduleCard">
                    <!-- 活動卡片們 -->
                    <li class="scheduleCards" v-for="(card,index) in cardsData" :key="index">
                        <!-- 卡片標題 -->
                        <div class="cardText">
                            <div class="cardTitle">
                                <h6 class="scheduleName bold">{{card.title}}</h6>
                            </div>
                            <!-- 卡片內容 -->
                            <div class="cardContent">
                                <p class="cardContentText smallText">{{card.content}}</p>
                            </div>
                            <!-- 人數，時間，地點 -->
                            <div class="info">
                                <div class="leftItem">
                                    <img class="peopleCountLabel cardIcon" src="@/assets/img/icon/peopleCount.svg" alt="">
                                    <div class="timeLabelBox">
                                        <img class="time cardIcon" src="@/assets/img/icon/time.svg" alt="">
                                    </div>
                                    <div class="placeLabelBox cardIcon">
                                        <img class="location" src="@/assets/img/icon/location.svg" alt="">
                                    </div>
                                </div>
                                <div class="rightItem">
                                    <p class="peopleCount smallText">{{card.peopleCount}}人</p>
                                    <div class="ymd">
                                        <p class="ymdStart smallText">{{ getTimeObject(card.startTime) }}</p>
                                        <p class="ymdEnd smallText">{{ getTimeObject(card.endTime) }}</p>
                                    </div>
                                    <div class="place">
                                        <div class="placeText smallText">{{ card.place }}</div>
                                    </div>
                            </div>
                            </div>
                        </div>
                        <Btn btnType="event" :btnStyle="card.btnStyle">{{ btnText[card.btnStyle] }}</Btn>
                    </li>              
                </ul>
            </div>

            <div class="circle1 circle"></div>
            <div class="circle2 circle"></div>
        </div>
    </div>
    <MainFooter></MainFooter>
</template>

<script setup>
    import { ref } from 'vue';
    
    import MainHeader from "@/components/MainHeader.vue";
    import Btn from '@/components/Btn.vue';
    import Calendar from '@/components/Calendar.vue'
    import MainFooter from "@/components/MainFooter.vue"


//data
const cardsData = ref([
    {
        title: "聖誕節Splooter聚餐聖誕節Splooter聚餐",
        content: "帶著你的毛孩們一起和我們Splooter共襄盛舉吧~現場有精美聖誕禮物喔!!",
        peopleCount: "45",
        startTime:{
            year: "2024",
            month: "12",
            day: "25",
            time: '18:30'
        },
        endTime:{
            year: "2024",
            month: "12",
            day: "25",
            time: '21:30'
        },
        place:"台北市信義區信義路五段7號86樓 (饗 A Joy)",
        btnStyle:"edit",
        
    }, 
    {
        title: "我們的暗號是爆炸頭軍曹GOGOGO~~",
        content: "帶著藍星的毛孩子們跟我們一起參加征服藍星路跑吧～～！",
        peopleCount: "不限",
        startTime:{
            year: "2024",
            month: "12",
            day: "31",
            time: '07:00'
        },
        endTime:{
            year: "2024",
            month: "12",
            day: "31",
            time: '11:30'
        },
        place:"二二八公園集合",
        btnStyle:"attend",
    },
    {
        title: "心臓を捧げよ！三天兩夜豪華郵輪寵物派對",
        content: "目標石垣島，帶著毛孩們一起出國吧！",
        peopleCount: "80",
        startTime:{
            year: "2025",
            month: "01",
            day: "23",
            time: '08:30'
        },
        endTime:{
            year: "2025",
            month: "01",
            day: "26",
            time: '22:00'
        },
        place:"基隆港",
        btnStyle:"registered",
    },
    {
        title: "英雄毛孩Cosplay比賽",
        content: "Splooter與毛孩們選擇喜歡的英雄角色來進行Cosplay,一同化身成正義的夥伴吧！",
        peopleCount: "60",
        startTime:{
            year: "2025",
            month: "02",
            day: "01",
            time: '09:30'
        },
        endTime:{
            year: "2025",
            month: "02",
            day: "01",
            time: '15:50'
        },
        place:"緯育Tibame台北職訓中心",
        btnStyle:"disable",        
    }
]);

const btnText = ref({
    attend : "參加",
    edit : "編輯",
    registered : "已參加",
    disable : "已額滿",
})


//開始時間～結束時間 物件
function getTimeObject(theTime){
    return `${theTime.year}年 ${theTime.month}月 ${theTime.day}日 ${theTime.time}`;
}

</script>
