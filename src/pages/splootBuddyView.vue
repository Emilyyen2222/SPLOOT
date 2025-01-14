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
    <div class="firstTimeUse" @click="showLightBox">
        <p class="xsText">第一次使用小幫手？</p>
    </div>
    <!-- 過濾篩選選單部分 -->
    <div class="selectTypeSection">
        <ul class="buddyType">
            <li class="buddyTypes walkies">
                <img src="@/assets/img/footer-blue.svg" alt="walkies" class="typeIcon">
                    <p class="smallText">散步陪伴</p>
                </img>
            </li>
            <li class="buddyTypes homeCare">
                <img src="@/assets/img/footer-blue.svg" alt="homecare" class="typeIcon">
                    <p class="smallText">到府照顧</p>
                </img>
            </li>
            <li class="buddyTypes fostering">
                <img src="@/assets/img/footer-blue.svg" alt="fostering" class="typeIcon">
                    <p class="smallText">友善寄宿</p>
                </img>
            </li>
            <li class="buddyTypes petDrop">
                <img src="@/assets/img/footer-blue.svg" alt="petdrop" class="typeIcon">
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
                        :options="city.options">
                    </DropdownMenu>
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
    <Btn btnStyle="blue default buddytSearch">搜尋</Btn>

    <!-- 成為小幫手＋新增貼文 -->
    <div class="middleSection">
        <div class="toBeBuddy">
            <p class="smallText">你是喜愛動物又擁有照顧經驗的人嗎?</p>
            <Btn btnStyle="outline small textBlue howToBe">成為小幫手</Btn>
        </div>        
        <!-- 行程按鈕 -->       
        <div class="scheduleBtn">
            <img src="@/assets/img/icon/add-schedule.svg" alt="" class="scheduleIcon">
            <p class="xsText">新增行程</p>
        </div>        
    </div>

    <!-- 任務牆 -->
    <div class="bottomSection">
        <ul class="buddyCard">
            <li class="buddyCards">
                <img src="@/assets/img/pet-friendly/cards7.png" alt="" class="cardsImg">
                <div class="cardText">
                    <h6 class="cardsTitle bold">快速散步去</h6>
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
                    <div class="serviceTime smallText">服務時段：週一至週五 09:00-18:00</div>                
                    <Btn btnStyle="blue small">查看</Btn>                
                </div>
            </li>
        </ul>

        <div class="seeMoreBtn">
            <Btn btnStyle="outline default textBlue seeMore">查看更多</Btn> 
        </div>
    </div>
    <!-- 圓形 * 2 -->
    <div class="circle1 circle"></div>
    <div class="circle2 circle"></div>
 </div>
</div>

<!-- 小幫手介紹燈箱 -->

<div class="buddyLightBox" :class="{clicked:isLightBox}">
    <div class="colseBtn" @click="showLightBox"><img src="@/assets/img/icon/close.svg" alt="colseIcon"></div>
    <div class="buddyIntroduction introTop">
        <div class="introTitle">
            <h4 class="bold">值得信任的毛孩小幫手</h4>
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

        <div class="middleText">
            <p class="bold">什麼樣的毛孩適合寵物小幫手?</p>
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
        <div class="introTitle">
            <h4 class="bold">什麼人適合成為小幫手</h4>
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
    </div>

    <div class="introBtn">
        <Btn btnStyle="blue default">成為小幫手</Btn>
    </div>
</div>

<!-- 遮罩 -->
<div class="blackCover" :class="{clicked:isLightBox}"></div>


</template>

<script setup>
    import {onMounted, ref} from "vue";

    import MainHeader from "../components/MainHeader.vue";
    import DropdownMenu from "../components/DropdownMenu.vue";
    import Btn from '../components/Btn.vue';

    const city = {
    placeHolder: '請選擇城市',
    options: [
        { id: 100, name: '台北市' },
        { id: 200, name: '基隆市' },
        { id: 220, name: '新北市' },
        { id: 300, name: '新竹市' },
        { id: 302, name: '新竹縣' },
        { id: 400, name: '台中市' },
        { id: 500, name: '彰化縣' },
        { id: 540, name: '南投縣' },
        { id: 600, name: '嘉義市' },
        { id: 602, name: '嘉義縣' },
        { id: 700, name: '台南市' },
        { id: 800, name: '高雄市' },
        { id: 880, name: '澎湖縣' },
        { id: 900, name: '屏東縣' },
        { id: 950, name: '台東縣' },
        { id: 970, name: '花蓮縣' },
        { id: 209, name: '連江縣' },
        { id: 210, name: '金門縣' },
        { id: 290, name: '宜蘭縣' },
        { id: 350, name: '苗栗縣' },
        { id: 630, name: '雲林縣' }
    ]
};
    const district = {
        placeHolder: '請選擇行政區',
        options: [
            {
                id: 0,
                name: '選項1'
            },
            {
                id: 1,
                name: '選項2'
            },
            {
                id: 2,
                name: '選項3'
            },
            {
                id: 3,
                name: '選項4'
            },
        ]
    };

    //燈箱顯示與否
    let isLightBox = ref(false);

    function showLightBox(){
        isLightBox.value = !isLightBox.value;

    }




</script>
<!-- const firstTimeUse = document.querySelector(".firstTimeUse");
const lightBox = document.querySelector(".buddyLightBox");
const blackCover = document.querySelector(".blackCover");

firstTimeUse.addEventListener("click",function(){

    alert("aaa");
    // lightBox.classList.add("clicked");
    // blackCover.classList.add("clicked");
}); -->