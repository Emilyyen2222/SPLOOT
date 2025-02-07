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
                            <input type="radio" id="official" name="option" class="switch-input" @change="setActive('official')">
                            <input type="radio" id="splooter" name="option" class="switch-input" @change="setActive('splooter')">
                            <div class="slider"></div>
                            <div class="labels xsText">
                            <label for="official">官方活動</label>
                            <label for="splooter">Splooter</label>
                            </div>
                        </div>
                    </div>
                </div>  
                <!-- 上右 行程日曆 -->
                <div class="topRight">
                    <div class="calendar">
                         <Calendar
                         @dayclick="filterScheduleCard"
                         ></Calendar>
                    </div>
                </div>
        </div>
                <!-- 行程按鈕 -->
                <div class="scheduleBtnBox">
                    <div class="scheduleBtn" @click="toggleAddEvent">
                        <img src="@/assets/img/icon/add-schedule.svg" alt="" class="scheduleIcon">
                        <p class="xsText">新增行程</p>
                    </div>
                </div>
            <!-- 下 日曆活動內容 -->
            <div class="bottomMain">
                <!-- 活動卡片 -->
                <ul class="scheduleCard">
                    <!-- 活動卡片們 -->
                    <li class="scheduleCards" v-for="(card,index) in filterData" :key="index">
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
                        <Btn btnType="event" :btnStyle="card.status" @click="toggleSuccess(card)">{{ btnText[card.status] }}</Btn>
                    </li>                    
                </ul>
                <!-- 參加成功燈箱 -->
                <PopUp
                :is-pop-up="isSuccess">
                <div class="theSuccess">
                    <div class="topTitle">
                        <h3 class="bold">參加成功</h3>
                    </div>
                    <div class="bottomBox">
                        <div class="successBox">
                            <div class="succesContent">
                                <div class="cardTitle">
                                    <h6 class="scheduleName bold">{{selectedCard.title}}</h6>
                                </div>
                                <!-- 卡片內容 -->
                                <div class="cardContent">
                                    <p class="cardContentText smallText">{{selectedCard.content}}</p>
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
                                        <p class="peopleCount smallText">{{selectedCard.peopleCount}}人</p>
                                        <div class="ymd">
                                            <p class="ymdStart smallText">{{ getTimeObject(selectedCard.startTime) }}</p>
                                            <p class="ymdEnd smallText">{{ getTimeObject(selectedCard.endTime) }}</p>
                                        </div>
                                        <div class="place">
                                            <div class="placeText smallText">{{ selectedCard.place }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="organizerBox">
                                    <div class="organizer">
                                        <div class="organizerAvatar">
                                            <img :src="selectedCard.organizer.avatar" alt="avatar">
                                        </div>
                                        <div class="organizerInfo">
                                            <p class="organizerName smallText">主辦人： {{ selectedCard.organizer.name }}</p>
                                            <p class="lineId smallText">LINE： {{ selectedCard.organizer.line }}</p>
                                        </div>
                                    </div>
                                    <div class="lineQRcode">
                                        <!-- 這裡放QRcode -->
                                         <a :href="`https://line.me/ti/p/~${selectedCard.organizer.line}`" target="_blank">
                                             <QRcode
                                             v-if="selectedCard.organizer.line"
                                             :value="`https://line.me/ti/p/~${selectedCard.organizer.line}`"
                                             :size="64"
                                             ></QRcode>
                                         </a>
                                    </div>
                                </div>
                            </div>
                            <div class="successImg">
                                <img src="../assets/img/event/addEventPic.svg" alt="picture">
                            </div>
                        </div>
                        <Btn btnStyle="primary default" @click="toggleSuccess">確定</Btn>
                    </div>
                </div>
                </PopUp>
            </div>

            <div class="circle1 circle"></div>
            <div class="circle2 circle"></div>
        </div>
    </div>

    <!-- 新增行程燈箱 -->
    <LightBox
        :title="addEventTitle.title"
        :is-light-box="isAddEvent" 
        @toggle="toggleAddEvent">
        <div class="addEvent">
            <div class="newEventText">
                <div class="title">
                    <InputText                
                        :placeHolder="newEventTitle.placeHolder"
                        :errorMsg="newEventTitle.errorMsg"
                        :hasError="newEventTitle.inputError"
                        :maxlength="12"

                        v-model="newEventTitle.inputValue">
                    </InputText>
                </div>
                <div class="newEventContent">
                    <InputText 
                        :placeHolder="newEventContent.placeHolder"
                        :errorMsg="newEventContent.errorMsg"
                        :hasError="newEventContent.inputError"
                        :maxlength="30"
                        v-model="newEventContent.inputValue">
                    </InputText>
                </div>
            </div>
            <div class="peopleCount">
                <div class="peopleCountlabel eventlabel">
                    <div class="peopleIcon eventIcon">
                        <img src="../assets/img/icon/peopleCount.svg" alt="" class="iconImg">
                    </div>
                    <p class="smallText">人數上限</p>
                </div>
                <div class="peopleNumber eventInput">
                    <InputText                
                        size = "small"
                        :placeHolder="peopleNumber.placeHolder"
                        :errorMsg="peopleNumber.errorMsg"
                        :hasError="peopleNumber.inputError"
                        :maxlength="3"
                        v-model="peopleNumber.inputValue">
                    </InputText>
                </div>
            </div>
            <div class="eventTime">
                <div class="eventTimelabel eventlabel">
                    <div class="timeIcon eventIcon">
                        <img src="../assets/img/icon/time.svg" alt="" class="iconImg">
                    </div>
                    <p class="smallText">活動時間</p>
                </div>
                <div class="eventTimeDropDown">
                    <div class="startTime timeDropDownBox">
                        <div class="frontBox theTimeBox">
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown startTimeY"
                                    :placeHolder="startTimeY.placeHolder"
                                    :options="startTimeY.options"
                                    v-model="startTimeY.menuValue">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown startTimeM"
                                    :placeHolder="startTimeM.placeHolder"
                                    :options="startTimeM.options"
                                    v-model="startTimeM.menuValue">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown startTimeD"
                                    :placeHolder="startTimeD.placeHolder"
                                    :options="startTimeD.options"
                                    v-model="startTimeD.menuValue">
                                </DropdownMenu>
                            </div>
                        </div>
                        <div class="backBox theTimeBox">
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown startTimeH"
                                    :placeHolder="startTimeH.placeHolder"
                                    :options="startTimeH.options"
                                    v-model="startTimeH.menuValue">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown startTime"
                                    :placeHolder="startTime.placeHolder"
                                    :options="startTime.options"
                                    v-model="startTime.menuValue">
                                </DropdownMenu>
                            </div>
                        </div>
                    </div>

                    <div class="endTime timeDropDownBox">
                        <div class="frontBox theTimeBox">
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown endTimeY"
                                    :placeHolder="endTimeY.placeHolder"
                                    :options="endTimeY.options"
                                    v-model="endTimeY.menuValue">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown endTimeM"
                                    :placeHolder="endTimeM.placeHolder"
                                    :options="endTimeM.options"
                                    v-model="endTimeM.menuValue">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown endTimeD"
                                    :placeHolder="endTimeD.placeHolder"
                                    :options="endTimeD.options"
                                    v-model="endTimeD.menuValue">
                                </DropdownMenu>
                            </div>
                        </div>
                        <div class="backBox theTimeBox">
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown endTimeH"
                                    :placeHolder="endTimeH.placeHolder"
                                    :options="endTimeH.options"
                                    v-model="endTimeH.menuValue">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown endTime"
                                    :placeHolder="endTime.placeHolder"
                                    :options="endTime.options"
                                    v-model="endTime.menuValue">
                                </DropdownMenu>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="eventPlace">
                <div class="eventPlacelabel eventlabel">
                    <div class="placeIcon eventIcon">
                        <img src="../assets/img/icon/location.svg" alt="" class="iconImg">
                    </div>
                    <p class="smallText">活動地點</p>
                </div>
                <div class="activePlace eventInput">
                    <InputText                
                        size = "small"
                        :placeHolder="activePlace.placeHolder"
                        :errorMsg="activePlace.errorMsg"
                        :hasError="activePlace.inputError"
                        :maxlength="30"
                        v-model="activePlace.inputValue">
                    </InputText>
                </div>
            </div>
            <div class="newEventBtn">
                    <Btn btnStyle="primary small" @click="submitCard">提交</Btn>
                    <Btn btnStyle="baseline small" @click="toggleAddEvent">取消</Btn>
            </div>
        </div>
    </LightBox>

    <MainFooter></MainFooter>
</template>

<script setup>
    import { ref, onMounted, computed, watch } from 'vue';
    import QRcode from 'qrcode.vue'
    
    import MainHeader from "@/components/MainHeader.vue";
    import Btn from '@/components/Btn.vue';
    import Calendar from '@/components/Calendar.vue'
    import MainFooter from "@/components/MainFooter.vue"
    import LightBox  from "../components/LightBox.vue"
    import InputText from '@/components/InputText.vue';
    import DropdownMenu from "@/components/DropdownMenu.vue";
    import PopUp from "@/components/PopUp.vue"

    //data
    // 點選日曆後的資料過濾在這裡
    const cardsData = ref([]);
    
    //switch篩選器過濾後的陣列
    const filterData = computed(() => {
        return cardsData.value.filter(card => card.type === activeCard.value);
    })

    // 原始陣列(全部資料存入)
    const cardsRawData = ref([
    {
        title: "聖誕節Splooter聚餐",
        content: "帶著你的毛孩們一起和我們Splooter共襄盛舉吧~現場有精美聖誕禮物喔!!",
        peopleCount: "45",
        startTime: {
            year: "2024",
            month: "12",
            day: "25",
            time: "18:30"
        },
        endTime: {
            year: "2024",
            month: "12",
            day: "25",
            time: "21:30"
        },
        place: "台北市信義區信義路五段7號86樓 (饗 A Joy)",
        type: "official",
        status: "attend",
        organizer: {
            avatar: new URL("../assets/img/event/129.svg", import.meta.url).href,
            name: "派對大師",
            line: "party_master"
        }
    },
    {
        title: "澀谷事變",
        content: "19:00-發現澀谷被佈下「帳」/21:14-虎杖祓除蝗Guy，並且破壞「帳」/21:22-五條悟被封印",
        peopleCount: "777",
        startTime: {
            year: "2024",
            month: "10",
            day: "31",
            time: "19:00"
        },
        endTime: {
            year: "2027",
            month: "10",
            day: "31",
            time: "19:00"
        },
        place: "澀谷車站B5F",
        type: "official",
        status: "attend",
        organizer: {
            avatar: new URL("../assets/img/buddy-post/M.svg", import.meta.url).href,
            name: "神秘人",
            line: "spop333"
        }
    },
    {
        title: "我們的暗號是爆炸頭軍曹GOGOGO~~",
        content: "帶著藍星的毛孩子們跟我們一起參加征服藍星路跑吧～～！",
        peopleCount: "100",
        startTime: {
            year: "2025",
            month: "02",
            day: "07",
            time: "07:00"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "10",
            time: "11:30"
        },
        place: "二二八公園集合",
        type: "official",
        status: "attend",
        organizer: {
            avatar: new URL("../assets/img/event/129.svg", import.meta.url).href,
            name: "鯉魚王",
            line: "magikarp"
        }
    },
    {
        title: "心臓を捧げよ！三天兩夜豪華郵輪寵物派對",
        content: "目標石垣島，帶著毛孩們一起自由吧！",
        peopleCount: "80",
        startTime: {
            year: "2025",
            month: "02",
            day: "28",
            time: "08:30"
        },
        endTime: {
            year: "2025",
            month: "03",
            day: "15",
            time: "22:00"
        },
        place: "基隆港",
        type: "official",
        status: "attend",
        organizer: {
            avatar: new URL("../assets/img/event/129.svg", import.meta.url).href,
            name: "艾倫",
            line: "yoruou_2025"
        }
    },
    {
        title: "英雄毛孩Cosplay比賽",
        content: "Splooter與毛孩們選擇喜歡的英雄角色來進行Cosplay,一同化身成正義的夥伴吧！",
        peopleCount: "60",
        startTime: {
            year: "2025",
            month: "02",
            day: "05",
            time: "09:30"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "20",
            time: "15:50"
        },
        place: "緯育Tibame台北職訓中心",
        type: "official",
        status: "disable",
        organizer: {
            avatar: new URL("../assets/img/event/129.svg", import.meta.url).href,
            name: "變裝達人",
            line: "cosplay_king"
        }
    },
    {
        title: "毛孩電影之夜",
        content: "大螢幕、爆米花，還有最愛的毛孩陪伴，一起享受電影之夜吧！",
        peopleCount: "55",
        startTime: {
            year: "2025",
            month: "03",
            day: "01",
            time: "06:40"
        },
        endTime: {
            year: "2025",
            month: "03",
            day: "12",
            time: "10:10"
        },
        place: "基隆海洋廣場",
        type: "splooter",
        status: "registered",
        organizer: {
            avatar: new URL("../assets/img/event/129.svg", import.meta.url).href,
            name: "影視迷",
            line: "movielover"
        }
    },
    {
        title: "寵物飛盤挑戰賽",
        content: "測試你的毛孩接飛盤的技巧，一起來場激烈的比賽吧！",
        peopleCount: "15",
        startTime: {
            year: "2025",
            month: "03",
            day: "2",
            time: "06:30"
        },
        endTime: {
            year: "2025",
            month: "03",
            day: "29",
            time: "09:29"
        },
        place: "大安森林公園",
        type: "official",
        status: "attend",
        organizer: {
            avatar: new URL("../assets/img/event/129.svg", import.meta.url).href,
            name: "飛盤達人",
            line: "frisbee_master"
        }
    },
    {
        title: "毛孩時裝秀",
        content: "讓毛孩穿上最時尚的服飾，一起來場可愛的時裝秀吧！",
        peopleCount: "20",
        startTime: {
            year: "2025",
            month: "03",
            day: "28",
            time: "12:52"
        },
        endTime: {
            year: "2025",
            month: "04",
            day: "02",
            time: "22:26"
        },
        place: "淡水河畔",
        type: "official",
        status: "attend",
        organizer: {
            avatar: new URL("../assets/img/event/129.svg", import.meta.url).href,
            name: "時尚寵物",
            line: "fashion_pet"
        }
    },
    {
        title: "寵物攝影工作坊",
        content: "學習如何拍出超可愛的寵物照片，專業攝影師親自指導！",
        peopleCount: "25",
        startTime: {
            year: "2025",
            month: "03",
            day: "10",
            time: "20:14"
        },
        endTime: {
            year: "2025",
            month: "03",
            day: "31",
            time: "22:57"
        },
        place: "基隆海洋廣場",
        type: "official",
        status: "attend",
        organizer: {
            avatar: new URL("../assets/img/event/129.svg", import.meta.url).href,
            name: "攝影大師",
            line: "photo_master"
        }
    },
    {
        title: "寵物手作DIY",
        content: "一起動手製作專屬於毛孩的玩具與配件，創造美好回憶！",
        peopleCount: "5",
        startTime: {
            year: "2025",
            month: "03",
            day: "28",
            time: "13:00"
        },
        endTime: {
            year: "2025",
            month: "04",
            day: "01",
            time: "05:38"
        },
        place: "台北動物園",
        type: "official",
        status: "attend",
        organizer: {
            avatar: new URL("../assets/img/event/129.svg", import.meta.url).href,
            name: "DIY專家",
            line: "diy_crafts"
        }
    },
    {
        "title": "毛孩露營日",
        "content": "大自然、篝火與毛孩的陪伴，快來參加我們的戶外露營活動！",
        "peopleCount": "55",
        "startTime": {
            "year": "2025",
            "month": "02",
            "day": "09",
            "time": "16:33"
        },
        "endTime": {
            "year": "2025",
            "month": "02",
            "day": "15",
            "time": "15:19"
        },
        "place": "台中中央公園",
        "type": "official",
        "status": "attend",
        "organizer": {
            "avatar": new URL("../assets/img/event/129.svg", import.meta.url).href,
            "name": "喵星人王國",
            "line": "love_forever"
        }
    },
    {
        "title": "寵物攝影工作坊",
        "content": "學習如何拍出超可愛的寵物照片，專業攝影師親自指導！",
        "peopleCount": "10",
        "startTime": {
            "year": "2025",
            "month": "02",
            "day": "20",
            "time": "23:22"
        },
        "endTime": {
            "year": "2025",
            "month": "02",
            "day": "24",
            "time": "17:29"
        },
        "place": "高雄駁二藝術特區",
        "type": "splooter",
        "status": "attend",
        "organizer": {
            "avatar": new URL("../assets/img/event/129.svg", import.meta.url).href,
            "name": "寵愛一生",
            "line": "furry_diary"
        }
    },
    {
        "title": "寵物飛盤挑戰賽",
        "content": "測試你的毛孩接飛盤的技巧，一起來場激烈的比賽吧！",
        "peopleCount": "10",
        "startTime": {
            "year": "2025",
            "month": "02",
            "day": "05",
            "time": "18:47"
        },
        "endTime": {
            "year": "2025",
            "month": "02",
            "day": "23",
            "time": "20:25"
        },
        "place": "基隆海洋廣場",
        "type": "splooter",
        "status": "attend",
        "organizer": {
            "avatar": new URL("../assets/img/event/129.svg", import.meta.url).href,
            "name": "毛孩俱樂部",
            "line": "fashion_dog_cat"
        }
    },
    {
        "title": "毛孩瑜珈日",
        "content": "來一場寧靜與身心平衡的瑜珈體驗吧！帶著毛孩一起感受身心舒展的樂趣~",
        "peopleCount": "10",
        "startTime": {
            "year": "2025",
            "month": "02",
            "day": "21",
            "time": "21:11"
        },
        "endTime": {
            "year": "2025",
            "month": "02",
            "day": "27",
            "time": "19:10"
        },
        "place": "花博公園",
        "type": "splooter",
        "status": "edit",
        "organizer": {
            "avatar": new URL("../assets/img/event/129.svg", import.meta.url).href,
            "name": "萌寵生活",
            "line": "cat_kingdom"
        }
    }
    ]);

    const btnText = ref({
        attend : "參加",
        edit : "編輯",
        registered : "已參加",
        disable : "已額滿",
    });

    // switch分類篩選
    const activeCard = ref('official');

    const setActive = (cardType) => {
        activeCard.value = cardType;
        console.log(activeCard.value);
    };

    //日曆點選以及載入時間渲染
    const isDateObject = (touchedDate) => {
        const targetDate = new Date(touchedDate);
        targetDate.setHours(0, 0, 0, 0); // 使時間變成 00:00 以防時間差比較錯誤 只比較年月日

        //回傳若非數字則出現錯誤警告
        if (isNaN(targetDate.getTime())) {
            alert(`無效的日期格式:${touchedDate}`);
            console.error("無效的日期格式:", touchedDate);
            return;
        }

        console.log("選擇的日期:", targetDate.toLocaleDateString("zh-TW"));  //選擇日期 YYY/M/D 本地時間

        // 檢查cardsRawData資料
        if (!cardsRawData.value || !Array.isArray(cardsRawData.value)) {
            alert(`${cardsRawData.value}無效或不是陣列`);
            console.error("cardsRawData.value 無效或不是陣列");
            return;
        }

        // 資料過濾
        cardsData.value = cardsRawData.value.filter(d => {

            //資料缺少開始時間或是結束時間
            if (!d.startTime || !d.endTime) {
                console.warn("缺少 startTime 或 endTime");
                return false;
            }

            // 確保日期格式正確，開始時間設定為00:00:00，結束時間設定為23:59:59
            const startDate = new Date(`${d.startTime.year}-${d.startTime.month.padStart(2, '0')}-${d.startTime.day.padStart(2, '0')}T00:00:00`);
            const endDate = new Date(`${d.endTime.year}-${d.endTime.month.padStart(2, '0')}-${d.endTime.day.padStart(2, '0')}T23:59:59`);

            return startDate <= targetDate && endDate >= targetDate;
        }).sort((a, b) => {
            const dataA = new Date(`${a.startTime.year}-${a.startTime.month.padStart(2, '0')}-${a.startTime.day.padStart(2, '0')}`);
            const dataB = new Date(`${b.startTime.year}-${b.startTime.month.padStart(2, '0')}-${b.startTime.day.padStart(2, '0')}`);
            return dataA - dataB;
        });

        console.log("篩選後的 cardsData:", cardsData.value);
    };

    const filterScheduleCard = (day) => {
        const selectdate = day.date;
        isDateObject(selectdate);
    };

    // 預設篩選今天的活動
    onMounted(() => {
        const today = new Date();
        const todayString = today.toISOString().split("T")[0]; // 格式化為 YYYY-MM-DD
        isDateObject(todayString);
    });

    //卡片開始時間～結束時間 物件
    function getTimeObject(theTime){
        return `${theTime.year}年 ${theTime.month}月 ${theTime.day}日 ${theTime.time}`;
    }

    // －－－－－以下為各式燈箱－－－－－－－

    //--------------新增貼文燈箱-------------
    // 燈箱標題請輸入
    const addEventTitle = {title: "發起活動"}

    //燈箱狀態
    let isAddEvent = ref(false);

    // 控制燈箱的顯示與隱藏
    function toggleAddEvent() {
    isAddEvent.value = !isAddEvent.value;
    // 停止捲軸
    if (isAddEvent.value) {
    document.body.classList.add('clicked');
    } else {
    document.body.classList.remove('clicked');
    }
    //清空內容選單 以及提示錯誤
    newEventTitle.value.inputValue='';
    newEventTitle.value.inputError = false;
    newEventContent.value.inputValue='';
    newEventContent.value.inputError = false;
    peopleNumber.value.inputValue='';
    peopleNumber.value.inputError = false;
    activePlace.value.inputValue='';
    activePlace.value.inputError = false;
    }

    // ------------新增貼文輸入以及下拉式選單-------------

    const newEventTitle = ref({
    placeHolder: '標題',
    errorMsg: '未輸入標題',
    inputValue: '',
    inputError: false,
    });
    
    const newEventContent = ref({
        placeHolder: '內文',
        errorMsg: '未輸入內文',
        inputValue: '',
        inputError: false,
    });
    
    const peopleNumber = ref({
        placeHolder: '人數',
        errorMsg: '未輸入人數',
        inputValue: '',
        inputError: false,
    });
    
    const activePlace = ref({
        placeHolder: '地點',
        errorMsg: '未輸入地點',
        inputValue: '',
        inputError: false,
    });

    // input監看是否空白
    watch(() => newEventTitle.value.inputValue, (newValue) => {
        newEventTitle.value.inputError = newValue.trim() === '';

    });

    watch(() => newEventContent.value.inputValue, (newValue) => {
        newEventContent.value.inputError = newValue.trim() === '';
    });

    watch(() => peopleNumber.value.inputValue, (newValue) => {
            peopleNumber.value.inputError = newValue.trim() === '';
    });

    watch(() => activePlace.value.inputValue, (newValue) => {
            activePlace.value.inputError = newValue.trim() === '';
    });
    
    //下拉式選單

    const currentYear = new Date().getFullYear(); //抓取今年

    // 取得當月天數
    const getMonthDays = (year, month) => {
        return new Date(year, month, 0).getDate();
    };

    // 年
    const startTimeY = ref({
        placeHolder: '年',
        options: Array.from({length: 6}, (value,index) => ({name: currentYear + index})),
        menuValue:''
    });
    const endTimeY = ref({
        placeHolder: '年',
        options: Array.from({length: 6}, (value,index) => ({name: currentYear + index})),
        menuValue:''
    });

    // 月
    const startTimeM = ref({
        placeHolder: '月',
        options: Array.from({length:12}, (value,index) => ({name: index + 1})),
        menuValue:''
    });
    const endTimeM = ref({
        placeHolder: '月',
        options: Array.from({length: 12}, (value,index) => ({name: index + 1})),
        menuValue:''
    });

    // 日
    const startTimeD = ref({
        placeHolder: '日',
        options: [],
        menuValue:''
    });
    const endTimeD = ref({
        placeHolder: '日',
        options: [],
        menuValue:''
    });

    //監聽下拉式選單變化（年和月）
    watch([() => startTimeY.value.menuValue, () => startTimeM.value.menuValue], ([newYear, newMonth]) => {
        if (newYear && newMonth) {
            const days = getMonthDays(newYear, newMonth);
            startTimeD.value.options = Array.from({length: days},(value, index) => (
            {name: (index + 1).toString().padStart(2,'0')}
        ));
            startTimeD.value.menuValue = ""; // 重置選擇
        }
    });

    watch([() => endTimeY.value.menuValue, () => endTimeM.value.menuValue],([newYear,newMonth]) => {
        if(newYear && newMonth){
            const days = getMonthDays(newYear, newMonth);
            endTimeD.value.options = Array.from({length: days},(value, index) => (
                { name: (index + 1).toString().padStart(2,'0')}
            ));
            endTimeD.value.menuValue = ""; // 重置選擇
        }
    });

    // 時
    const startTimeH = ref({
        placeHolder: '時',
        options: Array.from({length:24},(value, index) => (
            {name : index.toString().padStart(2,'0')}
        )),
        menuValue:''
    });
    const endTimeH = ref({
        placeHolder: '時',
        options: Array.from({length:24},(value, index) => (
            {name : index.toString().padStart(2,'0')}
        )),
        menuValue:''
    });

    // 分
    const startTime = ref({
        placeHolder: '分',
        options: Array.from({length: 6}, (value, index) => (
            {name : (index * 10).toString().padStart(2,'0')}
        )),
        menuValue:''
    });
    const endTime = ref({
        placeHolder: '分',
        options: Array.from({length: 6}, (value, index) => (
            {name : (index * 10).toString().padStart(2,'0')}
        )),
        menuValue:''
    });

    //提交按鈕
    const submitCard = () => {
        if(submitCheck.value){
            alert('填寫未完成');
        }else if(timeCheck.value){
            alert('開始時間不能大於等於結束時間！');
        }else{
            alert('填寫完成');
        }
    };
    //提交前檢查是否有空白未填及時間(有異常為true)
    const submitCheck = computed(() => {    
        
        //input(有空白的話為true)
        return (newEventTitle.value.inputError ||
        newEventContent.value.inputError ||
        peopleNumber.value.inputError ||
        activePlace.value.inputError ||
        //下拉式(有空白的話為false)
        !startTimeY.value.menuValue ||
        !endTimeY.value.menuValue ||
        !startTimeM.value.menuValue ||
        !endTimeM.value.menuValue ||
        !startTimeD.value.menuValue ||
        !endTimeD.value.menuValue ||
        !startTimeH.value.menuValue ||
        !endTimeH.value.menuValue ||
        !startTime.value.menuValue ||
        !endTime.value.menuValue)       
    });

    //開始時間結束時間檢查（結束時間大於開始時間的話為false）
    const timeCheck = computed(() => {
        const start = new Date(startTimeY.value.menuValue,(startTimeM.value.menuValue - 1),startTimeD.value.menuValue,startTimeH.value.menuValue,startTime.value.menuValue);
        const end = new Date(endTimeY.value.menuValue,(endTimeM.value.menuValue - 1),endTimeD.value.menuValue,endTimeH.value.menuValue,endTime.value.menuValue);
         return start >= end;
    });

    //---------------------------------

    // 參加成功燈箱
    // 燈箱標題請輸入

    //PopUp狀態
    let isSuccess = ref(false);

    const selectedCard = ref(null); 
    // 控制燈箱的顯示與隱藏
    function toggleSuccess(card) {
        if (isSuccess.value) {            
            isSuccess.value = false;
            document.body.classList.remove('clicked');
        } else {
            if(card.status == "attend"){
                selectedCard.value = card; //儲存當前哪一張卡         
                isSuccess.value = true;
                document.body.classList.add('clicked');
            }
        }
    }

    // QR code轉換


    // 刪除行程燈箱

</script>