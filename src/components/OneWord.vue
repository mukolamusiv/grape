<template>
  <section class="wrap" v-if="data.question && !data.questionsEnd" @click="data.stateAnswer = false">
    <div class="test animate__animated animate__zoomIn" :class="{'opacity' : data.stateAnswer !== false}">
      <div class="close">
        <span class="test-number">
          Слово {{data.questionNamber + 1}} / {{data.questionsCount}}
        </span>
        <span class="material-icons c-pointer cancel" @click="store.ui.lessonTab = 'video'">disabled_by_default</span>
      </div>
      <div class="question">
        {{data.question.description}}
      </div>
      <div class="img">
        <img :src="data.question.image_src" >
      </div>
      <form v-if="data.question" @submit.prevent="sendAnswer()">
        <div class="form-item">
          <span class="input-name"></span>
          <label>
            <input type="text" v-model="data.answer">
          </label>
        </div>
        <div class="submit-panel" v-if="!data.stateAnswer && data.answer">
          <button type="submit" class="btn">
            <span class="material-icons">check</span>
            Надіслати відповідь
          </button>
        </div>
      </form>
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
        "Одне слово" завершено!<br>
        <span>Вірних слів: {{data.rightCount}} з {{data.questionsCount}}</span>
      </div>
    </div>
  </section>
</template>

<script setup>
import { reactive, watch } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import { useStore } from '@/store'

const { store } = useStore()
const route = useRoute()

const data = reactive({
  questions: null,
  question: null,
  answer: null,
  questionNamber: 0,
  questionsCount: 0,
  rightCount: 0,
  stateAnswer: false,
  questionsEnd: false
})

const sendAnswer = function () {
  if(data.answer){
    axios({
      method: 'POST',
      url: `/api/lesson-one-word/${route.params.id}`,
      data: {id: data.question.id, answer: data.answer}
   }).then(function (response) {
     if(response.data.reply === true){
       data.stateAnswer = 'right'
       data.rightCount = data.rightCount +1
    }
     else {
       data.stateAnswer = 'wrong'
    } console.log(data.rightCount)
    })
  }
}
const getQuestion = function () {
  axios({
    method: 'GET',
    url: `/api/lesson-one-word/${route.params.id}`,
    data: {}
 }).then(function (response) {
   console.log(response.data)
   data.questions = response.data.questions
   data.questionsCount = data.questions.length
   data.question = data.questions[data.questionNamber]
  })
}

watch( () => data.questionNamber, () => {
    if(data.questions) {
      data.question = data.questions[data.questionNamber]
      data.answer = null
    }
})
watch( () => data.stateAnswer, () => {
    if(data.stateAnswer === false && data.questionNamber < (data.questionsCount -1 ) ) {
      data.questionNamber = data.questionNamber +1
      console.log(data.questionNamber)
    }
    else if(data.stateAnswer === false) {
      data.questionsEnd = true
    }
})
getQuestion()
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
    margin: 32px 0;
  }
  form{
    padding: 0 16px 16px 16px;
    .form-item{
      margin-bottom: 32px;
      padding-bottom: 0;
      flex-direction: row;
      justify-content: center;
      label{
        max-width: 420px!important;
      }
      input{
        text-align: center;
      }
    }
  }
  .img{
    margin-bottom: 32px;
    display: flex;
    justify-content: center;
    img{
        width: 620px!important;
    }
  }
}
.submit-panel{
  justify-content: flex-end;
}
.selected{
  outline-color: #5186FF;
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
  .btn{
    width: 100%;
  }
  form label{
    font-size: 1rem;
  }
  .message-answer{
    .message {
      font-size: 1.8rem;
      border-radius: 0;
    }
    img{
      max-height: 40vh;
    }
  }
}
</style>
