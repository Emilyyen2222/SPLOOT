<template>
    <div class="hc-postCard" id="hcPostBuddy" v-for="(card,index) in cardsRawData" :key="index">
        <div class="buddyCards">
            <div class="cardBox">
                <div class="cardsImgBox">                        
                        <img :src="card.imgSrc" alt="" class="cardsImg">                        
                </div>
                <div class="cardText">
                    <h6 class="cardsTitle bold">{{ card.title }}</h6>
                    <div class="reviews">
                        
                        <ul class="stars">
                            <li v-for="n in 5">
                                <img :src="isStars(n, card.stars)" alt="star" :class="['star', 'star' + n]">
                            </li>
                        </ul>
                        <div class="avgGrade smallText">{{ card.stars }}</div>
                    </div>
                    <div class="serviceDays">
                        <p class="smallText">服務時段</p>
                        <div class="serviceDaysBox">
                            <p class="smallText">每週</p>
                            <ul class="daysUl">
                                <li v-for="day in card.serviceDays" class="daysItem xsText">{{ day }}</li>
                            </ul>                            
                        </div>
                    </div>                
                    <div class="serviceTime smallText">{{ card.serviceTimeStart }}-{{ card.serviceTimeEnd }}</div>
                </div>
            </div>
            <!-- <Router-link  to="/sploot-buddy/buddy-post">
                <Btn btnStyle="primary small">查看</Btn>  
            </Router-link> -->
        </div>

        <div class="hc-btn-group">
            <Btn btnStyle="primary default" id="editPostCard" @click="toggleEditPost">編輯</Btn>                
            <Btn btnStyle="baseline small" id="deletePostCard" @click="togglePopUp_deleteCard">刪除貼文</Btn>            
        </div> 
    </div>

          <!-- lightbox，編輯貼文 -->
          <LightBox 
          :title="editPost.title"
          :is-light-box="editPost.isLightBox.value" 
          @toggle="toggleEditPost">
          <div class="newPost">
            <div class="postType ">
                <p class="smallText inputLabel">服務類型*</p>
                <div class="dropdownMenu">
                    <DropdownMenu class="typeDropDown dropDown"
                        :placeHolder="postServiceType.placeHolder"
                        :options="postServiceType.options"
                        v-model="selectService">
                    </DropdownMenu>
                </div>
            </div>
            <div class="imgUpload">
                <div class="imgUploadSection">
                    <p class="smallText imgUploadText" v-if="!hasUploadImg">上傳主圖片*<br>建議1100x300px</p>
                    <div class="uploadImgBox" v-if="hasUploadImg">  <!-- 如果有圖片的話才顯現 -->
                        <img :src="hasUploadImg" alt="uploadImg" ref="uploadedImg">
                    </div>
                </div>
                <div class="imgUploadBtn">
                    <input type="file" hidden ref="fileInput" accept="image/*" @change="uploadFileImage_addPost">
                    <Btn btnStyle="primary small" @click="callFileInput_addPost">上傳圖檔</Btn>
                </div>
            </div>
            <div class="newPostInput">
                <div class="postTitle">
                    <p class="smallText inputLabel">發佈主題*</p>
                    <InputText                
                        size = "small"
                        placeHolder="這裡輸入發佈主題"
                        errorMsg="Invalid Input"
                        v-model="inputValuePostTitle"
                        :hasError="inputError">
                    </InputText>
                </div>
                <div class="postContent">
                    <p class="smallText inputLabel">發佈內容*</p>
                    <InputText 
                    class="textBox" 
                    inputType="textarea"             
                    size="small" 
                    placeHolder="請於200字內" 
                    errorMsg="Invalid Input" 
                    v-model="inputValuePostContent"
                    :hasError="inputError"></InputText>
                </div>
            </div>
            <div class="newPostBtn">
                <Btn btnStyle="primary small">提交</Btn>
                <div class="cancelBtn">
                    <Btn btnStyle="baseline small">取消</Btn>
                </div>
            </div>
          </div>
          </LightBox>

          <!-- PopUp，刪除卡片 -->
          <PopUp
          :is-pop-up="deleteCard.isPopUp.value">
            <div class="delete-petcard">
              <div class="title">
                <p class="bold">確定刪除資訊卡?</p>
              </div>
              <div class="btn-group">
                <Btn btnStyle="primary small" @click="togglePopUp_deleteCard">確定</Btn>
                <Btn btnStyle="baseline small" @click="togglePopUp_deleteCard">取消</Btn>
              </div>
            </div>
          </PopUp>

</template>

<script setup>
import { ref,reactive,computed,watch } from 'vue';


import Btn from '@/components/Btn.vue';
import DropdownMenu from '../components/DropdownMenu.vue';
import InputText from '../components/InputText.vue';
import LightBox from '../components/LightBox.vue';
import PopUp from '../components/PopUp.vue';

// 小幫手文章的card 的資料
//小幫手卡片
const cardsData = ref([]); //渲染的卡片

//全部卡片資料
const cardsRawData = ref([
{
        imgSrc: new URL("../assets/img/buddy-post/demo.png", import.meta.url).href,
        title: "台北市puppy高速散步",
        serviceDays: ["一", "二"],
        serviceTimeStart: "09:00",
        serviceTimeEnd: "18:00",
        city: "台北市",
        district: "中正區",
        serviceType: "walkies",
        petTypes: ["puppy", "small", "middle", "large", "elder", "kitten", "cat"],
        stars: 2,
    },
    {
        imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
        title: "板橋區cat快速散步去",
        serviceDays: ["一", "二"],
        serviceTimeStart: "09:00",
        serviceTimeEnd: "18:00",
        city: "新北市",
        district: "板橋區",
        serviceType: "walkies",
        petTypes: ["puppy", "cat"],
        stars: 5,
    },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "基隆市kitten基隆陪她走走",
    //     serviceDays: ["一", "四", "六", "日"],
    //     serviceTimeStart: "10:00",
    //     serviceTimeEnd: "20:00",
    //     city: "基隆市",
    //     district: "中正區",
    //     serviceType: "walkies",
    //     petTypes: ["puppy", "small", "kitten"],
    //     stars: 3,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "鳳山區large安心毛孩散步",
    //     serviceDays: ["一", "二", "四", "六", "日"],
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "19:00",
    //     city: "高雄市",
    //     district: "鳳山區",
    //     serviceType: "walkies",
    //     petTypes: ["large", "elder"],
    //     stars: 1,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台中市北屯區elder",
    //     serviceDays: ["一", "二", "三", "四", "五", "六", "日"],
    //     serviceTimeStart: "06:00",
    //     serviceTimeEnd: "18:00",
    //     city: "台中市",
    //     district: "北屯區",
    //     serviceType: "walkies",
    //     petTypes: ["elder", "cat"],
    //     stars: 4,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "桃園市桃園區puppy",
    //     serviceDays: ["一"],
    //     serviceTimeStart: "08:00",
    //     serviceTimeEnd: "19:00",
    //     city: "桃園市",
    //     district: "桃園區",
    //     serviceType: "walkies",
    //     petTypes: ["puppy", "small"],
    //     stars: 5,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "新北市新莊區middle",
    //     serviceDays: ["一", "二", "三", "四", "五", "日"],
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "17:00",
    //     city: "新北市",
    //     district: "新莊區",
    //     serviceType: "walkies",
    //     petTypes: ["middle", "large"],
    //     stars: 2,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "高雄市三民區small",
    //     serviceDays: ["二", "三", "六"],
    //     serviceTimeStart: "06:00",
    //     serviceTimeEnd: "20:00",
    //     city: "高雄市",
    //     district: "三民區",
    //     serviceType: "walkies",
    //     petTypes: ["small", "elder"],
    //     stars: 1,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台南市南區large",
    //     serviceDays: ["六", "日"],
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "19:00",
    //     city: "台南市",
    //     district: "南區",
    //     serviceType: "petDrop",
    //     petTypes: ["middle", "large"],
    //     stars: 2,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台南市安平區middle",
    //     serviceDays: ["一", "二"],
    //     serviceTimeStart: "06:00",
    //     serviceTimeEnd: "18:00",
    //     city: "台南市",
    //     district: "安平區",
    //     serviceType: "petDrop",
    //     petTypes: ["middle", "kitten"],
    //     stars: 4,
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "新北市新店區kitten",
    //     serviceTimeStart: "08:00",
    //     serviceTimeEnd: "20:00",
    //     city: "新北市",
    //     district: "新店區",
    //     serviceType: "petDrop",
    //     petTypes: ["large", "kitten"],
    //     stars: 4,
    //     serviceDays: ["一", "二", "六", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "桃園市中壢區puppy",
    //     serviceTimeStart: "10:00",
    //     serviceTimeEnd: "20:00",
    //     city: "桃園市",
    //     district: "中壢區",
    //     serviceType: "petDrop",
    //     petTypes: ["puppy", "large"],
    //     stars: 5,
    //     serviceDays: ["一", "二", "三", "四", "六", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台北市大安區large",
    //     serviceTimeStart: "09:00",
    //     serviceTimeEnd: "18:00",
    //     city: "台北市",
    //     district: "大安區",
    //     serviceType: "petDrop",
    //     petTypes: ["large", "small"],
    //     stars: 2,
    //     serviceDays: ["二", "三", "四", "五", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台中市西屯區small",
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "19:00",
    //     city: "台中市",
    //     district: "西屯區",
    //     serviceType: "petDrop",
    //     petTypes: ["small", "elder"],
    //     stars: 1,
    //     serviceDays: ["日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "前進！前進！為人類奉獻！",
    //     serviceTimeStart: "02:00",
    //     serviceTimeEnd: "10:00",
    //     city: "高雄市",
    //     district: "仁武區",
    //     serviceType: "petDrop",
    //     petTypes: ["cat"],
    //     stars: 5,
    //     serviceDays: ["一", "三", "五", "六", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "高雄市左營區cat",
    //     serviceTimeStart: "08:00",
    //     serviceTimeEnd: "22:00",
    //     city: "高雄市",
    //     district: "左營區",
    //     serviceType: "fostering",
    //     petTypes: ["kitten", "cat"],
    //     stars: 2,
    //     serviceDays: ["一"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台中市puppy提供長期寄宿",
    //     serviceTimeStart: "10:00",
    //     serviceTimeEnd: "20:00",
    //     city: "台中市",
    //     district: "東區",
    //     serviceType: "fostering",
    //     petTypes: ["puppy", "elder"],
    //     stars: 4,
    //     serviceDays: ["二", "五"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "桃園市middle短期安置",
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "17:00",
    //     city: "桃園市",
    //     district: "楊梅區",
    //     serviceType: "fostering",
    //     petTypes: ["middle", "small"],
    //     stars: 4,
    //     serviceDays: ["一", "二", "三", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台中市到府陪伴你的毛孩",
    //     serviceTimeStart: "09:00",
    //     serviceTimeEnd: "17:00",
    //     city: "台中市",
    //     district: "西區",
    //     serviceType: "homeCare",
    //     petTypes: ["small", "elder"],
    //     stars: 5,
    //     serviceDays: ["四", "五"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "新北市elder個人化照顧",
    //     serviceTimeStart: "08:00",
    //     serviceTimeEnd: "21:00",
    //     city: "新北市",
    //     district: "淡水區",
    //     serviceType: "homeCare",
    //     petTypes: ["elder", "cat"],
    //     stars: 2,
    //     serviceDays: ["一", "二", "三", "四", "五", "六", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台南市kitten寵物照顧專家",
    //     serviceTimeStart: "06:00",
    //     serviceTimeEnd: "16:00",
    //     city: "台南市",
    //     district: "永康區",
    //     serviceType: "homeCare",
    //     petTypes: ["small", "kitten"],
    //     stars: 1,
    //     serviceDays: ["一", "二", "三", "四", "五", "六", "日"],
    // },
    // {
    //     imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href,
    //     title: "台北市cat安心寵物照顧",
    //     serviceTimeStart: "07:00",
    //     serviceTimeEnd: "17:00",
    //     city: "台北市",
    //     district: "大同區",
    //     serviceType: "homeCare",
    //     petTypes: ["cat", "middle"],
    //     stars: 2,
    //     serviceDays: ["一", "二", "三", "四", "五", "六", "日"],
    // },
]);


//評分星星計算

const isStars = (n, stars) => {
    if(stars < 1){
        stars = 1;  //最少要有一顆星
    };

    if(n <= stars){
        return new URL('@/assets/img/icon/star-full.svg', import.meta.url).href
    }else{
        return new URL('@/assets/img/icon/star-line.svg', import.meta.url).href
    }
}; 

// 卡片查看更多
    const visbleCount = ref(6); //預設顯示6個

    const visibleCards = computed(() => {
        return cardsData.value.slice(0, visbleCount.value);
  });

  // 控制lightBox
  // 控制lightbox狀態
  const editPost = {
        title: "編輯貼文", 
        isLightBox: ref(false),
        };

  const toggleEditPost = () => toggleLightBox(editPost); 

  const toggleLightBox = (targetBox) =>{
    targetBox.isLightBox.value = !targetBox.isLightBox.value;;
    document.body.classList.toggle('clicked',targetBox.isLightBox.value);
  };

  //popup狀態
  const deleteCard = { isPopUp : ref (false )  };
  
  // 刪除資訊卡
  function togglePopUp_deleteCard() {
    deleteCard.isPopUp.value = !deleteCard.isPopUp.value;
    // // 停止捲軸
    if (deleteCard.isPopUp.value) {
      document.body.classList.add('clicked');
    } else {
      document.body.classList.remove('clicked');
    }
  };
  
 // 編輯貼文
    // 姓名
    const input_name = {
      size: 'small',
      textAlign: 'textLeft',
      placeHolder: '輸入姓名',
      errorMsg: '請輸入正確的格式',
      inputValue: ref(''),
      inputError: ref(false),
  };
  const input_idCard = {
      size: 'small',
      textAlign: 'textLeft',
      placeHolder: '輸入身分證號碼',
      errorMsg: '請輸入正確的格式',
      inputValue: ref(''),
      inputError: ref(false),
  };
  const input_selfIntro = {
      size: 'small',
      textAlign: 'textLeft',
      placeHolder: '輸入身分證號碼',
      errorMsg: '請輸入正確的格式',
      inputValue: ref(''),
      inputError: ref(false),
  };


  // 資料審核~
 // 兩個不同的上傳區塊
  const selfyImg = ref(null);   // 自拍照
  const idCardImg = ref(null);  // 身分證照片

  // 兩個不同的 input 參考
  const selfyFileInput = ref(null);
  const idCardFileInput = ref(null);

  // 按下按鈕時觸發對應的檔案上傳
  const callFileInput = (type) => {
    if (type === "selfy" && selfyFileInput.value) {
      selfyFileInput.value.click();
    } else if (type === "idCard" && idCardFileInput.value) {
      idCardFileInput.value.click();
    }
  };

  // 上傳圖片
  const uploadFileImage = (event, type) => {
    if (!event || !event.target || !event.target.files || event.target.files.length === 0) {
      return; // 防止 `event` 或 `files` 為空
    }

    const file = event.target.files[0];

    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = (e) => {
        if (type === "selfy") {
          selfyImg.value = e.target.result; // 設定自拍照
        } else if (type === "idCard") {
          idCardImg.value = e.target.result; // 設定身分證照
        }
      };
      reader.readAsDataURL(file);
    }
  };
  // dropDown
   // 取得目前年份
  const currentYear = new Date().getFullYear();
   // 利用 computed 動態生成從今年往回推 100 年的選項陣列
  const menu_birth_y = {
    placeHolder: '請選擇年份',
    options: computed(() => {
      const arr = [];
      for (let i = 0; i < 100; i++) {
        arr.push({ id: i, name: String(currentYear - i)+'年' });
      }
      return arr;
    })
  };
  
  const menu_birth_m = {
      placeHolder: '請選擇月份',
      options: computed(() => {
      const arr = [];
      for (let i = 1; i <= 12; i++) {
        arr.push({ id: i, name: String(i)+'月' });
      }
      return arr;
    })
  };
  const menu_birth_d = {
      placeHolder: '請選擇日期',
      options: [
          { id: 0, name: '1' },
          { id: 1, name: '2' },
          { id: 2, name: '3' },
          { id: 3, name: '4' },
          { id: 4, name: '5' },
          { id: 5, name: '6' },
          { id: 6, name: '7' },
          { id: 7, name: '8' },
          { id: 8, name: '9' },
          { id: 9, name: '10' },
          { id: 10, name: '11' },
          { id: 11, name: '12' },
          { id: 12, name: '13' },
          { id: 13, name: '14' },
          { id: 14, name: '15' },
          { id: 15, name: '16' },
          { id: 16, name: '17' },
          { id: 17, name: '18' },
          { id: 18, name: '19' },
          { id: 19, name: '20' },
          { id: 20, name: '21' },
          { id: 21, name: '22' },
          { id: 22, name: '23' },
          { id: 23, name: '24' },
          { id: 24, name: '25' },
          { id: 25, name: '26' },
          { id: 26, name: '27' },
          { id: 27, name: '28' },
          { id: 28, name: '29' },
          { id: 29, name: '30' },
          { id: 30, name: '31' },
      ]
  };

  // "新增貼文"燈箱

  const postServiceType = {
      placeHolder: "請選擇服務類型",
      options: [
          {name: "散步陪伴"},{name: "到府照顧"},{name: "友善寄宿"},{name: "寵物計程車"},
      ]}
  // 燈箱標題請輸入
  const lightTitle2 = {title: "發佈 散步陪伴 貼文"}

  //燈箱狀態
  let isLightBox2 = ref(false);

  // 控制燈箱的顯示與隱藏
  function toggleLightBox2() {
    isLightBox2.value = !isLightBox2.value;
    // 停止捲軸
    if (isLightBox2.value) {
      document.body.classList.add('clicked');
    } else {
      document.body.classList.remove('clicked');
    }
  }

  // 上傳圖片
  const fileInput = ref(null);
  const hasUploadImg = ref(null);
  const uploadedImg = ref(null);

  // 按下按鈕呼叫"選擇檔案"
  const callFileInput_addPost = () => {
      if(fileInput.value){
          fileInput.value.click();
      };
  }

  // 上傳
  const uploadFileImage_addPost = (event) => {
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

  // 小幫手管理
   // 服務地區
//城市選單
const city = {
    placeHolder: "全部城市",
    options: [
        {
          name: "全部城市",
          districts:[]
        },
        {
          name: "台北市",
          districts: ["中正區", "大同區", "中山區", "松山區", "大安區", "萬華區", "信義區", "士林區", "北投區", "內湖區", "南港區", "文山區"]
        },
        {
          name: "新北市",
          districts: ["板橋區", "新莊區", "中和區", "永和區", "三峡區", "淡水區", "汐止區", "瑞芳區", "土城區", "三峰區", "新店區", "坪林區", "林口區", "蘆洲區", "五股區", "八里區", "深坑區", "三芝區", "石碇區", "高雄區", "板橋區", "瑞金區", "平溪區", "雙溪區", "貢寮區"]
        },
        {
          name: "桃園市",
          districts: ["桃園區", "中壢區", "大溪區", "楊梅區", "蘆竹區", "大園區", "龍潭區", "平鎮區", "八德區", "觀音區", "龜山區", "八德區"]
        },
        {
          name: "台中市",
          districts: ["中區", "東區", "南區", "西區", "北區", "北屯區", "西屯區", "南屯區", "太平區", "大里區", "霧峰區", "烏日區", "豐原區", "后里區", "石岡區", "東勢區", "和平區", "新社區", "潭子區", "大雅區", "神岡區", "大肚區", "沙鹿區", "龍井區", "梧棲區", "清水區", "大甲區", "外埔區", "大安區"]
        },
        {
          name: "台南市",
          districts: ["中西區", "東區", "南區", "北區", "安平區", "安南區", "永康區", "歸仁區", "新化區", "左鎮區", "玉井區", "楠西區", "南化區", "仁德區", "關廟區", "龍崎區", "官田區", "麻豆區", "佳里區", "西港區", "七股區", "將軍區", "學甲區", "北門區", "新營區", "後壁區", "白河區", "東山區", "六甲區", "下營區", "柳營區", "鹽水區", "善化區", "大內區", "新市區", "山上區", "安定區"]
        },
        {
          name: "高雄市",
          districts: ["鹽埕區", "鼓山區", "左營區", "楠梓區", "三民區", "新興區", "前金區", "苓雅區", "前鎮區", "旗津區", "小港區", "鳳山區", "林園區", "大寮區", "大樹區", "大社區", "仁武區", "鳥松區", "岡山區", "橋頭區", "燕巢區", "田寮區", "阿蓮區", "路竹區", "湖內區", "茄萣區", "永安區", "彌陀區", "梓官區", "旗山區", "美濃區", "六龜區", "甲仙區", "杉林區", "內門區", "茂林區", "桃源區", "那瑪夏區"]
        },
        {
          name: "基隆市",
          districts: ["中正區", "七堵區", "暖暖區", "仁愛區", "中山區", "安樂區", "信義區"]
        },
        {
          name: "新竹市",
          districts: ["東區", "北區", "香山區"]
        },
        {
          name: "嘉義市",
          districts: ["東區", "西區"]
        },
        {
          name: "新竹縣",
          districts: ["北區", "香山區", "竹北市", "湖口鄉", "新豐鄉", "芎林鄉", "關西鎮", "五峰鄉", "八里區", "橫山鄉", "峨眉鄉", "寶山鄉", "尖石鄉", "北埔鄉", "横山乡", "竹东镇"]
        },
        {
          name: "苗栗縣",
          districts: ["苗栗市", "苑裡鎮", "通霄鎮", "三義鄉", "卓蘭鎮", "竹南鎮", "大湖鄉", "南庄鄉", "大肚鄉", "頭份市", "獅潭鄉", "西湖鄉", "頭屋鄉", "公館鄉", "銅鑼鄉", "臺中市", "後龍鎮", "造橋鄉"]
        },
        {
          name: "彰化縣",
          districts: ["彰化市", "芬園鄉", "花壇鄉", "秀水鄉", "鹿港鎮", "福興鄉", "線西鄉", "和美鎮", "伸港鄉", "員林市", "社頭鄉", "永靖鄉", "埔心鄉", "溪湖鎮", "大村鄉", "埔鹽鄉", "田中鎮", "北斗鎮", "田尾鄉", "埤頭鄉", "溪州鄉", "竹塘鄉", "二林鎮", "大城鄉", "芳苑鄉", "二水鄉"]
        },
        {
          name: "南投縣",
          districts: ["南投市", "中寮鄉", "草屯鎮", "國姓鄉", "埔里鎮", "仁愛鄉", "名間鄉", "集集鎮", "水里鄉", "魚池鄉", "信義鄉", "竹山鎮", "鹿谷鄉"]
        },
        {
          name: "雲林縣",
          districts: ["斗六市", "斗南鎮", "虎尾鎮", "西螺鎮", "古坑鄉", "大埤鄉", "莿桐鄉", "二崙鄉", "崙背鄉", "麥寮鄉", "臺西鄉", "東勢鄉", "褒忠鄉", "朴子市", "太保市", "布袋鎮"]
        },
        {
          name: "嘉義縣",
          districts: ["嘉義市", "番路鄉", "梅山鄉", "竹崎鄉", "阿里山鄉", "中埔鄉", "大埔鄉", "水上鄉", "鹿草鄉", "太保市", "朴子市", "東石鄉", "六腳鄉", "新港鄉", "民雄鄉", "大林鎮", "溪口鄉", "義竹鄉", "布袋鎮"]
        },
        {
          name: "屏東縣",
          districts: ["屏東市", "三地門鄉", "霧台鄉", "瑪家鄉", "九如鄉", "里港鄉", "高樹鄉", "鹽埔鄉", "長治鄉", "麟洛鄉", "竹田鄉", "內埔鄉", "萬丹鄉", "潮州鎮", "泰武鄉", "來義鄉", "萬巒鄉", "崁頂鄉", "新埤鄉", "南州鄉", "林邊鄉", "東港鎮", "琉球鄉", "佳冬鄉", "新園鄉", "枋山鄉", "滿州鄉"]
        },
        {
          name: "宜蘭縣",
          districts: ["宜蘭市", "頭城鎮", "礁溪鄉", "壯圍鄉", "員山鄉", "羅東鎮", "三星鄉", "大同鄉", "五結鄉", "冬山鄉", "蘇澳鎮", "南澳鄉", "釣魚台"]
        },
        {
          name: "花蓮縣",
          districts: ["花蓮市", "新城鄉", "秀林鄉", "吉安鄉", "壽豐鄉", "鳳林鄉", "光復鄉", "豐濱鄉", "瑞穗鄉", "萬榮鄉", "玉里鎮", "卓溪鄉", "富里鄉"]
        },
        {
          name: "台東縣",
          districts: ["台東市", "綠島鄉", "蘭嶼鄉", "延平鄉", "卑南鄉", "鹿野鄉", "關山鎮", "海端鄉", "池上鄉", "東河鄉", "成功鄉", "長濱鄉", "太麻里鄉", "金峰鄉", "大武鄉", "達仁鄉"]
        },
        {
          name: "金門縣",
          districts: ["金城鎮", "金湖鎮", "金沙鎮", "金寧鄉", "烈嶼鄉", "烏坵鄉"]
        },
        {
          name: "連江縣",
          districts: ["南竿鄉", "北竿鄉", "莒光鄉", "東引鄉"]
        },
      ],   
    };

    let selectedCity = ref(null); //v-model綁定
    let selectDistrict = ref(null); //v-model綁定
    const districtPlaceHolder = ref("全部行政區域");

    // 從選擇的城市中尋找他的行政區域 然後以{name: d}物件排列成陣列
    const districtsOptions = computed(() => {
        const cityData = city.options.find((c) => c.name === selectedCity.value);
        return cityData && selectedCity.value !== "全部城市" ? cityData.districts.map((d) => ({name: d})) : [];
    });

    // 點選新的城市後行政區清空
    watch(selectedCity, () => {        
        selectDistrict.value = null; 
        districtPlaceHolder.value = "全部行政區域";
    });

   // 寵物類型
   const tag_petKind = {    
    formChoice: singleChoice,
    options: ['幼犬', '小型犬', '中型犬','大型犬','老年犬','幼貓','成貓'],
    selected: ref([]),
  };
   // 服務時段
   const tag_weekDay = {    
    formChoice: singleChoice,
    options: ['週一', '週二', '週三', '週四', '週五', '週六', '週日'],
    selected: ref([]),
  };
     // Single choice
     function singleChoice(selected, option) {
      selected.value = [option];
      // console.log(selected.value);
    };
    // multiple choice
    function multipleChoice(selected, option) {
        if (optionSelected(selected, option)) {
            selected.value = selected.value.filter(opt => opt !== option);
        } else {
            selected.value.push(option);
        }
        // console.log(selected.value);
    };
    // 判斷是否被選取
    const optionSelected = (selected, option) => {
        return selected.value.includes(option);
    };

    // 服務時段-24hr制
     // 開始
    const timeStart = reactive({
      placeHolder: '起始時間',
      selected: '',
      options: computed(() => {
        return Array.from({ length: 24 }, (_, i) => ({
          id: i,
          name: `${String(i).padStart(2, '0')}:00` // 格式化為 00:00 ~ 23:00
        }));
      })
    });
     // 結束
    const timeEnd = reactive({
      placeHolder: '結束時間',
      selected: '',
      options: computed(() => {
        if (!timeStart.selected) return timeStart.options; // 若未選擇起始時間，顯示所有選項
        const startIndex = parseInt(timeStart.selected.split(':')[0]); // 取得起始時間數字 (00 ~ 23)
        return timeStart.options.filter(option => parseInt(option.name.split(':')[0]) > startIndex);
      })
    });

</script>
