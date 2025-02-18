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
                        @click="toggleLightBoxPetInfo(matchedOwner)">
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
                v-for="(matchedOwner, cardIndex) in matchedCard" 
                :key="cardIndex">
                
                <div class="petImage">
                    <img :src="matchedOwner.pets[0].imageSrc" alt="Pet Image"style="cursor: pointer;"
                        @click="toggleLightBoxPetInfo(matchedOwner)">
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
                    <img :src="selectedCard.pets[0].imageSrc" alt="">
                </div>
                <!-- 右側內容區 -->
                <div class="content">
                    <div class="topSection">
                    <div class="dot">
                        <div 
                            v-for="(pet, index) in selectedCard.pets" 
                            :key="index"
                            :class="{ 'dotActive': index === selectedCard.petShowing, 'dotInactive': index !== selectedCard.petShowing }"
                            @click="dotClicked(index)"
                        ></div>
                    </div>
                    <div class="number">{{ dottedNumber }}</div>
                    </div>
                    <!-- 名稱與距離 -->
                    <div class="info">
                        <div class="nameAndGender">
                            <h4 class="bold name">{{ selectedCard.pets[0].name }}</h4>
                            <!-- gender icon -->
                            <img v-if="selectedCard.pets[0].gender == 'Female'" src="../assets/img/icon/femaleIcon.svg" alt="Female Icon" style="width: 2rem;" />
                            <img v-else-if="selectedCard.pets[0].gender == 'Male'" src="../assets/img/icon/maleIcon.svg" alt="Male Icon" style="width: 2rem;" />
                        </div>
                        <div class="distance">
                        <div class="smallText distanceIcon"></div>
                        距離你{{ selectedCard.pets[0].distance }}公里
                        </div>
                    </div>
                    <!-- 標籤區 -->
                    <div class="tags">
                         <span class="xsText tag" v-for="tag in selectedCard.pets[0].tags" :key="tag">{{ tag }}</span>
                     </div>
                    <!-- 內文 -->
                    <p class="description bold">{{ selectedCard.pets[0].description }}</p>
                </div>
            </div>
        </div>
        <!-- 右側內容區 -->
        <div class="ownerContent" v-if="lightBoxPetInfo">
            <div class="boxDivider"></div>
            <!-- 名稱-->
                <div class="ownerName">
                    <h4 class="bold">{{selectedCard.owner}}</h4>
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
                <div class="smallText">寵物基本資料</div>
                <!-- 標籤區 -->
                <div class="tags">
                    <span class="xsText tag" v-for="tag in selectedCard.pets[0].tags" :key="tag">{{ tag }}</span>
                </div>
            </div>
            <div class="ownerInfoSec">
                <!-- 基本資料 -->
                <div class="smallText">正在舉辦</div>
                <!-- 標籤區 -->
                <div class="tags">
                <span class="xsText bold tagRed" v-for="event in selectedCard.pets[0].events" :key="event">{{event}}</span>
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
                { label: 'card4', name: 'Max', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '01', distance: 5, tags: ['金毛尋回犬', '溫順', '喜歡游泳'], description: 'Max 是一隻愛水的金毛，喜歡在湖邊玩耍，是個很好的夥伴！', gender: 'Male', events: ['2/10公園晨跑', '2/22湖邊遊玩'] },
                { label: 'card5', name: 'Bella', imageSrc: new URL('../assets/img/match/goldenDog.avif', import.meta.url).href, number: '02', distance: 7, tags: ['貴賓犬', '聰明', '喜歡散步'], description: 'Bella 是一隻聰明的貴賓犬，會很多小技巧，還是個愛散步的小天使！', gender: 'Female', events: ['2/15花園玩耍', '3/1跑步比賽'] },
                { label: 'card7', name: 'Charlie', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '03', distance: 3, tags: ['拉布拉多', '熱心', '愛啃骨頭'], description: 'Charlie 喜歡和人玩，對每個人都很熱心，最愛啃骨頭。', gender: 'Male', events: ['12/12碧潭野餐', '2/24迎風狗公園聚會'] }
            ],
            petShowing: 0
        },
        {
            owner: 'Sam',
            pets: [
                { label: 'card4', name: 'Lucy', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 4, tags: ['柯基', '外向', '喜歡跑步'], description: 'Lucy 是隻活潑的小柯基，喜歡跑步，總是跑得飛快！', gender: 'Female', events: ['2/10市區跑步', '3/5狗狗展'] },
                { label: 'card5', name: 'Oscar', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 6, tags: ['法國鬥牛犬', '粘人', '喜歡睡覺'], description: 'Oscar 喜歡在主人旁邊黏著，特別愛睡覺。', gender: 'Male', events: ['2/14午睡大賽', '3/10主人的生日派對'] },
                { label: 'card6', name: 'Rusty', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '03', distance: 5, tags: ['比格犬', '調皮', '愛追球'], description: 'Rusty 喜歡追著球跑，總是能讓周圍充滿活力！', gender: 'Male', events: ['2/5球場遊玩', '3/15公園追球'] }
            ],
            petShowing: 0
        },
        {
            owner: 'Lupe',
            pets: [
                { label: 'card4', name: 'Toby', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '01', distance: 3, tags: ['邊境牧羊犬', '機警', '喜歡挑戰'], description: 'Toby 很機警，總能迅速應對各種挑戰，最愛玩各種智力遊戲。', gender: 'Male', events: ['2/7智力挑戰賽', '3/20公園越野賽'] },
                { label: 'card4', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '01', distance: 8, tags: ['杜賓犬', '忠誠', '喜歡奔跑'], description: 'Rocky 是一隻忠誠的杜賓犬，愛與主人一起奔跑，是個很有活力的夥伴。', gender: 'Male', events: ['2/28戶外運動會', '3/8山區奔跑'] },
                { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male', events: ['2/15獨處挑戰', '3/25主人的散步活動'] },
                { label: 'card7', name: 'Zara', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '02', distance: 6, tags: ['臘腸犬', '堅毅', '喜歡挖洞'], description: 'Zara 喜歡在花園裡挖洞，是隻非常堅毅的小臘腸犬。', gender: 'Female', events: ['2/20挖洞比賽', '3/12花園冒險'] }
            ],
            petShowing: 0
        },
        {
            owner: 'Hao',
            pets: [
                { label: 'card4', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '01', distance: 8, tags: ['杜賓犬', '忠誠', '喜歡奔跑'], description: 'Rocky 是一隻忠誠的杜賓犬，愛與主人一起奔跑，是個很有活力的夥伴。', gender: 'Male', events: ['2/10街頭跑步', '3/22公園散步'] },
                { label: 'card4', name: 'Luna', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 10, tags: ['哈士奇', '調皮', '喜歡雪地'], description: 'Luna 喜歡在雪地裡玩耍，性格調皮，總是喜歡捉弄其他狗狗。', gender: 'Female', events: ['2/5雪地探索', '3/3雪地球賽'] },
                { label: 'card5', name: 'Milo', imageSrc: new URL('../assets/img/match/dog7.avif', import.meta.url).href, number: '02', distance: 5, tags: ['西施犬', '親和', '愛玩具'], description: 'Milo 是隻非常友善的小西施，對每個人都很親切，愛玩各種玩具。', gender: 'Male', events: ['2/12玩具大賽', '3/14親子活動'] }
            ],
            petShowing: 0
        },
        {
            owner: 'Ian',
            pets: [
                { label: 'card4', name: 'Luna', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 10, tags: ['哈士奇', '調皮', '喜歡雪地'], description: 'Luna 喜歡在雪地裡玩耍，性格調皮，總是喜歡捉弄其他狗狗。', gender: 'Female', events: ['2/5雪地遊戲', '3/12雪地狂奔'] },
                { label: 'card5', name: 'Maya', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '02', distance: 9, tags: ['拉布拉多', '活潑', '喜歡游泳'], description: 'Maya 是一隻喜歡游泳的拉布拉多，游泳時格外自在。', gender: 'Female', events: ['2/7湖邊泳池', '3/14水中挑戰'] },
                { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male', events: ['2/18獨立訓練', '3/5戶外散步'] }
            ],
            petShowing: 0
        },
        {
            owner: 'Olivia',
            pets: [
                { label: 'card4', name: 'Zeus', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '01', distance: 12, tags: ['大丹犬', '穩重', '喜歡散步'], description: 'Zeus 是一隻穩重的大丹犬，喜歡悠閒地散步，步伐穩定，極具威風。', gender: 'Male', events: ['2/8悠閒散步', '3/18悠遊大街'] },
                { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male', events: ['2/14健行活動', '3/5公園日'] },
                { label: 'card5', name: 'Maya', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '02', distance: 9, tags: ['拉布拉多', '活潑', '喜歡游泳'], description: 'Maya 是一隻喜歡游泳的拉布拉多，游泳時格外自在。', gender: 'Female', events: ['2/12泳池日', '3/28沙灘挑戰'] }
            ],
            petShowing: 0
        },
                { owner: 'Alice', pets: [
                { label: 'card1', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '01', distance: 4, tags: ['黃金獵犬', '友善', '喜歡嬉戲'], description: 'Buddy 是一隻非常友善的黃金獵犬，喜歡與人一起玩耍，活力十足！', gender: 'Male', events: ['2/12沙灘遊玩', '3/1公園散步'] },
                { label: 'card2', name: 'Lola', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '02', distance: 6, tags: ['邊境牧羊犬', '聰明', '喜歡挑戰'], description: 'Lola 是一隻聰明的邊境牧羊犬，愛解謎，經常參加各種智力挑戰。', gender: 'Female', events: ['2/20智力大賽', '3/5跨越障礙'] },
                { label: 'card3', name: 'Rex', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '03', distance: 5, tags: ['杜賓犬', '忠誠', '喜歡運動'], description: 'Rex 是隻忠誠的杜賓犬，喜歡和主人一起跑步，總是精力充沛。', gender: 'Male', events: ['2/7戶外跑步', '3/10跳躍挑戰'] }
            ], petShowing: 0 },

        { owner: 'Jack', pets: [
            { label: 'card1', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 4, tags: ['比特犬', '勇敢', '喜歡玩球'], description: 'Rocky 是一隻勇敢的比特犬，總是敢於挑戰各種遊戲，尤其喜歡玩球。', gender: 'Male', events: ['2/5球場大賽', '3/15戶外挑戰'] },
            { label: 'card2', name: 'Molly', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 6, tags: ['拉布拉多', '親切', '喜歡游泳'], description: 'Molly 是隻親切的拉布拉多，愛游泳，總是喜歡在水裡玩耍。', gender: 'Female', events: ['2/14湖邊泳池', '3/8水上競技'] },
            { label: 'card3', name: 'Bella', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '03', distance: 5, tags: ['貴賓犬', '聰明', '喜歡挑戰'], description: 'Bella 是隻聰明的貴賓犬，喜歡參加各種挑戰，特別擅長跳躍。', gender: 'Female', events: ['2/10障礙挑戰', '3/3跳躍比賽'] }
        ], petShowing: 0 },

        { owner: 'Sophie', pets: [
            { label: 'card1', name: 'Max', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '01', distance: 3, tags: ['金毛尋回犬', '溫順', '喜歡游泳'], description: 'Max 是隻溫順的金毛，特別喜歡水，會跳進湖裡游泳。', gender: 'Male', events: ['2/7湖邊游泳', '3/10公園散步'] },
            { label: 'card2', name: 'Lucy', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '02', distance: 5, tags: ['柴犬', '活潑', '喜歡獨處'], description: 'Lucy 是隻活潑的柴犬，儘管她喜歡獨處，但也很擅長獨立完成任務。', gender: 'Female', events: ['2/14獨立挑戰', '3/20戶外活動'] },
            { label: 'card3', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '03', distance: 4, tags: ['比格犬', '調皮', '愛玩具'], description: 'Buddy 是一隻調皮的比格犬，對玩具總是充滿興趣，愛和人玩耍。', gender: 'Male', events: ['2/12玩具大賽', '3/5跑步活動'] }
        ], petShowing: 0 },

        { owner: 'Michael', pets: [
            { label: 'card1', name: 'Rex', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '01', distance: 6, tags: ['拉布拉多', '溫馴', '喜歡游泳'], description: 'Rex 是一隻溫馴的拉布拉多，愛游泳，是水中小高手！', gender: 'Male', events: ['2/8湖邊泳池', '3/15水中挑戰'] },
            { label: 'card2', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '02', distance: 5, tags: ['金毛尋回犬', '親切', '喜歡戶外'], description: 'Rocky 是隻親切的金毛尋回犬，喜歡和朋友一起享受戶外時光。', gender: 'Male', events: ['2/5戶外露營', '3/18散步聚會'] },
            { label: 'card3', name: 'Maya', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '03', distance: 7, tags: ['柴犬', '堅韌', '喜歡戶外活動'], description: 'Maya 是隻堅韌的柴犬，喜歡挑戰各種戶外活動，總是充滿活力。', gender: 'Female', events: ['2/12戶外挑戰', '3/22森林遠足'] }
        ], petShowing: 0 },

        { owner: 'David', pets: [
            { label: 'card1', name: 'Charlie', imageSrc: new URL('../assets/img/match/dog7.avif', import.meta.url).href, number: '01', distance: 5, tags: ['法國鬥牛犬', '粘人', '喜歡睡覺'], description: 'Charlie 是隻粘人的法國鬥牛犬，喜歡在主人的膝蓋上睡覺。', gender: 'Male', events: ['2/5午睡大賽', '3/1狗狗展'] },
            { label: 'card2', name: 'Luna', imageSrc: new URL('../assets/img/match/dog8.avif', import.meta.url).href, number: '02', distance: 6, tags: ['哈士奇', '調皮', '喜歡雪地'], description: 'Luna 是隻調皮的哈士奇，喜歡在雪地裡玩耍，總是捉弄其他狗狗。', gender: 'Female', events: ['2/15雪地追逐', '3/10雪地大賽'] },
            { label: 'card3', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '03', distance: 8, tags: ['比格犬', '活潑', '喜歡跑步'], description: 'Buddy 是一隻活潑的比格犬，總是跑得飛快，愛與主人一起運動。', gender: 'Male', events: ['2/8公園奔跑', '3/18長跑挑戰'] }
        ], petShowing: 0 },
        { owner: 'Emma', pets: [
            { label: 'card1', name: 'Bella', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '01', distance: 6, tags: ['拉布拉多', '友善', '喜歡遊戲'], description: 'Bella 是一隻友善的拉布拉多，總是喜歡和朋友一起玩遊戲，特別是球類遊戲。', gender: 'Female', events: ['2/12公園遊戲', '3/3球類挑戰'] },
            { label: 'card2', name: 'Charlie', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '02', distance: 7, tags: ['德國牧羊犬', '聰明', '喜歡學習'], description: 'Charlie 是一隻聰明的德國牧羊犬，擅長學習新技巧和動作，總是挑戰自己。', gender: 'Male', events: ['2/20學習新技巧', '3/10協作訓練'] },
            { label: 'card3', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '03', distance: 5, tags: ['比特犬', '忠誠', '喜歡護衛'], description: 'Rocky 是隻忠誠的比特犬，天生擅長護衛，與主人形影不離。', gender: 'Male', events: ['2/10護衛訓練', '3/15安全測試'] }
        ], petShowing: 0 },

        { owner: 'Daniel', pets: [
            { label: 'card1', name: 'Daisy', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '01', distance: 4, tags: ['貴賓犬', '溫柔', '喜歡安靜'], description: 'Daisy 是隻溫柔的貴賓犬，喜歡安靜的環境，適合喜愛寧靜的人群。', gender: 'Female', events: ['2/12安靜時光', '3/1下午茶'] },
            { label: 'card2', name: 'Max', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '02', distance: 6, tags: ['邊境牧羊犬', '活躍', '喜歡挑戰'], description: 'Max 是一隻活躍的邊境牧羊犬，總是喜歡挑戰自我，參加各種運動。', gender: 'Male', events: ['2/14運動比賽', '3/5跳躍挑戰'] },
            { label: 'card3', name: 'Luna', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '03', distance: 8, tags: ['哈士奇', '堅韌', '喜歡冒險'], description: 'Luna 是隻堅韌的哈士奇，喜歡冒險，挑戰自我，時常參加越野活動。', gender: 'Female', events: ['2/10越野活動', '3/12雪地挑戰'] }
        ], petShowing: 0 },

        { owner: 'Sophia', pets: [
            { label: 'card1', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '01', distance: 5, tags: ['柯基犬', '可愛', '喜歡跳躍'], description: 'Buddy 是隻可愛的柯基犬，喜歡跳躍，擁有無窮的活力和精力。', gender: 'Male', events: ['2/5跳躍大賽', '3/15快速運動'] },
            { label: 'card2', name: 'Maggie', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '02', distance: 4, tags: ['黃金獵犬', '溫馴', '喜歡和人互動'], description: 'Maggie 是隻溫馴的黃金獵犬，喜歡和人互動，總是願意陪伴主人。', gender: 'Female', events: ['2/18互動時光', '3/1社交聚會'] },
            { label: 'card3', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '03', distance: 6, tags: ['大丹犬', '高大', '喜歡散步'], description: 'Rocky 是隻高大的大丹犬，喜歡長時間散步，享受放慢步伐的時光。', gender: 'Male', events: ['2/20長途散步', '3/3公園會面'] }
        ], petShowing: 0 },

        { owner: 'Lucas', pets: [
            { label: 'card1', name: 'Daisy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '01', distance: 5, tags: ['比格犬', '好奇', '喜歡探索'], description: 'Daisy 是隻好奇的比格犬，喜歡四處探索，總是充滿能量。', gender: 'Female', events: ['2/9探索之旅', '3/14新地點探險'] },
            { label: 'card2', name: 'Chester', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '02', distance: 7, tags: ['邊境牧羊犬', '聰明', '喜歡學習'], description: 'Chester 是隻聰明的邊境牧羊犬，喜歡學習新技能並與主人一起訓練。', gender: 'Male', events: ['2/10技巧挑戰', '3/3協作訓練'] },
            { label: 'card3', name: 'Lily', imageSrc: new URL('../assets/img/match/dog7.avif', import.meta.url).href, number: '03', distance: 6, tags: ['柴犬', '獨立', '喜歡慢跑'], description: 'Lily 是隻獨立的柴犬，喜歡和主人一起慢跑，享受悠閒的戶外時光。', gender: 'Female', events: ['2/15慢跑活動', '3/7戶外冒險'] }
        ], petShowing: 0 },

        { owner: 'Olivia', pets: [
            { label: 'card1', name: 'Charlie', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '01', distance: 4, tags: ['西高地白梗', '忠誠', '喜歡散步'], description: 'Charlie 是隻忠誠的西高地白梗，喜歡在陽光明媚的日子裡散步。', gender: 'Male', events: ['2/10午後散步', '3/5陽光活動'] },
            { label: 'card2', name: 'Milo', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '02', distance: 5, tags: ['法國鬥牛犬', '堅韌', '喜歡安靜'], description: 'Milo 是隻堅韌的法國鬥牛犬，喜歡在安靜的地方休息，享受寧靜的時光。', gender: 'Male', events: ['2/20靜態挑戰', '3/10休息時光'] },
            { label: 'card3', name: 'Rex', imageSrc: new URL('../assets/img/match/dog7.avif', import.meta.url).href, number: '03', distance: 6, tags: ['大丹犬', '高大', '喜歡旅行'], description: 'Rex 是隻高大的大丹犬，喜歡和主人一起去旅行，探索新地方。', gender: 'Male', events: ['2/25旅行探索', '3/12公路之旅'] }
        ], petShowing: 0 }
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
                    { label: 'card4', name: 'Toby', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '01', distance: 3, tags: ['邊境牧羊犬', '機警', '喜歡挑戰'], description: 'Toby 很機警，總能迅速應對各種挑戰，最愛玩各種智力遊戲。', gender: 'Male' },
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
                    { label: 'card5', name: 'Maya', imageSrc: new URL('../assets/img/match/Samoyed.avif', import.meta.url).href, number: '02', distance: 9, tags: ['拉布拉多', '活潑', '喜歡游泳'], description: 'Maya 是一隻喜歡游泳的拉布拉多，游泳時格外自在。', gender: 'Female' },
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
        const selectedCard = ref(null); 
        function toggleLightBoxPetInfo(card = null) {
            // isLightBoxPetInfo.value = !isLightBoxPetInfo.value;
            // const selectedCard = card;
            // currentLightBoxPet.value = ownerIndex;
            // console.log(isLightBoxPetInfo.value)
            if (card) {
                selectedCard.value = card; // 把传入的 card 赋值给 selectedCard
                isLightBoxPetInfo.value = true;
            } else {
                isLightBoxPetInfo.value = false;
                selectedCard.value = null;
            }
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
    
    