<template>
<MainHeader theme="red" bgc="pink-0"></MainHeader>
 
<!--- heroSection -->
<div class="herobox">
    <img class="img" src="@/assets/img/splootbox/banner.svg" alt="">
    <div class="herobtn">
        <h4 class="bold">聖誕禮盒來囉!</h4>
        <div class="btnBox">
            <RouterLink to="/sploot-box/question">
                <Btn btnStyle="white large">訂閱SPLOOT BOX</Btn>
            </RouterLink>
        </div>
    </div>
</div>

<!-- SPLOOT BOX大字區塊 -->
<div class="bigTitle">
    <div class="boxTitle"> 
        <h4 class="bold">SPLOOT BOX裡面有什麼?</h4>
        <p>What's in the box</p>
    </div>
</div>
<!-- splootbox介紹區塊 -->
<div class="boxContainer">
    <div class="boxSection">
        <div class="boxImage">
            <img src="@/assets/img/splootbox/splootbox1.jpg" alt="">
        </div>
        <div class="boxText">
            <h4 class="bold">必備日用品</h4>
            <p class="default">簡單實用，清潔護理一步到位，呵護毛孩健康</p>
        </div>
    </div>
    <div class="boxDivider"></div>
    <div class="boxSection">
        <div class="text boxText">
            <h4 class="bold">原肉鮮零食</h4>
            <p class="default">100%純肉製作，無人工添加，營養滿分，美味安心</p>
        </div>
        <div class="img boxImage">
            <img src="@/assets/img/splootbox/splootbox2.jpg" alt="">
        </div>
    </div>
    <div class="boxDivider"></div>
    <div class="boxSection">
        <div class="boxImage">
            <img src="@/assets/img/splootbox/splootbox3.jpg" alt="">
        </div>
        <div class="boxText">
            <h4 class="bold">功能玩具</h4>
            <p class="default">趣味互動，增強智力與活力，陪伴毛孩快樂消耗精力！</p>
        </div>
    </div>
</div>
<div class="bigTitle">
    <div class="boxTitle">
        <h4 class="bold">如何訂閱SLPOOT BOX</h4>
        <p class="bigText">How it works</p>
    </div>
</div>
<!-- 如何訂閱區塊 -->
<section class="howitworks">
    <div class="howitworks_section">
        <div class="reviews-container">
                <div class="review-card">
                <div class="review-content">
                    <div class="title">01</div>
                    <p class="bold">幫您的毛孩填寫<br>客製化問卷</p>
                </div>
                <div class="review-image">
                    <img src="../assets/img/splootbox/step1.svg"  alt="">
                </div>
            </div>
            <!--  -->
            <div class="review-card">
                <div class="review-content">
                    <div class="title">02</div>
                    <p class="bold">選擇方案 <br>（銀卡，金卡，白金卡）</p>
                </div>
                <div class="review-image">
                    <img src="@/assets/img/splootbox/step2.svg"  alt="">
                </div>
            </div>
            <!--  -->
            <div class="review-card">
                <div class="review-content">
                    <div class="title">03</div>
                    <p class="bold">當月份SPLOOT BOX會在下單後<br>五日內寄出</p>
                </div>
                <div class="review-image">
                    <img src="@/assets/img/splootbox/step3.svg"  alt="">
                </div>
            </div>
            <!--  -->
            <div class="review-card">
                <div class="review-content">
                    <div class="title">04</div>
                    <p class="bold">SPLOOT BOX<br>讓毛孩每個月都充滿期待！</p>
                </div>
                <div class="review-image">
                    <img src="@/assets/img/splootbox/step4.svg"  alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- 立即訂閱按鈕 -->
    <div class="howitworksbtn">
        <div class="btnBox">
            <RouterLink to="/sploot-box/question">
                <Btn btnStyle="primary large">立即訂閱</Btn>
            </RouterLink>
        </div>
    </div>
</section>
<!--狗狗評語文字區塊  -->
        <div class="reviewTitle">
            <div class="boxTitle3">
                <h4 class="feedback-title">狗狗給我們的評語</h4>
                <p class="feedback-content">
                    拿到我們的 SPLOOT BOX 訂閱盒後，記得與毛孩一起留下這段幸福時光！拍下狗狗與盒子合影，或錄製牠興奮開箱的可愛瞬間，並將照片或影片發布給我們。<br/><br/>
                    完成分享後，還能獲得專屬積分，累積積分兌換更多驚喜好禮！讓每個開箱時刻都成為珍貴的回憶，同時與我們一起分享這份快樂吧！
                </p>
            </div>
        </div>

<!-- 狗狗的評語圖文區塊 -->
            <div class="reviews-container">
                <div class="review-card">
                    <div class="review-image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                    <div class="review-content">
                        <h6 class="review-title">Emily:</h6>
                        <p class="review-text">
                            「SPLOOT BOX 的零食真的讓人安心！不僅好吃又健康，還特別符合節日的主題，我家狗狗吃完後心情都變超好！」
                        </p>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-image">
                        <img src="@/assets/img/splootbox/dogbox1.avif"  alt="">
                    </div>
                    <div class="review-content">
                        <h6 class="review-title">Sam:</h6>
                        <p class="review-text">
                            「超愛這次的聖誕SPLOOT BOX，尤其是聖誕餅乾，每次吃完都搖著尾巴要求再來一塊！」
                        </p>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                    <div class="review-content">
                        <h6 class="review-title">Lupe:</h6>
                        <p class="review-text">
                            「SPLOOT BOX 的零食真的讓人安心！不僅好吃又健康，還特別符合節日的主題，我家狗狗吃完後心情都變超好！」
                        </p>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-image">
                        <img src="@/assets/img/splootbox/dogbox1.avif"  alt="">
                    </div>
                    <div class="review-content">
                        <h6 class="review-title">Ian:</h6>
                        <p class="review-text">
                            「超愛這次的聖誕SPLOOT BOX，尤其是聖誕餅乾，每次吃完都要求再來一塊！」
                        </p>
                    </div>
                </div>
            </div>
<!-- testmonial大字區塊 -->
            <div class="box4">
                <div class="boxTitle4">
                    <p class="bigText">Testmonial</p>
                </div>
            </div>
<!-- 電子報區塊 -->
<div class="news">
    <div class="newsSection">
        <p class="smallText">
            訂閱SPLOOT BOX電子報，讓毛孩的生活充滿驚喜與期待！
        </p>
        <div class="emailBtn">
            <div>
                <InputText placeHolder="Email" textAlign="textCenter" errorMsg="Invalid Input" 
                v-model="inputValue" :hasError="inputError"></InputText>
            </div>
        </div>
        <div class="newsButton">
            <div class="btnBox">
                <RouterLink to="/question">
                    <Btn btnStyle="primary large">訂閱電子報</Btn>
                </RouterLink>
            </div>
        </div>
    </div>
</div>
<!--FAQ區塊-->            
<div class="faqWrapper">
    <div class="faqTitle">FAQ</div>
    <div class="faqContainer">
        <DropdownQa  question="可以隨時更改方案嗎？" answer="是的，您可以隨時更改您的方案！只需進入您的會員帳戶設定，選擇“我的訂閱”，然後根據您的需求升級、降級或切換至其他方案。
                    如果您在更改方案時有任何問題，歡迎聯繫我們的客服團隊，我們將竭誠為您服務！"></DropdownQa>
        <DropdownQa  question="QQQQQ" answer="AAAAA"></DropdownQa>
        <DropdownQa  question="QQQQQ" answer="AAAAA"></DropdownQa>
    </div>
</div>
            
<!-- circle bg -->
<div class="circleSplootBox"></div>
<MainFooter></MainFooter>         

         
</template>

<script setup>
import MainHeader from "../components/MainHeader.vue";
import DropdownQa from "../components/DropdownQa.vue";
import Btn from '../components/Btn.vue';
import InputText from '../components/InputText.vue';
import MainFooter from "../components/MainFooter.vue";


</script>