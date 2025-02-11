
<template>
  <MainHeader theme="red" bgc="natural-1"></MainHeader>
  <!-- 主內容 -->
    <main class="whole-bg">
      <!-- top nav -->
      <memberNav/>
      <!-- v-show : 審核判斷 -->
        <!-- hc : helper-center -->
      <div class="helperCenter">
        <div class="hc-title">
          <h6 class="bold">想成為小幫手嗎？簡單四步驟成為最可靠的小幫手</h6>
          <Btn btnStyle="outline small" @click="toggleHcManage">小幫手管理</Btn>
        </div>
        <div class="hc-nav">
              <!-- v-if? : 每完成一個步驟就放上打勾的icon? -->
              <div class="hc-steps" 
              @click="toggleHcTest"
              :class=" {'-disable' : step1}"> 
                <p>Step.1 適性測驗 </p>
                <img v-if="step1" src="../assets/img/icon/mc_stepbtn_pass.svg" alt="icon">
                <img v-else src="../assets/img/icon/mc_stepbtn_failed.svg" alt="icon">
                <p v-if="step1" class="stepStatues" >已通過</p>
                <p v-else class="stepStatues"> 未通過</p>
                <p class="hc-reson" style="display:none;">{{ hcTest.failReson }}</p>
              </div>
              <div class="hc-steps" 
              @click="toggleHcVarify"
              :class="{ '-disable': step2 }">
                <p>Step.2 資料審核</p>
                <img v-if="step2" src="../assets/img/icon/mc_stepbtn_pass.svg" alt="icon">
                <!-- 未審核 -->
                <img v-else-if="unreviewed" src="../assets/img/icon/mc_stepbtn_unreviewed.svg" alt="icon">
                <!-- 審核中 -->
                <img v-else-if="underReview" src="../assets/img/icon/mc_stepbtn_under-review.svg" alt="icon">
                <img v-else src="../assets/img/icon/mc_stepbtn_failed.svg" alt="icon">
                <p v-if="step2" class="stepStatues" > 通過</p>
                <p v-else-if="unreviewed">未審核</p>
                <p v-else-if="underReview">審核中</p>
                <p v-else class="stepStatues"> 未通過</p>
                <p class="hc-reson" style="display:none;">{{ hcVarify.failReson }}</p>
              </div>
              <div class="hc-steps" 
              @click="toggleHcSign"
              :class="{ '-disable': step3 }">
                <p>Step.3 合約簽署</p>
                <img v-if="step3" src="../assets/img/icon/mc_stepbtn_pass.svg" alt="icon">
                <img v-else src="../assets/img/icon/mc_stepbtn_failed.svg" alt="icon">
                <p v-if="step3" class="stepStatues" > 通過</p>
                <p v-else class="stepStatues"> 未通過</p>
                <p class="hc-reson" style="display:none;">{{ hcSign.failReson }}</p>
              </div>
      
        </div>
    
        <!-- 無身分 -->
        <div v-if="!isHelperPassed"
         class="hc-not-passed">      
      

          <div class="hc-post-manage">
            <h6 class="bold">貼文發布管理</h6>
            <div class="divider"></div>
      
            <div class="hc-msg">
              <p>通過小幫手認證後才可以管理貼文喔~</p>
            </div>          
      
          </div>
      
      
        </div>
      
        <!-- 有身分 ，貼文管理-->
        <div v-else="isHelperPassed"
         class="hc-passed">
          <div class="hc-post-manage">
      
            <h6 class="bold">貼文發布管理</h6>
      
            <div class="divider"></div>
      
            <div class="hc-grid-container">
              <!-- 1 -->
              <helperPostCard/>
              <!-- 2 -->
              <div class="hc-postCard empty" id="hcPostCare">     <!-- 之後 empty 改用監聽加上watch -->
                <div class="btn-group">
                  <Btn btnStyle="baseline small" @click="toggleAddpost">+ 到府照顧</Btn>
                </div>
              </div>
              <!-- 3 -->
              <div class="hc-postCard empty" id="hcPostStay">
                <div class="btn-group">
                  <Btn btnStyle="baseline small" @click="toggleAddpost">+ 友善寄宿</Btn>
                </div>                
              </div>
              <!-- 4 -->
              <div class="hc-postCard empty" id="hcPostUber">
                <div class="btn-group">
                  <Btn btnStyle="baseline small" @click="toggleAddpost">+ 到府接送</Btn>
                </div>                
              </div>
            </div>          
      
          </div>
      
        </div>     
        
      </div>
  
      <!-- lightbox，適性測驗 -->
      <LightBox 
        :title="hcTest.title"
        :is-light-box="hcTest.isLightBox.value" 
        @toggle="toggleHcTest">
        <div class="hcTest">
          <div class="questions">
    
            <div class="hcTest-q"
              v-for="(question, index) in questions" 
              :key="question.id">
              <p class="content">{{ index + 1 }}. {{ question.text }}</p>
              <div class="radio-group">
                <label>
                  <input
                    type="radio"
                    :name="'question' + question.id"
                    value="yes"
                    v-model="question.answer"
                  />
                  是
                </label>
                <label>
                  <input
                    type="radio"
                    :name="'question' + question.id"
                    value="no"
                    v-model="question.answer"
                  />
                  否
                </label>
              </div>        
            </div>
             
          </div>
          <div class="btn-group">
              <Btn btnStyle="primary default" @click="submitAndToggle_test">提交</Btn>
              <Btn btnStyle="baseline default" @click="reloadAndToggle_hcTest">放棄</Btn>
          </div>      
          
        </div>
      </LightBox>
  
      <!-- lightbox，資料審核 -->
      <LightBox 
        :title="hcVarify.title"
        :is-light-box="hcVarify.isLightBox.value" 
        @toggle="toggleHcVarify">
        <div class="hcVarify-wrapper">
  
          <div class="input-wrapper">
            <!-- 姓名 -->
            <div class="input-group">
                <label for="name">姓名</label>
                <InputText
                    :size="input_name.size"
                    :textAlign="input_name.textAlign"
                    :placeHolder="input_name.placeHolder"
                    :errorMsg="input_name.errorMsg"
                    :hasError="input_name.inputError.value"
                    v-model="input_name.inputValue.value">
                </InputText>
                <!-- <p>{{ input_name.inputValue.value }}</p> -->
            </div>        
            <!-- 生日 -->
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
            <!-- 身分證號碼 -->
            <div class="input-group">
                <label for="idCard">身分證號碼</label>
                <InputText
                    :size="input_idCard.size"
                    :textAlign="input_idCard.textAlign"
                    :placeHolder="input_idCard.placeHolder"
                    :errorMsg="input_idCard.errorMsg"
                    :hasError="input_idCard.inputError.value"
                    v-model="input_idCard.inputValue.value">
                </InputText>
            </div>  
          </div>
          <!-- 上傳檔案 -->
          <div class="upload-file-wrapper">
            <!-- 正面自拍 -->
            <div class="selfy">
              <p>正面自拍照</p>
              <div class="imgUpload">
                <div class="imgUploadSection">
                  <p class="smallText imgUploadText" v-if="!selfyImg">上傳個人自拍照*</p>
                  <div class="uploadImgBox" v-if="selfyImg">
                    <img :src="selfyImg" alt="uploadImg">
                  </div>
                </div>
                <div class="imgUploadBtn">
                  <input type="file" hidden ref="selfyFileInput" accept="image/*" @change="(event) => uploadFileImage(event, 'selfy')">
                  <Btn btnStyle="primary small" @click="callFileInput('selfy')">上傳圖檔</Btn>
                </div>
              </div>
            </div>

            <!-- 身分證正面 -->
            <div class="idCard">
              <p>身分證圖檔(正面)</p>
              <div class="imgUpload">
                <div class="imgUploadSection">
                  <p class="smallText imgUploadText" v-if="!idCardImg">上傳身分證正面*</p>
                  <div class="uploadImgBox" v-if="idCardImg">
                    <img :src="idCardImg" alt="uploadImg">
                  </div>
                </div>
                <div class="imgUploadBtn">
                  <input type="file" hidden ref="idCardFileInput" accept="image/*" @change="(event) => uploadFileImage(event, 'idCard')">
                  <Btn btnStyle="primary small" @click="callFileInput('idCard')">上傳圖檔</Btn>
                </div>
              </div>
            </div>
          </div>
          
          <div class="btn-group">
              <Btn btnStyle="primary default" @click="checkAndSubmit2">提交</Btn>
              <Btn btnStyle="baseline default" @click="reloadAndToggle_hcVarify">取消</Btn>
          </div>      
        </div>
      </LightBox> 
      
      <!-- lightbox，合約簽署 -->
      <LightBox 
        :title="hcSign.title"
        :is-light-box="hcSign.isLightBox.value" 
        @toggle="toggleHcSign">
        <div class="hcSign-wrapper">
          <div class="hc-terms"> 
            <div class="content">

              <p>歡迎您使用本網站（以下稱「本網站」或「本平台」）。在註冊或使用本網站所提供之服務前，請詳細閱讀以下使用者條款（以下稱「本條款」）。一旦您註冊或使用本網站，即表示您已閱讀、了解並同意遵守本條款。</p> <br>

              <p class="bold">一、適用範圍</p> <br>
              <p>本條款適用於本網站所提供之所有功能、資訊與服務（以下合稱「本服務」）。</p> <br>
              <p>若本條款與本網站所公告的其他規定（例如隱私權政策、活動辦法等）有不一致之處，則依該其他規定或活動辦法為準，但限於該規定或活動辦法所涉之特定範圍內。</p> <br>

              <p class="bold">二、使用資格</p> <br>
              <p>使用者應確保於註冊或使用本服務時，具備法律上之行為能力；若使用者為未成年人，應在法定代理人（父母或監護人）同意下使用本服務。</p> <br>
              <p>使用者應提供真實、正確的個人或公司資訊。如因提供不實資料導致任何爭議、損失，概由使用者自行承擔責任。</p> <br>

              <p class="bold">三、資料使用條款</p> <br>

              <p>1.資料提供與蒐集</p> <br>
              <p>使用者在使用本服務時，可能會主動提供個人或寵物相關資訊（包含但不限於姓名、聯絡方式、寵物資料等）。本網站將根據使用者提供之資料與下文所列範圍進行蒐集與使用。</p> <br>
              <p>使用者同意本網站依照相關法律及本條款，對該等資料進行保存、處理及使用。</p> <br>

              <p>2.資料使用目的</p> <br>
              <ul>
                  <li>會員身份驗證與管理</li>
                  <li>分析與優化使用者體驗</li>
                  <li>提供個人化的推薦、廣告與行銷內容</li>
                  <li>進行統計與研究以優化本服務</li>
              </ul>
              <p>非經使用者同意或符合法令規定，本網站不會將使用者的個資任意提供或移轉給第三方。</p> <br>

              <p>3.資料保護與安全</p> <br>
              <p>本網站採取合理技術及管理措施，以保障使用者的個人資料安全。如發生資料洩漏事件，本網站將依照法令規定通報主管機關及使用者。</p> <br>

              <p>4.資料保留與刪除</p> <br>
              <p>使用者如有刪除帳戶或特定資料之需求，請洽本網站客服或依本網站公布之程序辦理。但基於法規、契約或資訊安全要求，部分資料可能需保存於系統或備份中一段時間。</p> <br>

              <p class="bold">四、使用者行為準則</p> <br>
              <p>使用者承諾以合法且誠實之方式使用本服務，不得從事違反法律或公序良俗之行為。</p> <br>
              <p>使用者應自行保管帳號與密碼資訊，不得將帳號轉讓或借予他人使用。如有發現未經授權的使用情形，請立即通知本網站。</p> <br>

              <p class="bold">五、免責聲明</p> <br>

              <p>服務可用性與正確性</p> <br>
              <p>本網站盡力維護服務的安全與穩定，惟對於因系統維護、網路壅塞、不可抗力或其他非可歸責於本網站之事由所造成的服務中斷、延遲或資料遺失，本網站不負擔任何賠償責任。</p> <br>

              <p>第三方連結與外部內容</p> <br>
              <p>本網站可能含有連結至外部網站或第三方服務，該等網站或服務並非本網站所管理或控制，使用者應自行判斷並承擔風險。本網站對該第三方網站或服務之內容、政策或行為，不負任何責任。</p> <br>

              <p class="bold">六、智慧財產權</p> <br>
              <p>本網站上所載之文字、圖片、商標、程式碼等智慧財產，除標明為使用者上傳或第三方擁有者外，均歸本網站或其授權人所有。未經本網站或權利人事先同意，使用者不得複製、轉載、改作、轉售或進行任何商業使用。</p> <br>

              <p class="bold">七、條款修改</p> <br>
              <p>本網站有權於任何時間修訂或變更本條款，並於本網站公告修訂後生效。修訂後之條款同樣公佈於本網站，請使用者隨時留意並重新確認。</p> <br>
              <p>若使用者於本條款修訂生效後，仍繼續使用本服務，視為同意接受修訂後之條款。</p> <br>

              <p class="bold">八、準據法與管轄法院</p> <br>
              <p>本條款之解釋與適用，應以台灣法律為準據法。</p> <br>
              <p>因本條款或本服務所生爭議，如經協商不成，雙方同意以台灣之法院為第一審管轄法院。</p> <br>
              <p>如有任何疑問、建議或欲行使個人資料相關權利，歡迎聯繫本網站客服。感謝您使用本服務，並請您確保已詳讀並同意以上內容。</p> <br>
              
            </div>
          </div>
  
          <div class="hcSigh-check checkBox">
            <label class="boxAlign">
                <input type="checkbox" v-model="helperAgree" >
                <p class="smallText">
                  我已詳細閱讀並同意本契約的所有條款與內容，並願意遵守相關規定                    
                </p>
            </label>            

          </div>
  
          <div class="btn-group">
            <Btn btnStyle="primary default" @click="submitAndToggle_hcSign">提交</Btn>
            <Btn btnStyle="baseline default" @click="reloadAndToggle_hcSign">取消</Btn>
          </div>
        </div>
      </LightBox>
      
      <!-- lightbox，小幫手管理 -->
      <LightBox 
        :title="hcManage.title"
        :is-light-box="hcManage.isLightBox.value" 
        @toggle="toggleHcManage">
        <div class="hcManage-wrapper">
          <div class="input-wrapper">
            <!-- 服務地區 -->
            <div class="input-group">
              <label class="smallText">服務地區*</label>
              <div class="inputs zone">
                <DropdownMenu class="service-z"
                  :placeHolder="city.placeHolder"
                  :options="city.options"
                  v-model="selectedCity">
                </DropdownMenu>
                <DropdownMenu class="service-z"
                  :placeHolder="districtPlaceHolder"
                  :options="districtsOptions"
                  v-model="selectDistrict"
                  :key="selectedCity"> 
                </DropdownMenu>
              </div>
            </div>
            <!-- 寵物類型 -->
            <div class="input-group">
              <label class="smallText" for="">寵物類型*</label>
              <div class="inputs">
                <div class="tag-group">
                  <Btn v-for="option in tag_petKind.options" :key="option"
                  btnType="tag" 
                  :class="{'-active': optionSelected(tag_petKind.selected, option)}"
                  @click="tag_petKind.formChoice(tag_petKind.selected, option)">{{ option }}</Btn>
                </div>
                <div class="select-group">

                </div>
              </div>
            </div>
            <!-- 服務時段 -->
            <div class="input-group">
              <label class="smallText" for="">服務時段*</label>
              <div class="inputs service-time">
                <div class="tag-group">
                  <Btn v-for="option in tag_weekDay.options" :key="option"
                  btnType="tag" 
                  :class="{'-active': optionSelected(tag_weekDay.selected, option)}"
                  @click="tag_weekDay.formChoice(tag_weekDay.selected, option)">{{ option }}</Btn>
                </div>
                <div class="select-group">
                  <!-- 開始時間 -->
                  <DropdownMenu
                    class="service-t"
                    :placeHolder="timeStart.placeHolder"
                    :options="timeStart.options"
                    v-model="timeStart.selected"
                  />

                  <p>至</p>

                  <!-- 結束時間 -->
                  <DropdownMenu
                    class="service-t"
                    :placeHolder="timeEnd.placeHolder"
                    :options="timeEnd.options"
                    v-model="timeEnd.selected"
                  />
                </div>
              </div>
            </div>
            <!-- 自介 -->
            <div class="input-group">
              <label class="smallText">自我介紹</label>
              <div class="inputs">
                <InputText
                  :size = "input_selfIntro.size"
                  :textAlign = "input_selfIntro.textAlign"
                  :placeHolder="input_selfIntro.placeHolder"
                  :errorMsg="input_selfIntro.errorMsg"
                  :hasError="input_selfIntro.inputError.value"
                  v-model="input_selfIntro.inputValue.value">
              </InputText>
                <textarea name="" id=""
                rows="5" cols="50"></textarea>
              </div>
            </div>
          </div>
          <div class="btn-group">
            <Btn btnStyle="primary default" @click="submitAndToggle_hcManage">提交</Btn>
            <Btn btnStyle="baseline default" @click="reloadAndToggle_hcManage">取消</Btn>
          </div>
        </div>
      </LightBox>    
  
 
      <!-- lightbox，新增貼文 -->
      <LightBox 
        :title="addPost.title"
        :is-light-box="addPost.isLightBox.value" 
        @toggle="toggleAddpost">
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
      <!-- <PopUp
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
      </PopUp> -->
  
  
      <!-- circle bg -->
      <div class="member-circle"></div>  
  
    </main>
  
    
  </template>
  
<script setup>
  
  import { ref,reactive,computed,watch } from 'vue';
  // components
  import MainHeader from '@/components/MainHeader.vue';
  import Btn from '@/components/Btn.vue';
  import DropdownMenu from '../components/DropdownMenu.vue';
  import InputText from '../components/InputText.vue';
  import LightBox from '../components/LightBox.vue';
  // import PopUp from '../components/PopUp.vue';
  
  // pages
  import memberNav from '../views/memberNav.vue' ;
  import helperPostCard from '../views/helperPostCard.vue';
  
  // 適性測驗
    // 定義題目資料，每個題目包含 id 與題目內容
    const questions = ref([
      { id: 1, text: "看見流浪動物受傷時，我會儘速協助處理，不會冷漠忽視", answer: "" },
      { id: 2, text: "若飼主忽略寵物需要，我會禮貌提醒並提供適度合理建議", answer: "" },
      { id: 3, text: "寵物突發疾病時，我會立即送醫並通知飼主，非自行拖延", answer: "" },
      { id: 4, text: "若飼主遺漏日常照護，我願提供提醒並協助維護寵物健康", answer: "" },
      { id: 5, text: "面對寵物與飼主需求，我會保持充分耐心並展現真誠善意", answer: "" }
    ]);
    
  // lightbox
    const addPost = {
      title: "新增貼文", 
      isLightBox: ref(false),
      };
    const editPost = {
      title: "編輯貼文", 
      isLightBox: ref(false),
      };

    const hcTest = {
      title: "適性測驗", 
      isLightBox: ref(false),
      failReson: '*未通過原因'};
    const hcVarify = {
      title: "資料審核", 
      isLightBox: ref(false),
      failReson: '*未通過原因'};
    const hcSign = {
      title: "合約簽署", 
      isLightBox: ref(false),
      failReson: '*未通過原因'};

    const hcManage = {
      title: "小幫手管理", 
      isLightBox: ref(false),
      };
  
  // 控制lightbox狀態
  const toggleLightBox = (targetBox) =>{
    targetBox.isLightBox.value = !targetBox.isLightBox.value;;
    document.body.classList.toggle('clicked',targetBox.isLightBox.value);
    console.log('觸發關閉');
  };

  // 建立專門的處裡含數->放進要使用的事件中
  const toggleAddpost = () => toggleLightBox(addPost);
  const toggleEditPost = () => toggleLightBox(editPost);
  const toggleHcTest = () => toggleLightBox(hcTest);
  const toggleHcVarify = () => toggleLightBox(hcVarify);
  const toggleHcSign = () => toggleLightBox(hcSign);
  const toggleHcManage = () => toggleLightBox(hcManage);

  // 回傳函數，使之可以在 template 中使用
  // return{
  //   toggleLightBox,
  //   toggleAddpost,
  //   toggleEditPost,
  //   toggleHcTest,
  //   toggleHcVarify,
  //   toggleHcSign,
  //   toggleHcManage
  // };

  // 定義一個反應式對象來儲存每題的答案（key 為題目 id，值為 "yes" 或 "no"）
  // const questions.answer = ref({});
  
  // 提交時，這裡檢查輸出答案
  const handleSubmit = () => {
    // 之後要寫邏輯，用ajax把資料傳給後端
    // 確保輸出的是普通物件
    console.log("提交了");
  };

  // 放棄時，重置所有答案
  const handleCancel = () => {
    // 直接賦值一個新物件，確保 Vue 能偵測變更
    questions.value.forEach( q=>q.answer = "" );
    console.log('重置了')
  };
  const handleCancelHcVarify = () => {
    // 直接賦值一個新物件，確保 Vue 能偵測變
    console.log('重置了')
  };  
  const handleCancelSign = () => {
    // 直接賦值一個新物件，確保 Vue 能偵測變更
    helperAgree.value = false;
    console.log('重置了-取消勾選')
  };  
  
  // 儲存或取消時，依序觸發 兩個事件: 
    // 儲存 + 關掉
    const submitAndToggle_test = () =>{
      checkAndSubmit1();
      handleSubmit();
      toggleHcTest();
    };
    const submitAndToggle_hcVarify = () =>{
      checkAndSubmit2();
      handleSubmit();
    };
    const submitAndToggle_hcSign = () =>{
      checkAndSubmit3();
      handleSubmit();
      toggleHcSign();
    };
    const submitAndToggle_hcManage = () =>{
      handleSubmit();
      toggleHcManage();
    };
    // 重整 + 關掉
    const reloadAndToggle_hcTest = () =>{
        handleCancel();
        toggleHcTest();
        console.log('重置並且關閉');
    };
    const reloadAndToggle_hcVarify = () =>{
        handleCancel();
        toggleHcVarify();
    };
    const reloadAndToggle_hcSign = () =>{
        handleCancelSign();
        toggleHcSign();
    };
    const reloadAndToggle_hcManage = () =>{
        handleCancel();
        toggleHcManage();
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
  
  // 
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
      placeHolder: '輸入自我介紹',
      errorMsg: '請輸入內容',
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
  // 選擇生日 的 dropdown
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
  
  // 身分審核步驟

  // hc-nav
  const step1 = ref(false);
  const step2 = ref(false);
  const step3 = ref(false);
  // 當三個步驟都通過，賦予小幫手身分=>貼文管理的區塊變換
  const stepsCompeleted = computed(()=>{
    return step1.value && step2.value && step3.value;
    });
  // 判斷是否有小幫手身分(通過與否)=> 下方管理小幫手貼文的區塊切換
  const isHelperPassed = computed(() => stepsCompeleted.value);

  // 適性測驗
    // 按下按鈕時，手動觸發"檢查"、"提交"
    const checkAndSubmit1 = ()=>{
      // checkStep1;
      step1.value = questions.value.every( q => q.answer ==='yes' );
      if( step1.value ){
        console.log('step1成立，將結果提交')
      }else{
        console.log('step1不成立，顯示錯誤訊息')
      };        
    };


  // 資料審核
    // 未審核
    let unreviewed = ref(false);
    // 審核中
    let underReview = ref(false);
    const isStep2Passed = computed(()=>{
      return !unreviewed.value && !underReview.value;
    });


    const checkAndSubmit2 = () => {
      const hcVarifyFields = ref({
      name: input_name.inputValue.value,
      birthday: selectedYear.value && selectedMonth.value && selectedDay.value ? `${selectedYear.value}-${selectedMonth.value}-${selectedDay.value}` : "",
      idNumbers: input_idCard.inputValue.value,
      selfy: selfyImg.value,
      idCard: idCardImg.value
      });

      // 檢查是否有欄位空的
      const isInCompolete = Object.values(hcVarifyFields.value).some(value => value=== "")
      
      if( isInCompolete ){
        alert("請完整填寫表單")
        // 中斷執行
        return
      }else{
        // 寫submit

        step2.value = false;    // 確保 step2 初始為 false
        unreviewed.value = true; 
        underReview.value = false; 
        toggleHcVarify();
      };

      console.log("所有欄位都已填寫，可以提交了")
    };  

  // 和約簽署
  const helperAgree = ref(false);
    const checkAndSubmit3 = ()=>{
      // checkStep3;
      step3.value = helperAgree.value;
      if( step3.value ){
        console.log('step3成立，將結果提交')
      }else{
        console.log('step3不成立，顯示錯誤訊息')
      };        
    };


</script>