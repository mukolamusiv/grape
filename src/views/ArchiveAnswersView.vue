<template>
  <main>
    <div class="title-page">
      Архів відповідей
    </div>
    <section v-if="data.answers">
      <div class="open-question" v-for="(answer, index) in data.answers" v-bind:key="answer.id">
        <div class="question">{{index+1}}. {{answer.open_question.question}}</div>
        <div class="answer" :class="{'answer-true' : answer.reply, 'answer-false' : !answer.reply,}">
          <div class="answer-about">
            <router-link class="student-name" :to="{ path: `/profile-student/${answer.user.id}`}">
              {{answer.user.surname}} {{answer.user.name}}
            </router-link>
            <div class="date-time" v-if="answer.created_at">
              {{answer.created_at.substring(0, 10).split('-').reverse().join('.')}} о {{answer.created_at.substring(11, 19)}}
            </div>
          </div>
          {{answer.answer}}
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { reactive } from 'vue'
import axios from 'axios'
import { useStore } from '@/store'
const { store } = useStore()

const data = reactive({
  answers: null,
})
const getAnswers = function () {
  axios({
    method: 'GET',
    url: `api/audit-open-question-completed`,
    data: {}
 }).then(function (response) {
   data.answers = response.data
  }).catch(function (error) {
     store.error(error.request.status)
  })
}

getAnswers()
</script>

<style lang="scss" scoped>
main{
  padding: 16px;
  background: #f0f2f5;
}
section{
  padding-top: 0;
}
.title-page{
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  font-size: 2.5rem;
  font-weight: 600;
  color: #736797;
}
.open-question{
  display: flex;
  flex-direction: column;
  padding: 16px;
  border-radius: 8px;
  .question{
    width: 100%;
    font-size: 1.5rem;
    color: #6f40fe;
    margin-bottom: 8px;
  }
  .answer-about{
    .student-name{
      font-size: 1.2rem;
    }
    .date-time{
      color: #737373;
    }
  }
  .answer{
    flex-grow: 1;
    padding: 16px;
    margin-bottom: 16px;
    outline: 1px solid rgba(146, 145, 156, 0.4117647059);
    border-radius: 5px;
    background: #ffffff;
  }
  .submit-panel {
    justify-content: flex-end;
  }
}
.answer-true{
  outline-color: #45d800!important;
}
.answer-false{
  outline-color: #c62f2f!important;
}
@media (max-width: 575.98px) {
  section{
    padding: 0;
  }
}
</style>
