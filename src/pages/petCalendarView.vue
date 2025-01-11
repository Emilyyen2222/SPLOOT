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
                        <img src="@/assets/img/pet-calendar/ca.png" alt="">
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
                    <li class="scheduleCards">
                        <div class="cardText">
                            <div class="cardTitle">
                                <h6 class="scheduleName bold">00000000000000000我們的暗號是爆炸頭軍曹</h6>
                            </div>
                            <div class="cardcontent">
                                <p class="summary smallText">帶著你的毛孩們一起和我們Splooter共襄盛舉吧~聖誕快樂~~現場有精美聖誕禮物喔!!</p>
                            </div>
                            <!-- 卡片內容 -->
                            <div class="info">
                                <div class="leftItem">
                                    <img class="peopleCount cardIcon" src="@/assets/img/icon/peopleCount.svg" alt="">
                                    <div class="timeLabelBox">
                                        <img class="time cardIcon" src="@/assets/img/icon/time.svg" alt="">
                                    </div>
                                    <div class="placeLabelBox cardIcon">
                                        <img class="location" src="@/assets/img/icon/location.svg" alt="">
                                    </div>
                                </div>
                                <div class="rightItem">
                                    <p class="noOfpeople smallText">45人</p>
                                    <div class="ymd">
                                        <p class="ymdStart smallText">2024年 12月 25日 18:30</p>
                                        <p class="ymdEnd smallText">2024年 12月 25日 21:30</p>
                                    </div>
                                    <div class="adress">
                                        <div class="placeText smallText">台北市信義區信義路五段7號86樓 (饗 A Joy)</div>
                                    </div>
                            </div>
                            </div>
                        </div>
                        <div class="cardsBtnBox">
                            <div class="btn small blue"><span>參加</span></div>
                        </div>
                    </li> 
                    <li class="scheduleCards">
                        <div class="cardText">
                            <div class="cardTitle">
                                <h6 class="scheduleName bold">00000000000000000我們的暗號是爆炸頭軍曹</h6>
                            </div>
                            <div class="cardcontent">
                                <p class="summary smallText">帶著你的毛孩們一起和我們Splooter共襄盛舉吧~聖誕快樂~~現場有精美聖誕禮物喔!!</p>
                            </div>
                            <!-- 卡片內容 -->
                            <div class="info">
                                <div class="leftItem">
                                    <img class="peopleCount cardIcon" src="@/assets/img/icon/peopleCount.svg" alt="">
                                    <div class="timeLabelBox">
                                        <img class="time cardIcon" src="@/assets/img/icon/time.svg" alt="">
                                    </div>
                                    <div class="placeLabelBox cardIcon">
                                        <img class="location" src="@/assets/img/icon/location.svg" alt="">
                                    </div>
                                </div>
                                <div class="rightItem">
                                    <p class="noOfpeople smallText">45人</p>
                                    <div class="ymd">
                                        <p class="ymdStart smallText">2024年 12月 25日 18:30</p>
                                        <p class="ymdEnd smallText">2024年 12月 25日 21:30</p>
                                    </div>
                                    <div class="adress">
                                        <div class="placeText smallText">台北市信義區信義路五段7號86樓 (饗 A Joy)</div>
                                    </div>
                            </div>
                            </div>
                        </div>
                        <div class="cardsBtnBox">
                            <div class="btn small blue"><span>參加</span></div>
                        </div>
                    </li> 
                    <li class="scheduleCards">
                        <div class="cardText">
                            <div class="cardTitle">
                                <h6 class="scheduleName bold">00000000000000000我們的暗號是爆炸頭軍曹</h6>
                            </div>
                            <div class="cardcontent">
                                <p class="summary smallText">帶著你的毛孩們一起和我們Splooter共襄盛舉吧~聖誕快樂~~現場有精美聖誕禮物喔!!</p>
                            </div>
                            <!-- 卡片內容 -->
                            <div class="info">
                                <div class="leftItem">
                                    <img class="peopleCount cardIcon" src="@/assets/img/icon/peopleCount.svg" alt="">
                                    <div class="timeLabelBox">
                                        <img class="time cardIcon" src="@/assets/img/icon/time.svg" alt="">
                                    </div>
                                    <div class="placeLabelBox cardIcon">
                                        <img class="location" src="@/assets/img/icon/location.svg" alt="">
                                    </div>
                                </div>
                                <div class="rightItem">
                                    <p class="noOfpeople smallText">45人</p>
                                    <div class="ymd">
                                        <p class="ymdStart smallText">2024年 12月 25日 18:30</p>
                                        <p class="ymdEnd smallText">2024年 12月 25日 21:30</p>
                                    </div>
                                    <div class="adress">
                                        <div class="placeText smallText">台北市信義區信義路五段7號86樓 (饗 A Joy)</div>
                                    </div>
                            </div>
                            </div>
                        </div>
                        <div class="cardsBtnBox">
                            <div class="btn small blue"><span>參加</span></div>
                        </div>
                    </li> 
                    <li class="scheduleCards">
                        <div class="cardText">
                            <div class="cardTitle">
                                <h6 class="scheduleName bold">00000000000000000我們的暗號是爆炸頭軍曹</h6>
                            </div>
                            <div class="cardcontent">
                                <p class="summary smallText">帶著你的毛孩們一起和我們Splooter共襄盛舉吧~聖誕快樂~~現場有精美聖誕禮物喔!!</p>
                            </div>
                            <!-- 卡片內容 -->
                            <div class="info">
                                <div class="leftItem">
                                    <img class="peopleCount cardIcon" src="@/assets/img/icon/peopleCount.svg" alt="">
                                    <div class="timeLabelBox">
                                        <img class="time cardIcon" src="@/assets/img/icon/time.svg" alt="">
                                    </div>
                                    <div class="placeLabelBox cardIcon">
                                        <img class="location" src="@/assets/img/icon/location.svg" alt="">
                                    </div>
                                </div>
                                <div class="rightItem">
                                    <p class="noOfpeople smallText">45人</p>
                                    <div class="ymd">
                                        <p class="ymdStart smallText">2024年 12月 25日 18:30</p>
                                        <p class="ymdEnd smallText">2024年 12月 25日 21:30</p>
                                    </div>
                                    <div class="adress">
                                        <div class="placeText smallText">台北市信義區信義路五段7號86樓 (饗 A Joy)</div>
                                    </div>
                            </div>
                            </div>
                        </div>
                        <div class="cardsBtnBox">
                            <div class="btn small blue"><span>參加</span></div>
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
