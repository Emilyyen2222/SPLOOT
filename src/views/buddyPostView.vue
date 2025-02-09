<template>
<MainHeader theme="blue" bgc="blueberry-0"></MainHeader>
<!-- 主內容 -->
 <div class="wrapper">
<!-- 主要功能 -->
    <div class="buddyPost">
        <div class="nav">
            <div class="return">
                <Router-link  to="/sploot-buddy">
                    <Btn btnStyle="baseline small">返回</Btn>
                </Router-link>
            </div>
            <ul class="navTag">
                <li class="navTags" v-for="(tags, index) in navTag" :key="index"><Btn :btnStyle="`small ${tags.btnStyle}`" @click="getServiceType(tags)">{{ tags.name }}</Btn></li>
            </ul>
        </div>
        <div class="heroContent">
            <!-- 貼文內容介紹 -->
            <div class="postContent">
                <div class="postTop">
                    <div class="postImg">
                        <img :src="post.imgSrc" alt="postImg">
                    </div>
                <div class="postMain">                
                        <div class="postTitle">
                            <h5 class="bold">{{ post.title }}</h5>
                            <div class="reviews">
                                <ul class="stars">
                                    <li v-for="n in 5"><img :src="isStars(n, post.stars)" alt="star" :class="['star', 'star' + n]"></li>
                                </ul>
                                <div class="avgGrade smallText">{{ post.avgGrade }}</div>
                                <div class="commentCount smallText">({{ post.commentCount }})</div>
                            </div>
                        </div>
                        <div class="postText">
                            <p>{{ post.content }}</p>
                        </div>                
                        <div class="editBtn">
                            <Btn btnStyle="baseline small">編輯貼文</Btn>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 貼文者資訊 -->
            <div class="poster">
                <div class="userBox">
                    <div class="avatar">
                        <img class="avatarImg" :src="poster.avatarSrc" alt="avatar">
                    </div>
                    <div class="topContent">
                        <h5 class="bold name">{{ poster.name }}</h5>
                        <div class="location">
                            <img class="locationIcon" src="@/assets/img/icon/location.svg" alt="locationIcon">
                            <p class="smallText">{{ poster.city }}, {{ poster.district }}</p>
                        </div>
                    </div>
                </div>
                <div class="information">
                    <div class="middleContent">
                        <div class="petType tagBox">
                            <p class="boxLabel smallText">寵物類型</p>
                            <ul class="typeTag tagUl">
                                <li class="typeTags tagLi" v-for="(type, index) in poster.petType" :key="index">{{ type }}</li>
                            </ul>
                        </div>
                        <div class="serviceTime tagBox">
                            <p class="boxLabel smallText">服務時間</p>
                            <ul class="timeTag tagUl">
                                <li class="timeTags tagLi" v-for="(day,index) in poster.serviceDays" :key="index">週{{ day }}</li>
                            </ul>
                            <div class="time">
                                <p class="smallText">{{ poster.serviceTimeStart }} - {{ poster.serviceTimeEnd }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bottomContent">
                        <p>{{ poster.introduce }}</p>
                    </div>
                </div>
                <div class="connect">
                    <div class="lineQRCode">
                        <a :href="`https://line.me/ti/p/~${poster.line}`" target="_blank">
                            <QRcode      
                                v-if="poster.line"
                                :value="`https://line.me/ti/p/~${poster.line}`"
                                :size="96"
                            ></QRcode>
                        </a>
                    </div>
                    <p class="smallText">聯繫小幫手</p>
                </div>
            </div>
        </div>

        <!-- 評論區 -->
        <div class="commentContent">
            <div class="newComment">
                <h6 class="bold">最新評論</h6>
                <Btn btnStyle="baseline small" @click="toggleLightBox">所有評論</Btn>  <!-- 要改成xs字型 -->
            </div>
            <!-- 評論卡片 -->
             <div class="swiper">
                 <ul class="commentCards latest">
                     <li class="commenmtCard" v-for="(card, index) in latestCommentCards" :key="index">
                         <div class="commenter">
                             <div class="avatar">
                                 <img class="avatarImg" :src="card.avatarSrc" alt="avatar">
                             </div>
                             <div class="commentInfo">
                                 <h6 class="bold">{{ card.name }}</h6>
                                 <p class="xsText">
                                     {{ card.time.year }}/{{ card.time.month }}/{{ card.time.day }}</p>
                                 <ul class="stars">
                                     <li v-for="n in 5"><img :src="isStars(n, card.stars)" alt="star" :class="['star', 'star' + n]"></li>
                                 </ul>
                             </div>
                         </div>
                         <div class="comment">
                             <p class="smallText">{{ card.content }}</p>
                         </div>
                     </li>
                 </ul>
             </div>
        </div>
        <!-- 發表評論 -->
        <div class="postComment">
            <div class="postTitle">
                <h6 class="bold">發表評論</h6>
            </div>
            <div class="inputComment">
                <div class="avatar">
                    <img class="avatarImg" :src="userInfo.avatar" alt="avatar">
                </div>
                <div class="content">
                    <ul class="stars">
                        <li v-for="n in 5"><img :src="isStars(n, mountedStars)" alt="star" :class="['star', 'star' + n]" @click="setStars(n)"></li>
                    </ul>
                    <div class="input">
                        <InputText 
                            class="textBox" 
                            inputType="textarea"             
                            size="small"
                            maxlength="80" 
                            :placeHolder="getComment.placeHolder" 
                            :errorMsg="getComment.errorMsg" 
                            v-model="getComment.inputValue"
                            :hasError="getComment.inputError">
                        </InputText>
                        <Btn btnStyle="primary default" @click="commentSubmit">發佈</Btn>
                    </div>
                </div>
            </div>
        </div>

        <!-- 圓形 * 2 -->
    <div class="circle1 circle"></div>
    <div class="circle2 circle"></div>

        <!-- 所有評論 -->
        <LightBox 
            :title="lightTitle.title"
            :is-light-box="isLightBox" 
            @toggle="toggleLightBox">
           <ul class="commentCards inLightBox">
                <li class="commenmtCard" v-for="(card, index) in sortedCommentCards" :key="index">
                    <div class="commenter">
                        <div class="avatar">
                            <img class="avatarImg" :src="card.avatarSrc" alt="avatar">
                        </div>
                        <div class="commentInfo">
                            <h6 class="bold">{{ card.name }}</h6>
                            <p class="xsText">
                                {{ card.time.year }}/{{ card.time.month }}/{{ card.time.day }}</p>
                            <ul class="stars">
                                <li v-for="n in 5"><img :src="isStars(n, card.stars)" alt="star" :class="['star', 'star' + n]"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="comment">
                        <p class="smallText">{{ card.content }}</p>
                    </div>
                </li>
           </ul>     
        </LightBox>
    </div>
 </div>
<MainFooter></MainFooter>


</template>

<script setup>
    import {computed, ref, watch} from "vue";
    import QRcode from 'qrcode.vue'

    import MainHeader from "@/components/MainHeader.vue";
    import Btn from '@/components/Btn.vue';
    import MainFooter from "@/components/MainFooter.vue"
    import InputText from '../components/InputText.vue';
    import LightBox from '../components/LightBox.vue';

    // 導航列標籤
    const navTag = ref([
        {
        name:  '散步陪伴',
        btnStyle: 'primary',
        },
        {
        name:  '到府照顧',
        btnStyle: 'outline',
        },
        {
        name:  '友善寄宿',
        btnStyle: 'outline',
        },
        {
        name:  '寵物計程車',
        btnStyle: 'outline',
        },
    ])

    //導航列標籤點選
    const getServiceType = (selectedTags) => {
        navTag.value.forEach(tags => tags.btnStyle = 'outline');
        selectedTags.btnStyle = 'primary';
    };

    // 文章主內容
    const post = ref({
        imgSrc: new URL("@/assets/img/buddy-post/demo.png", import.meta.url).href,
        title:"高速散步",
        stars:5,
        avgGrade:4.5,
        commentCount:3,
        content:"唉，散步陪伴這種事，說實話有點麻煩，不過既然你需要，我會盡量幫忙。需要陪你的毛孩散步嗎？我提供的服務可是高速散步，速度快到連詛咒隧道附近都能快速穿越，保證不會耽誤太久。雖然有點累，還是得做好，畢竟毛孩的安全是最重要的。放心，牠們會平安無事……應該。預計散步的地點在小桃他們家的神社附近，阿，我好想你，小桃。"
    });

    // 貼文者資訊
    const poster = ref({
        avatarSrc: new URL("@/assets/img/buddy-post/avatarImg.svg", import.meta.url).href,
        name: '高倉健',
        city: "台北市",
        district: "文山區",
        petType:["幼犬", "小型犬", "中型犬", "大型犬", "老年犬", "幼貓", "成貓"],
        serviceDays: ["一", "四", "六", "日"],
        serviceTimeStart: "10:00",
        serviceTimeEnd: "20:00",
        introduce:"唉，真沒勁……不過，我會盡量照顧好你的毛孩，我擅長高速散步、高速接送，都交給我。就算覺得好累，還是得做好這些事，反正我能應付。別擔心，牠們會安全的，應該。",
        line: "spop333",
    });

    // 評論者資料

    //前三筆資料
    const latestCommentCards = computed(() => {
        return sortedCommentCards.value.slice(0, 3);
    });

    //由新到舊
    const sortedCommentCards = computed(() => {
        // slice()先複製一份 以防原始資料排列被影響
        return commentCards.value.slice().sort((a, b) => {
            const dateA = new Date(a.time.year,(a.time.month -1),a.time.day);
            const dateB = new Date(b.time.year,(b.time.month -1),b.time.day);
            return dateB - dateA; //大的排前面
        });
    });

    // 原始資料
    const commentCards =ref([
        {
            avatarSrc: new URL("@/assets/img/buddy-post/demologo.svg", import.meta.url).href,
            name: "Emily",
            time: {
                year: "2025",
                month: "02",
                day: "18"
            },
            stars: 5,
            content: "雖然他說很累，但還是完成了任務，感覺不錯。"
        },
        {
            avatarSrc: new URL("@/assets/img/buddy-post/L.svg", import.meta.url).href,
            name: "Lupe",
            time: {
                year: "2025",
                month: "02",
                day: "01"
            },
            stars: 3,
            content: "C'est dommage! 雖然服務不錯，我的愛犬也看起來很開心，但他似乎有點心不在焉，少了些專注感。"
        },
        {
            avatarSrc: new URL("@/assets/img/buddy-post/e.svg", import.meta.url).href,
            name: "艾倫．葉卡",
            time: {
                year: "2025",
                month: "02",
                day: " 28"
            },
            stars: 5,
            content: "散步，這就是自由的味道吧？雙腳踏過的每一步，都像是在宣告——我還活著！坐啊，萊納。"
        },
        {
            avatarSrc: new URL("@/assets/img/buddy-post/S.svg", import.meta.url).href,
            name: "鄒宗翰",
            time: {
                year: "2025",
                month: "01",
                day: "31"
            },
            stars: 5,
            content: "散步路線很特別，還有經過詛咒隧道，挺有趣的。"
        },
        {
            avatarSrc: new URL("@/assets/img/buddy-post/H.svg", import.meta.url).href,
            name: "Haooooo",
            time: {
                year: "2025",
                month: "01",
                day: "22"
            },
            stars: 4,
            content: "The service was good, but he seemed a bit distracted and somewhat unfocused!!"
        },
        {
            avatarSrc: new URL("@/assets/img/buddy-post/M.svg", import.meta.url).href,
            name: "Mysterio",
            time: {
                year: "2024",
                month: "12",
                day: "25"
            },
            stars: 5,
            content: "You maybe wondering why the red suit?That's so bad guys can't see me bleed."
        },
        {
            avatarSrc: new URL("@/assets/img/buddy-post/Kosoku-baba.svg", import.meta.url).href,
            name: "Kosoku baba",
            time: {
                year: "2024",
                month: "11",
                day: "11"
            },
            stars: 5,
            content: "這小子速度快得讓我都差點跟不上。不過，看他那副萎掉的樣子，竟然還能堅持，倒是讓我有點佩服"
        },
        {
            avatarSrc: new URL("@/assets/img/buddy-post/v.svg", import.meta.url).href,
            name: "Alley",
            time: {
                year: "2024",
                month: "12",
                day: "09"
            },
            stars: 4,
            content: "很棒，哈密瓜很好吃！！！VVVVVVVVVVVVV"
        },
    ]);

    // 使用者資料
    const userInfo = ref({
        name:"USAGI",
        avatar: new URL("@/assets/img/buddy-post/usagi.svg", import.meta.url).href,
    })

    console.log(`現在的使用者為${userInfo.value.name}`)

    //評論input資料
    const getComment = ref({
        placeHolder: "請於80個字數內",
        errorMsg: "",
        inputValue: "",
        inputError: false,
    })

    //資料：星星數量
    const isStars = (n, stars) => {
        if(stars < 1 && stars != 0){
            stars = 1;
        }else if(stars == 0){
            stars = 0;
        }
        if(n <= stars){
            return new URL('@/assets/img/icon/star-full.svg', import.meta.url).href
        }else{
            return new URL('@/assets/img/icon/star-line.svg', import.meta.url).href
        }
    };

    // 點選評論：星星數量
    const mountedStars = ref(0); //初始星星分數
    const setStars = (n) => {
        mountedStars.value = n;
        getComment.value.inputError = false;
    };

    const commentSubmit = () => {
        if(getComment.value.inputValue.trim() === ""){
            getComment.value.inputError = true;
            getComment.value.errorMsg = "請填寫完整評論";
        }else if(mountedStars.value === 0){
            getComment.value.inputError = true;
            getComment.value.errorMsg = "請點選星星評分";
        }else{
            getComment.value.inputError = false;
        }
    };

    //監看有輸入時取消警告
    watch(() => getComment.value.inputValue, (newValue) => {
        getComment.value.inputError = !newValue.inputValue === '';
    });

    // 燈箱標題請輸入
    const lightTitle = {title: "所有評論"}

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
</script>