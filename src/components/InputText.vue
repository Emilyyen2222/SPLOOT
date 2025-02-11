<template>
  <div class="inputBox" :class="{'-error': hasError}">

    <input v-if="inputType === 'text'"
    :type="textType"
    :class="[textAlign, size]"
    :placeholder="placeHolder"
    :maxlength="maxlength"
    v-model="inputText"> 


    <textarea v-if="inputType == 'textarea'"
    :class="[textAlign, size]"
    :placeholder="placeHolder"
    :maxlength="maxlength"
    v-model="inputText">
    </textarea>   

    
    <p v-if="hasError" class="errorMsg"
      :class="textAlign">{{ errorMsg }}</p>
  </div>
</template>

<script setup>
  import { ref, defineProps, defineEmits } from 'vue';

  const props = defineProps({
  
    textType: { //Ian
      type: Number,
      default: 'text'
    },
    maxlength: { //Ian
      type: Number,
    },
    size: {
      type: String,
    },
    textAlign: {
      type: String,
      default: 'textLeft'
    },
    inputType: {
      type: String,
      default: 'text'
    },
    placeHolder: {
      type: String,
      required: true,
    },
    errorMsg: {
      type: String,
      default: 'Invalid Input'
    },
    hasError: {
      type: Boolean,
      default: false
    },
  });

  const inputText = defineModel();
</script>
