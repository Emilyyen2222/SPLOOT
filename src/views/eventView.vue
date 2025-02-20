<template>
    <!-- <MainHeader theme="blue" bgc=""></MainHeader> -->
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
                    <div class="scheduleBtn" @click="toggleAddEvent" v-if="activeCard === 'splooter'">
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
                        <Btn btnType="event" :btnStyle="card.status" @click="isEditOrSuccess(card)">{{ btnText[card.status] }}</Btn>
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
                        <Btn btnStyle="primary default" @click="successPopOff">確定</Btn>
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
            <div class="newEventBtn" v-if="editMode">
                    <Btn btnStyle="primary small" @click="updateCard">儲存</Btn>
                    <Btn btnStyle="baseline small" @click="toggleAddEvent">取消修改</Btn>
                    <Btn btnStyle="baseline small cancel" @click="checkCancel(false)">刪除貼文</Btn>
            </div>
            <div class="newEventBtn" v-else>
                    <Btn btnStyle="primary small" @click="submitCard">提交</Btn>
                    <Btn btnStyle="baseline small" @click="toggleAddEvent">取消</Btn>
            </div>
        </div>
    </LightBox>
    <!-- 確認刪除popup -->
        <PopUp
        :is-pop-up="isCancel"
        >
        <div class="checkAgain">
            <p class="bold">你真的要刪除行程嗎？</p>
            <Btn btnStyle="primary small" @click="checkCancel(true)">確定</Btn>
            <Btn btnStyle="baseline small cancel" @click="checkCancel(false)">取消</Btn>
        </div>
    </PopUp>

    <MainFooter></MainFooter>
</template>

<script setup>
    import { ref, onMounted, computed, watch } from 'vue';
    import { useAuthStores } from '@/stores/AuthBoxStores.js';  
    import QRcode from 'qrcode.vue'
    
    import MainHeader from "@/components/MainHeader.vue";
    import Btn from '@/components/Btn.vue';
    import Calendar from '@/components/Calendar.vue'
    import MainFooter from "@/components/MainFooter.vue"
    import LightBox  from "../components/LightBox.vue"
    import InputText from '@/components/InputText.vue';
    import DropdownMenu from "@/components/DropdownMenu.vue";
    import PopUp from "@/components/PopUp.vue"

    //登入狀態
    const authBoxStore = useAuthStores();

    //data
    const cardsRawData = ref([]);


    // popup選擇的卡片
    const selectedCard = ref([]); 

    
    //switch篩選器過濾後的陣列
    const filterData = computed(() => {
        return cardsRawData.value.filter(card => card.type === activeCard.value);
    })
    

    const btnText = ref({
        attend : "參加",
        edit : "編輯",
        registered : "取消參加",
        disable : "已額滿",
    });

    // switch分類篩選
    const activeCard = ref('official');

    const setActive = (cardType) => {
        activeCard.value = cardType;
        console.log(activeCard.value);
    };

    //日曆點選以及載入時間渲染
    const isDateObject = async (touchedDate) => {
        await findAllEventsPhp();
        const targetDate = new Date(touchedDate);
        targetDate.setHours(0, 0, 0, 0); // 使時間變成 00:00 以防時間差比較錯誤 只比較年月日

        //回傳若非數字則出現錯誤警告
        if (isNaN(targetDate.getTime())) {
            alert(`無效的日期格式:${touchedDate}`);
            console.error("無效的日期格式:", touchedDate);
            return;
        }

        console.log("選擇的日期:", targetDate.toLocaleDateString("zh-TW"));  //選擇日期 YYY/M/D 本地時間

        // 檢查allEventsRawData資料
        if (!cardsRawData.value || !Array.isArray(cardsRawData.value)) {
            alert(`${cardsRawData.value}無效或不是陣列`);
            console.error("cardsRawData.value 無效或不是陣列");
            return;
        }

        // 資料過濾
        const filteredData = cardsRawData.value.filter(d => {

            //資料缺少開始時間或是結束時間
            if (!d.startTime || !d.endTime) {
                console.warn("缺少 startTime 或 endTime");
                return false;
            }
            
            // 確保日期格式正確，開始時間設定為00:00:00，結束時間設定為23:59:59
            const startDate = new Date(`${d.startTime.year}-${d.startTime.month.padStart(2, '0')}-${d.startTime.day.padStart(2, '0')}T00:00:00`);
            const endDate = new Date(`${d.endTime.year}-${d.endTime.month.padStart(2, '0')}-${d.endTime.day.padStart(2, '0')}T23:59:59`);
            
            return startDate <= targetDate && endDate >= targetDate;
        });

        cardsRawData.value = filteredData.sort((a, b) => {
            const dataA = new Date(`${a.startTime.year}-${a.startTime.month.padStart(2, '0')}-${a.startTime.day.padStart(2, '0')}`);
            const dataB = new Date(`${b.startTime.year}-${b.startTime.month.padStart(2, '0')}-${b.startTime.day.padStart(2, '0')}`);
            return dataA - dataB;
        });

        console.log("篩選後的 cardsRawData:", cardsRawData.value);
    };

    const filterScheduleCard = (day) => {
        if(authBoxStore.isLoggedIn){
            const selectdate = day.date;
            isDateObject(selectdate);
        }else{
            authBoxStore.toggleAuthBox();
        };
    };

    // 預設篩選今天的活動
    onMounted(() => {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2,'0');
        const day = String(today.getDate()).padStart(2,'0');
        // 格式化為 YYYY-MM-DD
        const todayString = `${year}-${month}-${day}`;
        isDateObject(todayString);
    });

    //卡片開始時間～結束時間 物件
    function getTimeObject(theTime){
        return `${theTime.year}年 ${theTime.month}月 ${theTime.day}日 ${theTime.time}`;
    }

    // －－－－－以下為各式燈箱－－－－－－－

    //--------------新增貼文燈箱-------------
    const editMode = ref(false); //新增貼文以及編輯貼文按鈕模式變更

    // 燈箱標題請輸入
    const addEventTitle = {title: "發起活動"}

    //燈箱狀態
    let isAddEvent = ref(false);

    // 控制燈箱的顯示與隱藏
    function toggleAddEvent() {
        if(authBoxStore.isLoggedIn){
            isAddEvent.value = !isAddEvent.value;
            editMode.value = false; //關閉燈箱切換回新增貼文模式
            // 停止捲軸
            if (isAddEvent.value) {
            document.body.classList.add('clicked');
            } else {
            document.body.classList.remove('clicked');
            }
    
            if((!editMode.value)){
                //清空內容選單 以及提示錯誤
                newEventTitle.value.inputValue='';
                newEventTitle.value.inputError = false;
                newEventContent.value.inputValue='';
                newEventContent.value.inputError = false;
                peopleNumber.value.inputValue='';
                peopleNumber.value.inputError = false;
                activePlace.value.inputValue='';
                activePlace.value.inputError = false;
                startTimeD.value.menuValue = '';
                endTimeD.value.menuValue = '';
                startTimeY.value.placeHolder = '年';
                startTimeM.value.placeHolder = '月';
                startTimeD.value.placeHolder = '日';
                startTimeH.value.placeHolder = '時';
                startTime.value.placeHolder = '分';
                endTimeY.value.placeHolder = '年';
                endTimeM.value.placeHolder = '月';
                endTimeD.value.placeHolder = '日';
                endTimeH.value.placeHolder = '時';
                endTime.value.placeHolder = '分';
            }
        }else{
            authBoxStore.toggleAuthBox();
        };
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
            // startTimeD.value.menuValue = ""; // 重置選擇
        }
    });

    watch([() => endTimeY.value.menuValue, () => endTimeM.value.menuValue],([newYear,newMonth]) => {
        if(newYear && newMonth){
            const days = getMonthDays(newYear, newMonth);
            endTimeD.value.options = Array.from({length: days},(value, index) => (
                { name: (index + 1).toString().padStart(2,'0')}
            ));
            // endTimeD.value.menuValue = ""; // 重置選擇
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

    //新增
    const submitCard = () => {
        if(submitCheck.value){
            alert('填寫未完成');
        }else if(timeCheck.value){
            alert('開始時間不能大於等於結束時間！');
        }else{
            userCreateEventPhp();
            toggleAddEvent();
        }
    };

    //修改
    const updateCard = () => {
        if(submitCheck.value){
            alert('填寫未完成');
        }else if(timeCheck.value){
            alert('開始時間不能大於等於結束時間！');
        }else{
            updateEventPhp(selectedCard.value.eventId);
            toggleAddEvent();

            console.log(selectedCard.value.eventId);
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
        !endTime.value.menuValue);       
    });

    //開始時間結束時間檢查（結束時間大於開始時間的話為false）
    const timeCheck = computed(() => {
        const start = new Date(startTimeY.value.menuValue,(startTimeM.value.menuValue - 1),startTimeD.value.menuValue,startTimeH.value.menuValue,startTime.value.menuValue);
        const end = new Date(endTimeY.value.menuValue,(endTimeM.value.menuValue - 1),endTimeD.value.menuValue,endTimeH.value.menuValue,endTime.value.menuValue);
         return start >= end;
    });

    //---------------------------------

    // 參加成功燈箱

    //PopUp狀態
    let isSuccess = ref(false);

    // 控制編輯以及參加成功的按鈕（根據按鈕狀態做改變)
 

    // 關閉參加成功popup
    const successPopOff = () => {
        isSuccess.value = false;
        document.body.classList.remove('clicked');
    };

    async function isEditOrSuccess(card) {
        // 參加成功>開啟參加成功popup
        if(authBoxStore.isLoggedIn){
            if(card.status == "attend"){
                selectedCard.value = card; //儲存當前哪一張卡
                // 回傳資料庫更改活動狀態
                isSuccess.value = true;
                document.body.classList.add('clicked');
                // 切換按鈕樣式
                const success = await attendEventPhp(1, card.eventId);
                if(success){
                    card.status = "registered";
                };

                // 編輯>開啟發起活動燈箱
            }else if(card.status === "edit"){
                selectedCard.value = card;
                isAddEvent.value = true;
                editMode.value = true; // 開啟編輯模式
                document.body.classList.add('clicked');
                //card資料匯入燈箱(card 是一般物件)
                newEventTitle.value.inputValue = card.title;
                newEventContent.value.inputValue = card.content;
                peopleNumber.value.inputValue = card.peopleCount;
                activePlace.value.inputValue = card.place;
                startTimeY.value.menuValue = card.startTime.year;
                startTimeY.value.placeHolder = startTimeY.value.menuValue;
                startTimeM.value.menuValue = card.startTime.month;
                startTimeM.value.placeHolder = startTimeM.value.menuValue;
                startTimeD.value.menuValue = card.startTime.day;
                startTimeD.value.placeHolder = startTimeD.value.menuValue;
                startTimeH.value.menuValue = card.startTime.time.split(':')[0];
                startTimeH.value.placeHolder = startTimeH.value.menuValue;
                startTime.value.menuValue = card.startTime.time.split(':')[1];
                startTime.value.placeHolder = startTime.value.menuValue;
                endTimeY.value.menuValue = card.endTime.year;
                endTimeY.value.placeHolder = endTimeY.value.menuValue;
                endTimeM.value.menuValue = card.endTime.month;
                endTimeM.value.placeHolder = endTimeM.value.menuValue;
                endTimeD.value.menuValue = card.endTime.day;
                endTimeD.value.placeHolder = endTimeD.value.menuValue;
                endTimeH.value.menuValue = card.endTime.time.split(':')[0];
                endTimeH.value.placeHolder = endTimeH.value.menuValue;
                endTime.value.menuValue = card.endTime.time.split(':')[1];
                endTime.value.placeHolder = endTime.value.menuValue;
    
                editMode.value = true;
            }else if(card.status == "registered"){
                const success = await attendEventPhp(0, card.eventId);
                if (success) {
                    card.status = "attend";
                }
            }else if(card.status == "disable"){
                return;
            }            
        }else{
            authBoxStore.toggleAuthBox();
        };
    };
    // 刪除行程popup
    const isCancel = ref(false);

    // 確認是否刪除貼文
    const checkCancel = (isComform) => {
        if(isComform){
            if (selectedCard.value) {
                // 移除該行程
                cardsRawData.value = cardsRawData.value.filter(card => card !== selectedCard.value);
                deleteEventPhp(selectedCard.value.eventId);
            }
            toggleAddEvent();
        }
        isCancel.value = !isCancel.value;
    };

    // php

    async function findAllEventsPhp(){
        // 清空陣列
        cardsRawData.value = [];
        const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/findAllEvents.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        });

        try{
            const eventResp = await resp.json();
            if(eventResp['status'] == 'success'){
                const events = eventResp['data'];

                for(let event of events){
                    const startDate = new Date(event['eventStartDate']);
                    const endDate = new Date(event['eventEndDate']);

                    // 判斷是否已額滿
                    let status = event['attendStatus'];
                    if (event['currentParticipants'] >= event['capacity']) {
                        status = "disable"; // 設為已額滿
                    }
                    
                    cardsRawData.value.push(
                        {
                            eventId: event['eventId'],
                            title: event['title'],
                            content: event['description'],
                            peopleCount: String(event['capacity']),
                            startTime: {
                                year: String(startDate.getFullYear()),
                                month: String(startDate.getMonth() + 1),
                                day: String(startDate.getDate()),
                                time: event['timeStart']
                            },
                            endTime: {
                                year: String(endDate.getFullYear()),
                                month: String(endDate.getMonth() + 1),
                                day: String(endDate.getDate()),
                                time: event['timeEnd']
                            },
                            place: event['location'],
                            type: event['eventType'],
                            status: event['attendStatus'],
                            organizer: {
                                avatar: authBoxStore.memberPortrait(event['userPortrait']),
                                name: event['nameShown'],
                                line: event['lindId']
                            }
                        }
                    );
                }
            }else if(eventResp['status'] == 'error'){
                console.log(eventResp['message']);
            }
        } catch (error){
            console.error('Error parsing JSON:', error);
        }
        cardsRawData.value.sort((a, b) => {
            const dataA = new Date(`${a.startTime.year}-${a.startTime.month.padStart(2, '0')}-${a.startTime.day.padStart(2, '0')}`);
            const dataB = new Date(`${b.startTime.year}-${b.startTime.month.padStart(2, '0')}-${b.startTime.day.padStart(2, '0')}`);
            return dataA - dataB;
        });
    }
    // findAllEventsPhp();
    console.log(cardsRawData.value);

    // attend: 1 是參加 ,0是不參加
    async function attendEventPhp(attend, eventId){

        const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/attendEvent.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                eventId: eventId,
                attendStatus: attend
            }),
        });

        try{
            const attendResp = await resp.json();
            if(attendResp.status == 'success'){
                // 把參加狀態改成 registered / attend
                return true;
            }else if(attendResp.status == 'error'){
                return false;
            }
        }catch(error){
            console.error('Error parsing JSON:', error);
        }
    }
    // attendEventPhp(0,2); // user 不參加 event_id = 2
    // attendEventPhp(1,2); // user 參加 event_id = 2 

    // update = 'System' 代表是會員更新的
    async function updateEventPhp(eventId, updater = 'System'){

        const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/updateEvent.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                eventId: eventId,
                title: newEventTitle.value.inputValue,
                eventStartDate: `${startTimeY.value.menuValue}-${startTimeM.value.menuValue}-${startTimeD.value.menuValue} 00:00:00`,
                timeStart: `${startTimeH.value.menuValue}:${startTime.value.menuValue}`,
                eventEndDate: `${endTimeY.value.menuValue}-${endTimeM.value.menuValue}-${endTimeD.value.menuValue} 00:00:00`,
                timeEnd: `${endTimeH.value.menuValue}:${endTime.value.menuValue}`,
                location: activePlace.value.inputValue,
                description: newEventContent.value.inputValue,
                capacity: peopleNumber.value.inputValue,
                fullCapacity : 0,
                contact: '',
                updater: updater
            }),
        });

        try{
            const eventUpdate = await resp.json();
            if(eventUpdate.status == 'success'){
                
            }else if(eventUpdate.status == 'error'){
                console.log(eventUpdate.message);
            }
        }catch(error){
            console.error('Error parsing JSON:', error);
        }
        findAllEventsPhp();//重新渲染
    }

    async function userCreateEventPhp(){
        const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/userCreateEvent.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                title: newEventTitle.value.inputValue,
                eventStartDate: `${startTimeY.value.menuValue}-${startTimeM.value.menuValue}-${startTimeD.value.menuValue} 00:00:00`,
                timeStart: `${startTimeH.value.menuValue}:${startTime.value.menuValue}`,
                eventEndDate: `${endTimeY.value.menuValue}-${endTimeM.value.menuValue}-${endTimeD.value.menuValue} 00:00:00`,
                timeEnd: `${endTimeH.value.menuValue}:${endTime.value.menuValue}`,
                location: activePlace.value.inputValue,
                description: newEventContent.value.inputValue,
                capacity: peopleNumber.value.inputValue,
                fullCapacity : 0,
                contact: '',
            }),
        });

        try{
            const eventCreated = await resp.json();
            if(eventCreated.status == 'success'){
                console.log(eventCreated);
            }else if(eventCreated.status == 'error'){
                console.log(eventCreated.message);
            }
        }catch(error){
            console.error('Error parsing JSON:', error);
        }
        findAllEventsPhp();//重新渲染
        cardsRawData.value.sort((a, b) => {
            const dataA = new Date(`${a.startTime.year}-${a.startTime.month.padStart(2, '0')}-${a.startTime.day.padStart(2, '0')}`);
            const dataB = new Date(`${b.startTime.year}-${b.startTime.month.padStart(2, '0')}-${b.startTime.day.padStart(2, '0')}`);
            return dataA - dataB;
        });
    }
    // userCreateEventPhp();


    async function deleteEventPhp(eventId, updater = 'System'){
        const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/deleteEvent.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                eventId: eventId,
                updater: updater
            }),
        });

        try{
            const eventDeleted = await resp.json();
            if(eventDeleted.status == 'success'){
                console.log(eventDeleted);
            }else if(eventDeleted.status == 'error'){
                console.log(eventDeleted.message);
            }
        }catch(error){
            console.error('Error parsing JSON:', error);
        }
    }
    // deleteEventPhp(8);

</script>