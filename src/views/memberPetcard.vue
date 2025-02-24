
<template>
  <!-- <MainHeader theme="red" bgc=""></MainHeader> -->
  <!-- 主內容 -->
  <main class="whole-bg">
    <!-- top nav -->
    <memberNav :avatar="memberPortraitChosed"/>
  
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
            v-for="(card, index) in memberPetCards" :key="index">
            <!-- 卡片區 -->
            <div class="matchbox">
            <div class="upperSection">
                <div class="cardWrapMatch">
                    <div class="cardwrapper">

                        <!-- 左側圖片區 -->
                        <div class="imageContainer">
                            <img src="../assets/img/match/dog5.avif" alt="petPicture">
                        </div>
                        <!-- 右側內容區 -->
                        <div class="content">
                            <div class="topSection">
                                <div class="dot">
                                    <div>
                                        <div class="dotActive"></div>
                                        <div class="dotInActive"></div>
                                        <div class="dotInActive"></div>
                                    </div>
                                </div>
                                <div class="number">{{ String(index+1).padStart(2,"0") }}</div>
                            </div>
                            <!-- 名稱與距離 -->
                            <div class="info">
                                <div class="nameAndGender">
                                <h4 class="bold name">{{ card.name }}</h4>
                                    <!-- gender icon -->
                                    <img v-if="card.gender == '女生'" src="../assets/img/icon/femaleIcon.svg" alt="Female Icon" style="width: 2rem;" />
                                    <img v-else-if="card.gender == 'Male'" src="../assets/img/icon/maleIcon.svg" alt="Male Icon" style="width: 2rem;" />
                                </div>
                                <!-- <div class="distance">
                                <div class="smallText distanceIcon"></div>
                                距離你{{ memberPetCard.distance }}公里
                                </div> -->
                            </div>
                            <!-- 標籤區 -->
                            <div class="tags">
                                <span class="xsText tag" v-for="tag in card.cardTags" :key="tag">{{ tag }}</span>
                            </div>
                            <!-- 內文 -->
                            <p class="description bold">{{ card.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- 案扭區 -->
              <div class="ptc-btn-group">
                <Btn v-if="card.pet == 'dog'" btnStyle="primary default" @click="toggleLightBoxPetInfo(card.pet,'edit', index)">編輯</Btn>
                <Btn v-else-if="card.pet == 'cat'" btnStyle="primary default" @click="toggleLightBoxPetInfo(card.pet,'edit', index)">編輯</Btn>
                <div class="btn-group">
                  <Btn btnStyle="baseline small" @click="togglePopUp_deleteCard()">刪除卡片</Btn>
                </div>
              </div>
            </div>
            <!-- cardn+1 -->
            <div class="petcard addpc" id="addPetCard">
              <div class="" id="addPetCardBtn">
                <Btn btnStyle="baseline small" @click="toggleLightBoxPetInfo('dog','create')">+ 狗狗資訊卡</Btn>
                <Btn btnStyle="baseline small" @click="toggleLightBoxPetInfo('cat','create')">+ 貓貓資訊卡</Btn>
              </div>
            </div>           
        </div>
    
  </div>
  
      <!-- LightBox，編輯卡片-->
      <LightBox 
        :title="lightTitlePetInfo.title"
        :is-light-box="isLightBoxPetInfo" 
        @toggle="toggleLightBoxPetInfo(selectedPetType,'edit')">
        <!-- 狗才用 -->
        <div class="infoContainer">
        <!-- 資訊卡內文 -->
            <div class="infoWrap">
                <!-- 毛孩姓名，性別，品種 -->
                <div class="wPhotoSec">
                    <div class="imgUpload" @click="callFileInput">
                        <div class="imgUploadSection">
                            <p class="smallText imgUploadText" v-if="!hasUploadImg">上傳主圖片*<br>建議1100x300px</p>
                            <!-- 如果有圖片的話才顯現 -->
                            <div class="uploadImgBox" v-if="hasUploadImg">
                                <img src="../assets/img/match/dog5.avif" alt="uploadImg" ref="uploadedImg">
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
                                    v-model="petName" :hasError="inputError"></InputText>
                                </div>
                            </div>
                        </div>
                        <div class="fieldWrapper">
                            <div class="field">
                                <label>性別*</label>
                                <div class="tags">
                                    <Btn v-for="option in genderTags.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(genderTags.selected, option)}"
                                    @click="genderTags.formChoice(genderTags.selected, option)">{{ option }}</Btn>
                                    <!-- <p>{{ genderTags.selected }}</p> -->
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
                                        :options="menus.menuDog.options"
                                        v-model="menus.menuDog.menuValue">
                                        </DropdownMenu>
                                        <!-- <p>{{ menus.menuDog.menuValue.value }}</p> -->
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
                                        :options="menus.year.options"
                                        v-model="menus.year.menuValue.value">
                                        </DropdownMenu>
                                    </div>
                                </div>
                                <div class="dropdownMenu">
                                    <div class="month">
                                        <DropdownMenu class="dropDown city"
                                        :placeHolder="menus.month.placeHolder"
                                        :options="menus.month.options"
                                        v-model="menus.month.menuValue.value">
                                        </DropdownMenu>
                                    </div>
                                </div>
                                <div class="dropdownMenu">
                                    <div class="date">
                                        <DropdownMenu class="dropDown city"
                                        :placeHolder="menus.day.placeHolder"
                                        :options="menus.day.options"
                                        v-model="menus.day.menuValue.value">
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
                                    <Btn v-for="option in dogSizeTags.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(dogSizeTags.selected, option)}"
                                    @click="dogSizeTags.formChoice(dogSizeTags.selected, option)">{{ option }}</Btn>
                                    <!-- <p>{{ petSizeTags.selected }}</p> -->
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
                                    <Btn v-for="option in petSocialTags.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(petSocialTags.selected, option)}"
                                    @click="petSocialTags.formChoice(petSocialTags.selected, option)">{{ option }}</Btn>
                                    <!-- <p>{{ petSocialTags.selected }}</p> -->
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
                                        <Btn v-for="option in dogHobbyTags.options" :key="option"
                                        btnType="tag" 
                                        :class="{'-active': optionSelected(dogHobbyTags.selected, option)}"
                                        @click="dogHobbyTags.formChoice(dogHobbyTags.selected, option)">{{ option }}</Btn>
                                        <!-- <p>{{ dogHobbyTags.selected }}</p> -->
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
                                <input type="radio" name="neuterStatus" class="nRadioBtn" id="neutered" v-model="selectedNeutered" value="neutered">已絕育
                                <input type="radio" name="neuterStatus" class="nRadioBtn" id="notNeutered" v-model="selectedNeutered" value="unneutered">未絕育
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
                                v-model="petDescription" :hasError="inputError"></InputText>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="saveBtnBox">            
                      
            <Btn btnType="form" btnStyle="nextQ" @click="toggleAndSaveCard()">儲存</Btn>                             
            
            <Btn class="borderBottom" btnType="form" btnStyle="lastQ" @click="toggleLightBoxPetInfo()">取消編輯</Btn>
        </div> 
      </LightBox>

      <!-- LightBox，新增卡片-->
      <LightBox 
        :title="lightTitlePetInfo.title"
        :is-light-box="isLightBoxPetInfo" 
        @toggle="toggleLightBoxPetInfo(selectedPetType,'create')">
        <!-- 狗才用 -->
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
                                    v-model="petName" :hasError="inputError"></InputText>
                                </div>
                            </div>
                        </div>
                        <div class="fieldWrapper">
                            <div class="field">
                                <label>性別*</label>
                                <div class="tags">
                                    <Btn v-for="option in genderTags.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(genderTags.selected, option)}"
                                    @click="genderTags.formChoice(genderTags.selected, option)">{{ option }}</Btn>
                                    <!-- <p>{{ genderTags.selected }}</p> -->
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
                                        :options="menus.menuDog.options"
                                        v-model="menus.menuDog.menuValue">
                                        </DropdownMenu>
                                        <!-- <p>{{ menus.menuDog.menuValue.value }}</p> -->
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
                                        :options="menus.year.options"
                                        v-model="menus.year.menuValue.value">
                                        </DropdownMenu>
                                    </div>
                                </div>
                                <div class="dropdownMenu">
                                    <div class="month">
                                        <DropdownMenu class="dropDown city"
                                        :placeHolder="menus.month.placeHolder"
                                        :options="menus.month.options"
                                        v-model="menus.month.menuValue.value">
                                        </DropdownMenu>
                                    </div>
                                </div>
                                <div class="dropdownMenu">
                                    <div class="date">
                                        <DropdownMenu class="dropDown city"
                                        :placeHolder="menus.day.placeHolder"
                                        :options="menus.day.options"
                                        v-model="menus.day.menuValue.value">
                                        </DropdownMenu> 
                                    </div>
                                </div>
                                <div class="tags">
                                    <div class="unknown">
                                        <Btn v-for="option in tag5.options" :key="option"
                                        btnType="tag" 
                                        :class="{'-active': optionSelected(tag5.selected, option)}"
                                        @click="tag5.formChoice(tag5.selected, option)">{{ option }}</Btn>
                                        <!-- <p>{{ tag5.selected }}</p> -->
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
                                    <Btn v-for="option in dogSizeTags.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(dogSizeTags.selected, option)}"
                                    @click="dogSizeTags.formChoice(dogSizeTags.selected, option)">{{ option }}</Btn>
                                    <!-- <p>{{ petSizeTags.selected }}</p> -->
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
                                    <Btn v-for="option in petSocialTags.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(petSocialTags.selected, option)}"
                                    @click="petSocialTags.formChoice(petSocialTags.selected, option)">{{ option }}</Btn>
                                    <!-- <p>{{ petSocialTags.selected }}</p> -->
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
                                        <Btn v-for="option in dogHobbyTags.options" :key="option"
                                        btnType="tag" 
                                        :class="{'-active': optionSelected(dogHobbyTags.selected, option)}"
                                        @click="dogHobbyTags.formChoice(dogHobbyTags.selected, option)">{{ option }}</Btn>
                                        <!-- <p>{{ dogHobbyTags.selected }}</p> -->
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
                                <input type="radio" name="neuterStatus" class="nRadioBtn" id="neutered" v-model="selectedNeutered" value="neutered">已絕育
                                <input type="radio" name="neuterStatus" class="nRadioBtn" id="notNeutered" v-model="selectedNeutered" value="unneutered">未絕育
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
                                v-model="petDescription" :hasError="inputError"></InputText>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 貓用 -->
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
                                    v-model="petName" :hasError="inputError"></InputText>
                                </div>
                            </div>
                        </div>
                        <div class="fieldWrapper">
                            <div class="field">
                                <label>性別*</label>
                                <div class="tags">
                                    <Btn v-for="option in genderTags.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(genderTags.selected, option)}"
                                    @click="genderTags.formChoice(genderTags.selected, option)">{{ option }}</Btn>
                                    <!-- <p>{{ genderTags.selected }}</p> -->
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
                                        :options="menus.menuCat.options"
                                        v-model="menus.menuCat.menuValue">
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
                                        :options="menus.year.options"
                                        v-model="menus.year.menuValue.value">
                                        </DropdownMenu>
                                    </div>
                                </div>
                                <div class="dropdownMenu">
                                    <div class="month">
                                        <DropdownMenu class="dropDown city"
                                        :placeHolder="menus.month.placeHolder"
                                        :options="menus.month.options"
                                        v-model="menus.month.menuValue.value">
                                        </DropdownMenu>
                                    </div>
                                </div>
                                <div class="dropdownMenu">
                                    <div class="date">
                                        <DropdownMenu class="dropDown city"
                                        :placeHolder="menus.day.placeHolder"
                                        :options="menus.day.options"
                                        v-model="menus.day.menuValue.value">
                                        </DropdownMenu> 
                                    </div>
                                </div>
                                <div class="tags">
                                    <div class="unknown">
                                        <Btn v-for="option in tag5.options" :key="option"
                                        btnType="tag" 
                                        :class="{'-active': optionSelected(tag5.selected, option)}"
                                        @click="tag5.formChoice(tag5.selected, option)">{{ option }}</Btn>
                                        <!-- <p>{{ tag5.selected }}</p> -->
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
                                    <Btn v-for="option in catSizeTags.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(catSizeTags.selected, option)}"
                                    @click="catSizeTags.formChoice(catSizeTags.selected, option)">{{ option }}</Btn>
                                    <!-- <p>{{ petSizeTags.selected }}</p> -->
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
                                    <Btn v-for="option in petSocialTags.options" :key="option"
                                    btnType="tag" 
                                    :class="{'-active': optionSelected(petSocialTags.selected, option)}"
                                    @click="petSocialTags.formChoice(petSocialTags.selected, option)">{{ option }}</Btn>
                                    <!-- <p>{{ petSocialTags.selected }}</p> -->
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
                                        <Btn v-for="option in catHobbyTags.options" :key="option"
                                        btnType="tag" 
                                        :class="{'-active': optionSelected(catHobbyTags.selected, option)}"
                                        @click="catHobbyTags.formChoice(catHobbyTags.selected, option)">{{ option }}</Btn>
                                        <!-- <p>{{ petHobbyTags.selected }}</p> -->
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
                                <input type="radio" name="neuterStatus" class="nRadioBtn" id="neutered" v-model="selectedNeutered">已絕育
                                <input type="radio" name="neuterStatus" class="nRadioBtn" id="notNeutered" v-model="selectedNeutered">未絕育
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
                                v-model="petDescription" :hasError="inputError"></InputText>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="saveBtnBox">            
                      
            <Btn btnType="form" btnStyle="nextQ" @click="toggleAndSaveCard()">儲存</Btn>                             
            
            <Btn class="borderBottom" btnType="form" btnStyle="lastQ" @click="toggleLightBoxPetInfo()">取消編輯</Btn>
        </div> 
      </LightBox>
  
      <!-- LightBox，配對喜好調整 -->
      <!-- <LightBox 
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
      </LightBox> -->
  
      <!-- PopUp，刪除卡片 -->
      <PopUp
      :is-pop-up="deleteCard.isPopUp.value">
      <div class="delete-petcard">
        <div class="title">
          <p class="bold">確定刪除資訊卡?</p>
        </div>
        <div class="btn-group">
          <Btn btnStyle="primary small" @click="toggleAndDeleteCard()">確定</Btn>
          <Btn btnStyle="baseline small" @click="togglePopUp_deleteCard()">取消</Btn>
        </div>
      </div>
      </PopUp>   
  
    <!-- circle bg -->
    <div class="member-circle"></div>
  
  </main>
  
  </template>
  
  <script setup>
  
  import { ref,computed, onBeforeMount } from 'vue';
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

  // v-model
  const petId = ref('')
  const petName = ref('')
  const petDescription = ref('')
  const selectedNeutered = ref('')

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
        menuValue: ref([])
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
        menuValue: ref([])
    },
    year: {
        placeHolder: '年份',
        options: Array.from({ length: 2025 - 2005 + 1 }, (_, i) => ({
        id: i,
        name: `${2025 - i} 年`,
        })),
        menuValue: ref('')
    },
    month: {
        placeHolder: '月份',
        options: Array.from({ length: 12 }, (_, i) => ({
        id: i + 1,
        name: `${i + 1} 月`,
        })),
        menuValue: ref('')
    },
    day: {
        placeHolder: '日期',
        options: Array.from({ length: 31 }, (_, i) => ({
        id: i + 1,
        name: `${i + 1} 日`,
        })),
        menuValue: ref('')
    },
    };
    // 組合生日
    const birthDate= computed(()=>{      
      if (!menus || !menus.year || !menus.month || !menus.day) {
        console.warn("menus 或其屬性未初始化，返回 '未填寫'");
        return "未填寫"; 
    }

        const year = menus.year.menuValue?.value ? menus.year.menuValue.value.replace(" 年", ""):"";  
        const month = menus.month.menuValue?.value ? menus.month.menuValue.value.replace(" 月", "") : ""; 
        const day = menus.day.menuValue?.value ? menus.day.menuValue.value.replace(" 日", "") : ""; 
        if(year && month && day){
          return `${year}-${String(month).padStart(2,"0")}-${String(day).padStart(2,"0")}`
        };

        return "未填寫";
    });
    
  // 會員中心的 寵物資訊卡的 卡片資料
    const memberPetCards = ref([]);
    // const memberPetCards = ref([
    //     { label: '1', name: 'Rocky', imageSrc: new URL('../assets/img/match/dog6.avif', import.meta.url).href, number: '01', distance: 8, tags: ['杜賓犬', '忠誠', '喜歡奔跑'], description: 'Rocky 是一隻忠誠的杜賓犬，愛與主人一起奔跑，是個很有活力的夥伴。', gender: 'Male' },
    //     { label: '2', name: 'Luna', imageSrc: new URL('../assets/img/match/dog1.avif', import.meta.url).href, number: '01', distance: 10, tags: ['哈士奇', '調皮', '喜歡雪地'], description: 'Luna 喜歡在雪地裡玩耍，性格調皮，總是喜歡捉弄其他狗狗。', gender: 'Female' },
    //     { label: '3', name: 'Milo', imageSrc: new URL('../assets/img/match/dog7.avif', import.meta.url).href, number: '02', distance: 5, tags: ['西施犬', '親和', '愛玩具'], description: 'Milo 是隻非常友善的小西施，對每個人都很親切，愛玩各種玩具。', gender: 'Male' }
    // ])
    // 計算資訊卡的卡片數量
    const petCardCount = computed(() => memberPetCards.value.length);
    // by Emily
    

    //格式化數字
    // const dottedNumber = computed(() => {
    //     return (clickedIndex.value + 1).toString().padStart(2, '0'); //index+1並轉換為兩位數字, 前面加上0
    // });

      
  // 調整喜好
   // 哪種朋友
  const tag_friend = ref({
    formChoice: singleChoice,
    options: ['貓貓朋友', '狗狗朋友', '不限'],
    selected: [],
  });
  // 根據上一題的選項決定顯示: 貓貓朋友/狗狗朋友
   // 貓貓朋友
  const tag_cat = ref({
    formChoice: singleChoice,
    options: ['幼貓', '成貓', '品種貓','不限'],
    selected: [],
  });
   //  狗狗朋友
  const tag_dog = ref({
    formChoice: singleChoice,
    options: ['小型犬','中型犬', '大型犬', '不限'],
    selected: [],
  });
   //  社交性
  const tag_social = ref({
    formChoice: singleChoice,
    options: ['親貓親狗', '親近同類 親人', '不親近同類 親人', '不限'],
    selected: [],
  });
   // 絕育狀態
    // fixed : 結紮了
  const tag_fixed = ref({    
    formChoice: singleChoice,
    options: ['已絕育', '未絕育', '不限'],
    selected: [],
  });
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
    const genderTags = ref({
    formChoice: singleChoice,
    options: ['男生', '女生', '未知'],
    selected: [],
    });
    const dogSizeTags = ref({
    formChoice: singleChoice,
    options: ['小型犬10公斤以下', '中型犬11-25公斤', '大型犬26公斤以上'],
    selected: [],
    });
    const catSizeTags = ref({
    formChoice: singleChoice,
    options: ['成貓', '幼貓', '品種貓'],
    selected: [],
    });
    const petSocialTags = ref({
    formChoice: multipleChoice,
    options: ['親寵親人', '不親寵親人', '親寵不親人', '慢熟', '小孩友善'],
    selected: [],
    });
    const dogHobbyTags = ref({
    formChoice: multipleChoice,
    options: ['喜歡散步', '喜歡玩球', '喜歡玩飛盤', '熱愛玩水', '喜歡跳舞', '熱衷學習指令'],
    selected: [],
    });
    const tag5 = ref({
    formChoice: multipleChoice,
    options: ['未知'],
    selected: [],
    });
    const catHobbyTags = ref({
    formChoice: multipleChoice,
    options: ['喜歡玩蟑螂', '喜歡嗑貓草', '喜歡逗貓棒', '熱愛貓抓板', '喜歡採鍵盤', '喜歡空紙箱'],
    selected: [],
    });
    // 單選
    function singleChoice(selected, option) {
      selected.splice(0, 1);
      selected[0] = option;
    }
    function multipleChoice(selected, option) {
        if (optionSelected(selected, option)) {
            selected = selected.filter(opt => opt !== option);
        } else {
            selected.push(option);
        }
    }
    const optionSelected = (selected, option) => {
        return selected.includes(option);
    }

    // computed 取得陣列中的第一個值，方便比較
    const selectedOption = computed(() => {
      return tag_friend.value.selected.length ? tag_friend.selected.value[0] : null;
    });

    //燈箱狀態-資訊卡
    const lightTitlePetInfo = ref({
        title: ''
    });
    let isLightBoxPetInfo = ref(false);
    // 狗狗貓貓資訊卡切換
    const selectedPetType = ref('');
    const selectedGoal = ref('');

    // 狗狗資訊卡
    // 控制燈箱的顯示與隱藏
    function toggleLightBoxPetInfo(petType,goal, petIndex = -1) {
      petName.value = '';
      genderTags.value.selected = [];
      menus.menuDog.menuValue = [];
      menus.menuCat.menuValue = [];

      if(petIndex != -1 && goal == 'edit'){
        let currentPet = memberPetCards.value[petIndex];
        selectedPetType.value = currentPet.pet;
        petName.value = currentPet.name;
        genderTags.value.selected.push(currentPet.gender);
        tag5.value.selected.push(currentPet.tags);
        menus.menuDog.menuValue.push(currentPet.breed);
        menus.menuCat.menuValue.push(currentPet.breed);
        dogSizeTags.value.selected.push(currentPet.size);
        catSizeTags.value.selected.push(currentPet.size);
        // birthDate
        selectedNeutered.value = currentPet.neutured;
        petDescription.value = currentPet.description;
        hasUploadImg.value = currentPet.petHobby;
        
      }
        isLightBoxPetInfo.value = !isLightBoxPetInfo.value;
        if (petType) {
            selectedPetType.value = petType; 
            console.log(petType)
        }
        if(goal){
          selectedGoal.value = goal;
        }
        // 根據goal 決定打開 "新增" 還是 "編輯"
        if (goal == 'create' && petType == 'dog') {
            lightTitlePetInfo.value.title = '新增狗狗資訊卡';
            return lightTitlePetInfo.value.title;
        } else if (goal == 'edit' && petType == 'dog') {
            lightTitlePetInfo.value.title = '編輯狗狗資訊卡';
            return lightTitlePetInfo.value.title;
        }else if (goal == 'create' && petType == 'cat') {
            lightTitlePetInfo.value.title = '新增貓貓資訊卡';
            return lightTitlePetInfo.value.title;
        } else if (goal == 'edit' && petType == 'cat') {
            lightTitlePetInfo.value.title = '編輯貓貓資訊卡';
            return lightTitlePetInfo.value.title;
        }
        // 根據狀態新增或移除 clicked 類別
        if (isLightBoxPetInfo.value) {
            document.body.classList.add('clicked');
        } else {
            document.body.classList.remove('clicked');
        }
    }
    // 編輯>儲存
    function toggleAndSaveCard(){
      if(selectedGoal.value === 'create'){
        if(selectedPetType.value === 'dog'){
          createPetCardPhp('dog');
          alert('新增成功!');
          
        }else if (selectedPetType.value === 'cat'){
          createPetCardPhp('cat');
          alert('新增成功!');
        }
      }else if(selectedGoal.value === 'edit'){
        if(selectedPetType.value === 'dog'){
          updatePetCardPhp('dog');
          alert('更改成功!');
        }else if (selectedPetType.value === 'cat'){
          updatePetCardPhp('cat');
          alert('更改成功!');
        }
      }
      toggleLightBoxPetInfo()
    }
    
    // // 刪除>儲存
    // function toggleAndDeleteCard(petId){
    //     deletePetCardPhp(petId);
    //     togglePopUp_deleteCard();
    // }

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


// ajax
let breedMenu;
let hobbyTags;
let sizeTags;
    async function createPetCardPhp(pet){
      if(pet == 'dog'){
        breedMenu = menus.menuDog;
        hobbyTags = dogHobbyTags; 
        sizeTags = dogSizeTags;     
      }else if(pet == 'cat'){
        breedMenu = menus.menuCat;
        hobbyTags = catHobbyTags;
        sizeTags = catSizeTags;
      }
        console.log("送出前的`v-model`們:",{
            pet: selectedPetType.value,
            name: petName.value,
            gender: genderTags.value.selected[0],
            breed: breedMenu.menuValue,
            birthDate: birthDate.value,
            size: sizeTags.value.selected[0],
            neutured: selectedNeutered.value,
            description: petDescription.value,
            petImg: hasUploadImg.value,
            petHobby: hobbyTags.value.selected,
            petSocial: petSocialTags.value.selected
        });

        const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/createPetCard.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              pet: selectedPetType.value,
              name: petName.value,
              gender: genderTags.value.selected[0],
              breed: breedMenu.menuValue,
              birthDate: birthDate.value,
              size: sizeTags.value.selected[0],
              neutured: selectedNeutered.value,
              description: petDescription.value,
              petImg: hasUploadImg.value,
              petHobby: hobbyTags.value.selected,
              petSocial: petSocialTags.value.selected
            })
        });

        try{
            const petCardResp = await resp.json();
            if(petCardResp.status == 'success'){
                
            }else if(petCardResp.status == 'error'){
                console.log(petCardResp.message);
            }
        }catch(error){
            console.error('Error parsing JSON:', error);
        }
    };

    // async function updatePetCardPhp(petId, updater = 'System'){
    //     const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/updatePetCard.php`, {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //         },
    //         body: JSON.stringify({
    //             // petId.value: petId,
    //             // pet: selectedPetType.value,
    //             // name: petName,
    //             // gender: genderTags.value.selected,
    //             // breed: breedMenu.value.tags,
    //             // birthDate: birthDate.value,
    //             // size: sizeTags.value.selected,
    //             // neutured: selectedNeutered,
    //             // description: petDescription,
    //             // petImg: hasUploadImg.value,
    //             // petHobby: petHobbyTags.value.selected,
    //             // petSocial: tag_social.value.selected,
    //             // updater: updater
    //         })
    //         // body: JSON.stringify({
    //         //     petId: petId,
    //         //     pet: '狗狗',
    //         //     name: 'CoCo',
    //         //     gender: '男',
    //         //     breed: '柴犬',
    //         //     birthDate: '2025-02-02',
    //         //     size: '中型犬',
    //         //     neutured: '已絕育',
    //         //     description: '描述',
    //         //     petImg: hasUploadImg.value,
    //         //     petHobby: ['興趣', '興趣'],
    //         //     petSocial: ['社交', '社交'],
    //         //     updater: updater
    //         // })
    //     });

    //     try{
    //         const petCardResp = await resp.json();
    //         if(petCardResp.status == 'success'){
                
    //         }else if(petCardResp.status == 'error'){
    //             console.log(petCardResp.message);
    //         }
    //     }catch(error){
    //         console.error('Error parsing JSON:', error);
    //     }
    // };
    // updatePetCardPhp(3);

    async function findAllPetCardsPhp(){
        const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/findAllPetCards.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        });

        try{
          const petCardResp = await resp.json();
            if(petCardResp.status == 'success'){
                const petCards = petCardResp['data'];
                for(let pet of petCards){
                  // if(pet['pet'] == 'dog'){
                    //   breedMenu = menus.menuDog;
                    //   hobbyTags = dogHobbyTags; 
                    //   sizeTags = dogSizeTags;
                    // }else if(pet['pet'] == 'cat'){
                      //   breedMenu = menus.menuCat;
                      //   hobbyTags = catHobbyTags; 
                      //   sizeTags = catSizeTags;
                      // }
                    pet['cardTags'] = pet['petHobby'];
                    pet['cardTags'].unshift(pet['breed']);
                    // memberPetCards.value.push(pet);


                    // petId.value = pet['petId'];
                    // console.log(petId);
                    // selectedPetType.value = pet['pet'];
                    // petName.value = pet['name'];
                    // genderTags.value.selected = pet['gender'];
                    // breedMenu.menuValue = pet['breed'];
                    // birthDate.value = pet['birthDate'];                    
                    // selectedNeutered.value = pet['neutured'];
                    // petDescription.value = pet['description'];
                    // tag_social.value.selected = pet['petSocial']

                    
                    // 圖片從缺
                }
                memberPetCards.value = petCards;
                console.log('1', memberPetCards.value);
            }else if(petCardResp.status == 'error'){
                console.log(petCardResp.message);
            }
        }catch(error){
            console.error('Error parsing JSON:', error);
        }
    }

    // async function deletePetCardPhp(petId, updater = 'System'){
    //     const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/deletePetCard.php`, {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //         },
    //         body: JSON.stringify({
    //             petId: petId,
    //             updater: updater
    //         }),
    //     });

    //     try{
    //         const petDeleted = await resp.json();
    //         if(petDeleted.status == 'success'){
    //             console.log(petDeleted);
    //         }else if(petDeleted.status == 'error'){
    //             console.log(petDeleted.message);
    //         }
    //     }catch(error){
    //         console.error('Error parsing JSON:', error);
    //     }
    // }

    onBeforeMount(() => {
      findAllPetCardsPhp();
    })
    // deletePetCardPhp(1);
  </script>