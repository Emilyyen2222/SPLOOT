<template>
    <MainHeader theme="red" bgc=""></MainHeader>

    <button @click="selectedPetType = 'dog'">狗狗資訊卡</button>
    <button @click="selectedPetType = 'cat'">貓貓資訊卡</button>

<PopUp
    :is-pop-up="CreatePetCard.isPopUp.value"
    @toggle="togglePopUpCreatePetCard">
    <P class="bold" style="margin-bottom: 2.4rem;">請先建立寵物卡</P>
    <RouterLink to="/member-center/petcard" style="cursor: pointer;">
        <Btn btnType="form" btnStyle="nextQ">確定</Btn> 
    </RouterLink>
</PopUp>

<LightBox 
    :title="lightTitle.title"
    :is-light-box="isLightBox" 
    @toggle="toggleLightBox">

    <div class="infoContainer">
<!-- 狗狗資訊卡標題 -->

        <!-- 資訊卡內文 -->
        <div class="infoWrap">
            <!-- 毛孩姓名，性別，品種 -->
            <div class="wPhotoSec">
                <div class="photo">
                    <img src="../assets/img/splootbox/splootbox1.avif" alt="">
                </div>
                <div class="infoSection">
                    <div class="fieldWrapper">
                        <div class="field">
                            <label>毛孩姓名*</label>
                            <div class="petName">
                                <InputText placeHolder="斯普拉特" size = "small" text-align="left" errorMsg="Invalid Input" 
                                v-model="inputValue" :hasError="inputError"></InputText>
                            </div>
                        </div>
                    </div>
                    <div class="fieldWrapper">
                        <div class="field">
                            <label>性別*</label>
                            <div class="tags">
                                <span class="smallText tag">男生</span>
                                <span class="smallText tag">生</span>
                                <span class="smallText tag">未知</span>
                            </div>
                        </div>
                    </div>
                    <div class="fieldWrapper">
                        <div class="field">
                            <label>品種*</label>
                            <div class="breedOpt">
                                <DropdownMenu
                                :placeHolder="menus.menu1.placeHolder"
                                :options="menus.menu1.options">
                                </DropdownMenu>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 生日 -->
            <div class="birthdaySection">
                <div class="birthFieldWrapper">
                    <div class="field">
                        <label>生日</label>
                        <div class="birthBox">
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
                            <div class="tags">
                                <span class="smallText tag">未知</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 體型 -->
            <div class="petSize">
                <div class="sizeFieldWrapper">
                    <div class="field">
                        <label>體型</label>
                        <div class="sizeOptions">
                            <div class="tags">
                                <span class="smallText tag">小型犬10公斤以下</span>
                                <span class="smallText tag">中型犬11-25公斤</span>
                                <span class="smallText tag">大型犬26公斤以上</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 社交 -->
            <div class="social">
                <div class="socialfieldWrapper">
                    <div class="field">
                        <label>社交性</label>
                        <div class="sizeOptions">
                            <div class="tags">
                                <span class="smallText tag">親寵親人</span>
                                <span class="smallText tag">不親寵親人</span>
                                <span class="smallText tag">親寵不親人</span>
                                <span class="smallText tag">慢熟</span>
                                <span class="smallText tag">小孩友善</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 興趣愛好 -->
            <div class="interest">
                <div class="fieldWrapper">
                    <div class="field">
                        <label>興趣愛好</label>
                        <div class="sizeOptions">
                            <div class="tags">
                                <span class="smallText tag">喜歡散步</span>
                                <span class="smallText tag">喜歡玩球</span>
                                <span class="smallText tag">喜歡玩飛盤</span>
                                <span class="smallText tag">熱愛玩水</span>
                                <span class="smallText tag">喜歡跳舞</span>
                                <span class="smallText tag">熱衷學習指令</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 絕育狀態 -->
            <div class="neuter">
                <div class="neuterFieldWrapper">
                    <div class="field">
                        <label>絕育狀態*</label>
                        <div class="breedOptions">
                            <input type="radio" name="" class="nRadioBtn">已絕育
                            <input type="radio" name="" class="nRadioBtn">未絕育
                        </div>
                    </div>
                </div>
            </div>
            <!-- 毛孩簡介文字區 -->
            <div class="infoInput">
                <div class="fieldWrapper">
                    <div class="field">
                        <label>毛孩簡介*</label>
                            <InputText class="textBox" inputType="textarea" textAlign="left" size="small" placeHolder="請於80字內" errorMsg="Invalid Input" 
                            v-model="inputValue" :hasError="inputError"></InputText>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="saveBtnBox">
        <RouterLink to="/match" style="cursor: pointer;">
            <Btn btnType="form" btnStyle="nextQ">儲存</Btn> 
        </RouterLink>
        <Btn class="borderBottom" btnType="form" btnStyle="lastQ">取消編輯</Btn>
    </div> 
</LightBox>
    </template>
    
    <script setup>
        import { ref } from 'vue'

        import MainHeader from "../components/MainHeader.vue";
        
        import DropdownMenu from "../components/DropdownMenu.vue";
        import Btn from '../components/Btn.vue';
        import InputText from '../components/InputText.vue';
        import LightBox from "@/components/LightBox.vue";
        import PopUp from "@/components/PopUp.vue";

    // 上傳圖片
    const fileInput = ref(null);
    const hasUploadImg = ref(null);
    const uploadedImg = ref(null);

    // 按下按鈕呼叫"選擇檔案"
    const callFileInput = () => {
        if(fileInput.value){
            fileInput.value.click();
        };
    }
    // 上傳
    const uploadFileImage = (event) => {
        if (!event || !event.target || !event.target.files || event.target.files.length === 0) {
            return; //防止 `event` 或 `files` 為空
        };

        const file = event.target.files[0];

        if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
            hasUploadImg.value = e.target.result; // 設定預覽圖片的 base64 URL
        };
        reader.readAsDataURL(file);
    }
    };
    // 標籤
    const tag1 = {
    formChoice: singleChoice,
    options: ['男生', '女生', '未知'],
    selected: ref([]),
    };
    const tag2 = {
    formChoice: singleChoice,
    options: ['小型犬10公斤以下', '中型犬11-25公斤', '大型犬26公斤以上'],
    selected: ref([]),
    };
    const tag3 = {
    formChoice: multipleChoice,
    options: ['親寵親人', '不親寵親人', '親寵不親人', '慢熟', '小孩友善'],
    selected: ref([]),
    };
    const tag4 = {
    formChoice: multipleChoice,
    options: ['喜歡散步', '喜歡玩球', '喜歡玩飛盤', '熱愛玩水', '喜歡跳舞', '熱衷學習指令'],
    selected: ref([]),
    };
    const tag5 = {
        formChoice: multipleChoice,
        options: ['未知'],
        selected: ref([]),
    };
    const tag6 = {
    formChoice: multipleChoice,
    options: ['喜歡玩蟑螂', '喜歡嗑貓草', '喜歡逗貓棒', '熱愛貓抓板', '喜歡採鍵盤', '喜歡空紙箱'],
    selected: ref([]),
    };

    function singleChoice(selected, option) {
        selected.value = [option];
        // console.log(selected.value);
    }
    function multipleChoice(selected, option) {
        if (optionSelected(selected, option)) {
            selected.value = selected.value.filter(opt => opt !== option);
        } else {
            selected.value.push(option);
        }
        // console.log(selected.value);
    }
    const optionSelected = (selected, option) => {
        return selected.value.includes(option);
    }





    //燈箱狀態-資訊卡
    const lightTitleDogInfo = {title: "狗狗資訊卡"}

    let isLightBoxDogInfo = ref(true);

    // 狗狗資訊卡
    // 控制燈箱的顯示與隱藏
    function toggleLightBoxDogInfo() {
    isLightBoxDogInfo.value = !isLightBoxDogInfo.value;
    // 根據狀態新增或移除 clicked 類別
    if (isLightBoxDogInfo.value) {
    document.body.classList.add('clicked');
    } else {
    document.body.classList.remove('clicked');
    }
    }

    // 狗狗貓貓資訊卡切換
    const selectedPetType = ref('dog');


    //popup
    // 請先建立寵物卡
    const CreatePetCard = { isPopUp : ref (true)  };
    // 控制燈箱的顯示與隱藏
    function togglePopUpCreatePetCard() {
        CreatePetCard.isPopUp.value = !CreatePetCard.isPopUp.value;
        // // 停止捲軸
        if (CreatePetCard.isPopUp.value) {
        document.body.classList.add('clicked');
        } else {
        document.body.classList.remove('clicked');
        }
    };



const menus = {
  menu1: {
    placeHolder: '米克斯',
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
    
    