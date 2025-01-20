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
                <li class="navTags"><Btn btnStyle="primary small">散步陪伴</Btn></li>
                <li class="navTags"><Btn btnStyle="outline small">到府照顧</Btn></li>
                <li class="navTags"><Btn btnStyle="outline small">友善寄宿</Btn></li>
                <li class="navTags"><Btn btnStyle="outline small">寵物計程車</Btn></li>
            </ul>
        </div>
        <div class="heroContent">
            <!-- 貼文內容介紹 -->
            <div class="postContent">
                <div class="postTop">
                <div class="postImg">
                    <img src="../assets/img/buddy-post/demo.png" alt="">
                </div>
                <div class="postMain">                
                        <div class="postTitle">
                            <h5 class="bold">高速散步</h5>
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
                        </div>
                        <div class="postText">
                            <p>唉，散步陪伴這種事，說實話有點麻煩，不過既然你需要，我會盡量幫忙。需要陪你的毛孩散步嗎？我提供的服務可是高速散步，速度快到連詛咒隧道附近都能快速穿越，保證不會耽誤太久。雖然有點累，還是得做好，畢竟毛孩的安全是最重要的。放心，牠們會平安無事……應該。<br>預計散步的地點在小桃他們家的神社附近，阿，我好想你，小桃。</p>
                        </div>                
                        <div class="editBtn">
                            <Btn btnStyle="baseline small">編輯貼文</Btn>  <!-- 要改成xs字型 -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- 貼文者資訊 -->
            <div class="poster">
                <div class="avatar">
                    <img class="avatarImg" src="../assets/img/buddy-post/avatarImg.svg" alt="avatar">
                </div>
                <div class="information">
                    <div class="topContent">
                        <h5 class="bold name">高倉健</h5>
                        <div class="location">
                            <img class="locationIcon" src="@/assets/img/icon/location.svg" alt="locationIcon">
                            <p class="smallText">文山區, 臺北</p>
                        </div>
                    </div>
                    <div class="middleContent">
                        <div class="petType tagBox">
                            <p class=" smallText">寵物類型</p>
                            <ul class="typeTag tagUl">
                                <li class="typeTags tagLi">幼犬</li>
                                <li class="typeTags tagLi">小型犬</li>
                                <li class="typeTags tagLi">中型犬</li>
                                <li class="typeTags tagLi">大型犬</li>
                                <li class="typeTags tagLi">老年犬</li>
                                <li class="typeTags tagLi">幼貓</li>
                                <li class="typeTags tagLi">成貓</li>
                            </ul>
                        </div>
                        <div class="serviceTime tagBox">
                            <p class=" smallText">服務時間</p>
                            <ul class="timeTag tagUl">
                                <li class="timeTags tagLi">週一</li>
                                <li class="timeTags tagLi">週二</li>
                                <li class="timeTags tagLi">週三</li>
                                <li class="timeTags tagLi">週四</li>
                                <li class="timeTags tagLi">週五</li>
                                <li class="timeTags tagLi">週六</li>
                                <li class="timeTags tagLi">週日</li>
                            </ul>
                            <div class="time">
                                <p class="smallText">08:00 - 17:00</p>
                            </div>
                        </div>
                    </div>
                    <div class="bottomContent">
                        <p>唉，真沒勁……不過，我會盡量照顧好你的毛孩，我擅長高速散步、高速接送，都交給我。就算覺得好累，還是得做好這些事，反正我能應付。別擔心，牠們會安全的，應該。</p>
                    </div>
                </div>
                <div class="connect">
                    <div class="lineQRCode">
                        <img src="../assets/img/header-red.svg" alt="account" class="QRcode">
                    </div>
                    <p class="smallText">聯繫小幫手</p>
                </div>
            </div>
        </div>

        <!-- 評論區 -->
        <div class="commentContent">
            <div class="newComment">
                <h6 class="bold">最新評論</h6>
                <Btn btnStyle="baseline small">所有評論</Btn>  <!-- 要改成xs字型 -->
            </div>
            <!-- 評論卡片 -->
            <ul class="commentCards">
                <li class="commenmtCard">
                    <div class="commenter">
                        <div class="avatar">
                            <img class="avatarImg" src="../assets/img/buddy-post/demologo.svg" alt="avatar">
                        </div>
                        <div class="commentInfo">
                            <h6 class="bold">Emily</h6>
                            <p class="xsText">2024/12/25</p>
                            <ul class="stars">
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star1"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star2"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star3"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star4"></li>
                                <li><img src="@/assets/img/icon/star-line.svg" alt="star" class="star star5"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="comment">
                        <p class="smallText">雖然他說很累，但還是完成了任務，感覺不錯。雖然他說很累，但還是完成了任務，感覺不錯。雖然他說很累，但還是完成了任務，感覺不錯。</p>
                    </div>
                </li>
                <li class="commenmtCard">
                    <div class="commenter">
                        <div class="avatar">
                            <img class="avatarImg" src="../assets/img/buddy-post/L.svg" alt="avatar">
                        </div>
                        <div class="commentInfo">
                            <h6 class="bold">Lupe Chen</h6>
                            <p class="xsText">2025/1/2</p>
                            <ul class="stars">
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star1"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star2"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star3"></li>
                                <li><img src="@/assets/img/icon/star-line.svg" alt="star" class="star star4"></li>
                                <li><img src="@/assets/img/icon/star-line.svg" alt="star" class="star star5"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="comment">
                        <p class="smallText">服務不錯，但總覺得他有點心不在焉。</p>
                    </div>
                </li>
                <li class="commenmtCard">
                    <div class="commenter">
                        <div class="avatar">
                            <img class="avatarImg" src="../assets/img/buddy-post/S.svg" alt="avatar">
                        </div>
                        <div class="commentInfo">
                            <h6 class="bold">鄒宗翰</h6>
                            <p class="xsText">2025/1/11</p>
                            <ul class="stars">
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star1"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star2"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star3"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star4"></li>
                                <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star5"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="comment">
                        <p class="smallText">散步路線很特別，還有經過詛咒隧道，挺有趣的。</p>
                    </div>
                </li>
            </ul>
        </div>
        <!-- 發表評論 -->
        <div class="postComment">
            <div class="postTitle">
                <h6 class="bold">發表評論</h6>
                <p class="smallText">請於80個字數內</p>
            </div>
            <div class="inputComment">
                <div class="avatar">
                    <img class="avatarImg" src="../assets/img/buddy-post/gosuubaba.svg" alt="avatar">
                </div>
                <div class="content">
                    <ul class="stars">
                        <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star1"></li>
                        <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star2"></li>
                        <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star3"></li>
                        <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star4"></li>
                        <li><img src="@/assets/img/icon/star-line.svg" alt="star" class="star star5"></li>
                    </ul>
                    <div class="input">
                        <InputText
                        :textAlign="input.textAlign"
                        :placeHolder="input.placeHolder"
                        :errorMsg="input.errorMsg"
                        :hasError="input.inputError.value"
                        v-model="input.inputValue.value"
                        ></InputText>
                        <!-- <p>用 v-model 監聽: {{ input.inputValue }}</p> -->
                        <Btn btnStyle="primary default">發佈</Btn>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
<MainFooter></MainFooter>
</template>

<script setup>
import {ref} from "vue";

import MainHeader from "@/components/MainHeader.vue";
import Btn from '@/components/Btn.vue';
import MainFooter from "@/components/MainFooter.vue"
import InputText from '../components/InputText.vue';


const input = {
    textAlign: 'textLeft',
    placeHolder: '撰寫評論..',
    errorMsg: 'Invalid Input',
    inputValue: ref(''),
    inputError: ref(false),
}

</script>