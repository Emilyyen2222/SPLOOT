<template>
    <MainHeader theme="red" bgc=""></MainHeader>

    
<!-- 請先建立寵物卡 -->
<PopUp
    :is-pop-up="CreatePetCard.isPopUp.value"
    @toggle="togglePopUpCreatePetCard">
    <P class="bold" style="margin-bottom: 2.4rem;">請先建立寵物卡</P>
    <RouterLink to="/member-center/petcard" style="cursor: pointer;">
        <Btn btnType="form" btnStyle="nextQ">確定</Btn> 
        <!-- <Btn btnType="form" btnStyle="nextQ">配對問卷</Btn> 
        <Btn btnType="form" btnStyle="nextQ">開始配對</Btn>  -->
    </RouterLink>
</PopUp>

<!-- 寵物資訊卡 -->
<button @click="toggleLightBoxPetInfo('dog')">狗狗資訊卡</button>
<button @click="toggleLightBoxPetInfo('cat')">貓貓資訊卡</button>

<LightBox 
    :title="lightTitlePetInfo.title"
    :is-light-box="isLightBoxPetInfo" 
    @toggle="toggleLightBoxPetInfo()">
    <div v-if="selectedPetType === 'dog'" class="infoContainer">
    <!-- 資訊卡內文 -->
        <div class="infoWrap">
            <!-- 毛孩姓名，性別，品種 -->
            <div class="wPhotoSec">
                <div class="imgUpload" @click="callFileInput">
                    <div class="imgUploadSection">
                        <p class="smallText imgUploadText" v-if="!hasUploadImg">上傳主圖片*<br>建議1100x300px</p>
                        <div class="uploadImgBox" v-if="hasUploadImg">  <!-- 如果有圖片的話才顯現 -->
                            <img :src="hasUploadImg" alt="uploadImg" ref="uploadedImg">
                        </div>
                    </div>
                    <div class="imgUploadBtn">
                        <input type="file" hidden ref="fileInput" accept="image/*" @change="uploadFileImage">
                        <!-- <Btn btnStyle="primary small" >上傳圖檔</Btn> -->
                    </div>
                </div>
                <div class="infoSection">
                    <div class="fieldWrapper">
                        <div class="field">
                            <label>毛孩姓名*</label>
                            <div class="petName">
                                <InputText placeHolder="Splooter" size = "small" text-align="left" errorMsg="Invalid Input" 
                                v-model="inputValue" :hasError="inputError"></InputText>
                            </div>
                        </div>
                    </div>
                    <div class="fieldWrapper">
                        <div class="field">
                            <label>性別*</label>
                            <div class="tags">
                                <Btn v-for="option in tag1.options" :key="option"
                                btnType="tag" 
                                :class="{'-active': optionSelected(tag1.selected, option)}"
                                @click="tag1.formChoice(tag1.selected, option)">{{ option }}</Btn>
                            </div>
                        </div>
                    </div>
                    <div class="fieldWrapper">
                        <div class="field">
                            <label>品種*</label>
                            <div class="breedOpt">
                                <div class="dropdownMenu">
                                    <DropdownMenu class="dropDown"
                                    :placeHolder="menus.menuDog.placeHolder"
                                    :options="menus.menuDog.options">
                                    </DropdownMenu>
                                </div>
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
                            <div class="dropdownMenu">
                                <div class="year">
                                    <DropdownMenu class="dropDown city"
                                    :placeHolder="menus.year.placeHolder"
                                    :options="menus.year.options">
                                    </DropdownMenu>
                                </div>
                            </div>
                            <div class="dropdownMenu">
                                <div class="month">
                                    <DropdownMenu class="dropDown city"
                                    :placeHolder="menus.month.placeHolder"
                                    :options="menus.month.options">
                                    </DropdownMenu>
                                </div>
                            </div>
                            <div class="dropdownMenu">
                                <div class="date">
                                    <DropdownMenu class="dropDown city"
                                    :placeHolder="menus.day.placeHolder"
                                    :options="menus.day.options">
                                    </DropdownMenu> 
                                </div>
                            </div>
                            <div class="tags">
                                <div class="unknown">
                                    <Btn v-for="option in tag5.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(tag5.selected, option)}"
                                    @click="tag5.formChoice(tag5.selected, option)">{{ option }}</Btn>
                                </div>
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
                                <Btn v-for="option in tag2.options" :key="option"
                                btnType="tag" 
                                :class="{'-active': optionSelected(tag2.selected, option)}"
                                @click="tag2.formChoice(tag2.selected, option)">{{ option }}</Btn>
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
                                <Btn v-for="option in tag3.options" :key="option"
                                btnType="tag" 
                                :class="{'-active': optionSelected(tag3.selected, option)}"
                                @click="tag3.formChoice(tag3.selected, option)">{{ option }}</Btn>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 興趣愛好 -->
            <div class="interest">
                <div class="fieldWrapper">
                    <div class="field ">
                        <label>興趣愛好</label>
                        <div class="fieldInterest">
                            <div class="sizeOptions">
                                <div class="tags">
                                    <Btn v-for="option in tag4.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(tag4.selected, option)}"
                                    @click="tag4.formChoice(tag4.selected, option)">{{ option }}</Btn>
                                </div>
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
                            <input type="radio" name="neuterStatus" class="nRadioBtn" id="neutered">已絕育
                            <input type="radio" name="neuterStatus" class="nRadioBtn" id="notNeutered">未絕育
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
    <div v-if="selectedPetType === 'cat'" class="infoContainer">
    <!-- 資訊卡內文 -->
        <div class="infoWrap">
            <!-- 毛孩姓名，性別，品種 -->
            <div class="wPhotoSec">
                <div class="imgUpload" @click="callFileInput">
                    <div class="imgUploadSection">
                        <p class="smallText imgUploadText" v-if="!hasUploadImg">上傳主圖片*<br>建議1100x300px</p>
                        <div class="uploadImgBox" v-if="hasUploadImg">  <!-- 如果有圖片的話才顯現 -->
                            <img :src="hasUploadImg" alt="uploadImg" ref="uploadedImg">
                        </div>
                    </div>
                    <div class="imgUploadBtn">
                        <input type="file" hidden ref="fileInput" accept="image/*" @change="uploadFileImage">
                        <!-- <Btn btnStyle="primary small" >上傳圖檔</Btn> -->
                    </div>
                </div>
                <div class="infoSection">
                    <div class="fieldWrapper">
                        <div class="field">
                            <label>毛孩姓名*</label>
                            <div class="petName">
                                <InputText placeHolder="Splooter" size = "small" text-align="left" errorMsg="Invalid Input" 
                                v-model="inputValue" :hasError="inputError"></InputText>
                            </div>
                        </div>
                    </div>
                    <div class="fieldWrapper">
                        <div class="field">
                            <label>性別*</label>
                            <div class="tags">
                                <Btn v-for="option in tag1.options" :key="option"
                                btnType="tag" 
                                :class="{'-active': optionSelected(tag1.selected, option)}"
                                @click="tag1.formChoice(tag1.selected, option)">{{ option }}</Btn>
                            </div>
                        </div>
                    </div>
                    <div class="fieldWrapper">
                        <div class="field">
                            <label>品種*</label>
                            <div class="breedOpt">
                                <div class="dropdownMenu">
                                    <DropdownMenu class="dropDown"
                                    :placeHolder="menus.menuCat.placeHolder"
                                    :options="menus.menuCat.options">
                                    </DropdownMenu>
                                </div>
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
                            <div class="dropdownMenu">
                                <div class="year">
                                    <DropdownMenu class="dropDown city"
                                    :placeHolder="menus.year.placeHolder"
                                    :options="menus.year.options">
                                    </DropdownMenu>
                                </div>
                            </div>
                            <div class="dropdownMenu">
                                <div class="month">
                                    <DropdownMenu class="dropDown city"
                                    :placeHolder="menus.month.placeHolder"
                                    :options="menus.month.options">
                                    </DropdownMenu>
                                </div>
                            </div>
                            <div class="dropdownMenu">
                                <div class="date">
                                    <DropdownMenu class="dropDown city"
                                    :placeHolder="menus.day.placeHolder"
                                    :options="menus.day.options">
                                    </DropdownMenu> 
                                </div>
                            </div>
                            <div class="tags">
                                <div class="unknown">
                                    <Btn v-for="option in tag5.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(tag5.selected, option)}"
                                    @click="tag5.formChoice(tag5.selected, option)">{{ option }}</Btn>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 體型 -->
            <!-- <div class="petSize">
                <div class="sizeFieldWrapper">
                    <div class="field">
                        <label>體型</label>
                        <div class="sizeOptions">
                            <div class="tags">
                                <Btn v-for="option in tag2.options" :key="option"
                                btnType="tag" 
                                :class="{'-active': optionSelected(tag2.selected, option)}"
                                @click="tag2.formChoice(tag2.selected, option)">{{ option }}</Btn>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- 社交 -->
            <div class="social">
                <div class="socialfieldWrapper">
                    <div class="field">
                        <label>社交性</label>
                        <div class="sizeOptions">
                            <div class="tags">
                                <Btn v-for="option in tag3.options" :key="option"
                                btnType="tag" 
                                :class="{'-active': optionSelected(tag3.selected, option)}"
                                @click="tag3.formChoice(tag3.selected, option)">{{ option }}</Btn>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 興趣愛好 -->
            <div class="interest">
                <div class="fieldWrapper">
                    <div class="field ">
                        <label>興趣愛好</label>
                        <div class="fieldInterest">
                            <div class="sizeOptions">
                                <div class="tags">
                                    <Btn v-for="option in tag6.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(tag6.selected, option)}"
                                    @click="tag6.formChoice(tag6.selected, option)">{{ option }}</Btn>
                                </div>
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
                            <input type="radio" name="neuterStatus" class="nRadioBtn" id="neutered">已絕育
                            <input type="radio" name="neuterStatus" class="nRadioBtn" id="notNeutered">未絕育
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
        import { ref, computed } from 'vue'
        import LightBox from "@/components/LightBox.vue";
        import PopUp from "@/components/PopUp.vue";

    // popup 請先建立寵物卡
    const CreatePetCard = { isPopUp : ref (false)  };
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
    
    // 圖片上傳區塊
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
    }
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
    //燈箱狀態-資訊卡
    const lightTitlePetInfo = ref({
        title: '狗狗資訊卡'
    });
    let isLightBoxPetInfo = ref(true);
    // 狗狗貓貓資訊卡切換
    const selectedPetType = ref('dog');
    // 狗狗資訊卡
    // 控制燈箱的顯示與隱藏
    function toggleLightBoxPetInfo(petType) {
        isLightBoxPetInfo.value = !isLightBoxPetInfo.value;
        if (petType) {
            selectedPetType.value = petType; 
        }
        // 根據 petType 更新標題
        if (petType == 'dog') {
            lightTitlePetInfo.value.title = '狗狗資訊卡';
        } else if (petType == 'cat') {
            lightTitlePetInfo.value.title = '貓貓資訊卡';
        }
        // 根據狀態新增或移除 clicked 類別
        if (isLightBoxPetInfo.value) {
            document.body.classList.add('clicked');
        } else {
            document.body.classList.remove('clicked');
        }
    }
    const menus = {
    menuDog: {
        placeHolder: '我的狗狗品種是',
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
        { id: 30, name: '米克斯' },
        ],
    },
    menuCat: {
        placeHolder: '我的貓貓品種是',
        options: [
            { id: 0, name: '美短（美國短毛貓）' },
            { id: 1, name: '英短（英國短毛貓）' },
            { id: 2, name: '緬因貓' },
            { id: 3, name: '布偶貓' },
            { id: 4, name: '波斯貓' },
            { id: 5, name: '金吉拉' },
            { id: 6, name: '曼赤肯（矮腳貓）' },
            { id: 7, name: '無毛貓（斯芬克斯）' },
            { id: 8, name: '加菲貓' },
            { id: 9, name: '孟加拉貓' },
            { id: 10, name: '暹羅貓' },
            { id: 11, name: '折耳貓（蘇格蘭折耳貓）' },
            { id: 12, name: '俄羅斯藍貓' },
            { id: 13, name: '橘貓（米克斯）' },
            { id: 14, name: '三花貓（米克斯）' },
            { id: 15, name: '狸花貓（米克斯）' },
            { id: 16, name: '挪威森林貓' },
            { id: 17, name: '土耳其梵貓' },
            { id: 18, name: '土耳其安哥拉貓' },
            { id: 19, name: '埃及貓' },
            { id: 20, name: '喜馬拉雅貓' },
            { id: 21, name: '新加坡貓' },
            { id: 22, name: '美國捲耳貓' },
            { id: 23, name: '索馬利貓' },
            { id: 24, name: '巴厘貓' },
            { id: 25, name: '東方短毛貓' },
            { id: 26, name: '科拉特貓' },
            { id: 27, name: '塞爾凱克捲毛貓' },
            { id: 28, name: '德文捲毛貓' },
            { id: 29, name: '柯尼斯捲毛貓' },
            { id: 30, name: '日本短尾貓' },
            ],
        menuValue: ref('我的貓咪品種是'),
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
    };
    </script>
    
    