<template>
  <section class="wrap" v-if="data.question && !data.questionsEnd" @click="data.stateAnswer = false">
    <div class="test animate__animated animate__zoomIn" :class="{'opacity' : data.stateAnswer !== false}">
      <div class="close">
        <span class="test-number" @click="data.questionNamber++">
          Питання {{data.questionNamber + 1}} / {{data.questionsCount}}
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
            <input type="text" v-model="data.answer" required size="10">
          </label>
        </div>
        <div class="submit-panel">
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
</template>

<script setup>
import { reactive } from 'vue'
// import { useRoute } from 'vue-router'
// import axios from 'axios'
import { useStore } from '@/store'

const { store } = useStore()
// const route = useRoute()

const data = reactive({
  answer: null,
  questions: null,
  question: {
    id: 7,
    description: "Яка емоція на зображенні?",
    image_src: "https://ukrpublic.com/images/2021/06/15/s-96493e3985154d4ea607201fb550e5_large.jpg",
  },
  stateAnswer: false,
})

const sendAnswer = function () {

  if(data.answer){
    console.log(
      {
        question: data.question.id,
        ansver: data.answer
      }

    )
  }
}
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
  .material-icons{
    font-size: 200px;
    color: red;
    height: fit-content;
  }
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
