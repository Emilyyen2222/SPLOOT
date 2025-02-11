
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
              <!-- 點擊打開編輯會員資料的LightBox -->
              <Btn btnStyle="baseline small" id="memberInfoEdit" @click="toggleLightBox(lightTitle_memberInfo)">編輯</Btn>
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
                      <div class="label">姓名</div>
                      <div>{{ inputs.input_name.inputValue }}</div>
                    </div>
                    <div class="bi-inbox">
                      <div class="label">暱稱</div>
                      <div>{{ inputs.input_nickname.inputValue }}</div>
                    </div>
                    <div class="bi-inbox">
                      <div class="label">性別</div>
                      <div>{{ selectedSex }}</div>
                    </div>
                    <div class="bi-inbox">
                      <div class="label">生日</div>
                      <div>{{ selectedYear }} / {{ selectedMonth }} / {{ selectedDay }}</div>
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
                      <div class="label">信箱</div>
                      <div>{{ member.email }}</div>
                    </div>
                    <div class="bi-inbox">
                      <div class="label">密碼</div>
                      <div>{{ inputs.input_pwd.inputValue }}</div>
                    </div>
                    
                  </div>
              </div>
            </div>
            <!-- card 3 聯絡資料 -->
            <div class="card card-contact" id="">
    
              <div class="card-title">
                  <p class="bold">聯絡資訊</p>
              </div>
    
              <div class="divider"></div>
              <!-- card content -->
              <div class="card-content">
    
                    <div class="bi-inbox">
                      <div class="setWid">手機</div>
                      <div>{{ inputs.input_phone.inputValue }}</div>
                    </div>
                    <div class="bi-inbox">
                      <div class="setWid">聯絡地址</div>
                      <div>{{ wholeAddress }}</div>
                    </div>
                    <div class="bi-inbox">
                      <div class="setWid">LineID</div>
                      <div>{{ inputs.input_lineId.inputValue }}</div>
                    </div>
    
              </div>
            </div>
            <!-- 隱私權政策 -->
            <div class="privacy">
              <Btn btnStyle="text small" @click="togglePolicy">使用者同意書</Btn>
              <Btn btnStyle="text small" @click="togglePrivacy">隱私權政策</Btn>
            </div>
    
        </div>
    
        <!-- 會員資料的彈窗，memberInfo update, popup -->
        <div class="memberInfo-update">
            
            <!-- 編輯 -->
             
            <LightBox 
              :title="lightTitle_memberInfo.title"
              :is-light-box="lightTitle_memberInfo.isLightBox.value" 
              @toggle="toggleLightBox(lightTitle_memberInfo)">
              
              <div class="pb-container">
    
                <h6 class="bold">會員資料</h6>
                <!-- 頭像 -->
                <div class="card avatars">
    
                  <div class="bold card-title">
                    <p class="bold">頭像</p>
                  </div>
      
                  <div class="divider"></div>
      
                  <div class="card-content"> 
                    <!-- 用 v-for 產生 8 個頭像 -->
                    <div class="av-group" 
                        v-for="avatar in avatars" 
                        :key="avatar.avatarId" 
                        :class="{ '-selected': selectedAvatarId === avatar.avatarId }">
                      <div class="avatar" @click="chosed(avatar.avatarId)"> <!-- 點擊選擇頭像 -->
                        <img :src="avatar.img" alt="avatar">
                      </div>
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
                            v-model="inputs.input_name.inputValue"
                            :placeHolder="inputs.input_name.placeHolder"
                            :size="inputs.input_name.size"
                            :textAlign="inputs.input_name.textAlign"
                            :errorMsg="inputs.input_name.errorMsg"
                            :inputError="inputs.input_name.inputError"
                            >
                          </InputText>
                      </div>
                      <div class="input-group">
                          <label for="nickname">暱稱</label>
                          <InputText 
                            v-model="inputs.input_nickname.inputValue"
                            :placeHolder="inputs.input_nickname.placeHolder"
                            :size="inputs.input_nickname.size"
                            :textAlign="inputs.input_nickname.textAlign"
                            :errorMsg="inputs.input_nickname.errorMsg"
                            :inputError="inputs.input_nickname.inputError">
                          </InputText>
                      </div>
                      <div class="input-group" id="sexGroup">
                        <label for="sex">性別</label>
                        <div class="sex" id="sex">
                          <label for="male">
                              <input type="radio" class="" name="sex" value="男" id="male" style="color : #D14535; " v-model="selectedSex">男
                          </label>
                          <label for="female">
                              <input type="radio" class="" name="sex" value="女" id="female" style="color : #D14535; " v-model="selectedSex">女
                          </label>
                        </div>
                      </div>
                      <div class="input-group birthday">
                          <label for="">生日</label>
                          <div class="select-group">
                            <!-- 年分 -->
                            <DropdownMenu 
                              :placeHolder="menu_birth_y.placeHolder" 
                              :options="menu_birth_y.options.value"
                              class="dropBirthday"
                              v-model="selectedYear">            
                            </DropdownMenu> 
                            <!-- 月份 -->
                            <DropdownMenu
                              :placeHolder="menu_birth_m.placeHolder" 
                              :options="menu_birth_m.options.value"
                              class="dropBirthday"
                              v-model="selectedMonth">
                            </DropdownMenu>
                            <!-- 日期 -->
                            <DropdownMenu
                              :placeHolder="menu_birth_d.placeHolder" 
                              :options="menu_birth_d.options.value"
                              class="dropBirthday"
                              v-model="selectedDay">
                            </DropdownMenu>
                          </div>
                      </div>
      
                    </div>
                </div>
      
                <!-- 帳戶 -->
                <div class="card accountInfo">
      
                    <div class="card-title">
                      <p class="bold">帳戶</p>
                    </div>
      
                    <div class="divider"></div>
      
                    <div class="card-content">
                      <div class="input-group">                          
                          <label for="">帳戶</label>
                          <p>{{ member.email }}</p>                          
                      </div>
                      <div class="input-group">
                        <div class="pwdEye">
                          <label>密碼</label>
                          <img class="theEye" :src="eyeState_member" alt="" @click="eyeStateToggle_member">
                        </div>
                        <div class="group-pwd">
                          <div class="inputSetBox">
                            <p>{{ '******'}}</p>
                            <!-- <InputText
                                ref="password_member"
                                class="password_member"
                                placeHolder="密碼"
                                errorMsg="Invalid Input"
                                v-model="inputValuePassword"
                                :hasError="inputErrorPassword"
                                size="small">
                            </InputText> -->
                            <!-- <img class="theEye" :src="eyeState_member" alt="" @click="eyeStateToggle_member"> -->
                            <!-- <p>用 v-model 監聽: {{ inputValuePassword }}</p> -->
                          </div>
                          <Btn btnStyle="baseline small" @click="toggleLightBox(lightTitle_resetPwd)">變更密碼</Btn>                          
                        </div>
                        
                      </div>
                      <!-- 帳號狀態(已拿掉) -->
                      <div class="input-group third-login">
                        <label></label>
                        <div class="btn-group">
                          <Btn btnStyle="outline default">Google</Btn>
                          <Btn btnStyle="baseline small" @click="togglePopUp_unBind">解除綁訂</Btn>
                        </div>
                      </div>
                      <div class="input-group third-login">
                        <label></label>
                        <div class="btn-group">
                          <Btn btnStyle="outline default">LineID</Btn>
                          <Btn btnStyle="baseline small" @click="togglePopUp_unBind">綁訂</Btn>
                        </div>
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
                          <label>手機</label>
                          <InputText 
                          v-model="inputs.input_phone.inputValue"
                            :placeHolder="inputs.input_phone.placeHolder"
                            :size="inputs.input_phone.size"
                            :textAlign="inputs.input_phone.textAlign"
                            :errorMsg="inputs.input_phone.errorMsg"
                            :inputError="inputs.input_phone.inputError">
                          </InputText>
                      </div>
                      <div class="input-group">
                          <label>聯絡地址</label>
                          <div class="inputs">
                            <div class="select-group">
                              <DropdownMenu class="address"
                                :placeHolder="city.placeHolder"
                                :options="city.options"
                                v-model="selectedCity">
                              </DropdownMenu>
                              <DropdownMenu class="address"
                                :placeHolder="districtPlaceHolder"
                                :options="districtsOptions"
                                v-model="selectDistrict"
                                :key="selectedCity"> 
                              </DropdownMenu>
                            </div>
                            <!-- 剩下的地址 -->
                            <InputText 
                              v-model="inputs.input_address.inputValue"
                              :placeHolder="inputs.input_address.placeHolder"
                              :size="inputs.input_address.size"
                              :textAlign="inputs.input_address.textAlign"
                              :errorMsg="inputs.input_address.errorMsg"
                              :inputError="inputs.input_address.inputError">
                            </InputText>

                          </div>
                      </div>
                      <div class="input-group">
                          <label>LineID</label>
                          <div class="lineid-wrapper">
                            <InputText 
                            v-model="inputs.input_lineId.inputValue"
                              :placeHolder="inputs.input_lineId.placeHolder"
                              :size="inputs.input_lineId.size"
                              :textAlign="inputs.input_lineId.textAlign"
                              :errorMsg="inputs.input_lineId.errorMsg"
                              :inputError="inputs.input_lineId.inputError"
                              required>
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
                    <Btn btnStyle="primary default" @click="toggleLightBox(lightTitle_memberInfo)">儲存</Btn>
                  </div>
                  <div>
                    <Btn btnStyle="baseline default" @click="toggleLightBox(lightTitle_memberInfo)">取消修改</Btn>
                  </div>
              </div>
                          
            </LightBox>
  
            <!-- 驗證程序 : light box  -->
  
            <!-- 變更信箱 -->
            <LightBox 
                :title="lightTitle_resetEmail.title"
                :is-light-box="lightTitle_resetEmail.isLightBox.value" 
                @toggle="toggleLightBox(lightTitle_resetPwd)">
              <div>    
                  <!-- 1 輸入新的信箱 -->
                <div class="mc-update-verify">
    
                  <h5 class="bold">驗證新信箱</h5>
    
                  <p>請輸入新的信箱，我們會寄一封信到您的信箱</p>
                  
    
                  <label for="resetEmail">
                    <InputText
                      v-model="inputs.input_reEmail.inputValue"
                      :placeHolder="inputs.input_reEmail.placeHolder"
                      :size="inputs.input_reEmail.size"
                      :textAlign="inputs.input_reEmail.textAlign"
                      :errorMsg="inputs.input_reEmail.errorMsg"
                      :inputError="inputs.input_reEmail.inputError"
                    id="resetEmail">
                    </InputText>
                  </label>
    
                  <Btn btnType="form" btnStyle="nextQ">寄送驗證碼</Btn>
                  <!-- 改成 nextQuestion -->
                  <Btn btnStyle="baseline default" @click="toggleLightBox(lightTitle_resetEmail)">取消</Btn>
    
                </div>  
                  <!-- 2 輸入驗證碼 -->
                <div class="mc-update-verify">
    
                  <h5 class="bold">驗證新信箱</h5>              
    
                  <label for="">
                    <InputText
                      v-model="inputs.input_vCode.inputValue"
                      :placeHolder="inputs.input_vCode.placeHolder"
                      :size="inputs.input_vCode.size"
                      :textAlign="inputs.input_vCode.textAlign"
                      :errorMsg="inputs.input_vCode.errorMsg"
                      :inputError="inputs.input_vCode.inputError"
                    id="">
                    </InputText>
                  </label>
                  <!-- setinterval? -->
                  <Btn btnStyle="outline default">重新寄送驗證碼</Btn>
    
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
              :is-light-box="lightTitle_resetPwd.isLightBox.value" 
              :title="lightTitle_resetPwd.title"
              @toggle="toggleLightBox(lightTitle_resetPwd)">
                <div>
                      
                    <!-- 1 驗證信箱 -->
                  <div class="mc-update-verify">
      
                    <h5 class="bold">驗證信箱</h5>
      
                    <p>請輸入註冊時的信箱，我們會寄一封信到您的信箱</p>
                    
      
                    <label for="">
                      <InputText
                      :size = "inputs.input_vEmail.size"
                      :textAlign = "inputs.input_vEmail.textAlign"
                      :placeHolder="inputs.input_vEmail.placeHolder"
                      :errorMsg="inputs.input_vEmail.errorMsg"
                      :hasError="inputs.input_vEmail.inputError.value"
                      v-model="inputs.input_vEmail.inputValue.value">
                      </InputText>
                    </label>
      
                    <Btn btnStyle="primary default">寄送驗證碼</Btn>
      
                    <Btn btnStyle="baseline default" @click="toggleLightBox(lightTitle_resetPwd)">取消</Btn>
      
                  </div>  
                    <!-- 2 輸入驗證碼 -->
                  <div class="mc-update-verify">
      
                    <h5 class="bold">驗證信箱</h5>              
      
                    <label for="">
                      <!-- <InputText
                      :size = "input6.size"
                      :textAlign = "input6.textAlign"
                      :placeHolder="input6.placeHolder"
                      :errorMsg="input6.errorMsg"
                      :hasError="input6.inputError.value"
                      v-model="input6.inputValue.value"
                      id="">
                      </InputText> -->
                    </label>
      
                    <Btn btnStyle="white default">重新寄送驗證碼</Btn>
      
                    <Btn btnStyle="primary default">送出</Btn>
      
                  </div>
                    <!-- 3 輸入新密碼 -->
                  <div class="mc-update-verify">
      
                    <h5 class="bold">重設密碼</h5>              
      
                    <label for="">
                      <!-- <InputText
                      :size = "input6.size"
                      :textAlign = "input6.textAlign"
                      :placeHolder="input6.placeHolder"
                      :errorMsg="input6.errorMsg"
                      :hasError="input6.inputError.value"
                      v-model="input6.inputValue.value"
                      id="">
                      </InputText> -->
                    </label>
                    <label for="">
                      <!-- <InputText
                      :size = "input6.size"
                      :textAlign = "input6.textAlign"
                      :placeHolder="input6.placeHolder"
                      :errorMsg="input6.errorMsg"
                      :hasError="input6.inputError.value"
                      v-model="input6.inputValue.value"
                      id="">
                      </InputText> -->
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
  
          <!-- 網站服務條款 -->
          <Policy
              :is-light-box="isLightBoxPolicy" 
              :title="titlePolicy"
              @toggle="togglePolicy"
              policies="policyInfo"
          ></Policy>
          <!-- 隱私權政策 -->
          <Policy
              :is-light-box="isLightBoxPrivacy" 
              :title="titlePrivacy"
              @toggle="togglePrivacy"
              policies="privacyInfo"
          ></Policy>
  
            <!-- 綁定/解除綁訂 第三方登入 -->
            <PopUp
            :is-pop-up="unBind.isPopUp.value">
            <div class="unBind">
              <div class="title">
                <p class="bold">確定解除綁定?</p>
              </div>
              <div class="btn-group">
                <Btn btnStyle="primary small" @click="togglePopUp_unBind">確定</Btn>
                <Btn btnStyle="baseline small" @click="togglePopUp_unBind">取消</Btn>
              </div>            
            </div>
            </PopUp>
        </div>
    
    
    
      </div>
  
    <!-- circle bg -->
    <div class="member-circle"></div>
      
  </main>
  
</template>
  
<script setup>
  
import { ref,computed,reactive,watch,watchEffect} from 'vue';
// components
import MainHeader from '../components/MainHeader.vue';
import Btn from '../components/Btn.vue';
import DropdownMenu from '../components/DropdownMenu.vue';
import InputText from '../components/InputText.vue';
import LightBox from '../components/LightBox.vue';
import PopUp from '../components/PopUp.vue';
import Policy from '../components/Policy.vue';
// pages
import memberNav from '../views/memberNav.vue' ;
//密碼的眼睛按鈕
import openedEye from '@/assets/img/icon/login/openedEye.svg' 
import closedEye from '@/assets/img/icon/login/closedEye.svg' 

// const
  //input
    // 使用物件來統一管理所有輸入框的狀態
  const inputs = reactive({
    // input1: { placeHolder: '輸入預設文字' , errorMsg : '請輸入正確格式的'},
    input_name: { placeHolder: '輸入姓名' },
    input_nickname: { placeHolder: '輸入暱稱' },
    // input_email: { placeHolder: 'hao@gmail.com' },
    input_pwd: { placeHolder: '********' },
    input_phone: { placeHolder: '輸入手機' },
    input_address: { placeHolder: '輸入剩下地址'},
    input_lineId: { placeHolder: '輸入LineID' },
    input_reEmail: { placeHolder: '輸入新的信箱' },
    input_vCode: { placeHolder: '輸入驗證碼' },
    input_vEmail: { placeHolder: '輸入驗證碼' },
    input6: { placeHolder: '輸入驗證碼' }
  });

  // avatar
  const avatars=[
  {avatarId:1,img: new URL("@/assets/img/member-center/portrait1.svg", import.meta.url).href},
  {avatarId:2,img: new URL("@/assets/img/member-center/portrait2.svg", import.meta.url).href},
  {avatarId:3,img: new URL("@/assets/img/member-center/portrait3.svg", import.meta.url).href},
  {avatarId:4,img: new URL("@/assets/img/member-center/portrait4.svg", import.meta.url).href},
  {avatarId:5,img: new URL("@/assets/img/member-center/portrait5.svg", import.meta.url).href},
  {avatarId:6,img: new URL("@/assets/img/member-center/portrait6.svg", import.meta.url).href},
  {avatarId:7,img: new URL("@/assets/img/member-center/portrait7.svg", import.meta.url).href},
  {avatarId:8,img: new URL("@/assets/img/member-center/portrait8.svg", import.meta.url).href},
];

  // 居住地區--城市選單
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

  // lightBox title
  const lightTitle_memberInfo = {title: "會員資料", isLightBox: ref(false)};
  const lightTitle_resetEmail = {title: "變更信箱", isLightBox: ref(false)};
  const lightTitle_resetPwd = {title: "變更密碼", isLightBox: ref(false)};
  // const titlePolicy = {title: "網站服務條款", isLightBox: ref(false)};
  // const titlePrivacy = {title: "隱私權政策", isLightBox: ref(false)};

// function
  // 統一設定每個 inputText 的預設屬性，避免重複
  Object.keys(inputs).forEach(key => {
    inputs[key] = {
      ...inputs[key],
      size: 'small',
      textAlign: 'textLeft',
      errorMsg: '請輸入正確格式',
      inputValue: ref(''), // 這樣每個 input 都會擁有獨立的 v-model
      inputError: ref(false)
    };
  });

  // 監聽input的內容，驗證
  // test
    // 手機
    const isValidPhone = computed(() => {
      // 允許數字 (0-9)、加號 (+)、減號 (-)
      const phonePattern = /^[0-9+\-]+$/;
      return phonePattern.test(inputs.input_phone.inputValue);
    });

    watch(
      () => inputs.input_phone.inputValue, 
      (newValue, oldValue) => {
      console.log("輸入的手機",inputs.input_phone.inputValue);
      console.log("驗證結果",isValidPhone.value);

      if(isValidPhone.value){
          inputs.input_phone.inputError= false;
      }else{
          inputs.input_phone.inputError= true;
      }
      });
    

  // LightBox 燈箱
  
    // 控制燈箱的顯示與隱藏
    // 定義一個共用的 toggle 函式
    function toggleLightBox(lightObj) {
      lightObj.isLightBox.value = !lightObj.isLightBox.value;
      if (lightObj.isLightBox.value) {
        document.body.classList.add('clicked');
      } else {
        document.body.classList.remove('clicked');
      }
    };

  //PopUp狀態
    // 用isPopUp控制
  const unBind = { isPopUp : ref (false ) };
  
    // 控制燈箱的顯示與隱藏
    function togglePopUp_unBind() {
      unBind.isPopUp.value = !unBind.isPopUp.value;
      // // 停止捲軸
      if (unBind.isPopUp.value) {
        document.body.classList.add('clicked');
      } else {
        document.body.classList.remove('clicked');
      }
    };



  // 編輯會員資料 的彈窗

    // avatars 頭像

      // 選擇的頭像 ID，會加上框框
      const selectedAvatarId = ref(null);

      // 點擊頭像時，變更選中狀態
      const chosed = (avatarId) => {
        selectedAvatarId.value = avatarId;
      };

    // 基本資料
      // 選擇生日 的下拉選單
        // 取得目前年份
        const currentYear = new Date().getFullYear();

        // 定義年份下拉選單資料：從當前年份往回推 100 年
        const menu_birth_y = {
          placeHolder: '請選擇年份',
          options: computed(() => {
            const arr = [];
            for (let i = 0; i < 100; i++) {
              arr.push({ id: i, name: String(currentYear - i) });
            }
            return arr;
          })
        };

        // 定義月份下拉選單資料：1 到 12
        const menu_birth_m = {
          placeHolder: '請選擇月份',
          options: computed(() => {
            const arr = [];
            for (let i = 1; i <= 12; i++) {
              arr.push({ id: i, name: String(i) });
            }
            return arr;
          })
        };

        // 使用 v-model 綁定使用者所選的年份、月份與日期
        const selectedYear = ref('');
        const selectedMonth = ref('');
        const selectedDay = ref('');

        // 定義日期下拉選單資料：根據 selectedYear 與 selectedMonth 動態生成
        const menu_birth_d = {
          placeHolder: '請選擇日期',
          options: computed(() => {
            if (!selectedYear.value || !selectedMonth.value) return [];
            const year = parseInt(selectedYear.value);
            const month = parseInt(selectedMonth.value);
            // 利用 Date 物件計算該月的天數（傳入 month 代表下一個月的第0天即該月最後一天）
            const days = new Date(year, month, 0).getDate();
            return Array.from({ length: days }, (_, i) => ({
              id: i,
              name: String(i + 1)
            }));
          })
        };      

      // 性別
      const selectedSex = ref('');

    // 帳戶
        // 帳戶/號(信箱)
        const member = reactive({
            email : 'hao@gmail.com',   // 暫時寫死
            password: 'password'
          });
      //密碼
      //密碼顯示

        let eyeState_member = ref(closedEye);
        // let eyeState2 = ref(closedEye);
        // let eyeState3 = ref(closedEye);

        //抓取input type 改成password
        // onMounted(() => {
        //     const passwordInput_member = document.querySelector(".password_member input");
        //         passwordInput_member.type = 'password';
        //     const passwordInput2 = document.querySelector(".password2 input");
        //         passwordInput2.type = 'password';
        //     const passwordInput3 = document.querySelector(".password3 input");
        //         passwordInput3.type = 'password';
        // });

        function eyeStateToggle_member() {
            const passwordInput_member = document.querySelector(".password_member input");
            // passwordInput_member.type = passwordInput_member.type == 'password' ? 'text' : 'password';
            eyeState_member.value = eyeState_member.value == closedEye ? eyeState_member.value = openedEye : eyeState_member.value = closedEye;
            // 這裡讓這裡讓isPwdVisible的值在true/false來回切換
        };

      let inputValuePassword = ref('');
      let inputErrorPassword = ref(false);

      watch(inputValuePassword, (newValue, oldValue) => {
          if(inputValuePassword.value.includes('123')){
              inputErrorPassword.value = true;
          }else{
              inputErrorPassword.value = false;
          }
      });

  

    // 聯絡資料
      // 手機
      // 地址


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
        // 將地址合併成一個(前端顯示用)；保持三個傳到後端
        // 用computed確保
      const wholeAddress = computed(() => {
        // console.log(inputs.input_address.inputValue);
        const city = selectedCity.value || "";  // 確保不為 null
        const district = selectDistrict.value || "";
        const address = inputs.input_address.inputValue || ""; // 確保 address 存在

        return `${city} ${district} ${address}`.trim();
      });
      // 讓 selectDistrict 變成空字串，而不是 null
      watch(selectedCity, () => {        
          selectDistrict.value = ""; 
          districtPlaceHolder.value = "全部行政區域";
      });

      // 監聽是否成功
      watch(wholeAddress, (newVal) => {
        console.log("更新後的 wholeAddress:", newVal);
      });

      // 隱私權元件，Policy Component
      const isLightBoxPolicy = ref(false);
      const isLightBoxPrivacy = ref(false);

      const titlePolicy = ref("網站服務條款");
      const titlePrivacy = ref("隱私權政策");

      function togglePolicy() {
      isLightBoxPolicy.value = !isLightBoxPolicy.value;
      updateBodyClass();
      }

      function togglePrivacy() {
      isLightBoxPrivacy.value = !isLightBoxPrivacy.value;
      updateBodyClass();
      }

      function updateBodyClass() {
      if (isLightBoxPolicy.value || isLightBoxPrivacy.value) {
          document.body.classList.add('clicked');
      } else {
          document.body.classList.remove('clicked');
      }
      }


      
      
  
</script>