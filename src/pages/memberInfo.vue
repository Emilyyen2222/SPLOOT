
<template>
<MainHeader theme="red" bgc="natural-1"></MainHeader>
<!-- 主內容 -->
<main class="whole-bg">
  <!-- top nav -->
  <memberNav/>

  <div class="memberInfo"> 
      <div class="title2">
          <h6 class="bold">會員資料</h6>
          <div class="btn-wr">
            <!-- 打開編輯會員資料的LightBox -->
            <Btn btnStyle="baseline small" id="memberInfoEdit" @click="toggleLightBox_memberInfo">編輯</Btn>
          </div>
      </div>
  
      <div class="divider"></div>
  
      <div class="cards-container">
          <!-- basic info & account -->
          <div class="top2-cards">
            <!-- card 1 -->
            <div class="card card-basicInfo" id="basicInfo">
  
                <div class="card-title">
                  <p class="bold">基本資料</p>
                </div>
  
                <div class="divider"></div>
                
                <!-- card content -->
                <div class="card-content">
  
                  <div class="bi-inbox">
                    <div>姓名</div><div>派大星</div>
                  </div>
                  <div class="bi-inbox">
                    <div>暱稱</div><div>斯普拉特</div>
                  </div>
                  <div class="bi-inbox">
                    <div>性別</div><div>女</div>
                  </div>
                  <div class="bi-inbox">
                    <div>生日</div><div>2019.12.12</div>
                  </div>
                    
                  
                </div>
            </div>
            <!-- card 2 -->
            <div class="card card-account" id="">
  
                <div class="card-title">
                  <p class="bold">帳戶</p>
                </div>
  
                <div class="divider"></div>
                  <!-- card content -->
                <div class="card-content">
  
                  <div class="bi-inbox">
                    <div>信箱</div><div>abc123@gmail.com</div>
                  </div>
                  <div class="bi-inbox">
                    <div>密碼</div><div>******</div>
                  </div>
                  
                </div>
            </div>
          </div>
          <!-- card 3 -->
          <div class="card card-contact" id="">
  
            <div class="card-title">
                <p class="bold">聯絡資訊</p>
            </div>
  
            <div class="divider"></div>
            <!-- card content -->
            <div class="card-content">
  
                  <div class="bi-inbox">
                    <div class="setWid">手機</div><div>0912 345 678</div>
                  </div>
                  <div class="bi-inbox">
                    <div class="setWid">聯絡地址</div><div>104台北市中山區南京東路三段219號4F 104台北市中山區南京東路三段219號4F</div>
                  </div>
                  <div class="bi-inbox">
                    <div class="setWid">LineID</div><div>qwert012</div>
                  </div>
  
            </div>
          </div>
          <!-- 隱私權政策 -->
          <div class="privacy">
            <Btn btnStyle="text small">隱私權政策</Btn>
            <Btn btnStyle="text small">使用者同意書</Btn>
          </div>
  
      </div>
  
      <!-- 會員資料的彈窗，memberInfo update, popup -->
      <div class="memberInfo-update">
          <!-- 用 Routerlink -->
          
          <LightBox 
            :title="lightTitle1.title"
            :is-light-box="lightTitle1.isLightBox.value" 
            @toggle="toggleLightBox_memberInfo"
            pY="5.6rem" 
            pX="5.6rem"
            bgc="transparent:50%"
            id="memberInfoPop" 
            class="memberInfo-update">
            <div class="pb-container">
  
              <h6 class="bold">會員資料</h6>
              <!-- 頭像 -->
                <div class="card avatars">
    
                <div class="bold card-title">
                  <p class="bold">頭像</p>
                </div>
    
                <div class="divider"></div>
    
                  <div class="card-content">   <!-- 之後用v-for，產6個 -->            
                    <div class="av-group">
                        <div class="avatar">           <!-- 頭相框 -->
                        <img src="" alt="avatar">      <!-- 放頭像用 -->
                        </div>
                        <smallText>小白</smallText>
                    </div>
                    <div class="av-group">
                        <div class="avatar">           <!-- 頭相框 -->
                        <img src="" alt="avatar">      <!-- 放頭像用 -->
                        </div>
                        <smallText>小白</smallText>
                    </div>
                    <div class="av-group">
                        <div class="avatar">           <!-- 頭相框 -->
                        <img src="" alt="avatar">      <!-- 放頭像用 -->
                        </div>
                        <smallText>小白</smallText>
                    </div>
                    <div class="av-group">
                        <div class="avatar">           <!-- 頭相框 -->
                        <img src="" alt="avatar">      <!-- 放頭像用 -->
                        </div>
                        <smallText>小白</smallText>
                    </div>
                    <div class="av-group">
                        <div class="avatar">           <!-- 頭相框 -->
                        <img src="" alt="avatar">      <!-- 放頭像用 -->
                        </div>
                        <smallText>小白</smallText>
                    </div>
                    <div class="av-group">
                        <div class="avatar">           <!-- 頭相框 -->
                        <img src="" alt="avatar">      <!-- 放頭像用 -->
                        </div>
                        <smallText>小白</smallText>
                    </div>
    
                  </div>
    
                </div>
    
              <!-- 基本資料 -->
              <div class="card basicInfo">
    
                  <div class="card-title">
                    <p class="bold">基本資料</p>
                  </div>
    
                  <div class="divider"></div>
    
                  <div class="card-content">
                    <div class="input-group">
                        <label for="name">姓名</label>
                        <InputText
                            :size="input1.size"
                            :textAlign="input1.textAlign"
                            :placeHolder="input1.placeHolder"
                            :errorMsg="input1.errorMsg"
                            :hasError="input1.inputError.value"
                            v-model="input1.inputValue.value">
                        </InputText>
                    </div>
                    <div class="input-group">
                        <label for="nickname">暱稱</label>
                        <InputText 
                          :size="input1.size"
                          :textAlign="input1.textAlign"
                          :placeHolder="input1.placeHolder"
                          :errorMsg="input1.errorMsg"
                          :hasError="input1.inputError.value"
                          v-model="input1.inputValue.value">
                        </InputText>
                    </div>
                    <div class="input-group" id="sexGroup">
                      <label for="sex">性別</label>
                      <div class="sex" id="sex">
                        <label for="male">
                            <input type="radio" class="" name="sex" value="男" id="male" style="color : #D14535; ">男
                        </label>
                        <label for="female">
                            <input type="radio" class="" name="sex" value="女" id="female" style="color : #D14535; ">女
                        </label>
                      </div>
                    </div>
                    <div class="input-group">
                        <label for="birthday">生日</label>
                        <div class="select-group">
                          <DropdownMenu
                          :placeHolder="menu1.placeHolder" 
                          :options="menu1.options"
                          class="dropBirthday">
                          </DropdownMenu>
                          <DropdownMenu
                          :placeHolder="menu2.placeHolder" 
                          :options="menu2.options"
                          class="dropBirthday">
                          </DropdownMenu>
                        </div>
                    </div>
    
                  </div>
              </div>
    
              <!-- 帳戶 ，改成card布局 -->
              <div class="card accountInfo">
    
                  <div class="card-title">
                    <p class="bold">帳戶</p>
                  </div>
    
                  <div class="divider"></div>
    
                  <div class="card-content">
                    <div class="input-group">
                        
                        <label for="">帳戶</label>
                        <div class="group-email">
                          <InputText 
                            :size="input1.size"
                            :textAlign="input1.textAlign"
                            :placeHolder="input1.placeHolder"
                            :errorMsg="input1.errorMsg"
                            :hasError="input1.inputError.value"
                            v-model="input1.inputValue.value">
                          </InputText>
                          <Btn btnStyle="baseline small" @click="toggleLightBox_email">變更信箱</Btn>                      
                        </div>
                        
                    </div>
                    <div class="input-group">
                      
                      <label for="">密碼</label>
                      <div class="group-pwd">
                        <InputText 
                          :size="input1.size"
                          :textAlign="input1.textAlign"
                          :placeHolder="input1.placeHolder"
                          :errorMsg="input1.errorMsg"
                          :hasError="input1.inputError.value"
                          v-model="input1.inputValue.value">
                        </InputText>
                        <!-- eye button -->
                        <!-- <Btn btnStyle="text small" id="mcEye">眼</Btn> -->
                        <Btn btnStyle="baseline small" @click="toggleLightBox_pwd">變更密碼</Btn>
                      </div>
                      
                    </div>
                    <div class="input-group account-state">
                        <p>帳號狀態</p>
                        <InputText 
                          :size="input1.size"
                          :textAlign="input1.textAlign"
                          :placeHolder="input1.placeHolder"
                          :errorMsg="input1.errorMsg"
                          :hasError="input1.inputError.value"
                          v-model="input1.inputValue.value">
                        </InputText>
                    </div>
                    <div class="btn-group">
                      <Btn btnStyle="outline default">Google</Btn>
                      <Btn btnStyle="baseline small">解除綁訂</Btn>
                    </div>
                    <div class="btn-group">
                      <Btn btnStyle="outline default">LineID</Btn>
                      <Btn btnStyle="baseline small">綁訂</Btn>
                    </div>
                  </div>
    
    
              </div>
    
              <!-- 聯絡資料 -->
              <div class="card contactInfo">
    
                  <div class="card-title">
                    <p class="bold">聯絡資料</p>
                  </div>
    
                  <div class="divider"></div>
    
                  <div class="card-content">
                    <div class="input-group">
                        <p>手機</p>
                        <InputText 
                          :size="input1.size"
                          :textAlign="input1.textAlign"
                          :placeHolder="input1.placeHolder"
                          :errorMsg="input1.errorMsg"
                          :hasError="input1.inputError.value"
                          v-model="input1.inputValue.value">
                        </InputText>
                    </div>
                    <div class="input-group">
                        <p>聯絡地址</p>
                        <InputText 
                          :size="input1.size"
                          :textAlign="input1.textAlign"
                          :placeHolder="input1.placeHolder"
                          :errorMsg="input1.errorMsg"
                          :hasError="input1.inputError.value"
                          v-model="input1.inputValue.value">
                        </InputText>
                    </div>
                    <div class="input-group">
                        <p>LineID</p>
                        <div class="lineid-wrapper">
                          <InputText 
                            :size="input1.size"
                            :textAlign="input1.textAlign"
                            :placeHolder="input1.placeHolder"
                            :errorMsg="input1.errorMsg"
                            :hasError="input1.inputError.value"
                            v-model="input1.inputValue.value">
                          </InputText>
                        <p id="lineidnotice">*未提供Line ID 將無法使用 認識新毛友 和 尋找小幫手</p>
                        </div>
                    </div>
                  </div>
              </div>
              
            </div>
            <!-- 儲存修改紐 -->
            <div class="pu-btn-group">
                <div>
                  <Btn btnStyle="primary default">儲存</Btn>
                </div>
                <div>
                  <Btn btnStyle="baseline default">取消修改</Btn>
                </div>
            </div>
            <!-- 驗證程序 : pop up  -->
  
              <!-- lightBox 變更信箱 -->
            
  
  
              <!-- lightBox 重設密碼 -->
              
  
          </LightBox>

          <!-- 變更信箱 -->
          <LightBox 
              :title="lightTitle2.title"
              :is-light-box="lightTitle2.isLightBox.value" 
              @toggle="toggleLightBox_email"
              pY="5.6rem" 
              pX="5.6rem"
              bgc="transparent:50%" 
              id="resetEmailPop">
            <div>
    
                <!-- 1 輸入新的信箱 -->
              <div class="mc-update-verify">
  
                <h5 class="bold">驗證新信箱</h5>
  
                <p>請輸入新的信箱，我們會寄一封信到您的信箱</p>
                
  
                <label for="resetEmail">
                  <InputText
                  :size = "input3.size"
                  :textAlign = "input3.textAlign"
                  :placeHolder="input3.placeHolder"
                  :errorMsg="input3.errorMsg"
                  :hasError="input3.inputError.value"
                  v-model="input3.inputValue.value"
                  id="resetEmail">
                  </InputText>
                </label>
  
                <Btn btnStyle="primary default">寄送驗證碼</Btn>
  
                <Btn btnStyle="baseline default">取消</Btn>
  
              </div>  
                <!-- 2 輸入驗證碼 -->
              <div class="mc-update-verify">
  
                <h5 class="bold">驗證新信箱</h5>              
  
                <label for="">
                  <InputText
                  :size = "input4.size"
                  :textAlign = "input4.textAlign"
                  :placeHolder="input4.placeHolder"
                  :errorMsg="input4.errorMsg"
                  :hasError="input4.inputError.value"
                  v-model="input4.inputValue.value"
                  id="">
                  </InputText>
                </label>
  
                <Btn btnStyle="white default">重新寄送驗證碼</Btn>
  
                <Btn btnStyle="primary default">送出</Btn>
  
              </div>
                <!-- 3 更改成功 -->
              <div class="mc-update-verify">
  
                <h5 class="bold">更改成功!</h5>              
  
                <div class="tick"></div>
  
                <p>您的信箱已重設，請用新的信箱登入帳戶</p>
              </div>
            </div>
            </LightBox>

          <!-- 變更密碼 -->
          <LightBox 
            :title="lightTitle3.title"
            :is-light-box="lightTitle3.isLightBox.value" 
            @toggle="toggleLightBox_pwd"
            pY="5.6rem" 
            pX="5.6rem"
            bgc="transparent:50%"
            id="resetPwdPop" >
              <div>
                    
                  <!-- 1 驗證信箱 -->
                <div class="mc-update-verify">
    
                  <h5 class="bold">驗證信箱</h5>
    
                  <p>請輸入註冊時的信箱，我們會寄一封信到您的信箱</p>
                  
    
                  <label for="">
                    <InputText
                    :size = "input5.size"
                    :textAlign = "input5.textAlign"
                    :placeHolder="input5.placeHolder"
                    :errorMsg="input5.errorMsg"
                    :hasError="input5.inputError.value"
                    v-model="input5.inputValue.value"
                    id="">
                    </InputText>
                  </label>
    
                  <Btn btnStyle="primary default">寄送驗證碼</Btn>
    
                  <Btn btnStyle="baseline default">取消</Btn>
    
                </div>  
                  <!-- 2 輸入驗證碼 -->
                <div class="mc-update-verify">
    
                  <h5 class="bold">驗證信箱</h5>              
    
                  <label for="">
                    <InputText
                    :size = "input6.size"
                    :textAlign = "input6.textAlign"
                    :placeHolder="input6.placeHolder"
                    :errorMsg="input6.errorMsg"
                    :hasError="input6.inputError.value"
                    v-model="input6.inputValue.value"
                    id="">
                    </InputText>
                  </label>
    
                  <Btn btnStyle="white default">重新寄送驗證碼</Btn>
    
                  <Btn btnStyle="primary default">送出</Btn>
    
                </div>
                  <!-- 3 輸入新密碼 -->
                <div class="mc-update-verify">
    
                  <h5 class="bold">重設密碼</h5>              
    
                  <label for="">
                    <InputText
                    :size = "input6.size"
                    :textAlign = "input6.textAlign"
                    :placeHolder="input6.placeHolder"
                    :errorMsg="input6.errorMsg"
                    :hasError="input6.inputError.value"
                    v-model="input6.inputValue.value"
                    id="">
                    </InputText>
                  </label>
                  <label for="">
                    <InputText
                    :size = "input6.size"
                    :textAlign = "input6.textAlign"
                    :placeHolder="input6.placeHolder"
                    :errorMsg="input6.errorMsg"
                    :hasError="input6.inputError.value"
                    v-model="input6.inputValue.value"
                    id="">
                    </InputText>
                  </label>              
    
                  <label for="resetPwdAgree">
                    <input type="checkbox" name="agree" id="resetPwdAgree">我已閱讀並同意使用者政策和我們的隱私權政策。
                  </label>
    
                  <Btn btnStyle="primary default">進行重設</Btn>
    
                </div>
                  <!-- 4 更改成功 -->
                <div class="mc-update-verify">
    
                  <h5 class="bold">更改成功!</h5>              
    
                  <div class="tick"></div>
    
                  <p>您的密碼已重設，請用新的密碼登入帳戶</p>
                </div>   
    
              </div>
            </LightBox>
  
      </div>
  
  
  
    </div>

  <!-- circle bg -->
  <div class="member-circle"></div>
    
</main>

</template>

<script setup>

import { ref } from 'vue';
// components
import MainHeader from '../components/MainHeader.vue';
import Btn from '../components/Btn.vue';
import DropdownMenu from '../components/DropdownMenu.vue';
import InputText from '../components/InputText.vue';
import LightBox from '../components/LightBox.vue';
// pages
import memberNav from '../pages/memberNav.vue' ;


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


// // lightBox title
const lightTitle1 = {title: "會員資料", isLightBox: ref(false)};
const lightTitle2 = {title: "變更信箱", isLightBox: ref(false)};
const lightTitle3 = {title: "變更密碼", isLightBox: ref(false)};
//  // lightBox 狀態
// let isLightBox = ref(false);

// // 控制燈箱的顯示與隱藏
function toggleLightBox_memberInfo() {
  lightTitle1.isLightBox.value = !lightTitle1.isLightBox.value;
  // 根據狀態新增或移除 clicked 類別
  if (lightTitle1.isLightBox.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
};
function toggleLightBox_email() {
  lightTitle2.isLightBox.value = !lightTitle2.isLightBox.value;
  // 根據狀態新增或移除 clicked 類別
  if (lightTitle2.isLightBox.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
};
function toggleLightBox_pwd() {
  lightTitle3.isLightBox.value = !lightTitle3.isLightBox.value;
  // 根據狀態新增或移除 clicked 類別
  if (lightTitle2.isLightBox.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
};
</script>