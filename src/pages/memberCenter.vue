<template>
<MainHeader theme="red" bgc="natural-1"></MainHeader>
<!-- 主內容 -->

<div class="memberCenter">

  <!-- top nav -->
  <div class="topNav">
    <!-- msg & avatar -->
    <div class="msg-n-avatar">
        <!-- avatar -->
        <div class="avatar"></div>
        <!-- msg -->
        <div class="msg-welcome">
        <h5 class="bold">嗨! <span id="msgUsername">username</span> 歡迎回來</h5>
        </div>
    </div>
    <!-- mc nav -->
    <div class="mcNav">
      <div class="btn-wrapper">
        <!-- <RouterLink to="/member-center">
          <Btn btnStyle="white default">會員資料</Btn>
        </RouterLink> -->        
        <Btn btnStyle="white default">會員資料</Btn>
      </div>      
      <div class="btn-wrapper">
        <!-- <RouterLink to="/member-center">
          <Btn btnStyle="white default">寵物資訊卡</Btn>
        </RouterLink> -->
        <Btn btnStyle="white default">寵物資訊卡</Btn>
        <!-- <Btn btnstyle="white default">建立寵物資訊卡</Btn>
        <Btn btnstyle="white default">寵物資訊卡一覽</Btn> -->        
      </div>      
      <div class="btn-wrapper">
        <!-- <RouterLink to="/member-center">
          <Btn btnStyle="white default">寵物盒訂閱紀錄</Btn>
        </RouterLink> -->        
        <Btn btnStyle="white default">寵物盒訂閱紀錄</Btn>
      </div>      
      <div class="btn-wrapper">
        <!-- <RouterLink to="/member-center">
          <Btn btnStyle="white default">小幫手中心</Btn>
        </RouterLink> -->          
        <Btn btnStyle="white default">小幫手中心</Btn> 
      </div>      
        
    </div>
  </div>

  <!-- main content -->

   <!-- 會員資料 -->
  <div class="memberInfo"> <!-- 區塊更新 -->
    <div class="title2">
        <h6 class="bold">會員資料</h6>
        <div class="btn-wr">
          <Btn btnStyle="baseline small" id="memberInfoEdit">編輯</Btn>
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
        
        <div class="popup-basicInfo">
          <!-- close button -->
           <div class="closeBtn-group">
             <button class="close"></button>
           </div>
          <h6 class="bold">會員資料</h6>
          <!-- 頭像 -->
           <div class="card avatars">

            <dvi class="bold card-title">
              <p class="bold">頭像</p>
            </dvi>

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
                    <div class="inp-name">
                      <InputText 
                        placeHolder="" 
                        errorMsg="Invalid Input" 
                        v-model="inputValue" 
                        :hasError="inputError"
                        name="name"
                        id="name"
                        >
                      </InputText>
                    </div>
                </div>
                <div class="input-group">
                    <label for="nickname">暱稱</label>
                    <InputText 
                        placeHolder="" 
                        errorMsg="Invalid Input" 
                        v-model="inputValue" 
                        :hasError="inputError"
                        name="name"
                        id="nickname"
                        >
                      </InputText>
                </div>
                <div class="input-group">
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
                      :placeHolder="請選擇月份" 
                      :options="1">
                      </DropdownMenu>
                      <DropdownMenu
                      :placeHolder="請選擇日期" 
                      :options="1">
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
                    <div class="mc-pu-account">
                      <p>帳戶</p>
                      <InputText 
                        placeHolder="" 
                        errorMsg="Invalid Input" 
                        v-model="inputValue" 
                        :hasError="inputError"
                        name="email"
                        id=""
                        >
                      </InputText>
                    </div>
                    <a href="">變更信箱</a>
                </div>
                <div class="input-group">
                    <div class="mc-pu-password">
                    <p>密碼</p>
                    <div id="inputWrapper" class="input-wrapper">
                      <InputText 
                        placeHolder="" 
                        errorMsg="Invalid Input" 
                        v-model="inputValue" 
                        :hasError="inputError"
                        name="pwd"
                        id=""
                        >
                      </InputText>
                      <!-- eye button -->
                      <!-- <Btn btnStyle="text small" id="mcEye">眼</Btn> -->
                      <button id="mcEye">眼</button>
                    </div>
                    </div>
                    <Btn btnStyle="baseline small">變更密碼</Btn>
                </div>
                <div class="input-group account-state">
                    <p>帳號狀態</p>
                    <InputText 
                        placeHolder="正常" 
                        errorMsg="Invalid Input" 
                        v-model="inputValue" 
                        :hasError="inputError"
                        name=""
                        id=""
                        >
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
                        placeHolder="輸入手機" 
                        errorMsg="Invalid Input" 
                        v-model="inputValue" 
                        :hasError="inputError"
                        name="phone"
                        id=""
                        >
                      </InputText>
                </div>
                <div class="input-group">
                    <p>聯絡地址</p>
                    <InputText 
                        placeHolder="輸入地址" 
                        errorMsg="Invalid Input" 
                        v-model="inputValue" 
                        :hasError="inputError"
                        name=""address
                        id=""
                        >
                      </InputText>
                </div>
                <div class="input-group">
                    <p>LineID</p>
                    <div class="lineid-wrapper">
                      <InputText 
                        placeHolder="lineID" 
                        errorMsg="Invalid Input" 
                        v-model="inputValue" 
                        :hasError="inputError"
                        name="lineId"
                        id="lineId"
                        >
                      </InputText>
                    <p id="lineidnotice">*未提供Line ID 將無法使用 認識新毛友 和 尋找小幫手</p>
                    </div>
                </div>
              </div>
          </div>
          <div class="pu-btn-group">
              <div>
                <Btn btnStyle="primary default">儲存</Btn>
              </div>
              <div>
                <Btn btnStyle="baseline default">取消修改</Btn>
              </div>
          </div>

        </div>

    </div>



  </div>

   <!-- 檢視寵物卡 -->
  <div class="petcardView">
    <div class="petcard-title">
        <h6 class="bold">寵物資訊卡</h6>
        <smallText>目前有2張資訊卡</smallText>
    </div>

    <div class="divider"></div>

    <!-- view ver1 -->
    <div class="petcard-container">
        <!-- card1 -->
        <div class="petcard">
          <div class="ptc-top">
              <!-- 元件 -->
          </div>
          <div class="ptc-btn-group">
            <Btn btnStyle="primary default" id="deletePetCard">編輯</Btn>
            <div class="btn-group">
              <Btn btnStyle="baseline small" id="editPetCard">刪除卡片</Btn>
              <Btn btnStyle="baseline small" id="editPetCard">配對喜好設定</Btn>
            </div>
          </div>
        </div>
          <!-- card2 -->
        <div class="petcard">
          <div class="ptc-top">
              <!-- 元件 -->
          </div>
          <div class="ptc-btn-group">
            <Btn btnStyle="primary default" id="deletePetCard">編輯</Btn>
            <div class="btn-group">
              <Btn btnStyle="baseline small" id="editPetCard">刪除卡片</Btn>
              <Btn btnStyle="baseline small" id="editPetCard">配對喜好設定</Btn>
            </div>
          </div>
        </div>
          <!-- card3 -->
        <div class="petcard" id="addPetCard">
          <div class="" id="addPetCardBtn">
            <Btn btnStyle="baseline small">+ 狗狗資訊卡</Btn>
            <Btn btnStyle="baseline small">+ 貓貓資訊卡</Btn>
          </div>
        </div>           
    </div>

  </div>

   <!-- 訂閱紀錄 -->
  <div class="subRecord">

    <!-- recently sub -->
    <div class="sub-recently">
      <div class="sr-title">
        <h6 class="bold">當前方案</h6>
        <smallText>目前有n個訂閱</smallText>
      </div>

      <div class="divider"></div>

      <div class="sr-slider">
          <div class="cards-container">
               <!-- v-for -->
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                       <!-- cardData? -->
                      <div class="srItems">
                        <smallText>訂閱方案</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 銀卡 (3個月方案)</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>訂閱日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 2025/01/02</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>配送日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 每月10日</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>已配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 0</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>剩餘配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 3</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>金額</smallText>
                         <!-- 連結資料庫 -->
                        <smallText class="bold"> $ 1299</smallText>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div>
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                       <!-- cardData? -->
                      <div class="srItems">
                        <smallText>訂閱方案</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 銀卡 (3個月方案)</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>訂閱日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 2025/01/02</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>配送日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 每月10日</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>已配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 0</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>剩餘配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 3</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>金額</smallText>
                         <!-- 連結資料庫 -->
                        <smallText class="bold"> $ 1299</smallText>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div> 
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                       <!-- cardData? -->
                      <div class="srItems">
                        <smallText>訂閱方案</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 銀卡 (3個月方案)</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>訂閱日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 2025/01/02</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>配送日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 每月10日</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>已配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 0</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>剩餘配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 3</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>金額</smallText>
                         <!-- 連結資料庫 -->
                        <smallText class="bold"> $ 1299</smallText>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div> 
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                       <!-- cardData? -->
                      <div class="srItems">
                        <smallText>訂閱方案</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 銀卡 (3個月方案)</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>訂閱日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 2025/01/02</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>配送日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 每月10日</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>已配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 0</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>剩餘配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 3</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>金額</smallText>
                         <!-- 連結資料庫 -->
                        <smallText class="bold"> $ 1299</smallText>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div> 
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                       <!-- cardData? -->
                      <div class="srItems">
                        <smallText>訂閱方案</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 銀卡 (3個月方案)</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>訂閱日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 2025/01/02</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>配送日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 每月10日</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>已配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 0</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>剩餘配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 3</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>金額</smallText>
                         <!-- 連結資料庫 -->
                        <smallText class="bold"> $ 1299</smallText>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div> 
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                       <!-- cardData? -->
                      <div class="srItems">
                        <smallText>訂閱方案</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 銀卡 (3個月方案)</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>訂閱日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 2025/01/02</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>配送日期</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 每月10日</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>已配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 0</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>剩餘配送次數</smallText>
                         <!-- 連結資料庫 -->
                        <smallText> 3</smallText>
                      </div>
                      <div class="srItems">
                        <smallText>金額</smallText>
                         <!-- 連結資料庫 -->
                        <smallText class="bold"> $ 1299</smallText>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div> 
          </div>
      </div>
    </div>

    <!-- history sub -->
    <div class="sub-history">

      <div class="sh-title">
        <h6 class="bold">歷史紀錄</h6>
        <smallText></smallText>
      </div>

      <div class="divider"></div>

      <div class="sh-h">
        <div class="sh-h-title">
          <smallText class="bold">索引</smallText>
          <smallText class="bold">寵物名稱</smallText>
          <smallText class="bold">定月方案</smallText>
          <smallText class="bold">訂閱日期</smallText>
          <smallText class="bold">金額</smallText>
        </div>
        <div class="sh-h-content">
          <!-- v-for -->
          <div class="sh-h-items">
            <smallText>01</smallText>
            <smallText>小白</smallText>
            <smallText>銀卡(三個月)</smallText>
            <smallText>2024/01/15</smallText>
            <smallText>$300</smallText>
          </div>
          <div class="sh-h-items">
            <smallText>01</smallText>
            <smallText>小白</smallText>
            <smallText>銀卡(三個月)</smallText>
            <smallText>2024/01/15</smallText>
            <smallText>$300</smallText>
          </div>

        </div>
      </div>

          
    </div> 
        
  </div>

   <!-- 小幫手中心 -->
    <!-- v-if : 審核判斷 -->
    <div class="helperCenter">
      <!-- hc : helper-center -->

      <!-- 無身分 -->
      <div class="hc-not-passed">

        <div class="hc-title">
          <h6 class="bold">想成為小幫手嗎？簡單四步驟成為最可靠的小幫手</h6>
        </div>

        <div class="hc-nav">
            <!-- v-if? : 每完成一個步驟就放上打勾的icon? -->
            <div class="hc-steps"> 
              <smallText>適性測驗</smallText>
              <smallText class="helperCenter-status">(已完成)</smallText>
            </div>
            <div class="hc-steps">
              <smallText>資料審核</smallText>
              <smallText class="helperCenter-status">(已審核)</smallText>
            </div>
            <div class="hc-steps">
              <smallText>合約簽署</smallText>
              <smallText class="helperCenter-status">(已簽署)</smallText>
            </div>
            <div class="hc-steps">
              <smallText>小幫手管理</smallText>
              <smallText class="helperCenter-status" style="display: none;">(已審核)</smallText>
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

      <!-- 有身分 -->
      <div class="hc-post-manage">
          <h6 class="bold">貼文發布管理</h6>

          <div class="divider"></div>

          <div class="hc-m-container">
            <div class=""></div>
            <div></div>
            <div></div>
            <div></div>
          </div>          

        </div>     
    </div>


</div>
</template>

<script setup>
  import { ref } from 'vue';

  import MainHeader from '../components/MainHeader.vue';
  import Btn from '../components/Btn.vue';
  import DropdownMenu from '../components/DropdownMenu.vue';
  import InputText from '../components/InputText.vue';
  import LightBox from '../components/LightBox.vue';

//data
// const 
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
</script>

