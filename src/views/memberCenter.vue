
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
                      <div>{{ inputs.input_email.inputValue }}</div>
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
                      <div>{{ inputs.input_address.inputValue }}</div>
                    </div>
                    <div class="bi-inbox">
                      <div class="setWid">LineID</div>
                      <div>{{ inputs.input_lineId.inputValue }}</div>
                    </div>
    
              </div>
            </div>
            <!-- 隱私權政策 -->
            <div class="privacy">
              <Btn btnStyle="text small" @click="toggleLightBox(lightTitle_userPolicy)">使用者同意書</Btn>
              <Btn btnStyle="text small" @click="toggleLightBox(lightTitle_privacy)">隱私權政策</Btn>
            </div>
    
        </div>
    
        <!-- 會員資料的彈窗，memberInfo update, popup -->
        <div class="memberInfo-update">
            
            <!-- 編輯 -->
             
            <LightBox 
              :title="lightTitle_memberInfo.title"
              :is-light-box="lightTitle_memberInfo.isLightBox.value" 
              @toggle="toggleLightBox(lightTitle_memberInfo)"
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
      
                    <div class="card-content"> 
                        <!-- 用v-for，產6個 -->            
                      <div class="av-group" v-for="avatar in avatars" :key="avatar.id">
                          <div class="avatar">           <!-- 頭相框 -->
                            <img :src="avatar.img" alt="avatar">

                          </div>
                          <smallText>{{ avatar.name }}</smallText>
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
                              v-model="selectedYear"
                            >            
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
                              v-model="inputs.input_email.inputValue"
                              :placeHolder="inputs.input_email.placeHolder"
                              :size="inputs.input_email.size"
                              :textAlign="inputs.input_email.textAlign"
                              :errorMsg="inputs.input_email.errorMsg"
                              :inputError="inputs.input_email.inputError"
                              disabled>
                            </InputText>                            
                            <Btn btnStyle="baseline small" @click="toggleLightBox(lightTitle_resetEmail)">變更信箱</Btn>                      
                          </div>
                          
                      </div>
                      <div class="input-group">
                        
                        <label for="">密碼</label>
                        <div class="group-pwd">
                          <InputText 
                             v-model="inputs.input_pwd.inputValue"
                            :placeHolder="inputs.input_pwd.placeHolder"
                            :size="inputs.input_pwd.size"
                            :textAlign="inputs.input_pwd.textAlign"
                            :errorMsg="inputs.input_pwd.errorMsg"
                            :inputError="inputs.input_pwd.inputError"
                            readonly>
                          </InputText>
                          <!-- eye button -->
                          <!-- <Btn btnStyle="text small" id="mcEye">眼</Btn> -->
                          <Btn btnStyle="baseline small" @click="toggleLightBox(lightTitle_resetPwd)">變更密碼</Btn>
                        </div>
                        
                      </div>
                      <div class="input-group account-state">
                          <p>帳號狀態</p>
                          <InputText 
                            v-model="inputs.input_accState.inputValue"
                            :placeHolder="inputs.input_accState.placeHolder"
                            :size="inputs.input_accState.size"
                            :textAlign="inputs.input_accState.textAlign"
                            :errorMsg="inputs.input_accState.errorMsg"
                            :inputError="inputs.input_accState.inputError"
                            readonly>
                          </InputText>
                      </div>
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
                          <InputText 
                          v-model="inputs.input_address.inputValue"
                            :placeHolder="inputs.input_address.placeHolder"
                            :size="inputs.input_address.size"
                            :textAlign="inputs.input_address.textAlign"
                            :errorMsg="inputs.input_address.errorMsg"
                            :inputError="inputs.input_address.inputError">
                          </InputText>
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
                              :inputError="inputs.input_lineId.inputError">
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
  
            <!-- 驗證程序 : pop up  -->
  
            <!-- 變更信箱 -->
            <LightBox 
                :title="lightTitle_resetEmail.title"
                :is-light-box="lightTitle_resetEmail.isLightBox.value" 
                @toggle="toggleLightBox(lightTitle_resetPwd)"
                id="resetEmailPop">
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
              @toggle="toggleLightBox(lightTitle_resetPwd)"
              id="resetPwdPop" >
                <div>
                      
                    <!-- 1 驗證信箱 -->
                  <div class="mc-update-verify">
      
                    <h5 class="bold">驗證信箱</h5>
      
                    <p>請輸入註冊時的信箱，我們會寄一封信到您的信箱</p>
                    
      
                    <label for="">
                      <InputText
                      :size = "input_vEmail.size"
                      :textAlign = "input_vEmail.textAlign"
                      :placeHolder="input_vEmail.placeHolder"
                      :errorMsg="input_vEmail.errorMsg"
                      :hasError="input_vEmail.inputError.value"
                      v-model="input_vEmail.inputValue.value"
                      id="">
                      </InputText>
                    </label>
      
                    <Btn btnStyle="primary default">寄送驗證碼</Btn>
      
                    <Btn btnStyle="baseline default" @click="toggleLightBox(lightTitle_resetPwd)">取消</Btn>
      
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
  
            <!-- 使用者政策 -->
            <LightBox 
              :is-light-box="lightTitle_userPolicy.isLightBox.value" 
              :title="lightTitle_userPolicy.title"
              @toggle="toggleLightBox(lightTitle_userPolicy)">
              <h6>使用者政策</h6>
              <p>在您開始使用 SPLOOT布魯家 所經營之網站之前，請詳細閱讀以下所有服務條款：
              當您成為 SPLOOT布魯家 網站的會員時，即表示您已詳細閱讀、明確瞭解並同意接受本服務條款之所有內容。
              若您不同意所列之服務條款，則請您立即離開此網站或者不使用任何網站之任何服務提供。</p>
              <p class="bold">帳號</p>
              <p>當您向我們註冊新帳號時，請務必確保您所提供的資料皆是最準確、完整並且時常保持更新狀態。違反所列之條款者，將有可能導致被立即停止您的帳號以及網站所提供的所有服務。此外，在使用任何服務以及活動上，您有義務責任確保您的密碼安全、無論該密碼是透過使用我們服務而管理或者第三方服務。您必須立即通知我們，一旦您的密碼被盜用或者處於不安全狀態。</p>
              <p class="bold">連結到其他網站</p>
              <p>我們的服務可能含有部份連結，將連結到第三方網站或者服務。該些服務將不會處於我們的控制、操作以及擁有管轄權限的範圍內，所以本網站沒有承擔任何內容、隱私政策或者任何第三方網站所提供的服務之義務責任。您同意本網站不需要承擔任何責任、因使用該第三方網站所提供之內容、服務與商品而所導致的；直接或者間接性損失與破壞。我們強烈建議您必須詳細閱讀清楚有關您所造訪的第三方網站之服務條款以及隱私政策，以確保您自身的權益。</p>
              <p class="bold">終止服務</p>
              <p>在不需要任何事前通知以下，我們有可能隨時終止您使用我們網站服務的權限；以上終止服務決定並不需要任何理由即可即時生效，包括但不限於您違反本服務條款。終止服務適用於所有條款的規定，包括但不限於所有權規定、擔保聲明、賠款以及有限責任。在不需要任何事前通知以下，我們有可能隨時終止您所持有的登入帳號；以上終止服務決定並不需要任何理由即可即時生效，包括但不限於您違反本服務條款。一旦確定終止，您將會立即無法繼續使用所有服務。若您希望終止您的帳號，您可以隨時終止服務。終止服務適用於所有條款的規定，包括但不限於所有權規定、擔保聲明、賠款以及有限責任。</p>
              <p class="bold">政府法律</p>
              <p>以上所有條款將會會遵從（國家之法律）無論是否其條款衝突於法律服務條款。若我們未擁有執行以上條款之部份權益，並不等同於我們放棄所有條款的執行權益。若有以上有部份條款不適用於所指定之法庭，其其他之所有條款依然有效。以上所有條款達致雙方在服務使用上的一致性同意與協議，任何事前的協議將有可能影響雙方對於以上所有服務條款的取代或者更改。
              我們保留所有條款的更改、取代之權益，並所做出更改、取代之內容可自行決定。若有任何的更改涉及任何內容，我們將會嘗試提供最少30天的事前通知；該通知將會在新條款正式起效之前公布。至於任何內容的制定則由我們自行決定。若您欲繼續使用網站服務，請務必同意所有新條款；若您不同意新條款，將會要求停止使用網站所有服務。
              若您有任何問題與疑慮，煩請與 SPLOOT布魯家 進行聯繫。</p>
              <Btn @click="toggleLightBox(lightTitle_userPolicy)" class="padding" btnStyle="primary default">確定</Btn>
            </LightBox>
  
            <!-- 隱私權政策 -->
            <LightBox 
              :is-light-box="lightTitle_privacy.isLightBox.value" 
              :title="lightTitle_privacy.title"
              @toggle="toggleLightBox(lightTitle_privacy)">
              <h6>隱私權政策</h6>
              <p>歡迎您使用 SPLOOT布魯家（以下簡稱「本公司」）係依據本服務條款提供 SPLOOT布魯家 (http://www.sploot.co) 服務（以下簡稱「本服務」），為了讓您能夠安心的使用本網站的各項服務與資訊，特此向您說明本網站的隱私權保護政策，以保障您的權益，請您詳閱下列內容：</p>
              <p class="bold">一、隱私權保護政策的適用範圍</p>
              <p>隱私權保護政策內容，包括本網站如何處理您在使用網站服務時收集到的個人識別資料。隱私權保護政策不適用於其他相關連結的網站，也不適用於非本網站所委託或參與管理的人員。</p>
              <p class="bold">二、個人資料的蒐集、處理及利用方式</p>
              <p>當您造訪本網站或使用本網站所提供之功能服務時，我們將視該服務功能性別，請您提供必要的個人資料，並於特定目的範圍內處理及使用您的個人資料；未經您的書面同意，將不會將個人資料用於其他用途。
              本網站在您使用服務信箱、填寫問卷、參加活動時，會保存您所提供的姓名、電子郵件信箱、聯絡方式及使用時間等。
              於一般瀏覽時，伺服器會自行記錄相關行為，包括您使用連線設備之IP位址、使用時間、瀏覽器及點擊紀錄等，做為我們增進網站服務的參考依據，此記錄為內部應用，決不對外公開。</p>
              <p class="bold">三、資料之保護</p>
              <p>本網站主機均設有防火牆、反病毒系統及其他相關的資訊安全設備及必要的安全防護措施，對於本網站及您的個人資料加以嚴格保護。
                未經授權之人員不得接觸您的個人資料，且所有接觸之人員均經簽署保密契約，違反保密義務者將受到相關法律處分。</p>
              <Btn @click="toggleLightBox(lightTitle_privacy)" class="padding" btnStyle="primary default">確定</Btn>              
            </LightBox>
  
            <!-- 綁定/解除綁訂 第三方登入 -->
            <PopUp
            :is-pop-up="unBind.isPopUp.value"
            @toggle="togglePopUp_unBind">
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
  
  import { ref,computed,reactive } from 'vue';
  // components
  import MainHeader from '../components/MainHeader.vue';
  import Btn from '../components/Btn.vue';
  import DropdownMenu from '../components/DropdownMenu.vue';
  import InputText from '../components/InputText.vue';
  import LightBox from '../components/LightBox.vue';
  import PopUp from '../components/PopUp.vue';
  // pages
  import memberNav from '../views/memberNav.vue' ;
  
    // avatars
    const avatars=[
    {id:1,img: new URL("@/assets/img/member-center/portrait1.svg", import.meta.url).href, name: "小白"},
    {id:2,img: new URL("@/assets/img/member-center/portrait2.svg", import.meta.url).href,name: "小白"},
    {id:3,img: new URL("@/assets/img/member-center/portrait3.svg", import.meta.url).href,name: "小白"},
    {id:4,img: new URL("@/assets/img/member-center/portrait4.svg", import.meta.url).href,name: "小白"},
    {id:5,img: new URL("@/assets/img/member-center/portrait5.svg", import.meta.url).href,name: "小白"},
    {id:6,img: new URL("@/assets/img/member-center/portrait6.svg", import.meta.url).href,name: "小白"},
    {id:7,img: new URL("@/assets/img/member-center/portrait7.svg", import.meta.url).href,name: "小白"},
    {id:8,img: new URL("@/assets/img/member-center/portrait8.svg", import.meta.url).href,name: "小白"},
  ]

  // dropDown

// 生日
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
  
  // input
  // 使用物件來統一管理所有輸入框的狀態
  const inputs = reactive({
    input1: { placeHolder: '輸入預設文字' },
    input_name: { placeHolder: '輸入姓名' },
    input_nickname: { placeHolder: '輸入暱稱' },
    input_email: { placeHolder: '輸入信箱' },
    input_pwd: { placeHolder: '********' },
    input_accState: { placeHolder: '正常' },
    input_phone: { placeHolder: '輸入手機' },
    input_address: { placeHolder: '輸入地址' },
    input_lineId: { placeHolder: '輸入LineID' },
    input_reEmail: { placeHolder: '輸入新的信箱' },
    input_vCode: { placeHolder: '輸入驗證碼' },
    input_vEmail: { placeHolder: '輸入驗證碼' },
    input6: { placeHolder: '輸入驗證碼' }
  });

 // 統一設定每個 inputText 的預設屬性，避免重複
Object.keys(inputs).forEach(key => {
  inputs[key] = {
    ...inputs[key],
    size: 'small',
    textAlign: 'textLeft',
    errorMsg: 'Invalid Input',
    inputValue: ref(''), // 這樣每個 input 都會擁有獨立的 v-model
    inputError: ref(false)
  };
});

// 性別
const selectedSex = ref('');


   // lightBox title
  const lightTitle_memberInfo = {title: "會員資料", isLightBox: ref(false)};
  const lightTitle_resetEmail = {title: "變更信箱", isLightBox: ref(false)};
  const lightTitle_resetPwd = {title: "變更密碼", isLightBox: ref(false)};
  const lightTitle_userPolicy = {title: "使用者政策", isLightBox: ref(false)};
  const lightTitle_privacy = {title: "隱私權政策", isLightBox: ref(false)};
  
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
  
  
  //popup狀態
  const unBind = { isPopUp : ref (false )  };
  
  // 刪除資訊卡
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
  
  </script>