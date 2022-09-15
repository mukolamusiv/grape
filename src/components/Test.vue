<template>
  <section class="wrap">
    <div class="test">
      <div class="close">
        <span class="test-number" @click="data.questionNamber++">
          Питання {{data.questionNamber + 1}} / {{data.countQuestions}}
        </span>
        <span class="material-icons c-pointer cancel" @click="store.ui.lessonTab = 'video'">disabled_by_default</span>
      </div>
      <div class="question">
        Скільки є Святих Тайнств?
      </div>
      <form v-if="data.question">
        <label v-for="(answer) in data.question.answer" v-bind:key="answer.id" :class="{ selected: answer.id ===  data.answerID}">
          <input type="radio" name="answer" :value="answer.id" v-model="data.answerID">
          <span>{{answer.text}}</span>
        </label>
        <div class="submit-panel">
          <button type="submit" class="btn">
            <span class="material-icons">check</span>
            Надіслати відповідь
          </button>
        </div>
      </form>
    </div>
  </section>
</template>

<script setup>
import { reactive, watch, defineProps } from 'vue'
import { useStore } from '@/store'
const { store } = useStore()
const props = defineProps({
  questions: null
})
const data = reactive({
  countQuestions: props.questions.length,
  questionNamber: 0,
  question: props.questions[0],
  answerID: null
})

watch( () => data.questionNamber, () => {
    data.question = props.questions[data.questionNamber]
})
</script>

<style scoped lang="scss">
@import '@/assets/styles/color-style.scss';
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
@media (max-width: 575.98px) {
  .btn{
    width: 100%;
  }
  form label{
    font-size: 1rem;
  }
}
</style>
