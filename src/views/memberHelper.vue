
<template>
<MainHeader theme="red" bgc="natural-1"></MainHeader>
<!-- 主內容 -->
  <main class="whole-bg">
    <!-- top nav -->
    <memberNav/>
  
    <!-- v-if : 審核判斷 -->
    <div class="helperCenter">
      <!-- hc : helper-center -->
  
      <!-- 無身分 -->
      <div class="hc-not-passed">
    
        <div class="hc-title">
          <h6 class="bold">想成為小幫手嗎？簡單四步驟成為最可靠的小幫手</h6>
          <Btn btnStyle="outline small" @click="toggleLightBox_hcManage">小幫手管理</Btn>
        </div>
    
        <div class="hc-nav">
            <!-- v-if? : 每完成一個步驟就放上打勾的icon? -->
            <div class="hc-steps" @click="toggleLightBox_hcTest"> 
              <p>適性測驗</p>
              <p class="hc-status">(已完成)</p>
            </div>
            <div class="hc-steps" @click="toggleLightBox_hcVarify">
              <p>資料審核</p>
              <p class="hc-status">(已審核)</p>
            </div>
            <div class="hc-steps" @click="toggleLightBox_hcSign">
              <p>合約簽署</p>
              <p class="hc-status">(已簽署)</p>
            </div>
    
        </div>
        
        <div class="hc-post-manage">
          <h6 class="bold">貼文發布管理</h6>
    
          <div class="divider"></div>
    
          <div class="hc-msg">
            <p>通過小幫手認證後才可以管理貼文喔~</p>
          </div>          
    
        </div>
    
    
      </div>
    
      <!-- 有身分 ，貼文管理-->
      <div class="hc-passed">
        <div class="hc-post-manage">
    
          <h6 class="bold">貼文發布管理</h6>
    
          <div class="divider"></div>
    
          <div class="hc-grid-container">
            <!-- 1 -->
            <div class="hc-postCard" id="hcPostBuddy">
              <helperPostCard class="helperPostCard"/>
              <div class="hc-btn-group">
                <Btn btnStyle="primary default" id="editPostCard" @click="toggleLightBox_editPost">編輯</Btn>                
                <Btn btnStyle="baseline small" id="deletePostCard" @click="togglePopUp_deleteCard">刪除貼文</Btn>            
              </div>                
              
            </div>
            <!-- 2 -->
            <div class="hc-postCard empty" id="hcPostCare">     <!-- 之後 empty 改用監聽加上watch -->
              <div class="btn-group">
                <Btn btnStyle="baseline small" @click="toggleLightBox_addPost">+ 到府照顧</Btn>
              </div>
            </div>
            <!-- 3 -->
            <div class="hc-postCard empty" id="hcPostStay">
              <div class="btn-group">
                <Btn btnStyle="baseline small" @click="toggleLightBox_addPost">+ 友善寄宿</Btn>
              </div>                
            </div>
            <!-- 4 -->
            <div class="hc-postCard empty" id="hcPostUber">
              <div class="btn-group">
                <Btn btnStyle="baseline small" @click="toggleLightBox_addPost">+ 到府接送</Btn>
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
      @toggle="toggleLightBox_hcTest">
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
                  v-model="answers[question.id]"
                />
                是
              </label>
              <label>
                <input
                  type="radio"
                  :name="'question' + question.id"
                  value="no"
                  v-model="answers[question.id]"
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
      @toggle="toggleLightBox_hcVarify">
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
          </div>        
          <!-- 生日 -->
          <div class="input-group birthday">
              <label for="">生日</label>
              <div class="select-group">
                <DropdownMenu
                :placeHolder="menu_birth_y.placeHolder" 
                :options="menu_birth_y.options.value"
                class="dropBirthday">             
                </DropdownMenu>                
                <DropdownMenu
                :placeHolder="menu_birth_m.placeHolder" 
                :options="menu_birth_m.options.value"
                class="dropBirthday">
                </DropdownMenu>
                <DropdownMenu
                :placeHolder="menu_birth_d.placeHolder" 
                :options="menu_birth_d.options"
                class="dropBirthday">
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
          <div class="selfy">
            <p>正面自拍照</p>
            <div class="upload-area">
              <img v-if="imagePreview" :src="imagePreview" alt="預覽圖片">
              <p>上傳個人自拍照</p>
            </div>
            <Btn btnStyle="primary default" @click="triggerFileInput">上傳檔案</Btn>
            <input 
            type="file" 
            ref="fileInput" 
            style="display: none" 
            accept="image/*" 
            @change="handleFileChange" />
            <smallText>* 請提供2年內正面且清晰的個人照，可清楚辨識為身分證件上之同一人，方能通過審核。</smallText>
          </div>
          <div class="idCard">
            <p>身分證圖檔(正面)</p>
            <div class="upload-area">
              <img src="" alt="">
              <p>上傳身分證正面</p>
            </div>
            <Btn btnStyle="primary default" @click="triggerFileInput">上傳檔案</Btn>
            <input 
            type="file" 
            ref="fileInput" 
            style="display: none" 
            accept="image/*" 
            @change="handleFileChange" />
          </div>
        </div>
        
        <div class="btn-group">
            <Btn btnStyle="primary default" @click="submitAndToggle_hcVarify">提交</Btn>
            <Btn btnStyle="baseline default" @click="reloadAndToggle_hcVarify">取消</Btn>
        </div>      
      </div>
    </LightBox>
    
    <!-- lightbox，合約簽署 -->
    <LightBox 
      :title="hcSign.title"
      :is-light-box="hcSign.isLightBox.value" 
      @toggle="toggleLightBox_hcSign">
      <div class="hcSign-wrapper">
        <div class="hc-terms"> 
          <pre class="content">
            歡迎您使用本網站（以下稱「本網站」或「本平台」）。在註冊或使用本網站所提供之服務前，請詳細閱讀以下使用者條款（以下稱「本條款」）。一旦您註冊或使用本網站，即表示您已閱讀、了解並同意遵守本條款。

            一、適用範圍
            本條款適用於本網站所提供之所有功能、資訊與服務（以下合稱「本服務」）。
            若本條款與本網站所公告的其他規定（例如隱私權政策、活動辦法等）有不一致之處，則依該其他規定或活動辦法為準，但限於該規定或活動辦法所涉之特定範圍內。

            二、使用資格
            使用者應確保於註冊或使用本服務時，具備法律上之行為能力；若使用者為未成年人，應在法定代理人（父母或監護人）同意下使用本服務。
            使用者應提供真實、正確的個人或公司資訊。如因提供不實資料導致任何爭議、損失，概由使用者自行承擔責任。

            三、資料使用條款
            1. 資料提供與蒐集
            使用者在使用本服務時，可能會主動提供個人或寵物相關資訊（包含但不限於姓名、聯絡方式、寵物資料等）。本網站將根據使用者提供之資料與下文所列範圍進行蒐集與使用。
            使用者同意本網站依照相關法律及本條款，對該等資料進行保存、處理及使用。
            2. 資料使用目的
            本網站蒐集之資料，將主要用於提供與改進服務功能，例如：
            會員身份驗證與管理
            分析與優化使用者體驗
            提供個人化的推薦、廣告與行銷內容
            進行統計與研究以優化本服務
            非經使用者同意或符合法令規定，本網站不會將使用者的個資任意提供或移轉給第三方。
            3. 資料保護與安全
            本網站採取合理技術及管理措施，以保障使用者的個人資料安全。如發生資料洩漏事件，本網站將依照法令規定通報主管機關及使用者。
            資料保留與刪除
            使用者如有刪除帳戶或特定資料之需求，請洽本網站客服或依本網站公布之程序辦理。但基於法規、契約或資訊安全要求，部分資料可能需保存於系統或備份中一段時間。

            四、使用者行為準則
            使用者承諾以合法且誠實之方式使用本服務，不得從事違反法律或公序良俗之行為。
            使用者應自行保管帳號與密碼資訊，不得將帳號轉讓或借予他人使用。如有發現未經授權的使用情形，請立即通知本網站。

            五、免責聲明
            服務可用性與正確性
            本網站盡力維護服務的安全與穩定，惟對於因系統維護、網路壅塞、不可抗力或其他非可歸責於本網站之事由所造成的服務中斷、延遲或資料遺失，本網站不負擔任何賠償責任。
            本網站內的資訊、功能等，由合作夥伴或使用者自行提供，若該資訊不正確、誤導或有漏失，請使用者斟酌自身需求判斷並自行承擔風險。本網站對於此類內容之正確性、完整性及可靠性不負擔保責任。
            第三方連結與外部內容
            本網站可能含有連結至外部網站或第三方服務，該等網站或服務並非本網站所管理或控制，使用者應自行判斷並承擔風險。本網站對該第三方網站或服務之內容、政策或行為，不負任何責任。
            間接或衍生損失
            本網站對於使用者因使用本服務所導致的間接性、衍生性、懲罰性損害或利潤損失，無論是否已事先知悉該風險，均不承擔賠償責任。

            六、智慧財產權
            本網站上所載之文字、圖片、商標、程式碼等智慧財產，除標明為使用者上傳或第三方擁有者外，均歸本網站或其授權人所有。未經本網站或權利人事先同意，使用者不得複製、轉載、改作、轉售或進行任何商業使用。
            使用者於本網站上傳或分享之內容，其智慧財產權歸屬使用者所有，但使用者同意授權本網站在合理範圍內使用、改編或展示該內容，以進行宣傳、研究分析或服務優化。

            七、條款修改
            本網站有權於任何時間修訂或變更本條款，並於本網站公告修訂後生效。修訂後之條款同樣公佈於本網站，請使用者隨時留意並重新確認。
            若使用者於本條款修訂生效後，仍繼續使用本服務，視為同意接受修訂後之條款。

            八、準據法與管轄法院
            本條款之解釋與適用，應以台灣法律為準據法。
            因本條款或本服務所生爭議，如經協商不成，雙方同意以台灣之法院為第一審管轄法院。
            如有任何疑問、建議或欲行使個人資料相關權利，歡迎聯繫本網站客服。感謝您使用本服務，並請您確保已詳讀並同意以上內容。
          </pre>
        </div>

        <div class="hcSigh-check">
          <label class="check-content">
            <input type="checkbox">
            我已詳細閱讀並同意本契約的所有條款與內容，並願意遵守相關規定
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
      @toggle="toggleLightBox_hcManage">
      <div class="hcManage-wrapper">
        <div class="input-wrapper">
          <div class="input-group">
            <label for="">服務地區*</label>
            <div class="inputs">
              <!-- <DropdownMenu
              :placeHolder="menu1.placeHolder" 
              :options="menu1.options"></DropdownMenu>
              <DropdownMenu
              :placeHolder="menu1.placeHolder" 
              :options="menu1.options"></DropdownMenu> -->
            </div>
          </div>
          <div class="input-group">
            <label for="">寵物類型*</label>
            <div class="inputs"></div>
          </div>
          <div class="input-group">
            <label for="">服務時段*</label>
            <div class="inputs"></div>
          </div>
          <div class="input-group">
            <label for="">自我介紹</label>
            <div class="inputs">
              <textarea name="" id=""></textarea>
            </div>
          </div>
        </div>
        <div class="btn-group">
          <Btn btnStyle="primary default" @click="submitAndToggle_hcManage">提交</Btn>
          <Btn btnStyle="baseline default" @click="reloadAndToggle_hcManage">取消</Btn>
        </div>
      </div>
    </LightBox>    


    <!-- PopUp，刪除卡片 -->
    <PopUp
    :is-pop-up="deleteCard.isPopUp.value"
    @toggle="togglePopUp_deleteCard">
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

    <!-- lightbox，新增貼文 -->
    <LightBox 
      :title="addPost.title"
      :is-light-box="addPost.isLightBox.value" 
      @toggle="toggleLightBox_addPost">
    </LightBox>
    <!-- lightbox，編輯貼文 -->
    <LightBox 
      :title="editPost.title"
      :is-light-box="editPost.isLightBox.value" 
      @toggle="toggleLightBox_editPost">
    </LightBox>
    


    <!-- circle bg -->
    <div class="member-circle"></div>  

  </main>

  
</template>

<script setup>

import { reactive,ref,computed } from 'vue';
// components
import MainHeader from '@/components/MainHeader.vue';
import Btn from '@/components/Btn.vue';
import DropdownMenu from '../components/DropdownMenu.vue';
import InputText from '../components/InputText.vue';
import LightBox from '../components/LightBox.vue';
import PopUp from '../components/PopUp.vue';

// pages
import memberNav from '../views/memberNav.vue' ;
import helperPostCard from '../views/helperPostCard.vue';

// 適性測驗
  // 定義題目資料，每個題目包含 id 與題目內容
  const questions = ref([
    { id: 1, text: "看見流浪動物受傷時，我會儘速協助處理，不會冷漠忽視" },
    { id: 2, text: "若飼主忽略寵物需要，我會禮貌提醒並提供適度合理建議" },
    { id: 3, text: "寵物突發疾病時，我會立即送醫並通知飼主，非自行拖延" },
    { id: 4, text: "若飼主遺漏日常照護，我願提供提醒並協助維護寵物健康" },
    { id: 5, text: "面對寵物與飼主需求，我會保持充分耐心並展現真誠善意" }
  ]);

  // 定義一個反應式對象來儲存每題的答案（key 為題目 id，值為 "yes" 或 "no"）
  const answers = reactive({});

  // 提交時，這裡只是示範輸出答案
  const handleSubmit = () => {
    // 之後要用ajax把資料傳給後端
    console.log("問卷答案：", answers);
  };

  // 放棄時，重置所有答案
  const handleCancel = () => {
    for (const key in answers) {
      answers[key] = '';
    }
  };

// lightbox
  const addPost = {title: "新增貼文", isLightBox: ref(false)};
  const editPost = {title: "編輯貼文", isLightBox: ref(false)};
  const hcTest = {title: "適性測驗", isLightBox: ref(false)};
  const hcVarify = {title: "資料審核", isLightBox: ref(false)};
  const hcSign = {title: "合約簽署", isLightBox: ref(false)};
  const hcManage = {title: "小幫手管理", isLightBox: ref(false)};

// 控制lightbox狀態
  // 適性測驗
  function toggleLightBox_hcTest() {
    hcTest.isLightBox.value = !hcTest.isLightBox.value;
    if(hcTest.isLightBox.value){
      document.body.classList.add('clicked');
    }else{
      document.body.classList.remove('clicked');
    }
  };
  // 資料審核
  function toggleLightBox_hcVarify() {
    hcVarify.isLightBox.value = !hcVarify.isLightBox.value;
    if(hcVarify.isLightBox.value){
      document.body.classList.add('clicked');
    }else{
      document.body.classList.remove('clicked');
    }
  };
  // 合約簽署
  function toggleLightBox_hcSign() {
    hcSign.isLightBox.value = !hcSign.isLightBox.value;
    if(hcSign.isLightBox.value){
      document.body.classList.add('clicked');
    }else{
      document.body.classList.remove('clicked');
    }
  };
  // 小幫手管理
  function toggleLightBox_hcManage() {
    hcManage.isLightBox.value = !hcManage.isLightBox.value;
    if(hcManage.isLightBox.value){
      document.body.classList.add('clicked');
    }else{
      document.body.classList.remove('clicked');
    }
  };

    // 新增貼文
  function toggleLightBox_addPost() {
    addPost.isLightBox.value = !addPost.isLightBox.value;
    if(addPost.isLightBox.value){
      document.body.classList.add('clicked');
    }else{
      document.body.classList.remove('clicked');
    }
  };
  // 編輯貼文
  function toggleLightBox_editPost() {
    editPost.isLightBox.value = !editPost.isLightBox.value;
    if(editPost.isLightBox.value){
      document.body.classList.add('clicked');
    }else{
      document.body.classList.remove('clicked');
    }
  };

  // 依序觸發 兩個事件: 
   // 儲存 + 關掉
    const submitAndToggle_test = () =>{
      handleSubmit();
      toggleLightBox_hcTest();
    };
    const submitAndToggle_hcVarify = () =>{
      handleSubmit();
      toggleLightBox_hcVarify();
    };
    const submitAndToggle_hcSign = () =>{
      handleSubmit();
      toggleLightBox_hcSign();
    };
    const submitAndToggle_hcManage = () =>{
      handleSubmit();
      toggleLightBox_hcManage();
    };
   // 重整 + 關掉
   const reloadAndToggle_hcTest = () =>{
        handleSubmit();
        toggleLightBox_hcTest();
    };
    const reloadAndToggle_hcVarify = () =>{
        handleSubmit();
        toggleLightBox_hcVarify();
    };
    const reloadAndToggle_hcSign = () =>{
        handleSubmit();
        toggleLightBox_hcSign();
    };
    const reloadAndToggle_hcManage = () =>{
        handleSubmit();
        toggleLightBox_hcManage();
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
// 上傳檔案
const fileInput = ref(null);

const triggerFileInput = () => {
  fileInput.value?.click();
};

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    console.log("選擇的檔案：", file.name);
    // 可以在這裡進行上傳處理
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

//
const hcVarify_submit = () => {
  console.log('yyy');
}




</script>