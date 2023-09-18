<template>
  <section class="wrapp-quiz">
    <div class="quiz">
      <div class="quiz-header">

      </div>
      <div class="quiz-body">

      </div>
      <div class="quiz-footer">

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
  quiz: null,
})
const getQuiz = function () {
  axios({
    method: 'POST',
    url: `/form/about`,
    data: { id: '1' }
  }).then(function (response) {
    data.quiz = response.data.quiz
  })
}
</script>

<style scoped lang="scss">
@import '@/assets/styles/color-style.scss';

.opacity {
  opacity: 0.5;
}

.main {
  background: #19273678 !important;
}

.wrap {
  display: flex;
  justify-content: center;
  padding: 28px;
  height: 100%;
  align-items: flex-start;
}

.test {
  border: 4px solid rgba(0, 84, 169, .149);
  background: #ffffff;
  border-radius: 5px;
  width: 100%;
  max-width: 768px;

  .close {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    width: 100%;

    .test-number {
      flex-grow: 1;
      padding: 0 8px;
      color: gray;
    }

    .material-icons {
      font-size: 36px;
      margin-top: -4px;
      margin-right: -4px;
    }
  }

  .question {
    width: 100%;
    text-align: center;
    font-size: 1.5rem;
    font-weight: 600;
    color: #6f40fe;
    margin: 32px 0;
  }
}

form {
  display: flex;
  flex-direction: column;
  padding: 0 16px 16px 16px;

  input[type="radio"] {
    display: none;
    transform: scale(1.2);
    margin: 0 8px;
  }

  label {
    cursor: pointer;
    display: flex;
    align-items: center;
    outline: 2px solid #e6e6e6;
    margin-bottom: 32px;
    padding: 8px;
    border-radius: 5px;
    font-size: 1.2rem;
  }

  .submit-panel {
    justify-content: flex-end;
  }
}

.selected {
  outline-color: #5186FF;
}

.message-answer {
  bottom: 20px;
  position: fixed;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  z-index: 1;

  img {
    max-height: 100%;
  }
}

.wrong-answer {
  .message {
    background: #ae012f;
  }
}

.right-answer {
  .message {
    background: green;
  }
}

.message {
  text-align: center;
  color: white;
  font-size: 2rem;
  background: #ae012f;
  border-radius: 7px;
  padding: 4px 8px;
  margin-bottom: 24px;
}

.questions-end {
  .message {
    background: none;
    color: #45d800;

    span {
      color: gray;
      font-size: 1.2rem;
    }
  }
}

@media (max-width: 575.98px) {
  .btn {
    width: 100%;
  }

  form label {
    font-size: 1rem;
  }

  .message-answer {
    .message {
      font-size: 1.8rem;
      border-radius: 0;
    }

    img {
      max-height: 40vh;
    }
  }
}
</style>
