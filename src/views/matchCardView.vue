<template>
    <MainHeader theme="red" bgc="purple-1"></MainHeader>
    <!-- <main class="bg-purple-1" style="z-index: -10;"> -->
    <!------------------------match question 1---------------------->
<div class="matchbox">
    <div class="cardWrap">
        <!-- 卡片部分 -->
         <!-- <div class="cardWrapMatch"> -->
             <div class="cardwrapper" v-for="plan in filteredPlans" :key="plan.label" 
             :class="[{'movedLeft': movedLeft}, {'movedRight': movedRight}]">
             <!-- 左側圖片區 -->
                 <div class="imageContainer">
                     <img :src="plan.imageSrc" alt="">
                     <div class="iconOverlay">
                         <img v-if="disliked" src="../assets/img/icon/dislikeIcon.svg" alt="Icon" style="width: 17.1rem;">
                     </div>
                 </div>
             
                 <!-- 右側內容區 -->
                 <div class="content">
                     <div class="topSection">
                         <div class="dot">
                         <div class="dotActive"></div>
                         <div class="dotInactive"></div>
                         <div class="dotInactive"></div>
                         </div>
                         <div class="number">{{ plan.number }}</div>
                     </div>
                 
                     <!-- 名稱與距離 -->
                     <div class="info">
                         <div class="nameAndGender">
                         <h4 class="bold name">{{ plan.name }}</h4>
                         <img src="../assets/img/icon/genderIcon.svg" alt="" style="width: 2rem;">
                         </div>
                         <div class="distance">
                         <div class="smallText distanceIcon"></div>
                         距離你{{ plan.distance }}公里
                         </div>
                     </div>
     
                     <!-- 標籤區 -->
                     <div class="tags">
                         <span class="xsText tag" v-for="tag in plan.tags" :key="tag">{{ tag }}</span>
                     </div>
                     
                     <!-- 內文 -->
                     <p class="description bold">{{ plan.description }}</p>
                 
                     <div class="iconOverlay">
                         <img v-if="liked" src="../assets/img/icon/likeIcon.svg" alt="Icon" style="width: 14.3rem;">
                     </div>
                 </div>
             </div>
         <!-- </div> -->
        <div class="likeBtns">
            <Btn class="likeBtn" btnStyle="outline default"
            @click="dislikeClick">不喜歡</Btn> 
            <Btn class="likeBtn" btnType="form" btnStyle="nextQ"
            @click="likeClick">喜歡</Btn> 
        </div>
        <div class="preferenceBox">
            <div class="preferenceBtns">
                <Btn class="viewAllMatch" btnStyle="baseline small"
                @click="toggleLightBoxMatchAll">查看所有成功配對</Btn>
                <Btn class="preferenceBtn" btnStyle="baseline small"
                @click="toggleLightBoxMatch">更改喜好設定</Btn>
            </div>
        </div>
    </div>
    <!-- 遮罩部分 -->
    <div class="overlay">
        <div class="cardSlotsScroll">
            <div class="cardSlots"
            @click="toggleLightBoxPetInfo">
                <div v-for="(image, index) in petImages" :key="index" class="cardContainer">
                    <div class="petImage">
                    <img :src="image" alt="Pet Image">
                    <div class="dot">
                        <div class="dotActive"></div>
                        <div class="dotInactive"></div>
                        <div class="dotInactive"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- lightTitleMatchAll -->
<LightBox 
    :title="lightTitleMatchAll.title"
    :is-light-box="isLightBoxMatchAll" 
    @toggle="toggleLightBoxMatchAll()">
    <div class="cardSlotsPopUp">
        <div class="cardSlots"
        @click="toggleLightBoxPetInfo">
        <div v-for="(image, index) in petImages" :key="index" class="cardContainer">
            <div class="petImage">
            <img :src="image" alt="Pet Image">
            <div class="dot">
                <div class="dotActive"></div>
                <div class="dotInactive"></div>
                <div class="dotInactive"></div>
            </div>
            </div>
        </div>
        </div>
    </div>
</LightBox>
<!-- lightTitlePetInfo -->
<LightBox 
    :title="lightTitlePetInfo.title"
    :is-light-box="isLightBoxPetInfo" 
    @toggle="toggleLightBoxPetInfo()">
    <div class="cardWrapPopUp">
        <!-- 卡片部分 -->
        <div class="cardwrapper">
            <!-- 左側圖片區 -->
            <div class="imageContainer">
                <img src="../assets/img/splootbox/dog3.jpg" alt="">
            </div>
            <!-- 右側內容區 -->
            <div class="content">
                <div class="topSection">
                <div class="dot">
                    <div class="dotActive"></div>
                    <div class="dotInactive"></div>
                    <div class="dotInactive"></div>
                </div>
                <div class="number">01</div>
                </div>
                <!-- 名稱與距離 -->
                <div class="info">
                    <div class="nameAndGender">
                        <h4 class="bold name">COCO</h4>
                        <img src="../assets/img/icon/genderIcon.svg" alt="" style="width: 2rem;">
                    </div>
                    <div class="distance">
                    <div class="smallText distanceIcon"></div>
                    距離你6公里
                    </div>
                </div>
                <!-- 標籤區 -->
                <div class="tags">
                <span class="xsText tag">邊境牧羊</span>
                <span class="xsText tag">活潑外向</span>
                <span class="xsText tag">愛玩球</span>
                <span class="xsText tag">台北市</span>
                <span class="xsText tag">松山區</span>
                <span class="xsText tag">大型犬</span>
                <span class="xsText tag">已結紮</span>
                </div>
                <!-- 內文 -->
                <p class="description bold">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur 
                </p>
            </div>
        </div>
    </div>
    <!-- 右側內容區 -->
    <div class="ownerContent">
        <div class="boxDivider"></div>
        <!-- 名稱-->
            <div class="ownerName">
                <h4 class="bold">芙琳</h4>
                <div class="ownerTag">
                    <span class="xsText tag">小幫手</span>
                </div>
            </div>
        <!-- 內文 -->
         <div class="owerText">
            <p class="description bold">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur 
            </p>
        </div>
        <div class="ownerInfoSec">
            <!-- 基本資料 -->
            <div class="smallText">基本資料</div>
            <!-- 標籤區 -->
            <div class="tags">
            <span class="xsText tag">邊境牧羊</span>
            <span class="xsText tag">活潑外向</span>
            <span class="xsText tag">愛玩球</span>
            </div>
        </div>
        <div class="ownerInfoSec">
            <!-- 基本資料 -->
            <div class="smallText">正在舉辦</div>
            <!-- 標籤區 -->
            <div class="tags">
            <span class="xsText bold tagRed">12/12碧潭野餐</span>
            <span class="xsText bold tagRed">2/24迎風狗公園聚會</span>
            </div>
        </div>
        <div class="boxDivider"></div>
        
        <div class="lineSec">
            <div class="blockUser">
                    <Btn class="check" btnStyle="baseline small">檢舉</Btn>
                    <Btn class="check" btnStyle="baseline small">封鎖</Btn>
            </div>
            <div class="connect">
                <div class="lineQRCode">
                    <img src="../assets/img/buddy-post/demoQR.png" alt="account" class="QRcode">
                </div>
                <Btn class="check" btnStyle="baseline small">芙琳的LINE</Btn>
            </div>
        </div>
    </div>
</LightBox>
<!-- LightBox，配對喜好調整 -->
<LightBox 
    :title="lightTitleMatchReset.title"
    :is-light-box="isLightBoxlightTitleMatchReset" 
    @toggle="toggleLightBoxMatch()">

    <div class="matchAdjust">
        <div class="tag-wrapper">
        
        <div class="tag-container">
            <p>我想認識的毛孩朋友是</p>
            <div class="tag-group">
            <Btn v-for="option in tag_friend.options" :key="option"
            btnType="tag" 
            :class="{'-active': optionSelected(tag_friend.selected, option)}"
            @click="tag_friend.formChoice(tag_friend.selected, option)">{{ option }}</Btn>
            <!-- <p>Selected Options: {{ tag_friend.selected.value.join(' , ') }}</p> -->
            </div>
        </div>
        <div 
            class="tag-container"
            v-show=" selectedOption === '貓貓朋友' ">
            <p>我想認識的貓貓朋友是</p>
            <div class="tag-group">
            <Btn v-for="option in tag_cat.options" :key="option"
            btnType="tag" 
            :class="{'-active': optionSelected(tag_cat.selected, option)}"
            @click="tag_cat.formChoice(tag_cat.selected, option)">{{ option }}</Btn>
            </div>
        </div>
        <div 
            class="tag-container"
            v-show=" selectedOption === '狗狗朋友' ">
            <p>我想認識的狗狗朋友是</p>
            <div class="tag-group">
            <Btn v-for="option in tag_dog.options" :key="option"
            btnType="tag" 
            :class="{'-active': optionSelected(tag_dog.selected, option)}"
            @click="tag_dog.formChoice(tag_dog.selected, option)">{{ option }}</Btn>
            </div>
        </div>

        <div class="tag-container">
            <p>社交性</p>
            <div class="tag-group">
            <Btn v-for="option in tag_social.options" :key="option"
            btnType="tag" 
            :class="{'-active': optionSelected(tag_social.selected, option)}"
            @click="tag_social.formChoice(tag_social.selected, option)">{{ option }}</Btn>
            </div>
        </div>

        <div class="tag-container">
            <p>絕育狀態*</p>
            <div class="tag-group">
            <Btn v-for="option in tag_fixed.options" :key="option"
            btnType="tag" 
            :class="{'-active': optionSelected(tag_fixed.selected, option)}"
            @click="tag_fixed.formChoice(tag_fixed.selected, option)">{{ option }}</Btn>
            </div>
        </div>

        </div>          
        <div class="btn-group">
        <Btn btnStyle="primary small" @click="toggleLightBox_match">儲存</Btn>
        <Btn btnStyle="baseline small" @click="toggleLightBox_match">取消修改</Btn>
        </div>
    </div>
</LightBox>
<!-- circle bg -->
<div class="circleMatch"></div>
</template>
    
    <script setup>
        import { ref } from 'vue';
        import MainHeader from "../components/MainHeader.vue";
        import Btn from '../components/Btn.vue';
        import LightBox from "@/components/LightBox.vue";


    const filteredPlans = ref([
      {
        label: 'card1',
        name: 'Coco',
        imageSrc: new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        number: '01',
        distance: 6,
        tags: ['邊境牧羊', '活潑外向', '愛玩球'],
        description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit.'
      },
      {
        label: 'card2',
        name: 'Buddy',
        imageSrc:new URL('../assets/img/splootbox/dog3.jpg', import.meta.url).href,
        number: '01',
        distance: 8,
        tags: ['拉布拉多', '活潑外向', '愛吃'],
        description: 'Duis aute irure dolor in reprehenderit in voluptate velit esse.'
      },
      {
        label: 'card3',
        name: 'Brady',
        imageSrc:new URL('../assets/img/splootbox/dog3.jpg', import.meta.url).href,
        number: '01',
        distance: 8,
        tags: ['黃金獵犬', '活潑外向', '愛吃'],
        description: 'Duis aute irure dolor in reprehenderit in voluptate velit esse.'
      },
      {
        label: 'card4',
        name: 'Luka',
        imageSrc:new URL('../assets/img/splootbox/dog3.jpg', import.meta.url).href,
        number: '01',
        distance: 8,
        tags: ['柴犬', '活潑外向', '愛吃'],
        description: 'Duis aute irure dolor in reprehenderit in voluptate velit esse.'
      },
    ]);

        const movedLeft = ref(false); 
        const movedRight = ref(false); 
        //
        const dislikeClick = () => {
            matchDislike();
            moveCardLeft();
        };

        const likeClick = () => {
            matchLike();
            moveCardRight();
        };

        const moveCardLeft = () => {
        movedLeft.value = !movedLeft.value; 
        };
        const moveCardRight = () => {
        movedRight.value = !movedRight.value; 
        };


        // like/dislike icon active
        const liked = ref(false);
        const disliked = ref(false);

        // 點擊按鈕後讓icon自動消失
        function matchLike() {
        liked.value = true;

        setTimeout(() => {
            liked.value = false;
        }, 800);
        }

        function matchDislike() {
        disliked.value = true;

        setTimeout(() => {
            disliked.value = false;
        }, 800);
        }

        const petImages = ref([
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog1.avif', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href,
        new URL('../assets/img/splootbox/dog2.jpg', import.meta.url).href
        ]);

        // 燈箱 配對喜好設定
        const isLightBoxlightTitleMatchReset = ref(false);

        const lightTitleMatchReset = ref({
                title: '配對喜好設定'
        });
        function toggleLightBoxMatch() {
            isLightBoxlightTitleMatchReset.value = !isLightBoxlightTitleMatchReset.value;
            updateBodyClass();
        };

        // 燈箱 狗狗資訊卡 & 配對成功一覽
        const isLightBoxPetInfo = ref(false);
        const isLightBoxMatchAll = ref(false);

        const lightTitlePetInfo = ref({
            title: '狗狗資訊卡'
        });
        const lightTitleMatchAll = ref({
            title: '配對成功一覽'
        });

        function toggleLightBoxPetInfo() {
            isLightBoxPetInfo.value = !isLightBoxPetInfo.value;
        updateBodyClass();
        }

        function toggleLightBoxMatchAll() {
            isLightBoxMatchAll.value = !isLightBoxMatchAll.value;
        updateBodyClass();
        }

        function updateBodyClass() {
        if (isLightBoxPetInfo.value || isLightBoxMatchAll.value || isLightBoxlightTitleMatchReset.value) {
            document.body.classList.add('clicked');
        } else {
            document.body.classList.remove('clicked');
        }
        }

        /*燈箱 */
        // 哪種朋友
        const tag_friend = {
            formChoice: singleChoice,
            options: ['貓貓朋友', '狗狗朋友', '不限'],
            selected: ref([]),
        };
          // 貓貓朋友
        const tag_cat = {
            formChoice: singleChoice,
            options: ['幼貓', '成貓', '品種貓','不限'],
            selected: ref([]),
        };
        //  狗狗朋友
        const tag_dog = {
            formChoice: singleChoice,
            options: ['小型犬','中型犬', '大型犬', '不限'],
            selected: ref([]),
        };
        //  社交性
        const tag_social = {
            formChoice: singleChoice,
            options: ['親貓親狗', '親近同類 親人', '不親近同類 親人', '不限'],
            selected: ref([]),
        };
        // 絕育狀態
        // fixed : 結紮了
        const tag_fixed = {    
            formChoice: singleChoice,
            options: ['已絕育', '未絕育', '不限'],
            selected: ref([]),
        };
         // 單選
        function singleChoice(selected, option) {
            selected.value = [option];
        }
        // 多選
        function multipleChoice(selected, option) {
            if (optionSelected(selected, option)) {
                selected.value = selected.value.filter(opt => opt !== option);
            } else {
                selected.value.push(option);
            }
        }
        const optionSelected = (selected, option) => {
            return selected.value.includes(option);
        }

        // 圖片路徑
        const resolveImagePath = (image) => {
        // console.log("Resolving image path:", image);
        try {
            const resolvedPath = new URL(`../assets/images/${image}`, import.meta.url).href;
            // console.log("Resolved Path:", resolvedPath);
            return resolvedPath;
        } catch (error) {
            console.error("Failed to resolve image path:", error);
            return new URL('../assets/images/default.png', import.meta.url).href;
        }
        };
    </script>
    
    