<template>
 <MainHeader theme="blue" bgc="blueberry-0"></MainHeader>
<!-- 主內容 -->
<div class="wrapper">

<!-- 主要功能 -->
 <div class="splootBuddy">
    <div class="heroTitle">
        <h3 class="bold">最值得信任的</h3>
        <div class="enTitle">SPLOOT Buddy</div>        
    </div>
    <div class="secondTitle">
        <p>提供毛小孩們最棒且最有愛的服務</p>
    </div>
    <div class="firstTimeUse" >
        <Btn btnStyle="baseline small" @click="toggleLightBox">第一次使用小幫手？</Btn>
    </div>
    <!-- 過濾篩選選單部分 -->
    <div class="selectTypeSection">
        <ul class="buddyType">
            <li class="buddyTypes walkies">
                <img src="@/assets/img/icon/walkies.svg" alt="walkies" class="typeIcon">
                    <p class="smallText">散步陪伴</p>
                </img>
            </li>
            <li class="buddyTypes homeCare">
                <img src="@/assets/img/icon/homeCare.svg" alt="homecare" class="typeIcon">
                    <p class="smallText">到府照顧</p>
                </img>
            </li>
            <li class="buddyTypes fostering">
                <img src="@/assets/img/icon/fostering.svg" alt="fostering" class="typeIcon">
                    <p class="smallText">友善寄宿</p>
                </img>
            </li>
            <li class="buddyTypes petDrop">
                <img src="@/assets/img/icon/petDrop.svg" alt="petdrop" class="typeIcon">
                    <p class="smallText">毛孩計程車</p>
                </img>
            </li>
        </ul>
        <div class="selcetPlaceAndPetType">
            <div class="leftSection">
                <div class="leftLabel xsText">毛小孩位於</div>
                <div class="dropdownMenu">
                    <DropdownMenu class="dropDown city"
                        :placeHolder="city.placeHolder"
                        :options="city.options"
                        v-model="selectedCity">
                    </DropdownMenu>
                </div>
                <p>目前選擇的城市：{{ selectedCity ? selectedCity.name : "未選擇" }}</p>
                <div class="dropdownMenu">
                    <DropdownMenu class="dropDown district"
                        :placeHolder="district.placeHolder"
                        :options="district.options">
                    </DropdownMenu>
                </div>
            </div>
            <div class="rightSection">
                <div class="rightLabel xsText">毛小孩類型</div>
                <ul class="petType smallText">
                    <li class="petTypes all clicked">全部</li>
                    <li class="petTypes puppy">幼犬</li>
                    <li class="petTypes small">小型犬</li>
                    <li class="petTypes middle">中型犬</li>
                    <li class="petTypes large">大型犬</li>
                    <li class="petTypes elder">老年犬</li>
                    <li class="petTypes kitten">幼貓</li>
                    <li class="petTypes cat">成貓</li>
                </ul>
            </div>
        </div>
    </div>
    <Btn btnStyle="primary default buddytSearch">搜尋</Btn>

    <!-- 成為小幫手＋新增貼文 -->
    <div class="middleSection">
        <div class="toBeBuddy">
            <p class="smallText">你是喜愛動物又擁有照顧經驗的人嗎?</p>
            <div class="btnBox">
                <Btn btnStyle="outline small">成為小幫手</Btn>
            </div>
        </div>        
        <!-- 行程按鈕 -->       
        <div class="scheduleBtn">
            <img src="@/assets/img/icon/add-schedule.svg" alt="" class="scheduleIcon">
            <p class="xsText" @click="toggleLightBox2">新增貼文</p>
        </div>        
    </div>

    <!-- 任務牆 -->
    <div class="bottomSection">
        <ul class="buddyCard">
            <li class="buddyCards" v-for="(card,index) in cardsData" :key="index">
                <div class="cardBox">
                    <img :src="card.imgSrc" alt="" class="cardsImg">
                    <div class="cardText">
                        <h6 class="cardsTitle bold">{{ card.title }}</h6>
                        <div class="reviews">
                            <ul class="stars">
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star1"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star2"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star3"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star4"></li>
                                <li><img src="@/assets/img/icon/star-line.svg" alt="star" class="star star5"></li>
                            </ul>
                            <div class="avgGrade smallText">4.5</div>
                            <div class="commentCount smallText">(3)</div>
                        </div>
                        <div class="serviceTime smallText">服務時段：{{ card.serviceDaysStart }}至{{ card.serviceDaysEnd }} {{ card.serviceTimeStart }}-{{ card.serviceTimeEnd }}</div>                
                    </div>
                </div>
                <Router-link  to="/sploot-buddy/buddy-post">
                    <Btn btnStyle="primary small">查看</Btn>  
                </Router-link>
            </li>
        </ul>

        <div class="seeMoreBtn">
            <Btn btnStyle="outline default textBlue seeMore">查看更多</Btn> 
        </div>
    </div>
</div>

</div>
<!-- 圓形 * 2 -->
<div class="circle1 circle"></div>
<div class="circle2 circle"></div>


<!-- "第一次使用小幫手"燈箱 -->

<LightBox 
    :title="lightTitle.title"
    :is-light-box="isLightBox" 
    @toggle="toggleLightBox">
    <div class="buddyIntroduction introTop">
        <div class="topText littleTitle">
            <h6 class="bold">SPLOOT承諾</h6>
        </div>
        <div class="introSectionBox">
            <div class="introSection">
                <img src="" alt="" class="introImg">
                <div class="introText">
                    <p class="bold">身分認證介紹</p>
                    <p>我們要求每位小幫手提供身分證明，並進行身份核對，確保所有小幫手都是可信的真實人物，給寵物主人更多的安心保障。</p>
                </div>
            </div>
            <div class="introSection">
                <img src="" alt="" class="introImg">
                <div class="introText">
                    <p class="bold">篩選小幫手</p>
                    <p>嚴格篩選登記的小幫手，杜絕假冒身分與重複登記情況，確保每位小幫手都能提供高品質的服務與專業保障。</p>
                </div>
            </div>
        </div>

        <div class="middleText littleTitle">
            <h6 class="bold">什麼樣的毛孩適合寵物小幫手?</h6>
        </div>

        <div class="introSectionBox">
            <div class="introSection">
                <img src="" alt="" class="introImg">
                <div class="introText">
                    <p class="bold">排斥關籠、需要陪伴</p>
                    <p>有些毛孩通常不喜歡被關在籠子裡，並且對陪伴需求較高，小幫手可以提供陪伴以及散步等活動，使毛孩心情更加舒緩。</p>
                </div>
            </div>
            <div class="introSection">
                <img src="" alt="" class="introImg">
                <div class="introText">
                    <p class="bold">不適合外宿</p>
                    <p>毛孩們對固定的環境較為依賴，尤其是貓咪，若家長在擔心因為出遠門而被留下的毛孩，小幫手就是你最佳的好夥伴!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="buddyIntroduction introBottom">
        <div class="littleTitle">
            <h6 class="bold">什麼人適合成為小幫手</h6>
        </div>

        <div class="introSectionBox">
            <div class="introSection">
                <img src="" alt="" class="introImg">
                <div class="introText">
                    <p class="bold">喜愛動物，樂於與寵物互動的人</p>
                    <p>適合那些對動物有高度熱情，喜歡與各類毛孩互動、建立良好關係的人，能提供毛孩所需的關愛與陪伴。</p>
                </div>
            </div>
            <div class="introSection">
                <img src="" alt="" class="introImg">
                <div class="introText">
                    <p class="bold">有責任心，能確保寵物安全與健康的人</p>
                    <p>小幫手需要具備高度責任感，確保在照顧過程中提供寵物安全、健康的生活環境，讓主人無後顧之憂。</p>
                </div>
            </div>
        </div>
        <div class="introBtn">
            <Btn btnStyle="primary default">成為小幫手</Btn>
        </div>
    </div>
</LightBox>

<!-- "新增貼文"燈箱 -->
<LightBox 
    padding="pb-0"
    :title="lightTitle2.title"
    :is-light-box="isLightBox2" 
    @toggle="toggleLightBox2">

<div class="newPost">
    <div class="imgUpload">
        <div class="imgUploadSection">
            <p class="smallText imgUploadText" v-if="!hasUploadImg">上傳主圖片*<br>建議1100x300px</p>
            <div class="uploadImgBox" v-if="hasUploadImg">  <!-- 如果有圖片的話才顯現 -->
                <img :src="hasUploadImg" alt="uploadImg">
            </div>
        </div>
        <div class="imgUploadBtn">
            <input type="file" hidden ref="fileInput" accept="image/*" @change="uploadFileImage">
            <Btn btnStyle="primary small" @click="callFileInput">上傳圖檔</Btn>
        </div>
    </div>
    <div class="newPostInput">
        <div class="postTitle">
            <p class="smallText inputLabel">發佈主題*</p>
            <InputText
                textAlign = "textLeft"
                size = "small"
                placeHolder="這裡輸入發佈主題"
                errorMsg="Invalid Input"
                v-model="inputValue"
                :hasError="inputError">
            </InputText>
        </div>
        <div class="postContent">
            <p class="smallText inputLabel">發佈內容*</p>
            <!-- <InputText
                textAlign = "textLeft"
                size = "small"
                placeHolder="請於200字內"
                errorMsg="Invalid Input"
                v-model="inputValue"
                :hasError="inputError">
            </InputText> -->
            <textarea name="" id="" placeHolder="請於200字內"></textarea>
        </div>
    </div>
    <div class="newPostBtn">
        <Btn btnStyle="primary small">提交</Btn>
        <div class="cancelBtn">
            <Btn btnStyle="baseline small">取消</Btn>
        </div>
    </div>
</div>



</LightBox>

<MainFooter></MainFooter>




</template>

<script setup>
    import {onMounted, ref, watch} from "vue";

    import MainHeader from "@/components/MainHeader.vue";
    import DropdownMenu from "@/components/DropdownMenu.vue";
    import Btn from '@/components/Btn.vue';
    import LightBox from "@/components/LightBox.vue";
    import MainFooter from "@/components/MainFooter.vue"
    import InputText from '@/components/InputText.vue';

//城市選單
    const city = {
    placeHolder: "請選擇城市",
    options: [
        { id: 100, name: "台北市" },
        { id: 200, name: "基隆市" },
        { id: 220, name: "新北市" },
        { id: 300, name: "新竹市" },
        { id: 302, name: "新竹縣" },
        { id: 400, name: "台中市" },
        { id: 500, name: "彰化縣" },
        { id: 540, name: "南投縣" },
        { id: 600, name: "嘉義市" },
        { id: 602, name: "嘉義縣" },
        { id: 700, name: "台南市" },
        { id: 800, name: "高雄市" },
        { id: 880, name: "澎湖縣" },
        { id: 900, name: "屏東縣" },
        { id: 950, name: "台東縣" },
        { id: 970, name: "花蓮縣" },
        { id: 209, name: "連江縣" },
        { id: 210, name: "金門縣" },
        { id: 290, name: "宜蘭縣" },
        { id: 350, name: "苗栗縣" },
        { id: 630, name: "雲林縣" }
    ]
};

const district = {
  placeHolder: "請選擇行政區",
  options: []};

const districtData = {
    100: ["中正區", "大同區", "中山區", "松山區", "大安區", "萬華區", "信義區", "士林區", "北投區", "內湖區", "南港區", "文山區"],
    200: ["仁愛區", "信義區", "中正區", "中山區", "安樂區", "暖暖區", "七堵區"],
    220: ["板橋區", "三重區", "中和區", "永和區", "新莊區", "新店區", "樹林區", "鶯歌區", "三峽區", "淡水區", "汐止區", "瑞芳區", "土城區", "蘆洲區", "五股區", "泰山區", "林口區", "深坑區", "石碇區", "坪林區", "三芝區", "石門區", "八里區", "平溪區", "雙溪區", "貢寮區", "金山區", "萬里區", "烏來區"],
    300: ["東區", "北區", "香山區"],
    302: ["竹北市", "湖口鄉", "新豐鄉", "新埔鎮", "關西鎮", "芎林鄉", "寶山鄉", "竹東鎮", "五峰鄉", "橫山鄉", "尖石鄉", "北埔鄉", "峨眉鄉"],
    400: ["中區", "東區", "南區", "西區", "北區", "北屯區", "西屯區", "南屯區", "太平區", "大里區", "霧峰區", "烏日區", "豐原區", "后里區", "石岡區", "東勢區", "和平區", "新社區", "潭子區", "大雅區", "神岡區", "大肚區", "沙鹿區", "龍井區", "梧棲區", "清水區", "大甲區", "外埔區", "大安區"],
    500: ["彰化市", "芬園鄉", "花壇鄉", "秀水鄉", "鹿港鎮", "福興鄉", "線西鄉", "和美鎮", "伸港鄉", "員林市", "社頭鄉", "永靖鄉", "埔心鄉", "溪湖鎮", "大村鄉", "埔鹽鄉", "田中鎮", "北斗鎮", "田尾鄉", "埤頭鄉", "溪州鄉", "竹塘鄉", "二林鎮", "大城鄉", "芳苑鄉", "二水鄉"],
    540: ["南投市", "中寮鄉", "草屯鎮", "國姓鄉", "埔里鎮", "仁愛鄉", "名間鄉", "集集鎮", "水里鄉", "魚池鄉", "信義鄉", "竹山鎮", "鹿谷鄉"],
    600: ["東區", "西區"],
    602: ["番路鄉", "梅山鄉", "竹崎鄉", "阿里山鄉", "中埔鄉", "大埔鄉", "水上鄉", "鹿草鄉", "太保市", "朴子市", "東石鄉", "六腳鄉", "新港鄉", "民雄鄉", "大林鎮", "溪口鄉", "義竹鄉", "布袋鎮"],
    700: ["中西區", "東區", "南區", "北區", "安平區", "安南區", "永康區", "歸仁區", "新化區", "左鎮區", "玉井區", "楠西區", "南化區", "仁德區", "關廟區", "龍崎區", "官田區", "麻豆區", "佳里區", "西港區", "七股區", "將軍區", "學甲區", "北門區", "新營區", "後壁區", "白河區", "東山區", "六甲區", "下營區", "柳營區", "鹽水區", "善化區", "大內區", "山上區", "新市區", "安定區"],
    800: ["新興區", "前金區", "苓雅區", "鹽埕區", "鼓山區", "旗津區", "前鎮區", "三民區", "楠梓區", "小港區", "左營區", "仁武區", "大社區", "岡山區", "路竹區", "阿蓮區", "田寮區", "燕巢區", "橋頭區", "梓官區", "彌陀區", "永安區", "湖內區", "鳳山區", "大寮區", "林園區", "鳥松區", "大樹區", "旗山區", "美濃區", "六龜區", "內門區", "杉林區", "甲仙區", "桃源區", "那瑪夏區", "茂林區", "茄萣區"],
    880: ["馬公市", "西嶼鄉", "望安鄉", "七美鄉", "白沙鄉", "湖西鄉"],
    900: ["屏東市", "三地門鄉", "霧台鄉", "瑪家鄉", "九如鄉", "里港鄉", "高樹鄉", "鹽埔鄉", "長治鄉", "麟洛鄉", "竹田鄉", "內埔鄉", "萬丹鄉", "潮州鎮", "泰武鄉", "來義鄉", "萬巒鄉", "崁頂鄉", "新埤鄉", "南州鄉", "林邊鄉", "東港鎮", "琉球鄉", "佳冬鄉", "新園鄉", "枋寮鄉", "枋山鄉", "春日鄉", "獅子鄉", "車城鄉", "牡丹鄉", "恆春鎮", "滿州鄉"]
};

//城市選單監聽

// let selectedCity = ref(null); //v-model綁定

// watch(selectedCity, (newValue) => {
//     console.log("選擇的城市變更為:", newValue);
// });

// // 監聽 `selectedCity`，動態更新 `district.options`
// watch(selectedCity, (newCity) => {
//   if (newCity) {
//     // 確保 newCity 是數字
//     const cityId = Number(newCity);
//     district.value.options = districtData[cityId] || [];
//   } else {
//     district.value.options = [];
//   }
// });



//小幫手卡片
    const cardsData = ref([
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        }, 
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        },
    ])

// "第一次使用小幫手"燈箱
// 燈箱標題請輸入
const lightTitle = {title: "值得信任的毛孩小幫手"}

 //燈箱狀態
let isLightBox = ref(false);

// 控制燈箱的顯示與隱藏
function toggleLightBox() {
  isLightBox.value = !isLightBox.value;
  // 停止捲軸
  if (isLightBox.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
}

// "新增貼文"燈箱
// 燈箱標題請輸入
const lightTitle2 = {title: "發佈 散步陪伴 貼文"}

 //燈箱狀態
let isLightBox2 = ref(false);

// 控制燈箱的顯示與隱藏
function toggleLightBox2() {
  isLightBox2.value = !isLightBox2.value;
  // 停止捲軸
  if (isLightBox2.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
}

// "新增貼文"燈箱裡的input
let inputValue = ref('');
let inputError = ref(false);

watch(inputValue, (newValue, oldValue) => {
    if(inputValue.value.includes('123')){
        inputError.value = true;
    }else{
        inputError.value = false;
    }
})


const fileInput = ref(null);
const hasUploadImg = ref(null);

// 按下按鈕呼叫"選擇檔案"
const callFileInput = () => {
    fileInput.value.click();
}

// 上傳圖片
const uploadFileImage = () => {
    const file = event.target.files[0];
  if (file && file.type.startsWith('image/')) {
    const reader = new FileReader();
    reader.onload = (e) => {
        hasUploadImg.value = e.target.result; // 設定預覽圖片的 base64 URL
    };
    reader.readAsDataURL(file);
  }
};


</script>