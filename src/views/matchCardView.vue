<template>
    <MainHeader theme="red" bgc=""></MainHeader>
    <!-- <main class="bg-purple-1" style="z-index: -10;"> -->
    <!------------------------match question 1---------------------->
<div class="matchbox">
    <div class="cardWrap">
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
    <div class="likeBtns">
        <Btn class="likeBtn" btnStyle="outline default">不喜歡</Btn> 
        <Btn class="likeBtn" btnType="form" btnStyle="nextQ">喜歡</Btn> 
    </div>
    <div class="preferenceBox">
        <div class="preferenceBtns">
            <Btn class="viewAllMatch" btnStyle="baseline small"
            @click="toggleLightBoxMatchAll">查看所有成功配對</Btn>
            <RouterLink to="/member-center/petCard">
                <Btn class="preferenceBtn" btnStyle="baseline small">更改喜好設定</Btn>
            </RouterLink>
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
            <span class="xsText bold tagRed">12/12碧潭野餐</span>
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

<!-- circle bg -->
<div class="circleMatch"></div>
</template>
    
    <script setup>
        import { ref } from 'vue';
        import MainHeader from "../components/MainHeader.vue";
        import Btn from '../components/Btn.vue';
        import LightBox from "@/components/LightBox.vue";

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
    if (isLightBoxPetInfo.value || isLightBoxMatchAll.value) {
        document.body.classList.add('clicked');
    } else {
        document.body.classList.remove('clicked');
    }
    }
    </script>
    
    