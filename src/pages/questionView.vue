<template>
<MainHeader theme="red" bgc=""></MainHeader>

<!------------------------ question 1---------------------->
<div class="box">
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
            <DropdownMenu
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
                        <DropdownMenu
                        :placeHolder="menus.year.placeHolder"
                        :options="menus.year.options">
                        </DropdownMenu>
                    </div>
                    <div class="month">
                        <DropdownMenu
                        :placeHolder="menus.month.placeHolder"
                        :options="menus.month.options">
                        </DropdownMenu>
                    </div>
                    <div class="date">
                        <DropdownMenu
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
                <Btn class="check" btnStyle="btn text small">查看</Btn>
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
        <!-- <div class="options"></div> -->
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
<!---question 7---->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">選擇付款與運送方式</h4>
        <div class="options date">
                <div class="ship">
                    <div class="xsText left">收貨地點</div>
                    <div class="year">
                        <DropdownMenu
                        :placeHolder="menus.country.placeHolder"
                        :options="menus.country.options">
                        </DropdownMenu>
                    </div>
                    <div class="xsText left">取貨方式</div>
                    <div class="month">
                        <DropdownMenu
                        :placeHolder="menus.shipPlace.placeHolder"
                        :options="menus.shipPlace.options">
                        </DropdownMenu>
                    </div>
                    <div class="xsText left">付款方式</div>
                    <div class="date">
                        <DropdownMenu
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

<!-- circle bg -->
    <div class="circleQuestion"></div>
</template>

<script setup>
    import MainHeader from "../components/MainHeader.vue";
    import DropdownMenu from "../components/DropdownMenu.vue";
    import Btn from '../components/Btn.vue';
    import InputText from '../components/InputText.vue';

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
};



</script>

