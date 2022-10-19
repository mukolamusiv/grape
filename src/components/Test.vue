<template>
  <section class="wrap" v-if="data.questions && !data.questionsEnd" @click="data.stateAnswer = false">
    <div class="test animate__animated animate__zoomIn" :class="{'opacity' : data.stateAnswer !== false}">
      <div class="close">
        <span class="test-number">
          Питання {{data.questionNamber + 1}} / {{data.questionsCount}}
        </span>
        <span class="material-icons c-pointer cancel" @click="store.ui.lessonTab = 'video'">disabled_by_default</span>
      </div>
      <div class="question">
        {{data.question.description}}
      </div>
      <form v-if="data.question" @submit.prevent="sendAnswer()">
        <label v-for="(answer) in data.question.answer" v-bind:key="answer.id" :class="{ selected: answer.id ===  data.answerID}">
          <input type="radio" name="answer" :value="answer.id" v-model="data.answerID">
          <span>{{answer.text}}</span>
        </label>
        <div class="submit-panel" v-if="!data.stateAnswer && data.answerID">
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
        Тест завершено!<br>
        <span>Вірних відповідей: {{data.rightCount}} з {{data.questionsCount}} питань</span>
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
  answerID: null,
  questionNamber: 0,
  questionsCount: 0,
  stateAnswer: false,
  rightCount: 0,
  questionsEnd: false
})
const getQuestion = function () {
  axios({
    method: 'GET',
    url: `/api/lesson-question/${route.params.id}`,
    data: {}
  }).then(function (response) {
    data.questions = response.data.questionsDTO
    data.questionsCount = data.questions.length
    data.question = data.questions[data.questionNamber]
  }).catch(function (error) {
     store.error(error.request.status)
  })
}
const sendAnswer = function () {
  if(data.answerID){
    axios({
      method: 'POST',
      url: `/api/lesson-question/${data.question.id}`,
      data: {answer_id: data.answerID}
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
watch( () => data.questionNamber, () => {
    if(data.questions) {
      data.question = data.questions[data.questionNamber]
    }
})
watch( () => data.stateAnswer, () => {
    if(data.stateAnswer === false && data.questionNamber < (data.questionsCount -1 ) ) {
      data.questionNamber = data.questionNamber +1
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
