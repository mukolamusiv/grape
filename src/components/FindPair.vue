<template>
  <section class="wrap" v-if="!data.questionsEnd && data.pairs" @click="data.stateAnswer = false">
    <div class="test animate__animated animate__zoomIn" :class="{'opacity' : data.stateAnswer !== false}">
      <div class="close">
        <span class="material-icons c-pointer cancel" @click="store.ui.lessonTab = 'video'">disabled_by_default</span>
      </div>
      <div class="question">
        Підбери пару
      </div>
      <div class="pairs">
        <div class="pairs-item"  v-for="(pair, index) in data.pairs" v-bind:key="pair.id" :class="{'selected' : pair.selected }" @click="selectItem(index)" v-show="!pair.hidden">
          <img :src="pair.image_src"  v-if="pair.image_src">
          <div class="text">
            {{pair.text}}
          </div>
        </div>
      </div>
    </div>
    <div class="message-answer wrong-answer animate__animated animate__bounceIn" v-if="data.stateAnswer === 'wrong'">
      <div class="message">:( Нажаль відповідь невірна!</div>
      <img src="@/assets/img/sad.png" alt="Grape">
    </div>
    <div class="message-answer right-answer animate__animated animate__bounceIn" v-if="data.stateAnswer === 'right'">
      <div class="message">:) Молодець, відповідь вірна!</div>
      <img src="@/assets/img/right.png" alt="Grape">
    </div>
  </section>
  <section class="wrap" v-if="data.questionsEnd">
    <div class="test questions-end">
      <div class="close">
        <span class="material-icons c-pointer cancel" @click="store.ui.lessonTab = 'video'">disabled_by_default</span>
      </div>
      <div class="message">
        "Підбери пару" завершено!<br>
      </div>
    </div>
  </section>
</template>

<script setup>
import { reactive, watch } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import { useStore } from '@/store'
//
const { store } = useStore()
const route = useRoute()

const data = reactive({
  pairs: null,
  question: null,
  answer: [],
  pairsCount: 0,
  rightCount: 0,
  stateAnswer: false,
  questionsEnd: false
})

const getPairs = function () {
  axios({
    method: 'GET',
    url: `/api/lesson-pair/${route.params.id}`,
    data: {}
 }).then(function (response) {
   console.log(response.data)
   data.pairs = response.data.data
   data.pairsCount = data.pairs.length
  }).catch(function (error) {
     store.error(error.request.status)
  })
}

const sendAnswer = function () {
  if(data.answer){
    axios({
      method: 'POST',
      url: `/api/lesson-pair/${route.params.id}`,
      data: {answer: [data.answer[0].id, data.answer[1].id]}
   }).then(function (response) {
     if(response.data.reply === true){
       data.stateAnswer = 'right'
       data.rightCount = data.rightCount +1
     }
     else {
       data.stateAnswer = 'wrong'
     }
   }).catch(function (error) {
      store.error(error.request.status)
   })
  }
}

const selectItem = function (index) {
  if(!data.stateAnswer){
    if (data.pairs[index].selected === true) {
      data.pairs[index].selected = false
      data.answer = []
    }
    else {
      data.pairs[index]['selected'] = true
      data.answer.push(
        {
          id: data.pairs[index].id,
          index: index
        }
      )
    }
  }
}

watch( () =>   data.answer.length, () => {
    if(data.answer.length === 2){
      sendAnswer()
    }
})

watch( () => data.stateAnswer, (newValue, oldValue) => {
    if(oldValue == 'right'){
      data.pairs[data.answer[0].index].hidden = true
      data.pairs[data.answer[1].index].hidden = true
    }
    if(newValue === false) {
      data.pairs[data.answer[0].index].selected = false
      data.pairs[data.answer[1].index].selected = false
      data.answer = []
      if(data.rightCount == (data.pairsCount/2)) {
        data.questionsEnd = true
      }
    }
})
getPairs()
</script>

<style scoped lang="scss">
@import '@/assets/styles/color-style.scss';
.opacity {
  opacity: 0.5;
}
.main{
  background: #19273678!important;
}
.wrap{
  display: flex;
  justify-content: center;
  padding: 28px;
  height: 100%;
  align-items: flex-start;
}
.test{
  border: 4px solid rgba(0,84,169,.149);
  background: #ffffff;
  border-radius: 5px;
  width: 100%;
  max-width: 768px;
  .close{
    display: flex;
    justify-content: flex-end;
    align-items: center;
    width: 100%;
    .test-number{
      flex-grow: 1;
      padding: 0 8px;
    color: gray;
    }
    .material-icons{
      font-size: 36px;
      margin-top: -4px;
      margin-right: -4px;
    }
  }
  .question{
    width: 100%;
    text-align: center;
    font-size: 1.5rem;
    font-weight: 600;
    color: #6f40fe;
    margin: 32px 0 16px 0;
  }
  .pairs{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    padding: 16px;
    text-align: center;
    font-size: 1rem;
    font-weight: 600;
    color: #6f40fe;
    .pairs-item{
      cursor: pointer;
      width: calc(33.33% - 16px);
      min-height: 140px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      padding: 8px;
      margin: 8px;
      outline: 2px solid #e1e3e5;
      border-radius: 3px;
      img{
        margin-bottom: 8px;
      }
      .text{
        text-align: center;
      }
    }
  }
}
.submit-panel{
  justify-content: flex-end;
}
.selected{
  outline-color: #5186FF!important;
  // background: #5186FF;
}
.message-answer{
  bottom: 20px;
  position: fixed;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  z-index: 1;
  img{
    max-height: 100%;
  }
}
.wrong-answer{
  .message{
    background: #ae012f;
  }
}
.right-answer{
  .message{
    background: green;
  }
}
.message{
  text-align: center;
  color: white;
  font-size: 2rem;
  background: #ae012f;
  border-radius: 7px;
  padding: 4px 8px;
  margin-bottom: 24px;
}
.questions-end{
  .message{
    background: none;
    color: #45d800;
    span{
      color: gray;
      font-size: 1.2rem;
    }
  }
}
@media (max-width: 575.98px) {
  .message-answer{
    .message {
      font-size: 1.8rem;
      border-radius: 0;
    }
    img{
      max-height: 40vh;
    }
  }
  .pairs-item{
    width: calc(50% - 16px)!important;
  }
}
</style>
