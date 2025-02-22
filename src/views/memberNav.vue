
<template>

  <!-- top nav -->
  <div class="topNav">
    <!-- msg & avatar -->
    <div class="msg-n-avatar">
        <!-- avatar -->
        <div class="avatar">
          <img :src="memberPortrait" alt="avatar">
        </div>
        <!-- msg -->
        <div class="msg-welcome">
        <h5 class="bold">嗨! <span id="msgUsername">{{ inputs.input_nickname.inputValue }}</span> 歡迎回來</h5>
        </div>
    </div>
    <!-- mc nav -->
    <div class="mcNav">
      <div class="btn-wrapper">
        <RouterLink to='/member-center' custom v-slot="{navigate, isActive}">
          <Btn :btnStyle="isActive ? 'primary default' : 'white default'" 
          @click="navigate" 
          class="mcNav-btn"
          >會員資料</Btn>
        </RouterLink>        
      </div>      
      <div class="btn-wrapper">
        <RouterLink to="/member-center/petcard" custom v-slot="{navigate, isActive}">
          <Btn :btnStyle="isActive ? 'primary default' : 'white default'" 
          @click="navigate" 
          class="mcNav-btn">寵物資訊卡</Btn>
        </RouterLink>
      </div>      
      <div class="btn-wrapper">
        <RouterLink to="/member-center/subscription" custom v-slot="{navigate, isActive}">
          <Btn :btnStyle="isActive ? 'primary default' : 'white default'" 
          @click="navigate" 
          class="mcNav-btn">寵物盒訂閱紀錄</Btn>
        </RouterLink>        
      </div>      
      <div class="btn-wrapper">
        <RouterLink to="/member-center/helper" custom v-slot="{navigate, isActive}">
          <Btn :btnStyle="isActive ? 'primary default' : 'white default'" 
          @click="navigate" 
          class="mcNav-btn">小幫手中心</Btn>
        </RouterLink>          
      </div>      
        
    </div>
  </div>       

</template>

<script setup>

import { ref, computed, reactive } from 'vue';

// components
import Btn from '../components/Btn.vue';

  // // username
  // const userName = ref(
  //   {name: 'Hao'},
  // )

const props = defineProps({
  avatar: {
    type: Number,
    default: 1
  }
})

const memberPortrait = computed(()=> {      
        // console.log("帶進switch的值:", props.avatar);
        switch (props.avatar){
          case 1 : 
            return new URL(`@/assets/img/member-center/portrait1.svg`,import.meta.url).href;
          case 2 : 
            return new URL(`@/assets/img/member-center/portrait2.svg`,import.meta.url).href;
          case 3 : 
            return new URL(`@/assets/img/member-center/portrait3.svg`,import.meta.url).href;
          case 4 : 
            return new URL(`@/assets/img/member-center/portrait4.svg`,import.meta.url).href;
          case 5 : 
            return new URL(`@/assets/img/member-center/portrait5.svg`,import.meta.url).href;
          case 6 : 
            return new URL(`@/assets/img/member-center/portrait6.svg`,import.meta.url).href;
          case 7 : 
            return new URL(`@/assets/img/member-center/portrait7.svg`,import.meta.url).href;
          case 8 : 
            return new URL(`@/assets/img/member-center/portrait8.svg`,import.meta.url).href;
          default:
            return new URL(`@/assets/img/member-center/portrait1.svg`,import.meta.url).href;
        };
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

const inputs = reactive({
    // input1: { placeHolder: '輸入預設文字' , errorMsg : '請輸入正確格式的'},
    input_firstName: { placeHolder: '輸入姓名',inputValue : ref('') },
    input_lastName: { placeHolder: '輸入姓名' ,inputValue : ref('')},
    input_nickname: { placeHolder: '輸入暱稱' ,inputValue : ref('')},
  });

  // 統一設定每個 inputText 的預設屬性，避免重複
  Object.keys(inputs).forEach(key => {
    inputs[key] = {
      ...inputs[key],
      size: 'small',
      textAlign: 'textLeft',
      errorMsg: '請輸入正確格式',
      hasError: ref(false)
    };
  });

// 撈資料 顯示
async function showMemberInfoPhp() {
        const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/showMemberInfo.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        try{
          const memberInfo = await resp.json();

          inputs.input_firstName.inputValue = memberInfo['firstName'];
          inputs.input_lastName.inputValue = memberInfo['lastName'];
          inputs.input_nickname.inputValue = memberInfo['nickname'];

          // memberPortrait = memberInfo['portrait'];
          // console.log(memberPortrait)
        } catch (error){
          console.error('Error parsing JSON:', error);
        }
      }

      showMemberInfoPhp();

</script>