
<template>
  <MainHeader theme="red" bgc="natural-1"></MainHeader>
  <!-- 主內容 -->
  <main class="whole-bg">
    <!-- top nav -->
    <memberNav/>
  
  <div class="petcardView">
        <div class="petcard-title">
            <h6 class="bold">寵物資訊卡</h6>
            <p>目前有2張資訊卡</p>
        </div>
    
        <div class="divider"></div>
    
        <!-- view -->
        <div class="petcard-container">
            <!-- card1 -->
            <div class="petcard pc1">
              <div class="cardWrap">
                <!-- v-for -->
                <!-- 卡片部分 -->
                <div class="cardwrapper">
                  <!-- 左側圖片區 -->
                  <div class="imageContainer">
                      <img src="@/assets/img/home/matchCard.svg" alt="">
                      <!-- <img :src="avatar.img" alt="avatar"> -->
                  </div>
                  <!-- 右側內容區 -->
                  <div class="content">
                      <div class="topSection">
                      <div class="number">01</div>
                      </div>
                      <!-- 名稱與距離 -->
                      <div class="info">
                          <h4 class="name">COCO</h4>
                          <div class="distance">
                          <div class="smallText distanceIcon"></div>
                          距離你6公里
                          </div>
                      </div>
                      <!-- 標籤區 -->
                      <div class="tags">
                        <!-- v-for? -->
                      <span class="xsText tag">邊境牧羊</span>
                      <span class="xsText tag">活潑外向</span>
                      <span class="xsText tag">愛玩球</span>
                      <span class="xsText tag">台北市</span>
                      <span class="xsText tag">松山區</span>
                      <span class="xsText tag">大型犬</span>
                      <span class="xsText tag">已結紮</span>
                      </div>
                      <!-- 內文 -->
                      <p class="description bold">
                        汪!你好我是COCO，雖然叫做COCO，但其實最愛麻古，純鮮奶茶大推，阿然後，珍珠就是要像狗糧一樣嘎蹦脆才好吃啊!
                      </p>
                  </div>
                </div>
              </div>
              <div class="ptc-btn-group">
                <Btn btnStyle="primary default" @click="toggleLightBox_editDog">編輯</Btn>
                <div class="btn-group">
                  <Btn btnStyle="baseline small" @click="togglePopUp_deleteCard">刪除卡片</Btn>
                  <Btn btnStyle="baseline small" @click="toggleLightBox_match">配對喜好設定</Btn>
                </div>
              </div>
            </div>
              <!-- card2 -->
            <div class="petcard pc2">
              <div class="cardWrap">
                <!-- 卡片部分，v-module>編輯彈窗的輸入內容 -->
                <div class="cardwrapper">
                  <!-- 左側圖片區 -->
                  <div class="imageContainer">
                      <img src="@/assets/img/home/matchCard.svg" alt="">
                  </div>
                  <!-- 右側內容區 -->
                  <div class="content">
                      <div class="topSection">
                      <div class="number">01</div>
                      </div>
                      <!-- 名稱與距離 -->
                      <div class="info">
                          <h4 class="name">COCO</h4>
                          <div class="distance">
                          <div class="smallText distanceIcon"></div>
                          距離你6公里
                          </div>
                      </div>
                      <!-- 標籤區 -->
                      <div class="tags">
                      <span class="xsText tag">邊境牧羊</span>
                      <span class="xsText tag">活潑外向</span>
                      <span class="xsText tag">愛玩球</span>
                      <span class="xsText tag">台北市</span>
                      <span class="xsText tag">松山區</span>
                      <span class="xsText tag">大型犬</span>
                      <span class="xsText tag">已結紮</span>
                      </div>
                      <!-- 內文 -->
                      <p class="description bold" >
                        汪!汪汪汪汪汪汪!汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪!
                      </p>
                  </div>
                </div>
              </div>
              <div class="ptc-btn-group">
                <Btn btnStyle="primary default" @click="toggleLightBox_editDog">編輯</Btn>
                <div class="btn-group">
                  <Btn btnStyle="baseline small" @click="togglePopUp_deleteCard">刪除卡片</Btn>
                  <Btn btnStyle="baseline small" @click="toggleLightBox_match">配對喜好設定</Btn>
                </div>
              </div>
            </div>
              <!-- card3 -->
            <div class="petcard addpc" id="addPetCard">
              <div class="" id="addPetCardBtn">
                <Btn btnStyle="baseline small" @click="toggleLightBox_editDog">+ 狗狗資訊卡</Btn>
                <Btn btnStyle="baseline small" @click="toggleLightBox_editCat">+ 貓貓資訊卡</Btn>
              </div>
            </div>           
        </div>
    
  </div>
  
      <!-- LightBox，編輯卡片 : 兩: 貓&狗-->
       <!-- 狗 -->
      <LightBox 
      :title="lightTitle_editDog.title"
      :is-light-box="lightTitle_editDog.isLightBox.value" 
      @toggle="toggleLightBox_editDog">
  
        <div class="infoContainer">
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
                                  <InputText placeHolder="斯普拉特" size = "small" errorMsg="Invalid Input" 
                                  v-model="inputValue" :hasError="inputError"></InputText>
                              </div>
                          </div>
                      </div>
                      <div class="fieldWrapper">
                          <div class="field">
                              <label>性別*</label>
                              <div class="tags">
                                  <span class="smallText tag">男生</span>
                                  <span class="smallText tag">女生</span>
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
                              <InputText class="textBox" placeHolder="請於80字內" errorMsg="Invalid Input" 
                              v-model="inputValue" :hasError="inputError"></InputText>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="saveBtnBox">
            <Btn btnStyle="primary default">儲存</Btn> 
            <Btn class="borderBottom" btnStyle="baseline default" @click="toggleLightBox_editDog">取消編輯</Btn>
        </div> 
  
      </LightBox>
       <!-- 貓 -->
      <LightBox 
      :title="lightTitle_editCat.title"
      :is-light-box="lightTitle_editCat.isLightBox.value" 
      @toggle="toggleLightBox_editCat">
    
        <div class="infoContainer">
        <!-- 貓貓資訊卡標題 -->
  
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
                                  <span class="smallText tag">女生</span>
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
                              <InputText class="textBox" textAlign="left" placeHolder="請於80字內" errorMsg="Invalid Input" 
                              v-model="inputValue" :hasError="inputError"></InputText>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="saveBtnBox">
            <Btn btnStyle="primary default">儲存</Btn> 
            <Btn class="borderBottom" btnStyle="baseline default" @click="toggleLightBox_editCat">取消編輯</Btn>
        </div> 
  
      </LightBox>
  
      <!-- LightBox，配對喜好調整 -->
      <LightBox 
        :title="lightTitle_matchReset.title"
        :is-light-box="lightTitle_matchReset.isLightBox.value" 
        @toggle="toggleLightBox_match"
        id="matchAdjustPop" 
        class="matchAdjust-wrapper">
  
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
  
      <!-- PopUp，刪除卡片 -->
      <PopUp
      :is-pop-up="deleteCard.isPopUp.value"
      @toggle="togglePopUp_deleteCard"
      id="deletePetcardPop">
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
  
  
  
    <!-- circle bg -->
    <div class="member-circle"></div>
  
  </main>
  
  </template>
  
  <script setup>
  
  import { ref,computed,reactive,defineProps } from 'vue';
  // components
  import MainHeader from '@/components/MainHeader.vue';
  import Btn from '@/components/Btn.vue';
  import DropdownMenu from '@/components/DropdownMenu.vue';
  import InputText from '@/components/InputText.vue';
  import LightBox from '@/components/LightBox.vue';
  import PopUp from "@/components/popUp.vue";
  // pages
  import memberNav from '../views/memberNav.vue' ;
  // import petInfoCardView from '../views/petInfoCardView.vue' ;
  
  // dropDown
  const menu1 = {
      placeHolder: '請選擇月份',
      options: [
          {
              id: 0,
              name: '1'
          },
          {
              id: 1,
              name: '2'
          },
          {
              id: 2,
              name: '3'
          },
          {
              id: 3,
              name: '4'
          },
          {
              id: 4,
              name: '5'
          },
          {
              id: 5,
              name: '6'
          },
          {
              id: 6,
              name: '7'
          },
          {
              id: 7,
              name: '8'
          },
          {
              id: 8,
              name: '9'
          },
          {
              id: 9,
              name: '10'
          },
          {
              id: 10,
              name: '11'
          },
          {
              id: 11,
              name: '12'
          },
      ]
  };
  
  const menu2 = {
      placeHolder: '請選擇日期',
      options: [
          {
              id: 0,
              name: '選項1'
          },
          {
              id: 1,
              name: '選項2'
          },
          {
              id: 2,
              name: '選項3'
          },
          {
              id: 3,
              name: '選項4'
          },
      ]
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
  // input
   // basic name 姓名
  const input1 = {
      size: 'small',
      textAlign: 'textLeft',
      placeHolder: '這裡填預設文字',
      errorMsg: 'Invalid Input',
      inputValue: ref(''),
      inputError: ref(false),
  }
  const input3 = {
      size: 'small',
      textAlign: 'textLeft',
      placeHolder: '輸入新的信箱',
      errorMsg: 'Invalid Input',
      inputValue: ref(''),
      inputError: ref(false),
  };
  const input4 = {
      size: 'small',
      textAlign: 'textLeft',
      placeHolder: '輸入驗證碼',
      errorMsg: 'Invalid Input',
      inputValue: ref(''),
      inputError: ref(false),
  };
  const input5 = {
      size: 'small',
      textAlign: 'textLeft',
      placeHolder: '輸入驗證碼',
      errorMsg: 'Invalid Input',
      inputValue: ref(''),
      inputError: ref(false),
  };
  const input6 = {
      size: 'small',
      textAlign: 'textLeft',
      placeHolder: '輸入驗證碼',
      errorMsg: 'Invalid Input',
      inputValue: ref(''),
      inputError: ref(false),
  };
  
  // 調整喜好
   // 哪種朋友
  const tag_friend = {
    formChoice: singleChoice,
    options: ['貓貓朋友', '狗狗朋友', '不限'],
    selected: ref([]),
  };
  // 根據上一題的選項決定顯示: 貓貓朋友/狗狗朋友
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
    // fixed : 結紮了
  const tag_fixed = {    
    formChoice: singleChoice,
    options: ['已絕育', '未絕育', '不限'],
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

  // computed 取得陣列中的第一個值，方便比較
  const selectedOption = computed(() => {
    return tag_friend.selected.value.length ? tag_friend.selected.value[0] : null;
  });

  // lightBox title
  const lightTitle_editDog = {title: "狗狗資訊卡", isLightBox: ref(false)};
  const lightTitle_editCat = {title: "貓貓資訊卡", isLightBox: ref(false)};
  const lightTitle_matchReset = {title: "配對喜好設定", isLightBox: ref(false)};
  
  // 控制燈箱的顯示與隱藏
   // 編輯卡片
     // 狗
  function toggleLightBox_editDog() {  
    lightTitle_editDog.isLightBox.value = !lightTitle_editDog.isLightBox.value;
    // 根據狀態新增或移除 clicked 類別
    if (lightTitle_editDog.isLightBox.value) {
      document.body.classList.add('clicked');
    } else {
      document.body.classList.remove('clicked');
    }
  };
     // 貓
  function toggleLightBox_editCat() {  
    lightTitle_editCat.isLightBox.value = !lightTitle_editCat.isLightBox.value;
    if (lightTitle_editCat.isLightBox.value) {
      document.body.classList.add('clicked');
    } else {
      document.body.classList.remove('clicked');
    }
  };
   // 配對喜好設定 
  function toggleLightBox_match() {
    lightTitle_matchReset.isLightBox.value = !lightTitle_matchReset.isLightBox.value;
    if (lightTitle_matchReset.isLightBox.value) {
      document.body.classList.add('clicked');
    } else {
      document.body.classList.remove('clicked');
    }
  };
  
  
  //popup狀態
  const deleteCard = { isPopUp : ref (false )  };
  
  // 刪除資訊卡
  // 控制燈箱的顯示與隱藏
  function togglePopUp_deleteCard() {
    deleteCard.isPopUp.value = !deleteCard.isPopUp.value;
    // // 停止捲軸
    if (deleteCard.isPopUp.value) {
      document.body.classList.add('clicked');
    } else {
      document.body.classList.remove('clicked');
    }
  };
  
  </script>