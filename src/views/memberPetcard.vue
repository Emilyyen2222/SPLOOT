
<template>
  <MainHeader theme="red" bgc="natural-1"></MainHeader>
  <!-- 主內容 -->
  <main class="whole-bg">
    <!-- top nav -->
    <memberNav/>
  
  <div class="petcardView">
        <div class="petcard-title">
            <div class="title-container">
                <h6 class="bold">寵物資訊卡</h6>
                <p>目前有 {{ petCardCount }} 張資訊卡</p>
            </div>
            <Btn btnStyle="baseline small" @click="toggleLightBox_match">配對喜好設定</Btn>
        </div>
    
        <div class="divider"></div>
    
        <!-- view -->
        <div class="petcard-container">
            <!-- card1~n -->
            <!-- v-for : 卡片與按鈕-->
            <div class="petcard" 
            v-for="plan in cardsData" :key="plan.label">
            <!-- 卡片區 -->
            <div class="matchbox">
            <div class="upperSection">
                <div class="cardWrapMatch">
                    <div class="cardwrapper" 
                        v-for="(plan, ownerIndex) in cardsData" :key="plan.owner" 
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
            </div>
        </div>
            <!-- 案扭區 -->
              <div class="ptc-btn-group">
                <Btn btnStyle="primary default" @click="toggleLightBoxPetInfo('dog')">編輯</Btn>
                <div class="btn-group">
                  <Btn btnStyle="baseline small" @click="togglePopUp_deleteCard">刪除卡片</Btn>
                </div>
              </div>
            </div>
            <!-- cardn+1 -->
            <div class="petcard addpc" id="addPetCard">
              <div class="" id="addPetCardBtn">
                <Btn btnStyle="baseline small" @click="toggleLightBoxPetInfo('dog')">+ 狗狗資訊卡</Btn>
                <Btn btnStyle="baseline small" @click="toggleLightBoxPetInfo('cat')">+ 貓貓資訊卡</Btn>
              </div>
            </div>           
        </div>
    
  </div>
  
      <!-- LightBox，編輯卡片 : 兩: 貓&狗-->
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
                            <!-- 如果有圖片的話才顯現 -->
                            <div class="uploadImgBox" v-if="hasUploadImg">
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
            <Btn btnType="form" btnStyle="nextQ" @click="toggleLightBoxPetInfo()">儲存</Btn>             
            <Btn class="borderBottom" btnType="form" btnStyle="lastQ">取消編輯</Btn>
        </div> 
      </LightBox>
  
      <!-- LightBox，配對喜好調整 -->
      <LightBox 
        :title="lightTitle_matchReset.title"
        :is-light-box="lightTitle_matchReset.isLightBox.value" 
        @toggle="toggleLightBox_match">
  
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
  
  // lightBox title
  const lightTitle_matchReset = {title: "配對喜好設定", isLightBox: ref(false)};

  // dropDown
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

  // 寵物資訊卡的卡片資料
  const matchedCard = ref([
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
                    { label: 'card4', name: 'Toby', imageSrc: new URL('../assets/img/match/dog4.avif', import.meta.url).href, number: '01', distance: 3, tags: ['邊境牧羊犬', '機警', '喜歡挑戰'], description: 'Toby 很機警，總能迅速應對各種挑戰，最愛玩各種智力遊戲。', gender: 'Male' },
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
                    { label: 'card5', name: 'Maya', imageSrc: new URL('../assets/img/match/dog4.avif', import.meta.url).href, number: '02', distance: 9, tags: ['拉布拉多', '活潑', '喜歡游泳'], description: 'Maya 是一隻喜歡游泳的拉布拉多，游泳時格外自在。', gender: 'Female' },
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
                    // { label: 'card5', name: 'Oscar', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 6, tags: ['法國鬥牛犬', '粘人', '喜歡睡覺'], description: 'Oscar 喜歡在主人旁邊黏著，特別愛睡覺。', gender: 'Male' },
                    // { label: 'card6', name: 'Rusty', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '03', distance: 5, tags: ['比格犬', '調皮', '愛追球'], description: 'Rusty 喜歡追著球跑，總是能讓周圍充滿活力！', gender: 'Male' }
                ],
                petShowing: 0
            },
            {
                owner: 'Lupe',
                pets: [
                    { label: 'card4', name: 'Toby', imageSrc: new URL('../assets/img/match/dog4.avif', import.meta.url).href, number: '01', distance: 3, tags: ['邊境牧羊犬', '機警', '喜歡挑戰'], description: 'Toby 很機警，總能迅速應對各種挑戰，最愛玩各種智力遊戲。', gender: 'Male' },
                    // { label: 'card4', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '01', distance: 8, tags: ['杜賓犬', '忠誠', '喜歡奔跑'], description: 'Rocky 是一隻忠誠的杜賓犬，愛與主人一起奔跑，是個很有活力的夥伴。', gender: 'Male' },
                    // { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male' },
                    // { label: 'card7', name: 'Zara', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '02', distance: 6, tags: ['臘腸犬', '堅毅', '喜歡挖洞'], description: 'Zara 喜歡在花園裡挖洞，是隻非常堅毅的小臘腸犬。', gender: 'Female' }
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
                    // { label: 'card5', name: 'Maya', imageSrc: new URL('../assets/img/match/dog4.avif', import.meta.url).href, number: '02', distance: 9, tags: ['拉布拉多', '活潑', '喜歡游泳'], description: 'Maya 是一隻喜歡游泳的拉布拉多，游泳時格外自在。', gender: 'Female' },
                    // { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male' }
                ],
                petShowing: 0
            },
            {
                owner: 'Olivia',
                pets: [
                    { label: 'card4', name: 'Zeus', imageSrc: new URL('../assets/img/match/dog3.avif', import.meta.url).href, number: '01', distance: 12, tags: ['大丹犬', '穩重', '喜歡散步'], description: 'Zeus 是一隻穩重的大丹犬，喜歡悠閒地散步，步伐穩定，極具威風。', gender: 'Male' },
                    // { label: 'card5', name: 'Buddy', imageSrc: new URL('../assets/img/match/dog2.avif', import.meta.url).href, number: '02', distance: 7, tags: ['柴犬', '堅韌', '喜歡獨處'], description: 'Buddy 是隻堅韌的柴犬，雖然愛獨處，但也會在主人需要時給予陪伴。', gender: 'Male' },
                    // { label: 'card5', name: 'Maya', imageSrc: new URL('../assets/img/match/dog5.avif', import.meta.url).href, number: '02', distance: 9, tags: ['拉布拉多', '活潑', '喜歡游泳'], description: 'Maya 是一隻喜歡游泳的拉布拉多，游泳時格外自在。', gender: 'Female' }
                ],
                petShowing: 0
            }
        ]);

    // member memberPetCardsData 會員中心的卡片資料
    const memberPetCardsData = ref([
        { label: 'card4', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '01', distance: 8, tags: ['杜賓犬', '忠誠', '喜歡奔跑'], description: 'Rocky 是一隻忠誠的杜賓犬，愛與主人一起奔跑，是個很有活力的夥伴。', gender: 'Male' },
        { label: 'card4', name: 'Luna', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 10, tags: ['哈士奇', '調皮', '喜歡雪地'], description: 'Luna 喜歡在雪地裡玩耍，性格調皮，總是喜歡捉弄其他狗狗。', gender: 'Female' },
        { label: 'card5', name: 'Milo', imageSrc: new URL('../assets/img/match/dog7.avif', import.meta.url).href, number: '02', distance: 5, tags: ['西施犬', '親和', '愛玩具'], description: 'Milo 是隻非常友善的小西施，對每個人都很親切，愛玩各種玩具。', gender: 'Male' }                
    ])

    // 計算資訊卡的卡片數量
    const petCardCount = computed(() => memberPetCardsData.length);
    // by Emily
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
  // 寵物資訊卡-貓&狗
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

    // computed 取得陣列中的第一個值，方便比較
    const selectedOption = computed(() => {
      return tag_friend.selected.value.length ? tag_friend.selected.value[0] : null;
    });

    //燈箱狀態-資訊卡
    const lightTitlePetInfo = ref({
        title: '狗狗資訊卡'
    });
    let isLightBoxPetInfo = ref(false);
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
  function togglePopUp_deleteCard() {
    deleteCard.isPopUp.value = !deleteCard.isPopUp.value;
    if (deleteCard.isPopUp.value) {
      document.body.classList.add('clicked');
    } else {
      document.body.classList.remove('clicked');
    }
  };
  // 刪除卡片
//   const cardsAfterDelete = ref(null)
//   const conFirmDeleteCard = () => {
//     if(petcards.length>0){
//         cardsAfterDelete = petcards.length -1;
//     }else{
//         alert("沒有卡片可以刪囉!")
//         return
//     }
//     togglePopUp_deleteCard();
//   };

  
  </script>