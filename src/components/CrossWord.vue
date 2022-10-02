<template>
  <section class="wrap" v-if="data.crossWord && !data.questionsEnd" @click="data.stateAnswer = false">
    <div class="test animate__animated animate__zoomIn" :class="{'opacity' : data.stateAnswer !== false}">
      <div class="close">
        <span class="material-icons c-pointer cancel" @click="store.ui.lessonTab = 'video'">disabled_by_default</span>
      </div>
      <div class="question">
        {{data.crossWord.description}}
      </div>
      <div class="cross-word">
        <table>
          <tr v-for="(question, indexTR ) in data.crossWord.questions" v-bind:key="question.id" :class="{'right' : data.crossWord.questions[indexTR]['reply']}">
            <input type="text"
              v-if="!data.crossWord.questions[indexTR]['reply']"
              v-model="data.crossWord.questions[indexTR]['answer']"
              :maxlength="question.characters"
              v-on:keyup.enter="sendAnswer(data.crossWord.questions[indexTR]['id'], data.crossWord.questions[indexTR]['answer'], indexTR)"
              @click="selectTR(indexTR)"
            >
            <div class="input-answer-form" v-if="question">

            </div>
            <td v-for="(n, indexTD ) in data.crossWord.max_characters" v-bind:key="n" :class="{ 'boreder-none': indexTD < question.shift || indexTD > (question.shift + question.characters -1), 'main-word-bg': indexTD === data.crossWord.main_word_shift}">
              <span class="question-number" v-if="indexTD === question.shift">{{indexTR+1}}</span>
              <span v-if="data.crossWord.questions[indexTR]['answer'][indexTD - question.shift]">{{data.crossWord.questions[indexTR]['answer'][indexTD - question.shift]}}</span>
            </td>
            <td class="boreder-none">
              <button class="btn" v-if="data.selectedIndex == indexTR">
                <span class="material-icons delete" @click="deleteAnswer(indexTR)">backspace</span>
              </button>
            </td>
            <td class="boreder-none">
              <button class="btn" v-if="data.selectedIndex == indexTR">
                <span class="material-icons" @click="sendAnswer(data.crossWord.questions[indexTR]['id'], data.crossWord.questions[indexTR]['answer'], indexTR)">published_with_changes</span>
              </button>
            </td>
          </tr>
        </table>
      </div>
      <div class="question-text">
        <p v-for="(question, index) in data.crossWord.questions" v-bind:key="question.id">{{index+1}}. {{question.question_text}}</p>
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
</template>

<script setup>
import { reactive } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import { useStore } from '@/store'

const { store } = useStore()
const route = useRoute()

const data = reactive({
  answer: null,
  crossWord: null,
  selectedIndex: null,
  stateAnswer: false
})

const selectTR = function (index) {
  if(!data.crossWord.questions[index]['reply']){
    data.selectedIndex = index
  }
}
const deleteAnswer = function (index){
  data.crossWord.questions[index]['answer'] = ''
  data.selectedIndex = null
}
const getCrossWord = function () {
  axios({
    method: 'GET',
    url: `api/lesson-crossword/${route.params.id}`,
    data: {}
 }).then(function (response) {
   data.crossWord = response.data
   console.log(response.data)
 })
}
const sendAnswer = function (id, answer, index) {
  console.log('response.data')
  if(answer){
    axios({
      method: 'POST',
      url: `api/test-crossword/${route.params.id}`,
      data: {id: id, answer: answer}
   }).then(function (response) {
     data.selectedIndex = null
     console.log(response.data)
     if(response.data.reply === true){
       data.stateAnswer = 'right',
       data.crossWord.questions[index]['reply'] = true
      }
     else {
       data.stateAnswer = 'wrong'
       data.crossWord.questions[index]['answer'] = ''
    }
  })
  }
  // data.selectedIndex = null

  console.log(answer, data.selectedIndex)
}
getCrossWord()
</script>

<style scoped lang="scss">
@import '@/assets/styles/color-style.scss';
input:focus ~   td{
    border-color: #5186FF!important;
}
.btn{
  padding: 0;
  margin: 0;
  border: none;
  height: 100%;
  align-items: center;
  width: 100%;
  z-index: 9999;
  position: relative;
  .material-icons{
    margin: 0;
    font-size: 1.8rem;
  }
}
.delete{
  font-size: 1.5rem!important;
}
.main-word-bg{
  background: #e6e5e5;
}
.cross-word{
  display: flex;
  justify-content: center;
  padding: 16px;
  margin-bottom: 32px;
  font-size: 1.5rem;
  table{
    border-collapse: collapse;
    tr{
      max-width: 100%;
      overflow: scroll;
    }
    td{
      border: 1px solid black;
      padding: 4px;
      text-align: center;
      width: 45px;
      height: 45px;
      text-transform: uppercase;
      .question-number{
        font-size: 0.8rem;
        position: fixed;
        display: block;
      }
    }
  }
  .boreder-none{
    border: none!important;
  }
  input{
    position: absolute;
    right: 0;
    width: 100%;
    opacity: 0;
  }
  .selected{
    td{
      border: 1px solid #5186FF;
    }
  }
  .right{
    td{
      color: green;
    }
  }
}
.question-text{
  padding: 16px 32px;
  font-size: 1.2rem;
}
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
