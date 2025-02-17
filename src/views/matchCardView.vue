<template>
    <MainHeader theme="red" bgc="purple-1"></MainHeader>
<!-- 全部內容 -->
<div class="matchbox">
    <!-- 遮罩以上 -->
    <div class="upperSection">
        <!-- 卡片部分 -->
         <div class="cardWrapMatch">
             <div class="cardwrapper" 
                v-for="(plan, ownerIndex) in filteredCards" :key="plan.owner" 
                :class="[{'movedLeft': movedLeft}, {'movedRight': movedRight}]">

                <!-- 左側圖片區 -->
                 <div class="imageContainer">
                     <img :src="plan.pets[plan.petShowing].imageSrc" alt="">
                 </div>
                 <!-- 右側內容區 -->
                 <div class="content">
                     <div class="topSection">
                        <div class="dot">
                            <div 
                                v-for="(pet, index) in plan.pets" 
                                :key="index"
                                :id="index"
                                :class="{ 'dotActive': index === plan.petShowing, 'dotInactive': index !== plan.petShowing }"
                                @click="dotClicked(index, ownerIndex)"
                            ></div>
                        </div>
                        <div class="number">{{ dottedNumber }}</div>
                    </div>
                     <!-- 名稱與距離 -->
                     <div class="info">
                         <div class="nameAndGender">
                         <h4 class="bold name">{{ plan.pets[plan.petShowing].name }}</h4>
                            <!-- gender icon -->
                            <img v-if="plan.pets[plan.petShowing].gender == 'Female'" src="../assets/img/icon/femaleIcon.svg" alt="Female Icon" style="width: 2rem;" />
                            <img v-else-if="plan.pets[plan.petShowing].gender == 'Male'" src="../assets/img/icon/maleIcon.svg" alt="Male Icon" style="width: 2rem;" />
                         </div>
                         <div class="distance">
                         <div class="smallText distanceIcon"></div>
                         距離你{{ plan.pets[plan.petShowing].distance }}公里
                         </div>
                     </div>
                     <!-- 標籤區 -->
                     <div class="tags">
                         <span class="xsText tag" v-for="tag in plan.pets[plan.petShowing].tags" :key="tag">{{ tag }}</span>
                     </div>
                     <!-- 內文 -->
                     <p class="description bold">{{ plan.pets[plan.petShowing].description }}</p>
                 </div>
             </div>
         </div>
        <div class="likeBtns">
            <Btn class="likeBtn" btnStyle="outline default"
            @click="dislikeClick">不喜歡</Btn> 
            <Btn class="likeBtn" btnType="form" btnStyle="nextQ"
            @click="likeClick">喜歡</Btn>
            <div class="iconOverlayDislike">
                <img v-if="dislikedIcon" src="../assets/img/icon/dislikeIcon.svg" alt="Icon" style="width: 17.1rem;">
            </div>
            <div class="iconOverlayLike">
                <img v-if="likedIcon" src="../assets/img/icon/likeIcon.svg" alt="Icon" style="width: 14.3rem;">
            </div>
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
        <div class="cardSlots">
            <div class="cardContainer" 
                v-for="(matchedOwner, cardIndex) in matchedCard" 
                :key="cardIndex">
                
                <div class="petImage">
                    <img :src="matchedOwner.pets[0].imageSrc" alt="Pet Image"style="cursor: pointer;"
                        @click="toggleLightBoxPetInfo">
                    
                    <div class="dot">
                        <div 
                            v-for="(pet, dotIndex) in matchedOwner.pets" 
                            :key="dotIndex"
                            :class="{ 'dotActive': clickedIndexOverlay[cardIndex] === dotIndex, 'dotInactive': clickedIndexOverlay[cardIndex] !== dotIndex }"
                            @click="clickedIndexOverlay[cardIndex] = dotIndex;">
                        </div>
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
    <div class="matchAllBox">
    <div class="cardSlotsPopUp">
        <div class="cardSlots">
            <div class="cardContainer" 
                v-for="(owner, ownerIndex) in matchedCard" 
                :key="ownerIndex">
                
                <div class="petImage"
                    v-for="(pet, petIndex) in owner.pets" 
                    :key="petIndex">
                    <img :src="pet.imageSrc" alt="Pet Image"
                        style="cursor: pointer;"
                        @click="toggleLightBoxPetInfo">
                    
                    <div class="dot">
                        <div 
                            v-for="(pet, dotIndex) in matchedCard" 
                            :key="dotIndex"
                            :class="{ 'dotActive': clickedIndexMatchAll[cardIndex] === dotIndex, 'dotInactive': clickedIndexMatchAll[cardIndex] !== dotIndex }"
                            @click="clickedIndexMatchAll[cardIndex] = dotIndex;">
                        </div>
                    </div>
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
    @toggle="toggleLightBoxPetInfo">
    <div class="petInfoBoxPopUp">
        <div class="cardWrapPopUp">
            <!-- 卡片部分 -->
            <div class="cardwrapper" v-if="lightBoxPetInfo">
                <!-- 左側圖片區 -->
                <div class="imageContainer">
                    <img :src="matchedCard[0].pets[0].imageSrc" alt="">
                </div>
                <!-- 右側內容區 -->
                <div class="content">
                    <div class="topSection">
                    <!-- <div class="dot">
                        <div class="dotActive"></div>
                        <div class="dotInactive"></div>
                        <div class="dotInactive"></div>
                    </div> -->
                    <div class="dot">
                        <div 
                            v-for="(pet, index) in filteredCards" 
                            :key="index"
                            :class="{ 'dotActive': index === clickedIndex, 'dotInactive': index !== clickedIndex }"
                            @click="dotClicked(index)"
                        ></div>
                    </div>
                    <div class="number">{{ dottedNumber }}</div>
                    </div>
                    <!-- 名稱與距離 -->
                    <div class="info">
                        <div class="nameAndGender">
                            <h4 class="bold name">{{ lightBoxPetInfo.name }}</h4>
                            <!-- gender icon -->
                            <img v-if="plan.pets[plan.petShowing].gender == 'Female'" src="../assets/img/icon/femaleIcon.svg" alt="Female Icon" style="width: 2rem;" />
                            <img v-else-if="plan.pets[plan.petShowing].gender == 'Male'" src="../assets/img/icon/maleIcon.svg" alt="Male Icon" style="width: 2rem;" />
                        </div>
                        <div class="distance">
                        <div class="smallText distanceIcon"></div>
                        距離你{{ lightBoxPetInfo.distance }}公里
                        </div>
                    </div>
                    <!-- 標籤區 -->
                    <div class="tags">
                         <span class="xsText tag" v-for="tag in lightBoxPetInfo.tags" :key="tag">{{ tag }}</span>
                     </div>
                    <!-- 內文 -->
                    <p class="description bold">{{ lightBoxPetInfo.description }}</p>
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
        import { ref, computed } from 'vue';
        import MainHeader from "../components/MainHeader.vue";
        import Btn from '../components/Btn.vue';
        import LightBox from "@/components/LightBox.vue";

        const movedLeft = ref(false);
        const movedRight = ref(false);
        const likedIcon = ref(false);
        const dislikedIcon = ref(false);
        const cardFlying = ref(false);
        const isLightBoxlightTitleMatchReset = ref(false);
        const isLightBoxPetInfo = ref(false);
        const isLightBoxMatchAll = ref(false);


        const matchedCard = ref([
            {
                owner: 'Emily',
                pets: [
                    { label: 'card4', name: 'Max', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '01', distance: 5, tags: ['金毛尋回犬', '溫順', '喜歡游泳'], description: 'Max 是一隻愛水的金毛，喜歡在湖邊玩耍，是個很好的夥伴！', gender: 'Male' },
                    { label: 'card5', name: 'Bella', imageSrc: new URL('../assets/img/match/goldenDog.avif', import.meta.url).href, number: '02', distance: 7, tags: ['貴賓犬', '聰明', '喜歡散步'], description: 'Bella 是一隻聰明的貴賓犬，會很多小技巧，還是個愛散步的小天使！', gender: 'Female' },
                    { label: 'card7', name: 'Charlie', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '03', distance: 3, tags: ['拉布拉多', '熱心', '愛啃骨頭'], description: 'Charlie 喜歡和人玩，對每個人都很熱心，最愛啃骨頭。', gender: 'Male' }
                ],
                petShowing: 0
            },
            {
                owner: 'Sam',
                pets: [
                    { label: 'card4', name: 'Lucy', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 4, tags: ['柯基', '外向', '喜歡跑步'], description: 'Lucy 是隻活潑的小柯基，喜歡跑步，總是跑得飛快！', gender: 'Female' },
                    { label: 'card5', name: 'Oscar', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 6, tags: ['法國鬥牛犬', '粘人', '喜歡睡覺'], description: 'Oscar 喜歡在主人旁邊黏著，特別愛睡覺。', gender: 'Male' },
                    { label: 'card6', name: 'Rusty', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '03', distance: 5, tags: ['比格犬', '調皮', '愛追球'], description: 'Rusty 喜歡追著球跑，總是能讓周圍充滿活力！', gender: 'Male' }
                ],
                petShowing: 0
            },
            {
                owner: 'Lupe',
                pets: [
                    { label: 'card4', name: 'Toby', imageSrc: new URL('../assets/img/match/dog4.avif', import.meta.url).href, number: '01', distance: 3, tags: ['邊境牧羊犬', '機警', '喜歡挑戰'], description: 'Toby 很機警，總能迅速應對各種挑戰，最愛玩各種智力遊戲。', gender: 'Male' },
                    { label: 'card4', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '01', distance: 8, tags: ['杜賓犬', '忠誠', '喜歡奔跑'], description: 'Rocky 是一隻忠誠的杜賓犬，愛與主人一起奔跑，是個很有活力的夥伴。', gender: 'Male' },
                    { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male' },
                    { label: 'card7', name: 'Zara', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '02', distance: 6, tags: ['臘腸犬', '堅毅', '喜歡挖洞'], description: 'Zara 喜歡在花園裡挖洞，是隻非常堅毅的小臘腸犬。', gender: 'Female' }
                ],
                petShowing: 0
            },
            {
                owner: 'Hao',
                pets: [
                    { label: 'card4', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '01', distance: 8, tags: ['杜賓犬', '忠誠', '喜歡奔跑'], description: 'Rocky 是一隻忠誠的杜賓犬，愛與主人一起奔跑，是個很有活力的夥伴。', gender: 'Male' },
                    { label: 'card4', name: 'Luna', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 10, tags: ['哈士奇', '調皮', '喜歡雪地'], description: 'Luna 喜歡在雪地裡玩耍，性格調皮，總是喜歡捉弄其他狗狗。', gender: 'Female' },
                    { label: 'card5', name: 'Milo', imageSrc: new URL('../assets/img/match/dog7.avif', import.meta.url).href, number: '02', distance: 5, tags: ['西施犬', '親和', '愛玩具'], description: 'Milo 是隻非常友善的小西施，對每個人都很親切，愛玩各種玩具。', gender: 'Male' }
                ],
                petShowing: 0
            },
            {
                owner: 'Ian',
                pets: [
                    { label: 'card4', name: 'Luna', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 10, tags: ['哈士奇', '調皮', '喜歡雪地'], description: 'Luna 喜歡在雪地裡玩耍，性格調皮，總是喜歡捉弄其他狗狗。', gender: 'Female' },
                    { label: 'card5', name: 'Maya', imageSrc: new URL('../assets/img/match/dog4.avif', import.meta.url).href, number: '02', distance: 9, tags: ['拉布拉多', '活潑', '喜歡游泳'], description: 'Maya 是一隻喜歡游泳的拉布拉多，游泳時格外自在。', gender: 'Female' },
                    { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male' }
                ],
                petShowing: 0
            },
            {
                owner: 'Olivia',
                pets: [
                    { label: 'card4', name: 'Zeus', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '01', distance: 12, tags: ['大丹犬', '穩重', '喜歡散步'], description: 'Zeus 是一隻穩重的大丹犬，喜歡悠閒地散步，步伐穩定，極具威風。', gender: 'Male' },
                    { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male' },
                    { label: 'card5', name: 'Maya', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '02', distance: 9, tags: ['拉布拉多', '活潑', '喜歡游泳'], description: 'Maya 是一隻喜歡游泳的拉布拉多，游泳時格外自在。', gender: 'Female' }
                ],
                petShowing: 0
            }
        ]);


        const lightBoxPetInfo = ref(
            { label: 'card7', name: 'Luka', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '07', distance: 4, tags: ['薩摩耶', '活潑外向', '愛吃肉肉'], description: 'Duis aute irure dolor in reprehenderit in voluptate velit esse.' }
            );
        const cardsData = ref([
            {
                owner: 'Emily',
                pets: [
                    { label: 'card4', name: 'Max', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '01', distance: 5, tags: ['金毛尋回犬', '溫順', '喜歡游泳'], description: 'Max 是一隻愛水的金毛，喜歡在湖邊玩耍，是個很好的夥伴！', gender: 'Male' },
                    { label: 'card5', name: 'Bella', imageSrc: new URL('../assets/img/match/goldenDog.avif', import.meta.url).href, number: '02', distance: 7, tags: ['貴賓犬', '聰明', '喜歡散步'], description: 'Bella 是一隻聰明的貴賓犬，會很多小技巧，還是個愛散步的小天使！', gender: 'Female' },
                    { label: 'card7', name: 'Charlie', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '03', distance: 3, tags: ['拉布拉多', '熱心', '愛啃骨頭'], description: 'Charlie 喜歡和人玩，對每個人都很熱心，最愛啃骨頭。', gender: 'Male' }
                ],
                petShowing: 0
            },
            {
                owner: 'Sam',
                pets: [
                    { label: 'card4', name: 'Lucy', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 4, tags: ['柯基', '外向', '喜歡跑步'], description: 'Lucy 是隻活潑的小柯基，喜歡跑步，總是跑得飛快！', gender: 'Female' },
                    { label: 'card5', name: 'Oscar', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 6, tags: ['法國鬥牛犬', '粘人', '喜歡睡覺'], description: 'Oscar 喜歡在主人旁邊黏著，特別愛睡覺。', gender: 'Male' },
                    { label: 'card6', name: 'Rusty', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '03', distance: 5, tags: ['比格犬', '調皮', '愛追球'], description: 'Rusty 喜歡追著球跑，總是能讓周圍充滿活力！', gender: 'Male' }
                ],
                petShowing: 0
            },
            {
                owner: 'Lupe',
                pets: [
                    { label: 'card4', name: 'Toby', imageSrc: new URL('../assets/img/match/dog4.avif', import.meta.url).href, number: '01', distance: 3, tags: ['邊境牧羊犬', '機警', '喜歡挑戰'], description: 'Toby 很機警，總能迅速應對各種挑戰，最愛玩各種智力遊戲。', gender: 'Male' },
                    { label: 'card4', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '01', distance: 8, tags: ['杜賓犬', '忠誠', '喜歡奔跑'], description: 'Rocky 是一隻忠誠的杜賓犬，愛與主人一起奔跑，是個很有活力的夥伴。', gender: 'Male' },
                    { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male' },
                    { label: 'card7', name: 'Zara', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '02', distance: 6, tags: ['臘腸犬', '堅毅', '喜歡挖洞'], description: 'Zara 喜歡在花園裡挖洞，是隻非常堅毅的小臘腸犬。', gender: 'Female' }
                ],
                petShowing: 0
            },
            {
                owner: 'Hao',
                pets: [
                    { label: 'card4', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '01', distance: 8, tags: ['杜賓犬', '忠誠', '喜歡奔跑'], description: 'Rocky 是一隻忠誠的杜賓犬，愛與主人一起奔跑，是個很有活力的夥伴。', gender: 'Male' },
                    { label: 'card4', name: 'Luna', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 10, tags: ['哈士奇', '調皮', '喜歡雪地'], description: 'Luna 喜歡在雪地裡玩耍，性格調皮，總是喜歡捉弄其他狗狗。', gender: 'Female' },
                    { label: 'card5', name: 'Milo', imageSrc: new URL('../assets/img/match/dog7.avif', import.meta.url).href, number: '02', distance: 5, tags: ['西施犬', '親和', '愛玩具'], description: 'Milo 是隻非常友善的小西施，對每個人都很親切，愛玩各種玩具。', gender: 'Male' }
                ],
                petShowing: 0
            },
            {
                owner: 'Ian',
                pets: [
                    { label: 'card4', name: 'Luna', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 10, tags: ['哈士奇', '調皮', '喜歡雪地'], description: 'Luna 喜歡在雪地裡玩耍，性格調皮，總是喜歡捉弄其他狗狗。', gender: 'Female' },
                    { label: 'card5', name: 'Maya', imageSrc: new URL('../assets/img/match/dog4.avif', import.meta.url).href, number: '02', distance: 9, tags: ['拉布拉多', '活潑', '喜歡游泳'], description: 'Maya 是一隻喜歡游泳的拉布拉多，游泳時格外自在。', gender: 'Female' },
                    { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male' }
                ],
                petShowing: 0
            },
            {
                owner: 'Olivia',
                pets: [
                    { label: 'card4', name: 'Zeus', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '01', distance: 12, tags: ['大丹犬', '穩重', '喜歡散步'], description: 'Zeus 是一隻穩重的大丹犬，喜歡悠閒地散步，步伐穩定，極具威風。', gender: 'Male' },
                    { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male' },
                    { label: 'card5', name: 'Maya', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '02', distance: 9, tags: ['拉布拉多', '活潑', '喜歡游泳'], description: 'Maya 是一隻喜歡游泳的拉布拉多，游泳時格外自在。', gender: 'Female' }
                ],
                petShowing: 0
            }
        ]);

        const clickedOwnerIndex = ref(0); //目前選中的owner,default為第一個
        const clickedIndex = ref(0); //目前選中的寵物index
        // const clickedIndexOverlay = ref(0); 
        // const clickedIndexMatchAll = ref(0); 
        const clickedIndexOverlay = ref(Array(matchedCard.value.length).fill(null)); 
        const clickedIndexMatchAll = ref(Array(matchedCard.value.length).fill(null));   



        const dotClicked = (index, ownerIndex = -1) => {
            clickedIndex.value = index;
            if(ownerIndex != -1){
                filteredCards.value[ownerIndex].petShowing = index;
            }
        };

        //格式化數字
        const dottedNumber = computed(() => {
            return (clickedIndex.value + 1).toString().padStart(2, '0'); //index+1並轉換為兩位數字, 前面加上0
        });

        //依照 clickedOwnerIndex 動態過濾對應的寵物資料
        const filteredCards = computed(() => {
            // return cardsData.value[clickedOwnerIndex.value].pets;
            return cardsData.value.slice(0,3).reverse();
        });

        //刪除卡片
        function deleted(){
            filteredCards.value.pop();
            if(cardsData.value.length > 0){
                filteredCards.value.unshift(cardsData.value[0]);
                cardsData.value.splice(0,1);
            }
        }

        // like/dislike 按鈕
        const likeClick = () => {
            if(cardFlying.value == false){
                matchLike();
                moveCardRight();
                cardFlying.value == true;
                clickedIndex.value = 0;

            }
        };
    
        const dislikeClick = () => {
            if(cardFlying.value == false){
                matchDislike();
                moveCardLeft();
                cardFlying.value == true;
                clickedIndex.value = 0;

            }
        };

        // 動畫處理 + 刪除卡片
        const moveCardLeft = () => {
            movedLeft.value = true;
            movedRight.value = false;

            setTimeout(() => {
                movedLeft.value = false;
                deleted(); // 動畫結束後才刪除
            }, 300);
        };

        const moveCardRight = () => {
        movedRight.value = true;
        movedLeft.value = false;
        
        setTimeout(() => {
            movedRight.value = false;
            deleted(); // 動畫結束後才刪除
        }, 300);
        };

        // like/dislike icon 動畫
        const matchLike = () => {
        likedIcon.value = true;
        setTimeout(() => {
            likedIcon.value = false;
        }, 500);
        };

        const matchDislike = () => {
            dislikedIcon.value = true;
            setTimeout(() => {
                dislikedIcon.value = false;
                cardFlying.value = false;
            }, 500);
        };

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
        const lightTitleMatchReset = ref({
                title: '配對喜好設定'
        });
        // 燈箱 狗狗資訊卡 & 配對成功一覽
        const lightTitlePetInfo = ref({
            title: '狗狗資訊卡'
        });
        const lightTitleMatchAll = ref({
            title: '配對成功一覽'
        });
        function toggleLightBoxMatch() {
            isLightBoxlightTitleMatchReset.value = !isLightBoxlightTitleMatchReset.value;
            updateBodyClass();
        };
        // const currentLightBoxPet = ref(0);
        function toggleLightBoxPetInfo(ownerIndex) {
            isLightBoxPetInfo.value = !isLightBoxPetInfo.value;
            // currentLightBoxPet.value = ownerIndex;
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
        // fixed : 已結紮
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
    </script>
    
    