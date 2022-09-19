<template>
  <section class="wrap" v-if="data.questions" @click="data.ui.wrongAnswer = false">
    <div class="test animate__animated animate__zoomIn" :class="{'opacity' : data.ui.wrongAnswer}">
      <div class="close">
        <span class="test-number" @click="data.questionNamber++">
          Питання {{data.questionNamber + 1}} / {{data.countQuestions}}
        </span>
        <span class="material-icons c-pointer cancel" @click="store.ui.lessonTab = 'video'">disabled_by_default</span>
      </div>
      <div class="question">
        {{data.question.description}}
      </div>
      <form v-if="data.question">
        <label v-for="(answer) in data.question.answer" v-bind:key="answer.id" :class="{ selected: answer.id ===  data.answerID}">
          <input type="radio" name="answer" :value="answer.id" v-model="data.answerID">
          <span>{{answer.text}}</span>
        </label>
        <div class="submit-panel" v-if="!data.ui.wrongAnswer && data.answerID">
          <div type="submit" class="btn" @click="sendAnswer()">
            <span class="material-icons">check</span>
            Надіслати відповідь
          </div>
        </div>
      </form>
    </div>
    <div class="wrong-answer animate__animated animate__bounceIn" v-if="data.ui.wrongAnswer">
      <!-- <span class="material-icons">mood_bad</span> -->
      <div class="message-wrong">:( Нажаль відповідь невірна!</div>
      <img src="@/assets/img/sad.png" alt="Grape">
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
  countQuestions: null,
  questionNamber: 0,
  questions: null,
  question: null,
  answerID: null,
  ui: {
    wrongAnswer: false
  }
})
const getQuestion = function () {
  console.log(route.params.id)
  axios({
    method: 'GET',
    url: `/api/lesson-question/${route.params.id}`,
    data: {}
 }).then(function (response) {
   data.questions = response.data
   data.countQuestions = data.questions.length
   data.question = data.questions[data.questionNamber]
   console.log(response.data)
 })
}
const sendAnswer = function () {
  if (data.answerID){
    axios({
      method: 'POST',
      url: `api/test-question/${data.question.id}`,
      data: {answer_id: data.answerID}
   }).then(function (response) {
     if(response.data === 'not true'){
       data.ui.wrongAnswer = true
     }
     console.log(response.data)
   })
  }
}
watch( () => data.questionNamber, () => {
    if(data.questions)
    data.question = data.questions[data.questionNamber]
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
}
form{
  display: flex;
  flex-direction: column;
  padding: 0 16px 16px 16px;
  input[type="radio"] {
    display: none;
    transform: scale(1.2);
    margin: 0 8px;
  }
  label{
    cursor: pointer;
    display: flex;
    align-items: center;
    outline: 2px solid #e6e6e6;
    margin-bottom: 32px;
    padding: 8px;
    border-radius: 5px;
    font-size: 1.2rem;
  }
  .submit-panel{
    justify-content: flex-end;
  }
}
.selected{
  outline-color: #5186FF;
}
.wrong-answer{
  bottom: 20px;
  position: fixed;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  z-index: 1;
  .material-icons{
    font-size: 200px;
    color: red;
    height: fit-content;
  }
  img{
    max-height: 100%;
  }
  .message-wrong{
    text-align: center;
    color: white;
    font-size: 2rem;
    background: #ae012f;
    border-radius: 7px;
    padding: 4px 8px;
    margin-bottom: 24px;
  }
}
@media (max-width: 575.98px) {
  .btn{
    width: 100%;
  }
  form label{
    font-size: 1rem;
  }
  .wrong-answer{
    .message-wrong {
      font-size: 1.8rem;
    }
    img{
      max-height: 40vh;
    }
  }
}
</style>
