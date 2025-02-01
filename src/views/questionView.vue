<template>
<MainHeader theme="red" bgc=""></MainHeader>

<!-- question 1--->
<div class="box firstBox">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩叫什麼名字？</h4>
        <div v-show="true" class="options">
            <div class="first">
            <InputText placeHolder="毛孩姓名" errorMsg="Invalid Input" 
            v-model="inputValue" :hasError="inputError">
            </InputText>
            </div>
            <Btn btnType="form" btnStyle="option">女生 狗狗</Btn>
            <Btn btnType="form" btnStyle="option">男生 狗狗</Btn>
            <Btn btnType="form" btnStyle="option">女生 貓貓</Btn>
            <Btn btnType="form" btnStyle="option">男生 貓貓</Btn>
        </div>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn>   
    </div>
     <!-- progress bar -->
     <div class="progressBarContainer">
        <div class="progressBar">
            <div class="progressSegment filled"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
        </div>
    </div>
</div>
<!------------------------ question2 貓---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是哪種體型？</h4>
        <div class="options">
            <Btn btnType="form" btnStyle="option">幼貓</Btn>
            <Btn btnType="form" btnStyle="option">成貓</Btn>
           
        </div>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn> 
        <Btn class="borderBottom" btnType="form" btnStyle="lastQ">上一題</Btn> 
    </div>
</div>
<!------------------------ question 2狗---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是哪種體型？</h4>
        <div class="options">
            <Btn btnType="form" btnStyle="option">小型犬</Btn>
            <Btn btnType="form" btnStyle="option">中型犬</Btn>
            <Btn btnType="form" btnStyle="option">大型犬</Btn>
        </div>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn> 
        <Btn class="borderBottom" btnType="form" btnStyle="lastQ">上一題</Btn> 
    </div>
</div>
<!------------------------ question 3---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是什麼品種？</h4>
        <div class="options">
            <DropdownMenu size="large"
                :placeHolder="menus.menu1.placeHolder" 
                :options="menus.menu1.options">
            </DropdownMenu>
        </div>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn> 
        <Btn class="borderBottom" btnType="form" btnStyle="lastQ">上一題</Btn> 
    </div>
</div>
<!------------------------ question 4---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩生日是？</h4>
        <div class="options date">
            <div class="smallText">領養的日期也可以喔！<br> 我們希望可以幫您的毛孩一起慶祝這特別的日子！</div>
                <div class="birthday">
                    <div class="year">
                        <DropdownMenu size="large"
                        :placeHolder="menus.year.placeHolder"
                        :options="menus.year.options">
                        </DropdownMenu>
                    </div>
                    <div class="month">
                        <DropdownMenu size="large"
                        :placeHolder="menus.month.placeHolder"
                        :options="menus.month.options">
                        </DropdownMenu>
                    </div>
                    <div class="date">
                        <DropdownMenu size="large"
                        :placeHolder="menus.day.placeHolder"
                        :options="menus.day.options">
                        </DropdownMenu> 
                    </div>
                </div>
        </div>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn> 
        <Btn class="borderBottom" btnType="form" btnStyle="lastQ">上一題</Btn> 
    </div>
</div>
<!-- Question 5 -->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">請輸入您的Email</h4>
        <div class="options">
            <div class="">
            <InputText placeHolder="Email" errorMsg="Invalid Input" 
            v-model="inputValue" :hasError="inputError">
            </InputText>
            </div>
            <div class="quickLogin">
                <div class="">已經有帳號？</div>
                <Btn class="check" btnStyle="baseline small">查看</Btn>
            </div>
        </div>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn> 
        <Btn class="borderBottom" btnType="form" btnStyle="lastQ">上一題</Btn>  
    </div>
</div>
<!-- Question6 -->
<div class="boxSub">
    <div class="questionContainer">
        <h4 class="title bold">為您的毛孩選擇一個方案等級</h4>
        <div class="container">
                <div class="card">
                    <div class="content">
                        <h6 class="title">銀卡</h6>
                        <div class="boxDivider"></div>
                        <ul class="planItems">
                            <li class="smallText">精選功能玩具 x1</li>
                            <li class="smallText">天然原肉零食 x1</li>
                            <li class="smallText">必備日用品<span class="xsText">（如便攜式飲水器或小型毛巾）</span></li>
                        </ul>
                        <ul class="planText">
                            <li class="smallText">適合對象：</li>
                            <li class="smallText">初次體驗者，讓毛孩嘗試 Sploot Box 的基本樂趣！</li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <h6 class="title">金卡</h6>
                        <div class="boxDivider"></div>
                        <ul class="planItems">
                            <li class="smallText">高互動功能玩具 x2</li>
                            <li class="smallText">原肉健康零食 x2</li>
                            <li class="smallText">必備日用品<span class="xsText">（如寵物洗毛精、耳朵清潔用品）</span></li>
                            <li class="smallText">免費加入會員獨享活動資格</li>
                        </ul>
                        <ul class="planText">
                            <li class="smallText">適合對象：</li>
                            <li class="smallText">需要更多寵物用品、愛好玩具的活潑毛孩！</li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                </div>
                <div class="card popular">
                    <div class="content">
                        <h6 class="title">白金卡</h6>
                        <div class="boxDivider"></div>
                        <ul class="planItems">
                            <li class="smallText">全套高互動玩具 x3</li>
                            <li class="smallText">豪華版原肉零食組 x3</li>
                            <li class="smallText">高級寵物日用品<span class="xsText">如牙膏牙刷組、耳護清潔液）</span></li>
                            <li class="smallText">獨家驚喜禮物 x1</li>
                            <li class="smallText red">專屬服務：免費諮詢小幫手專區</li>
                        </ul>
                        <ul class="planText">
                            <li class="smallText">適合對象：</li>
                            <li class="smallText">追求全方位照護及豐富體驗的毛孩與飼主！</li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                </div>
            </div>
        <div class="subBtn">
            <Btn btnType="form" btnStyle="nextQ">下一題</Btn> 
            <Btn class="borderBottom" btnType="form" btnStyle="lastQ">上一題</Btn> 
        </div> 
    </div>
</div>
<!-- Question7 -->
<div class="boxSub">
    <div class="questionContainer">
        <h4 class="title bold">為您的毛孩選擇一個方案等級</h4>
        <div class="container">
                <div class="card">
                    <div class="content">
                        <h6 class="title">銀卡</h6>
                        <div class="boxDivider"></div>
                        <ul class="planItems">
                            <li class="smallText">精選功能玩具 x1</li>
                            <li class="smallText">天然原肉零食 x1</li>
                            <li class="smallText">必備日用品<span class="xsText">（如便攜式飲水器或小型毛巾）</span></li>
                        </ul>
                        <ul class="planText">
                            <li class="smallText">適合對象：</li>
                            <li class="smallText">初次體驗者，讓毛孩嘗試 Sploot Box 的基本樂趣！</li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <h6 class="title">金卡</h6>
                        <div class="boxDivider"></div>
                        <ul class="planItems">
                            <li class="smallText">高互動功能玩具 x2</li>
                            <li class="smallText">原肉健康零食 x2</li>
                            <li class="smallText">必備日用品<span class="xsText">（如寵物洗毛精、耳朵清潔用品）</span></li>
                            <li class="smallText">免費加入會員獨享活動資格</li>
                        </ul>
                        <ul class="planText">
                            <li class="smallText">適合對象：</li>
                            <li class="smallText">需要更多寵物用品、愛好玩具的活潑毛孩！</li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                </div>
                <div class="card popular">
                    <div class="content">
                        <h6 class="title">白金卡</h6>
                        <div class="boxDivider"></div>
                        <ul class="planItems">
                            <li class="smallText">全套高互動玩具 x3</li>
                            <li class="smallText">豪華版原肉零食組 x3</li>
                            <li class="smallText">高級寵物日用品<span class="xsText">如牙膏牙刷組、耳護清潔液）</span></li>
                            <li class="smallText">獨家驚喜禮物 x1</li>
                            <li class="smallText red">專屬服務：免費諮詢小幫手專區</li>
                        </ul>
                        <ul class="planText">
                            <li class="smallText">適合對象：</li>
                            <li class="smallText">追求全方位照護及豐富體驗的毛孩與飼主！</li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="@/assets/img/splootbox/dogbox.avif"  alt="">
                    </div>
                </div>
            </div>
        <div class="subBtn">
            <Btn btnType="form" btnStyle="nextQ">下一題</Btn> 
            <Btn class="borderBottom" btnType="form" btnStyle="lastQ">上一題</Btn> 
        </div> 
    </div>
</div>
<!---question 8---->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">選擇付款與運送方式</h4>
        <div class="options date">
                <div class="ship">
                    <div class="xsText left">收貨地點</div>
                    <div class="year">
                        <DropdownMenu size="large"
                        :placeHolder="menus.country.placeHolder"
                        :options="menus.country.options">
                        </DropdownMenu>
                    </div>
                    <div class="xsText left">取貨方式</div>
                    <div class="month">
                        <DropdownMenu size="large"
                        :placeHolder="menus.shipPlace.placeHolder"
                        :options="menus.shipPlace.options">
                        </DropdownMenu>
                    </div>
                    <div class="xsText left">付款方式</div>
                    <div class="date">
                        <DropdownMenu size="large"
                        :placeHolder="menus.payment.placeHolder"
                        :options="menus.payment.options">
                        </DropdownMenu> 
                    </div>
                    <div class="xsText"> *目前僅提供信用卡付款</div>
                </div>
        </div>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn> 
        <Btn class="borderBottom" btnType="form" btnStyle="lastQ">上一題</Btn> 
    </div>
</div>
<!-- Question 9 -->
<div class="boxPayment">
    <div class="questionContainer">
        <h4 class="title bold">完成購買程序</h4>
        <div class="options">
            <div class="paymentBox">
                <div class="textBox">
                    <p>SPLOOT BOX 三個月方案 - 白金卡(Platinum)</p> 
                    <p>$3,597</p> 
                </div>
                <div class="boxDivider"></div>
                <div class="textBox">
                    <p>月費</p> 
                    <p>$3,597</p> 
                </div>
                <div class="boxDivider"></div>
                <div class="textBox">
                    <p>今日應付金額</p> 
                    <p>$3,597</p> 
                </div>
            </div>
            <div class="infoBox">
                <div class="xsText left">信用卡付款</div>
                <InputText textAlign = "textLeft" placeHolder="卡號" errorMsg="Invalid Input" 
                v-model="inputValue" :hasError="inputError">
                </InputText>
                <InputText textAlign = "textLeft" placeHolder="持卡人姓名" errorMsg="Invalid Input" 
                v-model="inputValue" :hasError="inputError">
                </InputText>
                <div class="cardInfo">
                    <div class="info">
                        <DropdownMenu size=""
                        :placeHolder="menus.visaYear.placeHolder"
                        :options="menus.visaYear.options">
                        </DropdownMenu>
                    </div>
                    <div class="info">
                        <DropdownMenu size=""
                        :placeHolder="menus.visaMonth.placeHolder"
                        :options="menus.visaMonth.options">
                        </DropdownMenu>
                    </div>
                    <div class="info">
                    <InputText textAlign = "textLeft" placeHolder="安全碼" errorMsg="Invalid Input" 
                    v-model="inputValue" :hasError="inputError">
                    </InputText>
                    </div>
                </div>
            </div>
        </div>
            <ul class="planItems">
                <li class="xsText">SHOPLINE將會使用本次交易資訊作為後續定期扣款，點擊提交即同意 《SHOPLINE Payments 支付服務條款》及《SHOPLINE Payments 隱私權政策》。</li>
                <li class="xsText">本金流服務由 SHOPLINE Payments 提供，通過 PCI-DSS 國際信用卡組織最高等級認證，提供安全的交易服務，支援國內外信用卡刷卡。</li>
            </ul>

            <li class="checkBox">
                <div class="boxAlign">
                    <input type="checkbox">
                    <p class="xsText">
                        我同意 

                        <span class="xsText link" @click="togglePopUp" href="">網站服務條款</span> 及 
                        <span class="xsText link" @click="togglePopUp" href="">隱私權政策</span>
                    </p>
                </div>
                <div class="boxAlign">
                    <input type="checkbox">
                    <p class="xsText">我同意成為 SPLOOT 的會員</p>
                </div>
                <div class="boxAlign">
                    <input type="checkbox">
                    <p class="xsText">我願意接收 SPLOOT 的最新消息、優惠及服務推廣相關資訊</p>
                </div>
            </li>
        <Btn btnType="form" btnStyle="nextQ">開始訂閱SPLOOT BOX</Btn>   
    </div>
</div>
<!-- Question 10 -->
<div class="boxFinish">
        <div class="finishBox">
            <h4 class="title bold">感謝您的訂閱</h4>
            <div class="">
                <p>您已成功訂閱SPLOOT BOX 白金卡(Platinum)三個月方案 </p>
                <Btn class="padding" btnType="form" btnStyle="nextQ">回到首頁</Btn>  
            </div>
        </div>
</div>
<div class="boxFinish">
        <div class="finishBox">
            <h4 class="title bold">感謝您的訂閱</h4>
            <p>您已成功訂閱SPLOOT BOX 白金卡(Platinum)三個月方案</p>
            <p>請至信箱查閱訂單詳情</p>
            <Btn class="padding top" btnType="form" btnStyle="nextQ">回到首頁</Btn>
        </div>
</div>
<!-- circle bg -->
<div class="circleQuestion"></div>

<PopUp
:is-pop-up="isPopUp"
>
<div class="policy">
<h6>隱私權政策</h6>
<p>在您開始使用 SPLOOT布魯家 所經營之網站之前，請詳細閱讀以下所有服務條款：
當您成為 SPLOOT布魯家 網站的會員時，即表示您已詳細閱讀、明確瞭解並同意接受本服務條款之所有內容。
若您不同意所列之服務條款，則請您立即離開此網站或者不使用任何網站之任何服務提供。
帳號 當您向我們註冊新帳號時，請務必確保您所提供的資料皆是最準確、完整並且時常保持更新狀態。違反所列之條款者，將有可能導致被立即停止您的帳號以及網站所提供的所有服務。此外，在使用任何服務以及活動上，您有義務責任確保您的密碼安全、無論該密碼是透過使用我們服務而管理或者第三方服務。您必須立即通知我們，一旦您的密碼被盜用或者處於不安全狀態。
連結到其他網站 我們的服務可能含有部份連結，將連結到第三方網站或者服務。該些服務將不會處於我們的控制、操作以及擁有管轄權限的範圍內，所以本網站沒有承擔任何內容、隱私政策或者任何第三方網站所提供的服務之義務責任。您同意本網站不需要承擔任何責任、因使用該第三方網站所提供之內容、服務與商品而所導致的；直接或者間接性損失與破壞。我們強烈建議您必須詳細閱讀清楚有關您所造訪的第三方網站之服務條款以及隱私政策，以確保您自身的權益。
終止服務 在不需要任何事前通知以下，我們有可能隨時終止您使用我們網站服務的權限；以上終止服務決定並不需要任何理由即可即時生效，包括但不限於您違反本服務條款。終止服務適用於所有條款的規定，包括但不限於所有權規定、擔保聲明、賠款以及有限責任。在不需要任何事前通知以下，我們有可能隨時終止您所持有的登入帳號；以上終止服務決定並不需要任何理由即可即時生效，包括但不限於您違反本服務條款。一旦確定終止，您將會立即無法繼續使用所有服務。若您希望終止您的帳號，您可以隨時終止服務。終止服務適用於所有條款的規定，包括但不限於所有權規定、擔保聲明、賠款以及有限責任。
政府法律 以上所有條款將會會遵從（國家之法律）無論是否其條款衝突於法律服務條款。若我們未擁有執行以上條款之部份權益，並不等同於我們放棄所有條款的執行權益。若有以上有部份條款不適用於所指定之法庭，其其他之所有條款依然有效。以上所有條款達致雙方在服務使用上的一致性同意與協議，任何事前的協議將有可能影響雙方對於以上所有服務條款的取代或者更改。
我們保留所有條款的更改、取代之權益，並所做出更改、取代之內容可自行決定。若有任何的更改涉及任何內容，我們將會嘗試提供最少30天的事前通知；該通知將會在新條款正式起效之前公布。至於任何內容的制定則由我們自行決定。若您欲繼續使用網站服務，請務必同意所有新條款；若您不同意新條款，將會要求停止使用網站所有服務。
若您有任何問題與疑慮，煩請與 SPLOOT布魯家 進行聯繫。</p>
<h6>隱私權政策</h6>
<p>歡迎您使用 SPLOOT布魯家（以下簡稱「本公司」）係依據本服務條款提供 SPLOOT布魯家 (http://www.sploot.co) 服務（以下簡稱「本服務」），為了讓您能夠安心的使用本網站的各項服務與資訊，特此向您說明本網站的隱私權保護政策，以保障您的權益，請您詳閱下列內容：
一、隱私權保護政策的適用範圍
隱私權保護政策內容，包括本網站如何處理您在使用網站服務時收集到的個人識別資料。隱私權保護政策不適用於其他相關連結的網站，也不適用於非本網站所委託或參與管理的人員。
二、個人資料的蒐集、處理及利用方式
當您造訪本網站或使用本網站所提供之功能服務時，我們將視該服務功能性別，請您提供必要的個人資料，並於特定目的範圍內處理及使用您的個人資料；未經您的書面同意，將不會將個人資料用於其他用途。
本網站在您使用服務信箱、填寫問卷、參加活動時，會保存您所提供的姓名、電子郵件信箱、聯絡方式及使用時間等。
於一般瀏覽時，伺服器會自行記錄相關行為，包括您使用連線設備之IP位址、使用時間、瀏覽器及點擊紀錄等，做為我們增進網站服務的參考依據，此記錄為內部應用，決不對外公開。
三、資料之保護
本網站主機均設有防火牆、反病毒系統及其他相關的資訊安全設備及必要的安全防護措施，對於本網站及您的個人資料加以嚴格保護。
未經授權之人員不得接觸您的個人資料，且所有接觸之人員均經簽署保密契約，違反保密義務者將受到相關法律處分。</p>
<Btn @click="togglePopUp" class="padding" btnType="form" btnStyle="nextQ">同意</Btn>
</div>
</PopUp>
</template>

<script setup>
    import MainHeader from "../components/MainHeader.vue";
    import DropdownMenu from "../components/DropdownMenu.vue";
    import Btn from '../components/Btn.vue';
    import InputText from '../components/InputText.vue';
    import { ref } from 'vue'
    import PopUp from "@/components/PopUp.vue";

  //popup狀態
let isPopUp =ref(false);

// 控制燈箱的顯示與隱藏
function togglePopUp() {
  isPopUp.value = !isPopUp.value;
  // // 停止捲軸
  if (isPopUp.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
}


    const menus = {
  menu1: {
    placeHolder: '我的毛孩品種是',
    options: [
    { id: 0, name: '柴犬' },
    { id: 1, name: '拉布拉多' },
    { id: 2, name: '哈士奇' },
    { id: 3, name: '黃金獵犬' },
    { id: 4, name: '德國牧羊犬' },
    { id: 5, name: '法國鬥牛犬' },
    { id: 6, name: '貴賓犬（泰迪）' },
    { id: 7, name: '臘腸犬' },
    { id: 8, name: '比熊犬' },
    { id: 9, name: '邊境牧羊犬' },
    { id: 10, name: '雪納瑞' },
    { id: 11, name: '西施犬' },
    { id: 12, name: '約克夏' },
    { id: 13, name: '柯基犬' },
    { id: 14, name: '馬爾濟斯' },
    { id: 15, name: '秋田犬' },
    { id: 16, name: '松獅犬' },
    { id: 17, name: '沙皮狗' },
    { id: 18, name: '牛頭梗' },
    { id: 19, name: '羅威納犬' },
    { id: 20, name: '大丹犬' },
    { id: 21, name: '杜賓犬' },
    { id: 22, name: '博美犬' },
    { id: 23, name: '喜樂蒂牧羊犬' },
    { id: 24, name: '阿拉斯加雪橇犬' },
    { id: 25, name: '巴哥犬' },
    { id: 26, name: '狐狸犬' },
    { id: 27, name: '愛斯基摩犬' },
    { id: 28, name: '大白熊犬' },
    { id: 29, name: '巴吉度犬' },
    { id: 30, name: '比格犬' },
    ],
  },
  year: {
    placeHolder: '年份',
    options: Array.from({ length: 2025 - 2005 + 1 }, (_, i) => ({
      id: i,
      name: `${2025 - i} 年`,
    })),
  },
  month: {
    placeHolder: '月份',
    options: Array.from({ length: 12 }, (_, i) => ({
      id: i + 1,
      name: `${i + 1} 月`,
    })),
  },
  day: {
    placeHolder: '日期',
    options: Array.from({ length: 31 }, (_, i) => ({
      id: i + 1,
      name: `${i + 1} 日`,
    })),
  },
country: {
  placeHolder: '送貨地點',
  options: [
    { id: 0, name: '台灣' },
    { id: 1, name: '香港' },
    { id: 2, name: '澳門' },
  ],
},
shipPlace: {
  placeHolder: '送貨地點',
  options: [
    { id: 0, name: '台灣' },
    { id: 1, name: '香港' },
    { id: 2, name: '澳門' },
  ],
},
payment: {
  placeHolder: '送貨地點',
  options: [
    { id: 0, name: '台灣' },
    { id: 1, name: '香港' },
    { id: 2, name: '澳門' },
  ],
},
visaYear: {
    placeHolder: '年份',
    options: Array.from({ length: 2025 - 2005 + 1 }, (_, i) => ({
      id: i,
      name: `${2025 - i} 年`,
    })),
  },
visaMonth: {
    placeHolder: '月份',
    options: Array.from({ length: 12 }, (_, i) => ({
      id: i + 1,
      name: `${i + 1} 月`,
    })),
  },
};



</script>

