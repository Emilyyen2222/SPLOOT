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
                        <Btn btnType="event" :btnStyle="card.status">{{ btnText[card.status] }}</Btn>
                    </li>              
                </ul>
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
                        :hasError="newEventTitle.inputError.value"
                        v-model="newEventTitle.inputValue.value">
                    </InputText>
                </div>
                <div class="newEventContent">
                    <InputText 
                        :placeHolder="newEventContent.placeHolder"
                        :errorMsg="newEventContent.errorMsg"
                        :hasError="newEventContent.inputError.value"
                        v-model="newEventContent.inputValue.value">
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
                        :hasError="peopleNumber.inputError.value"
                        v-model="peopleNumber.inputValue.value">
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
                                    v-model="startTimeY.menuValue.value">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown startTimeM"
                                    :placeHolder="startTimeM.placeHolder"
                                    :options="startTimeM.options"
                                    v-model="startTimeM.menuValue.value">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown startTimeD"
                                    :placeHolder="startTimeD.placeHolder"
                                    :options="startTimeD.options"
                                    v-model="startTimeD.menuValue.value">
                                </DropdownMenu>
                            </div>
                        </div>
                        <div class="backBox theTimeBox">
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown startTimeH"
                                    :placeHolder="startTimeH.placeHolder"
                                    :options="startTimeH.options"
                                    v-model="startTimeH.menuValue.value">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown startTime"
                                    :placeHolder="startTime.placeHolder"
                                    :options="startTime.options"
                                    v-model="startTime.menuValue.value">
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
                                    v-model="endTimeY.menuValue.value">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown endTimeM"
                                    :placeHolder="endTimeM.placeHolder"
                                    :options="endTimeM.options"
                                    v-model="endTimeM.menuValue.value">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown endTimeD"
                                    :placeHolder="endTimeD.placeHolder"
                                    :options="endTimeD.options"
                                    v-model="endTimeD.menuValue.value">
                                </DropdownMenu>
                            </div>
                        </div>
                        <div class="backBox theTimeBox">
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown endTimeH"
                                    :placeHolder="endTimeH.placeHolder"
                                    :options="endTimeH.options"
                                    v-model="endTimeH.menuValue.value">
                                </DropdownMenu>
                            </div>
                            <div class="dropdownMenu">
                                <DropdownMenu 
                                    class="dropDown endTime"
                                    :placeHolder="endTime.placeHolder"
                                    :options="endTime.options"
                                    v-model="endTime.menuValue.value">
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
                        :hasError="activePlace.inputError.value"
                        v-model="activePlace.inputValue.value">
                    </InputText>
                </div>
            </div>
            <div class="newEventBtn">
                    <Btn btnStyle="primary small">提交</Btn>
                    <Btn btnStyle="baseline small" @click="toggleAddEvent">取消</Btn>
            </div>
        </div>



    </LightBox>

    <MainFooter></MainFooter>
</template>

<script setup>
    import { ref, onMounted, computed, watch } from 'vue';
    
    import MainHeader from "@/components/MainHeader.vue";
    import Btn from '@/components/Btn.vue';
    import Calendar from '@/components/Calendar.vue'
    import MainFooter from "@/components/MainFooter.vue"
    import LightBox  from "../components/LightBox.vue"
    import InputText from '@/components/InputText.vue';
    import DropdownMenu from "@/components/DropdownMenu.vue";



//data
const cardsData = ref([]);
const filterData = computed(() => {
    return cardsData.value.filter(card => card.type === activeCard.value);

})

const cardsRawData = ref([
{
    title: "聖誕節Splooter聚餐",
    content: "帶著你的毛孩們一起和我們Splooter共襄盛舉吧~現場有精美聖誕禮物喔!!",
    peopleCount: "45",
    startTime: {
        year: "2025",
        month: "12",
        day: "25",
        time: '18:30'
    },
    endTime: {
        year: "2025",
        month: "12",
        day: "25",
        time: '21:30'
    },
    place: "台北市信義區信義路五段7號86樓 (饗 A Joy)",
    type: "official",
    status: "attend",
}, 
{
    title: "我們的暗號是爆炸頭軍曹GOGOGO~~",
    content: "帶著藍星的毛孩子們跟我們一起參加征服藍星路跑吧～～！",
    peopleCount: "不限",
    startTime: {
        year: "2025",
        month: "02",
        day: "27",
        time: '07:00'
    },
    endTime: {
        year: "2025",
        month: "02",
        day: "28",
        time: '11:30'
    },
    place: "二二八公園集合",
    type: "official",
    status: "attend",
},
{
    title: "心臓を捧げよ！三天兩夜豪華郵輪寵物派對",
    content: "目標石垣島，帶著毛孩們一起出國吧！",
    peopleCount: "80",
    startTime: {
        year: "2025",
        month: "02",
        day: "5",
        time: '08:30'
    },
    endTime: {
        year: "2025",
        month: "02",
        day: "28",
        time: '22:00'
    },
    place: "基隆港",
    type: "official",
    status: "registered",
},
{
    title: "英雄毛孩Cosplay比賽",
    content: "Splooter與毛孩們選擇喜歡的英雄角色來進行Cosplay,一同化身成正義的夥伴吧！",
    peopleCount: "60",
    startTime: {
        year: "2025",
        month: "02",
        day: "05",
        time: '09:30'
    },
    endTime: {
        year: "2025",
        month: "02",
        day: "20",
        time: '15:50'
    },
    place: "緯育Tibame台北職訓中心",
    type: "official",
    status: "disable",        
},
{
        title: "毛孩電影之夜",
        content: "大螢幕、爆米花，還有最愛的毛孩陪伴，一起享受電影之夜吧！",
        peopleCount: "55",
        startTime: {
            year: "2025",
            month: "03",
            day: "12",
            time: "06:46"
        },
        endTime: {
            year: "2025",
            month: "03",
            day: "12",
            time: "10:11"
        },
        place: "基隆海洋廣場",
        type: "official",
        status: "registered"
    },
    {
        title: "寵物飛盤挑戰賽",
        content: "測試你的毛孩接飛盤的技巧，一起來場激烈的比賽吧！",
        peopleCount: "15",
        startTime: {
            year: "2025",
            month: "03",
            day: "23",
            time: "06:39"
        },
        endTime: {
            year: "2025",
            month: "03",
            day: "29",
            time: "09:29"
        },
        place: "大安森林公園",
        type: "official",
        status: "attend"
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
        status: "attend"
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
        status: "attend"
    },
    {
        title: "毛孩時裝秀",
        content: "讓毛孩穿上最時尚的服飾，一起來場可愛的時裝秀吧！",
        peopleCount: "45",
        startTime: {
            year: "2025",
            month: "02",
            day: "19",
            time: "04:50"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "25",
            time: "01:37"
        },
        place: "台北動物園",
        type: "official",
        status: "registered"
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
        status: "attend"
    },
    {
        title: "毛孩露營日",
        content: "大自然、篝火與毛孩的陪伴，快來參加我們的戶外露營活動！",
        peopleCount: "55",
        startTime: {
            year: "2025",
            month: "02",
            day: "09",
            time: "16:33"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "15",
            time: "15:19"
        },
        place: "台中中央公園",
        type: "official",
        status: "attend"
    },
    {
        title: "寵物攝影工作坊",
        content: "學習如何拍出超可愛的寵物照片，專業攝影師親自指導！",
        peopleCount: "10",
        startTime: {
            year: "2025",
            month: "02",
            day: "20",
            time: "23:22"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "24",
            time: "17:29"
        },
        place: "高雄駁二藝術特區",
        type: "splooter",
        status: "attend"
    },
    {
        title: "寵物飛盤挑戰賽",
        content: "測試你的毛孩接飛盤的技巧，一起來場激烈的比賽吧！",
        peopleCount: "10",
        startTime: {
            year: "2025",
            month: "02",
            day: "05",
            time: "18:47"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "23",
            time: "20:25"
        },
        place: "基隆海洋廣場",
        type: "splooter",
        status: "attend"
    },
    {
        title: "毛孩瑜珈日",
        content: "來一場寧靜與身心平衡的瑜珈體驗吧！帶著毛孩一起感受身心舒展的樂趣~",
        peopleCount: "10",
        startTime: {
            year: "2025",
            month: "02",
            day: "21",
            time: "21:11"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "27",
            time: "19:10"
        },
        place: "花博公園",
        type: "splooter",
        status: "edit"
    },
    {
        title: "哈哈哈哈",
        content: "哈哈哈哈哈哈",
        peopleCount: "2",
        startTime: {
            year: "2025",
            month: "02",
            day: "15",
            time: "21:11"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "28",
            time: "19:10"
        },
        place: "哈哈哈哈哈",
        type: "official",
        status: "attend"
    },
    {
        title: "忍者培訓",
        content: "忍者 是指忍人所不能忍的",
        peopleCount: "10",
        startTime: {
            year: "2025",
            month: "02",
            day: "15",
            time: "21:11"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "28",
            time: "19:10"
        },
        place: "木葉忍者村",
        type: "official",
        status: "attend"
    },
    {
        title: "毛小孩你好",
        content: "你好你好你好",
        peopleCount: "8",
        startTime: {
            year: "2025",
            month: "02",
            day: "15",
            time: "21:11"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "28",
            time: "19:10"
        },
        place: "台北101",
        type: "splooter",
        status: "attend"
    },
    {
        title: "哥布林團結",
        content: "我是哥布林",
        peopleCount: "100",
        startTime: {
            year: "2025",
            month: "02",
            day: "15",
            time: "21:11"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "28",
            time: "19:10"
        },
        place: "哥布林巢穴",
        type: "splooter",
        status: "disable"
    },
    {
        title: "精靈聚會",
        content: "我們反對哥布林",
        peopleCount: "10",
        startTime: {
            year: "2025",
            month: "02",
            day: "15",
            time: "21:11"
        },
        endTime: {
            year: "2025",
            month: "02",
            day: "28",
            time: "19:10"
        },
        place: "精靈之森",
        type: "splooter",
        status: "attend"
    },
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

    //開始時間～結束時間 物件
    function getTimeObject(theTime){
        return `${theTime.year}年 ${theTime.month}月 ${theTime.day}日 ${theTime.time}`;
    }

    // －－－－－以下為各式燈箱－－－－－－－

    //--------------新增貼文燈箱-------------
    // 燈箱標題請輸入
    const addEventTitle = {title: "發起活動"}

    //燈箱狀態
    let isAddEvent = ref(true);

    // 控制燈箱的顯示與隱藏
    function toggleAddEvent() {
    isAddEvent.value = !isAddEvent.value;
    // 停止捲軸
    if (isAddEvent.value) {
    document.body.classList.add('clicked');
    } else {
    document.body.classList.remove('clicked');
    }
    }

    // ------------新增貼文輸入以及下拉式選單-------------

    const newEventTitle = {
    placeHolder: '標題',
    errorMsg: '未輸入標題',
    inputValue: ref(''),
    inputError: ref(false),
    }

    const newEventContent = {
    placeHolder: '內文',
    errorMsg: '未輸入內文',
    inputValue: ref(''),
    inputError: ref(false),
    }

    const peopleNumber = {
    placeHolder: '人數',
    errorMsg: '未輸入人數',
    inputValue: ref(''),
    inputError: ref(false),
    }

    const activePlace = {
    placeHolder: '地點',
    errorMsg: '未輸入地點',
    inputValue: ref(''),
    inputError: ref(false),
    }

    //下拉式選單

    const currentYear = new Date().getFullYear(); //抓取今年

    // 取得當月天數
    const getMonthDays = (year, month) => {
        return new Date(year, month, 0).getDate();
    };

    // 年
    const startTimeY = {
        placeHolder: '年',
        options: Array.from({length: 6}, (value,index) => ({name: currentYear + index})),
        menuValue: ref('')
    };
    const endTimeY = {
        placeHolder: '年',
        options: Array.from({length: 6}, (value,index) => ({name: currentYear + index})),
        menuValue: ref('')
    };

    // 月
    const startTimeM = {
        placeHolder: '月',
        options: Array.from({length:12}, (value,index) => ({name: index + 1})),
        menuValue: ref('')
    };
    const endTimeM = {
        placeHolder: '月',
        options: Array.from({length: 12}, (value,index) => ({name: index + 1})),
        menuValue: ref('')
    };

    // 日
    const startTimeD = {
        placeHolder: '日',
        options: [],
        menuValue: ref('')
    };
    const endTimeD = {
        placeHolder: '日',
        options: [],
        menuValue: ref('')
    };

    //監聽下拉式選單變化（年和月）
    watch([startTimeY.menuValue, startTimeM.menuValue],([newYear,newMonth]) => {
        if(newYear && newMonth){
            const days = getMonthDays(newYear, newMonth);
            startTimeD.options = Array.from({length: days},(value, index) => {
                return index <= 9 ? {name: `0${index + 1}`} : {name: index + 1}
            })
            startTimeD.menuValue.value = ""; // 重置選擇
        }
    });

    watch([endTimeY.menuValue, endTimeM.menuValue],([newYear,newMonth]) => {
        if(newYear && newMonth){
            const days = getMonthDays(newYear, newMonth);
            endTimeD.options = Array.from({length: days},(value, index) => {
                return index <= 9 ? {name: `0${index + 1}`} : {name: index + 1}
            })
            endTimeD.menuValue.value = ""; // 重置選擇
        }
    });

    // 時
    const startTimeH = {
        placeHolder: '時',
        options: Array.from({length:24},(value, index) => {
          return index <= 9 ? {name: `0${index}`} : {name:index}
        }),
        menuValue: ref('')
    };
    const endTimeH = {
        placeHolder: '時',
        options: Array.from({length: 24},(value, index) => {
          return index <= 9 ? {name: `0${index}`} : {name:index}
        }),
        menuValue: ref('')
    };

    // 分
    const startTime = {
        placeHolder: '分',
        options: Array.from({length: 6}, (value, index) => {
           return index == 0 ? {name: "00"} : {name: index * 10}
        }),
        menuValue: ref('')
    };
    const endTime = {
        placeHolder: '分',
        options: Array.from({length: 6}, (value, index) => {
           return index == 0 ? {name: "00"} : {name: index * 10}
        }),
        menuValue: ref('')
    };

    //---------------------------------

    // 參加成功燈箱

    // 刪除行程燈箱

</script>
