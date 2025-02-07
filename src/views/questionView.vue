<template>
<MainHeader theme="red" bgc=""></MainHeader>

<!-- question 1--->
<div v-if="question==1" class="box firstBox">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩叫什麼名字？</h4>
        <div class="options">
            <div class="first">
            <InputText placeHolder="毛孩姓名" textAlign="textCenter" errorMsg="Invalid Input" 
            v-model="q1input" :hasError="false">
            </InputText>
            </div>
            <Btn v-for="option in questionPet.options" :key="option"
            btnType="form" btnStyle="option" 
            :class="{'-active': optionSelected(questionPet.selected, option)}"
            @click="questionPet.formChoice(questionPet.selected, option)">{{ option }}</Btn>
        </div>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(q1input != '' 
        && questionPet.selected.value.length != 0 )">下一題</Btn> 
    </div>
     
</div>
<!------------------------ question2 貓---------------------->
<div v-if="question==2"  class="box firstBox">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是哪種體型？</h4>
        <div class="options">
            <!-- <Btn btnType="form" btnStyle="option">幼貓</Btn>
            <Btn btnType="form" btnStyle="option">成貓</Btn> -->
            <Btn v-for="option in q2Form.options" :key="option"
            btnType="form" btnStyle="option" 
            :class="{'-active': optionSelected(q2Form.selected, option)}"
            @click="q2Form.formChoice(q2Form.selected, option)">{{ option }}</Btn>
        </div>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(q2Form.selected.value.length != 0)">下一題</Btn> 
        <Btn class="" btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn> 
    </div>
</div>
<!------------------------ question 2狗---------------------->
<!-- <div v-if="question==2 && pet=='dog'" class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是哪種體型？</h4>
        <div class="options">
            <Btn v-for="option in q2Form.options" :key="option"
            btnType="form" btnStyle="option" 
            :class="{'-active': optionSelected(q2Form.selected, option)}"
            @click="q2Form.formChoice(q2Form.selected, option)">{{ option }}</Btn>
        </div>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(q2Form.selected.value.length != 0)">下一題</Btn> 
        <Btn class="borderBottom" btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn> 
    </div>
</div> -->
<!------------------------ question 3---------------------->
<div v-if="question==3" class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是什麼品種？</h4>
        <div class="options">
            <div class="dropdownMenu">
                <DropdownMenu class="dropDown city" size="large"
                    :placeHolder="q3Menu.placeHolder" 
                    :options="q3Menu.options"
                    v-model="q3Menu.menuValue">
                </DropdownMenu>
            </div>
        </div>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(q3Menu.menuValue.value != '')">下一題</Btn> 
        <Btn class="borderBottom" btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn> 
    </div>
</div>
<!------------------------ question 4---------------------->
<div v-if="question==4" class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩生日是？</h4>
        <div class="options date">
            <div class="smallText">領養的日期也可以喔！<br> 我們希望可以幫您的毛孩一起慶祝這特別的日子！</div>
                <div class="birthday">
                    <div class="year dropdownMenu">
                        <DropdownMenu class="dropDown city" size="large"
                        :placeHolder="menus.year.placeHolder"
                        :options="menus.year.options"
                        v-model="menus.year.menuValue">
                        </DropdownMenu>
                    </div>
                    <div class="month dropdownMenu">
                        <DropdownMenu class="dropDown city" size="large"
                        :placeHolder="menus.month.placeHolder"
                        :options="menus.month.options"
                        v-model="menus.month.menuValue">
                        </DropdownMenu>
                    </div>
                    <div class="date dropdownMenu">
                        <DropdownMenu class="dropDown city" size="large"
                        :placeHolder="menus.day.placeHolder"
                        :options="menus.day.options"
                        v-model="menus.day.menuValue">
                        </DropdownMenu> 
                    </div>
                </div>
        </div>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(true)">下一題</Btn> 
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn> 
    </div>
</div>
<!-- Question 5 -->
<div v-if="question==5" class="box">
    <div class="questionContainer">
        <h4 class="title bold">請輸入您的Email</h4>
        <div class="options">
            <div class="">
            <InputText placeHolder="Email" textAlign="textCenter" errorMsg="請輸入正確的 email 格式" 
            v-model="emailInput" :hasError="emailError">
            </InputText>
            </div>
            <div class="quickLogin">
                <div class="">已經有帳號？</div>
                <Btn class="check" btnStyle="baseline small">立即登入</Btn>
            </div>
        </div>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(emailError == false)">下一題</Btn> 
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn> 
    </div>
</div>
<!-- Question6 -->
<div v-if="question==6" class="boxSub">
    <div class="questionContainer">
        <h4 class="title bold">為您的毛孩選擇一個方案等級</h4>
        <div class="container">
                <div class="card" 
                :class="{'-active': subSelected == '銀卡'}"
                @click="subToggle('銀卡')">
                    <div class="content">
                        <h6 class="title">銀卡</h6>
                        <div class="boxDivider"></div>
                        <ul class="planItems">
                            <li class="smallText">精選功能玩具 x1</li>
                            <li class="smallText">天然原肉零食 x1</li>
                            <li class="smallText">必備日用品<span class="xsText">（如便攜式飲水器或小型毛巾）</span></li>
                        </ul>
                        <ul class="planText">
                            <li class="smallText">適合對象：</li>
                            <li class="smallText">初次體驗者，讓毛孩嘗試 Sploot Box 的基本樂趣！</li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                </div>
                <div class="card"
                :class="{'-active': subSelected == '金卡'}"
                @click="subToggle('金卡')">
                    <div class="content">
                        <h6 class="title">金卡</h6>
                        <div class="boxDivider"></div>
                        <ul class="planItems">
                            <li class="smallText">高互動功能玩具 x2</li>
                            <li class="smallText">原肉健康零食 x2</li>
                            <li class="smallText">必備日用品<span class="xsText">（如寵物洗毛精、耳朵清潔用品）</span></li>
                            <li class="smallText">免費加入會員獨享活動資格</li>
                        </ul>
                        <ul class="planText">
                            <li class="smallText">適合對象：</li>
                            <li class="smallText">需要更多寵物用品、愛好玩具的活潑毛孩！</li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                </div>
                <div class="card popular"
                :class="{'-active': subSelected == '白金卡'}"
                @click="subToggle('白金卡')">
                    <div class="content">
                        <h6 class="title">白金卡</h6>
                        <div class="boxDivider"></div>
                        <ul class="planItems">
                            <li class="smallText">全套高互動玩具 x3</li>
                            <li class="smallText">豪華版原肉零食組 x3</li>
                            <li class="smallText">高級寵物日用品<span class="xsText">如牙膏牙刷組、耳護清潔液）</span></li>
                            <li class="smallText">獨家驚喜禮物 x1</li>
                            <li class="smallText red">專屬服務：免費諮詢小幫手專區</li>
                        </ul>
                        <ul class="planText">
                            <li class="smallText">適合對象：</li>
                            <li class="smallText">追求全方位照護及豐富體驗的毛孩與飼主！</li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                </div>
            </div>
        <div class="subBtn">
            <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(subSelected != '')">下一題</Btn> 
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn>  
        </div> 
    </div>
</div>
<!-- Question7 -->
<div v-if="question==7" class="boxSubPlan">
    <div class="questionContainer">
        <h4 class="title bold">為您的毛孩選擇一個訂閱週期</h4>
        <div class="container">
                <!-- <div class="card"
                :class="{'-active': subSelected == '單次體驗'}"
                @click="subToggle('單次體驗')">
                    <div class="image">
                        <img src="@/assets/img/icon/giftIcon.svg"  alt="">
                    </div>
                    <h6 class="times">x1</h6>
                    <h6 class="subMonths">單次體驗</h6>
                    <h6 class="price">＄799</h6>
                </div> -->
                <div v-for="plan in filteredPlans" :key="plan.label"
                class="card"
                :class="[{'-active': planSelected == plan.label}, 
                {'popular': plan.label == '12個月'}]"
                @click="planSelected = plan.label">
                    <div class="image">
                        <img src="@/assets/img/icon/giftIcon.svg"  alt="">
                    </div>
                    <h6 class="times">{{ plan.times }}</h6>
                    <h6 class="subMonths">{{ plan.label }}</h6>
                    <h6 class="price">{{ "$" + plan.price.toLocaleString() }}</h6>

                </div>
                <!-- <div class="card popular"
                :class="{'-active': subSelected == '12個月'}"
                @click="subToggle('12個月')">
                    <div class="image">
                        <img src="@/assets/img/icon/giftIcon.svg"  alt="">
                    </div>
                    <h6 class="times">x12</h6>
                    <h6 class="subMonths">12個月</h6>
                    <h6 class="price">＄7,128</h6>
                </div> -->
            </div>
        <div class="subBtn">
            <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(planSelected != '')">下一題</Btn> 
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn> 
        </div> 
    </div>
</div>
<!---question 8---->
<div v-if="question==8" class="box">
    <div class="questionContainer">
        <h4 class="title bold">選擇收貨地點</h4>
        <div class="options date">
                <!-- <div class=""> -->
                    <div class="dropdownMenu">
                    <DropdownMenu size="large" class="dropDown city"
                        :placeHolder="city.placeHolder"
                        :options="city.options"
                        v-model="selectedCity">
                    </DropdownMenu>
                    </div>
                    <div class="dropdownMenu">
                    <DropdownMenu size="large" class="dropDown district"
                        :placeHolder="districtPlaceHolder"
                        :options="districtsOptions"
                        v-model="selectDistrict"
                        :key="selectedCity">
                    </DropdownMenu>
                    </div>
                    <!-- <div class="first"> -->
                    <div class="dropdownMenu">
                    <InputText textAlign="textLeft" class="address" placeHolder="收貨地址" errorMsg="Invalid Input" 
                    v-model="q8input" :hasError="false">
                    </InputText>
                    </div>
                    <!-- </div> -->
                <!-- </div> -->
        </div>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(
            selectedCity.value != '' 
        && selectDistrict.value != '' 
        && q8input != '')">下一題</Btn> 
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn>  
    </div>
</div>
<!-- Question 9 -->
<div v-if="question==9" class="boxPayment">
    <div class="questionContainer">
        <h4 class="title bold">完成購買程序</h4>
        <div class="options">
            <div class="paymentBox">
                <div class="textBox">
                    <p>SPLOOT BOX 
                    {{ periodName[planSelected] }}方案 - {{subSelected}}
                    ({{ planName[subSelected] }})</p> 
                    <p>{{"$" + selectedPrice.toLocaleString() }}</p> 
                </div>
                <div class="boxDivider"></div>
                <div class="textBox">
                    <p>月費</p> 
                    <p>{{"$" + monthlyPrice.toLocaleString() }}</p>

                </div>
                <div class="boxDivider"></div>
                <div class="textBox">
                    <p>今日應付金額</p> 
                    <p>{{"$" + monthlyPrice.toLocaleString()}}</p> 
                </div>
            </div>
            <div class="infoBox">
                <div class="xsText left">信用卡付款</div>
                <InputText size = "small" placeHolder="卡號" errorMsg="請輸入信用卡資訊" 
                v-model="formattedCardNumber" 
                :hasError="creditCardError"
                @input="formatCardNumber">
                </InputText>
                <InputText size = "small" placeHolder="持卡人姓名" errorMsg="請輸入持卡人姓名" 
                v-model="q9Form2" :hasError="inputError">
                </InputText>
                <div class="cardInfo">
                    <div class="info dropdownMenu">
                        <DropdownMenu class="dropDown city"
                        :placeHolder="menus.visaYear.placeHolder"
                        :options="menus.visaYear.options"
                        v-model="q9Form3">
                        </DropdownMenu>
                    </div>
                    <div class="info dropdownMenu">
                        <DropdownMenu class="dropDown city"
                        :placeHolder="menus.visaMonth.placeHolder"
                        :options="menus.visaMonth.options"
                        v-model="q9Form4">
                        </DropdownMenu>
                    </div>
                    <div class="info">
                    <InputText 
                    size = "small" 
                    placeHolder="安全碼" 
                    errorMsg="請輸入3~4位安全碼" 
                    v-model="q9Form5" 
                    :hasError="inputError"
                    @input="validateCVV">
                    </InputText>
                    </div>
                </div>
            </div>
        </div>
            <ul class="planItems">
                <li class="xsText">SHOPLINE將會使用本次交易資訊作為後續定期扣款，點擊提交即同意 《SHOPLINE Payments 支付服務條款》及《SHOPLINE Payments 隱私權政策》。</li>
                <li class="xsText">本金流服務由 SHOPLINE Payments 提供，通過 PCI-DSS 國際信用卡組織最高等級認證，提供安全的交易服務，支援國內外信用卡刷卡。</li>
            </ul>

            <li class="checkBox">
                <div class="boxAlign">
                    <input type="checkbox"
                    v-model="q9Checkbox">
                    <p class="xsText">
                        我同意 
                        <span class="xsText link" href="" @click="togglePolicy">網站服務條款</span> 及 
                        <span class="xsText link" href="" @click="togglePrivacy">隱私權政策</span>
                    </p>
                </div>
                <div class="boxAlign">
                    <input type="checkbox">
                    <p class="xsText">我同意成為 SPLOOT 的會員</p>
                </div>
                <div class="boxAlign">
                    <input type="checkbox">
                    <p class="xsText">我願意接收 SPLOOT 的最新消息、優惠及服務推廣相關資訊</p>
                </div>
            </li>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(
        q9Form1 != '' 
        && q9Form2 != '' 
        && q9Form3 != ''
        && q9Form4 != '' 
        && q9Form5 != ''
        && q9Checkbox != '')">開始訂閱SPLOOT BOX</Btn>  
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn>   
    </div>
</div>
<!-- Question 10 -->
<div v-if="question==10" class="boxFinish">
        <div class="finishBox">
            <h4 class="title bold">感謝您的訂閱</h4>
            <div class="">
                <p>您已成功訂閱SPLOOT BOX <br>
                    {{ periodName[planSelected] }}方案 - {{subSelected}}
                    ({{ planName[subSelected] }})</p>
                <RouterLink to="/">
                    <Btn class="padding" btnType="form" btnStyle="nextQ">回到首頁</Btn>  
                </RouterLink>
            </div>
        </div>
</div>
<!-- 非會員 -->
<div v-if="question==11" class="boxFinish">
        <div class="finishBox">
            <h4 class="title bold">感謝您的訂閱</h4>
            <p>您已成功訂閱SPLOOT BOX 白金卡(Platinum)三個月方案</p>
            <p>請至信箱查閱訂單詳情</p>
            <RouterLink to="/">
                <Btn class="padding" btnType="form" btnStyle="nextQ">回到首頁</Btn>  
            </RouterLink>
        </div>
</div>
<!-- progress bar -->
<ProgressBar :total="9" :current="question" ></ProgressBar>
<!-- circle bg -->
<div class="circleQuestion"></div>

<!-- 網站服務條款 -->
<Policy
    :is-light-box="isLightBoxPolicy" 
    :title="titlePolicy"
    @toggle="togglePolicy"
    policies="policyInfo"
></Policy>
<!-- 隱私權政策 -->
<Policy
    :is-light-box="isLightBoxPrivacy" 
    :title="titlePrivacy"
    @toggle="togglePrivacy"
    policies="privacyInfo"
></Policy>
</template>

<script setup>
    import { ref, watch, computed } from 'vue';
    import MainHeader from "../components/MainHeader.vue";
    import DropdownMenu from "../components/DropdownMenu.vue";
    import Btn from '../components/Btn.vue';
    import InputText from '../components/InputText.vue';
    import ProgressBar from "../components/ProgressBar.vue";
    import Policy from '../components/Policy.vue';

    const question = ref(1);
    const pet = ref('');
    const q1input = ref('');
    const q8input = ref('');
 
    let q2Form;
    let q3Menu;
    const subSelected = ref('');
    let q9Form2 = '';
    let q9Form3 = '';
    let q9Form4 = '';
    let q9Checkbox = '';

    function subToggle(card){
        subSelected.value = (card);
    };
    // 下一題按鈕
    function nextQuestion(bol = false) {
    if (bol == true) {
        question.value++;
    } else {
        alert("請輸入選項");
    }
    }
    function lastQuestion(){
        question.value--;
    }
    
    const questionPet = {
        formChoice: singleChoice,
        options: ['女生 狗狗', '男生 狗狗', '女生 貓貓', '男生 貓貓'],
        selected: ref([]),
    };
    const questionCat = {
        formChoice: singleChoice,
        options: ['幼貓', '成貓'],
        selected: ref([]),
    };
    const questionDog = {
        formChoice: singleChoice,
        options: ['小型犬', '中型犬', '大型犬'],
        selected: ref([]),
    };
    // question 1 監看是貓咪還是狗狗
    watch(questionPet.selected, (newValue, oldValue) => {
        console.log(questionPet.selected.value[0]);
        if (questionPet.selected.value[0].includes('貓貓')) {
            pet.value = 'cat';
            q2Form = questionCat;
            q3Menu = menus.menuCat;
            console.log(q3Menu);
        } else if(questionPet.selected.value[0].includes('狗狗')) {
            pet.value = 'dog';
            q2Form = questionDog;
            q3Menu = menus.menuDog;
            console.log(q3Menu);
        }
    })

    function singleChoice(selected, option) {
    selected.value = [option];
    // console.log(selected.value);
    }
    function multipleChoice(selected, option) {
        if (optionSelected(selected, option)) {
            selected.value = selected.value.filter(opt => opt !== option);
        } else {
            selected.value.push(option);
        }
        // console.log(selected.value);
    }
    const optionSelected = (selected, option) => {
        return selected.value.includes(option);
    }

    //城市下拉選單  
    //城市選單
    const city = {
        placeHolder: "請選擇城市",
        options: [
        {
          name: "台北市",
          districts: ["中正區", "大同區", "中山區", "松山區", "大安區", "萬華區", "信義區", "士林區", "北投區", "內湖區", "南港區", "文山區"]
        },
        {
          name: "新北市",
          districts: ["板橋區", "新莊區", "中和區", "永和區", "三峡區", "淡水區", "汐止區", "瑞芳區", "土城區", "三峰區", "新店區", "坪林區", "林口區", "蘆洲區", "五股區", "八里區", "深坑區", "三芝區", "石碇區", "高雄區", "板橋區", "瑞金區", "平溪區", "雙溪區", "貢寮區"]
        },
        {
          name: "桃園市",
          districts: ["桃園區", "中壢區", "大溪區", "楊梅區", "蘆竹區", "大園區", "龍潭區", "平鎮區", "八德區", "觀音區", "龜山區", "八德區"]
        },
        {
          name: "台中市",
          districts: ["中區", "東區", "南區", "西區", "北區", "北屯區", "西屯區", "南屯區", "太平區", "大里區", "霧峰區", "烏日區", "豐原區", "后里區", "石岡區", "東勢區", "和平區", "新社區", "潭子區", "大雅區", "神岡區", "大肚區", "沙鹿區", "龍井區", "梧棲區", "清水區", "大甲區", "外埔區", "大安區"]
        },
        {
          name: "台南市",
          districts: ["中西區", "東區", "南區", "北區", "安平區", "安南區", "永康區", "歸仁區", "新化區", "左鎮區", "玉井區", "楠西區", "南化區", "仁德區", "關廟區", "龍崎區", "官田區", "麻豆區", "佳里區", "西港區", "七股區", "將軍區", "學甲區", "北門區", "新營區", "後壁區", "白河區", "東山區", "六甲區", "下營區", "柳營區", "鹽水區", "善化區", "大內區", "新市區", "山上區", "安定區"]
        },
        {
          name: "高雄市",
          districts: ["鹽埕區", "鼓山區", "左營區", "楠梓區", "三民區", "新興區", "前金區", "苓雅區", "前鎮區", "旗津區", "小港區", "鳳山區", "林園區", "大寮區", "大樹區", "大社區", "仁武區", "鳥松區", "岡山區", "橋頭區", "燕巢區", "田寮區", "阿蓮區", "路竹區", "湖內區", "茄萣區", "永安區", "彌陀區", "梓官區", "旗山區", "美濃區", "六龜區", "甲仙區", "杉林區", "內門區", "茂林區", "桃源區", "那瑪夏區"]
        },
        {
          name: "基隆市",
          districts: ["中正區", "七堵區", "暖暖區", "仁愛區", "中山區", "安樂區", "信義區"]
        },
        {
          name: "新竹市",
          districts: ["東區", "北區", "香山區"]
        },
        {
          name: "嘉義市",
          districts: ["東區", "西區"]
        },
        {
          name: "新竹縣",
          districts: ["北區", "香山區", "竹北市", "湖口鄉", "新豐鄉", "芎林鄉", "關西鎮", "五峰鄉", "八里區", "橫山鄉", "峨眉鄉", "寶山鄉", "尖石鄉", "北埔鄉", "横山乡", "竹东镇"]
        },
        {
          name: "苗栗縣",
          districts: ["苗栗市", "苑裡鎮", "通霄鎮", "三義鄉", "卓蘭鎮", "竹南鎮", "大湖鄉", "南庄鄉", "大肚鄉", "頭份市", "獅潭鄉", "西湖鄉", "頭屋鄉", "公館鄉", "銅鑼鄉", "臺中市", "後龍鎮", "造橋鄉"]
        },
        {
          name: "彰化縣",
          districts: ["彰化市", "芬園鄉", "花壇鄉", "秀水鄉", "鹿港鎮", "福興鄉", "線西鄉", "和美鎮", "伸港鄉", "員林市", "社頭鄉", "永靖鄉", "埔心鄉", "溪湖鎮", "大村鄉", "埔鹽鄉", "田中鎮", "北斗鎮", "田尾鄉", "埤頭鄉", "溪州鄉", "竹塘鄉", "二林鎮", "大城鄉", "芳苑鄉", "二水鄉"]
        },
        {
          name: "南投縣",
          districts: ["南投市", "中寮鄉", "草屯鎮", "國姓鄉", "埔里鎮", "仁愛鄉", "名間鄉", "集集鎮", "水里鄉", "魚池鄉", "信義鄉", "竹山鎮", "鹿谷鄉"]
        },
        {
          name: "雲林縣",
          districts: ["斗六市", "斗南鎮", "虎尾鎮", "西螺鎮", "古坑鄉", "大埤鄉", "莿桐鄉", "二崙鄉", "崙背鄉", "麥寮鄉", "臺西鄉", "東勢鄉", "褒忠鄉", "朴子市", "太保市", "布袋鎮"]
        },
        {
          name: "嘉義縣",
          districts: ["嘉義市", "番路鄉", "梅山鄉", "竹崎鄉", "阿里山鄉", "中埔鄉", "大埔鄉", "水上鄉", "鹿草鄉", "太保市", "朴子市", "東石鄉", "六腳鄉", "新港鄉", "民雄鄉", "大林鎮", "溪口鄉", "義竹鄉", "布袋鎮"]
        },
        {
          name: "屏東縣",
          districts: ["屏東市", "三地門鄉", "霧台鄉", "瑪家鄉", "九如鄉", "里港鄉", "高樹鄉", "鹽埔鄉", "長治鄉", "麟洛鄉", "竹田鄉", "內埔鄉", "萬丹鄉", "潮州鎮", "泰武鄉", "來義鄉", "萬巒鄉", "崁頂鄉", "新埤鄉", "南州鄉", "林邊鄉", "東港鎮", "琉球鄉", "佳冬鄉", "新園鄉", "枋山鄉", "滿州鄉"]
        },
        {
          name: "宜蘭縣",
          districts: ["宜蘭市", "頭城鎮", "礁溪鄉", "壯圍鄉", "員山鄉", "羅東鎮", "三星鄉", "大同鄉", "五結鄉", "冬山鄉", "蘇澳鎮", "南澳鄉", "釣魚台"]
        },
        {
          name: "花蓮縣",
          districts: ["花蓮市", "新城鄉", "秀林鄉", "吉安鄉", "壽豐鄉", "鳳林鄉", "光復鄉", "豐濱鄉", "瑞穗鄉", "萬榮鄉", "玉里鎮", "卓溪鄉", "富里鄉"]
        },
        {
          name: "台東縣",
          districts: ["台東市", "綠島鄉", "蘭嶼鄉", "延平鄉", "卑南鄉", "鹿野鄉", "關山鎮", "海端鄉", "池上鄉", "東河鄉", "成功鄉", "長濱鄉", "太麻里鄉", "金峰鄉", "大武鄉", "達仁鄉"]
        },
        {
          name: "金門縣",
          districts: ["金城鎮", "金湖鎮", "金沙鎮", "金寧鄉", "烈嶼鄉", "烏坵鄉"]
        },
        {
          name: "連江縣",
          districts: ["南竿鄉", "北竿鄉", "莒光鄉", "東引鄉"]
        },
      ],   
    };

    let selectedCity = ref(''); //v-model綁定
    let selectDistrict = ref(''); //v-model綁定
    const districtPlaceHolder = ref("請選擇行政區域");

    // 從選擇的城市中尋找他的行政區域 然後以{name: d}物件排列成陣列
    const districtsOptions = computed(() => {
        const cityData = city.options.find((c) => c.name === selectedCity.value);
        return cityData && selectedCity.value !== "全部" ? cityData.districts.map((d) => ({name: d})) : [];
    });

    // 點選新的城市後行政區清空
    watch(selectedCity, () => {        
        selectDistrict.value = ''; 
        districtPlaceHolder.value = "請選擇行政區域";
    });

    const menus = {
        menuCat: {
        placeHolder: '我的貓咪品種是',
        options: [
            { id: 0, name: '美短（美國短毛貓）' },
            { id: 1, name: '英短（英國短毛貓）' },
            { id: 2, name: '緬因貓' },
            { id: 3, name: '布偶貓' },
            { id: 4, name: '波斯貓' },
            { id: 5, name: '金吉拉' },
            { id: 6, name: '曼赤肯（矮腳貓）' },
            { id: 7, name: '無毛貓（斯芬克斯）' },
            { id: 8, name: '加菲貓' },
            { id: 9, name: '孟加拉貓' },
            { id: 10, name: '暹羅貓' },
            { id: 11, name: '折耳貓（蘇格蘭折耳貓）' },
            { id: 12, name: '俄羅斯藍貓' },
            { id: 13, name: '橘貓（米克斯）' },
            { id: 14, name: '三花貓（米克斯）' },
            { id: 15, name: '狸花貓（米克斯）' },
            { id: 16, name: '挪威森林貓' },
            { id: 17, name: '土耳其梵貓' },
            { id: 18, name: '土耳其安哥拉貓' },
            { id: 19, name: '埃及貓' },
            { id: 20, name: '喜馬拉雅貓' },
            { id: 21, name: '新加坡貓' },
            { id: 22, name: '美國捲耳貓' },
            { id: 23, name: '索馬利貓' },
            { id: 24, name: '巴厘貓' },
            { id: 25, name: '東方短毛貓' },
            { id: 26, name: '科拉特貓' },
            { id: 27, name: '塞爾凱克捲毛貓' },
            { id: 28, name: '德文捲毛貓' },
            { id: 29, name: '柯尼斯捲毛貓' },
            { id: 30, name: '日本短尾貓' },
            ],
        menuValue: ref('我的貓咪品種是'),
        },
        menuDog: {
            placeHolder: '我的狗狗品種是',
            options: [
            { id: 0, name: '柴犬' },
            { id: 1, name: '拉布拉多' },
            { id: 2, name: '哈士奇' },
            { id: 3, name: '黃金獵犬' },
            { id: 4, name: '德國牧羊犬' },
            { id: 5, name: '法國鬥牛犬' },
            { id: 6, name: '貴賓犬（泰迪）' },
            { id: 7, name: '臘腸犬' },
            { id: 8, name: '比熊犬' },
            { id: 9, name: '邊境牧羊犬' },
            { id: 10, name: '雪納瑞' },
            { id: 11, name: '西施犬' },
            { id: 12, name: '約克夏' },
            { id: 13, name: '柯基犬' },
            { id: 14, name: '馬爾濟斯' },
            { id: 15, name: '秋田犬' },
            { id: 16, name: '松獅犬' },
            { id: 17, name: '沙皮狗' },
            { id: 18, name: '牛頭梗' },
            { id: 19, name: '羅威納犬' },
            { id: 20, name: '大丹犬' },
            { id: 21, name: '杜賓犬' },
            { id: 22, name: '博美犬' },
            { id: 23, name: '喜樂蒂牧羊犬' },
            { id: 24, name: '阿拉斯加雪橇犬' },
            { id: 25, name: '巴哥犬' },
            { id: 26, name: '狐狸犬' },
            { id: 27, name: '愛斯基摩犬' },
            { id: 28, name: '大白熊犬' },
            { id: 29, name: '巴吉度犬' },
            { id: 30, name: '比格犬' },
            ],
            menuValue: ref(''),
        },
        year: {
            placeHolder: '年份',
            options: Array.from({ length: 2025 - 2005 + 1 }, (_, i) => ({
            id: i,
            name: `${2025 - i} 年`,
            })),
            menuValue: ref(''),
        },
        month: {
            placeHolder: '月份',
            options: Array.from({ length: 12 }, (_, i) => ({
            id: i + 1,
            name: `${i + 1} 月`,
            })),
            menuValue: ref(''),
        },
        day: {
            placeHolder: '日期',
            options: Array.from({ length: 31 }, (_, i) => ({
            id: i + 1,
            name: `${i + 1} 日`,
            })),
            menuValue: ref(''),
        },
        visaYear: {
            placeHolder: '年份',
            options: Array.from({ length: 2025 - 2005 + 1 }, (_, i) => ({
            id: i,
            name: `${2025 - i} 年`,
            })),
        },
        visaMonth: {
            placeHolder: '月份',
            options: Array.from({ length: 12 }, (_, i) => ({
            id: i + 1,
            name: `${i + 1} 月`,
            })),
        },
    };

    // email格式驗證
    const emailInput = ref('');
    const emailError = ref();
    const isValidEmail = computed(() => {
    // 使用正規表達式來驗證email格式
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailPattern.test(emailInput.value);
    });

    watch(emailInput, (newValue, oldValue) => {
    if(isValidEmail.value){
        emailError.value = false;
    }else{
        emailError.value = true;
    }
    });

    //方案等級判別
    // 選擇的方案 & 訂閱週期
    const planSelected = ref("");
    
    const planName = {
    "銀卡": "Silver",
    "金卡": "Gold",
    "白金卡": "Platinum"
    };
    const periodName = {
    "單次體驗": "單次體驗",
    "3個月": "三個月",
    "6個月": "六個月",
    "12個月": "十二個月"
    };
    const monthFee = {
    "單次體驗": 1,
    "3個月": 3,
    "6個月": 6,
    "12個月": 12
    }
    // 訂閱週期對應表
    const planOptions = {
    "銀卡": [
        { label: "單次體驗", times: "x1", price: 799 },
        { label: "3個月", times: "x3", price: 2097 },
        { label: "6個月", times: "x6", price: 3774 },
        { label: "12個月", times: "x12", price: 7128 }
    ],
    "金卡": [
        { label: "單次體驗", times: "x1", price: 999 },
        { label: "3個月", times: "x3", price: 2697 },
        { label: "6個月", times: "x6", price: 4854 },
        { label: "12個月", times: "x12", price: 9168 }
    ],
    "白金卡": [
        { label: "單次體驗", times: "x1", price: 1299 },
        { label: "3個月", times: "x3", price: 3597 },
        { label: "6個月", times: "x6", price: 6474 },
        { label: "12個月", times: "x12", price: 12228 }
    ]
    };
    // 動態篩選訂閱週期
    const filteredPlans = computed(() => planOptions[subSelected.value] || planOptions[""]);
    // console.log("目前選擇的方案:", subSelected.value);
    // console.log("對應的訂閱方案:", planOptions[subSelected.value]);

    const selectedPrice = computed(() => {
      const selectedPlanObj = planOptions[subSelected.value].find(
        (p) => p.label == planSelected.value
      );
      return selectedPlanObj.price
    });

    const monthlyPrice = computed(() => {
    const months = monthFee[planSelected.value] || 1;
    return selectedPrice.value / months;
    });

    // question 9 信用卡號驗證
    const q9Form1 = ref('');
    const formattedCardNumber = ref(''); // 經過格式化的信用卡號（每4位加空格）
    const creditCardError = ref(false);

    const formatCardNumber = () => {
    // 移除所有非數字字符
    let numbersOnly = formattedCardNumber.value.replace(/\D/g, '');

    // 限制最大長度為16 
    numbersOnly = numbersOnly.slice(0, 16);

    // 每4位加一個空格
    formattedCardNumber.value = numbersOnly.replace(/(\d{4})/g, '$1 ').trim();

    // 更新原始卡號（去掉空格）
    q9Form1.value = numbersOnly;
    };
    // 監聽 formattedCardNumber是否滿足16位
    watch(formattedCardNumber, (newVal) => {
    creditCardError.value = newVal.replace(/\s/g, '').length > 0 && newVal.replace(/\s/g, '').length < 16;
    });

    //question 9 安全碼驗證
    const q9Form5 = ref('');
    const inputError = ref(false);

    const validateCVV = () => {
    // 只允許輸入數字
    q9Form5.value = q9Form5.value.replace(/\D/g, '');

    // 限制最多 4 位數
    if (q9Form5.value.length > 4) {
        q9Form5.value = q9Form5.value.slice(0, 4);
    }
    };
    // 監聽輸入值，判斷是否符合 3~4 位的條件
    watch(q9Form5, (newVal) => {
    inputError.value = newVal.length > 0 && (newVal.length < 3 || newVal.length > 4);
    });

    // Policy Component
    const isLightBoxPolicy = ref(false);
    const isLightBoxPrivacy = ref(false);

    const titlePolicy = ref("網站服務條款");
    const titlePrivacy = ref("隱私權政策");

    function togglePolicy() {
    isLightBoxPolicy.value = !isLightBoxPolicy.value;
    updateBodyClass();
    }

    function togglePrivacy() {
    isLightBoxPrivacy.value = !isLightBoxPrivacy.value;
    updateBodyClass();
    }

    function updateBodyClass() {
    if (isLightBoxPolicy.value || isLightBoxPrivacy.value) {
        document.body.classList.add('clicked');
    } else {
        document.body.classList.remove('clicked');
    }
    }
</script>

