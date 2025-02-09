<!-- Ian -->
<template>

    <div v-if="isLightBox" class="lightBox" :class="[{clicked:isLightBox}]">
        <div class="lightBoxContent">
            <div class="closeBtnBox">
                <!-- <div class="closeBtn" @click="policy">
                    <img src="@/assets/img/icon/close.svg" alt="closeIcon">
                </div> -->
            </div>
            <div class="introTitle">
                <h4 class="bold">{{ title }}</h4>
            </div>
            <div class="overflowBox">
                <div class="overflow">
                    <!-- 使用者政策 -->
                    <div v-if="ispolicyInfo">
                        <h6>使用者政策</h6>
                        <p>在您開始使用 SPLOOT 所經營之網站之前，請詳細閱讀以下所有服務條款：
                        當您成為 SPLOOT 網站的會員時，即表示您已詳細閱讀、明確瞭解並同意接受本服務條款之所有內容。
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
                        若您有任何問題與疑慮，煩請與 SPLOOT 進行聯繫。</p>
                        <Btn @click="policy" class="padding" btnStyle="primary default">同意</Btn>
                    </div>

                    <!-- 隱私權政策 -->
                    <div v-if="isprivacyInfo">
                        <h6>隱私權政策</h6>
                        <p>歡迎您使用 SPLOOT（以下簡稱「本公司」）係依據本服務條款提供 SPLOOT (http://www.sploot.co) 服務（以下簡稱「本服務」），為了讓您能夠安心的使用本網站的各項服務與資訊，特此向您說明本網站的隱私權保護政策，以保障您的權益，請您詳閱下列內容：</p>
                        <p class="bold">一、隱私權保護政策的適用範圍</p>
                        <p>隱私權保護政策內容，包括本網站如何處理您在使用網站服務時收集到的個人識別資料。隱私權保護政策不適用於其他相關連結的網站，也不適用於非本網站所委託或參與管理的人員。</p>
                        <p class="bold">二、個人資料的蒐集、處理及利用方式</p>
                        <p>當您造訪本網站或使用本網站所提供之功能服務時，我們將視該服務功能性別，請您提供必要的個人資料，並於特定目的範圍內處理及使用您的個人資料；未經您的書面同意，將不會將個人資料用於其他用途。
                        本網站在您使用服務信箱、填寫問卷、參加活動時，會保存您所提供的姓名、電子郵件信箱、聯絡方式及使用時間等。
                        於一般瀏覽時，伺服器會自行記錄相關行為，包括您使用連線設備之IP位址、使用時間、瀏覽器及點擊紀錄等，做為我們增進網站服務的參考依據，此記錄為內部應用，決不對外公開。</p>
                        <p class="bold">三、資料之保護</p>
                        <p>本網站主機均設有防火牆、反病毒系統及其他相關的資訊安全設備及必要的安全防護措施，對於本網站及您的個人資料加以嚴格保護。
                        未經授權之人員不得接觸您的個人資料，且所有接觸之人員均經簽署保密契約，違反保密義務者將受到相關法律處分。</p>
                        <Btn @click="policy" class="padding" btnStyle="primary default">同意</Btn>              
                    </div>
                </div>        
            </div>
        </div>
    </div>
    
    <div class="blackCover" :class="{clicked:isLightBox}"></div>

 </template>
 
 <script setup>
   import { defineProps, defineEmits, computed } from 'vue';

   import Btn from '@/components/Btn.vue'
    
    const props = defineProps({
        isLightBox: {
            type: Boolean,
            required: true,
        },
        title:{
            type: String,
            required: true,
        },
        policies:{
            type:String,
            required: true,
        }        
    })


    const ispolicyInfo =computed(() => props.policies ==="policyInfo");
    const isprivacyInfo =computed(() => props.policies ==="privacyInfo");
    
  
    const emit = defineEmits(['toggle']);

    function policy(){
    emit('toggle');
    }

    
 
 </script>
 
 