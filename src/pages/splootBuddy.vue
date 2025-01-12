<template>
 <Banner theme="blue" bgc="Blueberry-0"></Banner>
<!-- 主內容 -->
<div class="wrapper">
<!-- 主要功能 -->
 <div class="splootBuddy">
    <div class="heroTitle">
        <h3 class="bold">最值得信任的</h3>
        <div class="enTitle">SPLOOT Buddy</div>        
    </div>
    <div class="bottomTitle">
        <p>提供毛小孩們最棒且最有愛的服務</p>
    </div>
    <div class="firstTime">
        <p class="xsText">第一次使用小幫手？</p>
    </div>
    <!-- 過濾篩選選單部分 -->
    <div class="selectTypeSection">
        <ul class="buddyType">
            <li class="buddyTypes walkies">
                <img src="" alt="" class="TypeIcon">
                    <p>散步陪伴</p>
                </img>
            </li>
            <li class="buddyTypes homecare">
                <img src="" alt="" class="TypeIcon">
                    <p>到府照顧</p>
                </img>
            </li>
            <li class="buddyTypes fostering">
                <img src="" alt="" class="TypeIcon">
                    <p>友善寄宿</p>
                </img>
            </li>
            <li class="buddyTypes petDrop">
                <img src="" alt="" class="TypeIcon">
                    <p>毛孩計程車</p>
                </img>
            </li>
        </ul>
    <div class="selcetPlaceAndPetType">
        <div class="leftSection">
            <div class="leftLabel xsText">毛小孩位於</div>
            <div class="dropdownMenu">
                <DropdownMenu class="city"
                    :placeHolder="city.placeHolder"
                    :options="city.options">
                </DropdownMenu>
                <DropdownMenu class="district"
                    :placeHolder="district.placeHolder"
                    :options="district.options">
                </DropdownMenu>
            </div>
        </div>
        <div class="rightSection">
            <div class="rightLabel xsText">毛小孩類型</div>
            <ul class="petType">
                <li class="petTypes all">全部</li>
                <li class="petTypes puppy">幼犬</li>
                <li class="petTypes small">小型犬</li>
                <li class="petTypes middle">中型犬</li>
                <li class="petTypes large">大型犬</li>
                <li class="petTypes elder">老年犬</li>
                <li class="petTypes kitten">幼貓</li>
                <li class="petTypes cat">成貓</li>
            </ul>
        </div>
        <div class="buddytSearch btn default blue"><span>搜尋</span></div>
        <!-- 成為小幫手＋新增貼文 -->
        <div class="middleSection">
            <div class="toBeBuddy">
                <p class="smallText">你是喜愛動物又擁有照顧經驗的人嗎</p>
                <div class="toBeBuddyBtn smallText">成為小幫手</div>
            </div>
        </div>
        <!-- 任務牆 -->
         <div class="bottomSection">
            <ul class="buddyCard">
                <li class="buddyCards">
                    <img src="" alt="" class="cardsImg">
                    <div class="cardText">
                        <h6 class="cardsTitle bold">快速散步去</h6>
                        <div class="reviews">
                            <ul class="stars">
                                <li><img src="" alt="star" class="star star1"></li>
                                <li><img src="" alt="star" class="star star2"></li>
                                <li><img src="" alt="star" class="star star3"></li>
                                <li><img src="" alt="star" class="star star4"></li>
                                <li><img src="" alt="star" class="star star5"></li>
                            </ul>
                            <div class="avgGrade smallText">4.5</div>
                            <div class="commentCount smallText">(3)</div>
                        </div>
                        <div class="serviceTime">服務時段：週一至週五 09:00-18:00</div>
                    </div>
                    <div class="cardsBtnBox">
                        <div class="cardsBtn btn small blue"><span>查看</span></div>
                    </div>
                </li>
            </ul>

            <div class="seeMore"><p class="bold">查看更多</p></div>
         </div>
    </div>

    </div>




    <div class="circle1 circle"></div>
    <div class="circle2 circle"></div>
</div>

</div>

</template>

<script setup>
    import {ref} from "vue";

    import Banner from "../components/Banner.vue";
    import DropdownMenu from "../components/DropdownMenu.vue";

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


</script>
