<template>
<Banner theme="blue" bgc="yellow-1"></Banner>
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
                        <img src="../assets/img/pet-calendar/ca.png" alt="">
                    </div>
                </div>
            </div>
                <!-- 行程按鈕 -->
                <div class="scheduleBtnBox">
                    <div class="scheduleBtn">
                        <img src="@/assets/img/pet-calendar/add-schedule.svg" alt="" class="scheduleIcon">
                        <p class="xsText">新增行程</p>
                    </div>
                </div>
            <!-- 下 日曆活動內容 -->
            <div class="bottomMain">
                <!-- 活動卡片 -->
                <ul class="scheduleCard">
                    <li class="scheduleCards">
                        <div class="cardText">
                            <div class="cardTop">
                                <h6 class="scheduleName bold">聖誕節Splooter聚餐</h6>
                                <div class="scheduleType">已額滿</div>
                            </div>
                            <p class="summary">帶著你的毛孩們一起和我們Splooter共襄盛舉吧~聖誕快樂~~現場有精美聖誕禮物喔!!</p>
                            <div class="info">
                                <p class="noOfpeople">人數限制：45人</p>
                                <p class="time">活動時間：2024年 12月 25日 18:30-21:30</p>
                                <p class="place">活動地點：台北市信義區信義路五段7號86樓 (饗 A Joy）</p>
                            </div>
                        </div>
                        <div class="cardsBtnBox">
                            <div class="btn primary small blue">參加</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="circle1 circle"></div>
    <div class="circle2 circle"></div>
</template>

<script setup>
 import Banner from "../components/Banner.vue";
 import {ref} from "vue";

 //data
  
</script>
