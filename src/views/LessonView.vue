<template>
  <main v-if="data.lesson">
    <section class="lesson-header">
      <div class="bread-crumbs">
        <router-link :to="{ path: `/topic/${data.lesson.topic_id}`}">
          <span class="material-icons">reply</span>
          <span>Тема: "{{data.lesson.topic.title.substring(0, 20)}}<span v-if="data.lesson.topic.title.length>20">..</span>"</span>

        </router-link>
      </div>
      <div class="lesson-about">
        <div class="title">
          Урок: "{{data.lesson.title}}""
        </div>
        <div class="description">
          {{data.lesson.description}}
        </div>
      </div>
    </section>
    <section class="lesson-content">
      <div class="player">
        <audio
          controls
          preload="auto"
          controlsList="nodownload"
          :src="data.lesson.attachment[0].url">
              Your browser does not support the
              <code>audio</code> element.
        </audio>
      </div>
      <div class="lesson-content-text" v-html="data.lesson.text"></div>
    </section>
  </main>
</template>

<script setup>
import { reactive } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()

const data = reactive({
  lesson: null
})

const getLesson = function () {
  axios({
    method: 'GET',
    url: `/api/lesson/${route.params.id}}`,
    data: {}
 }).then(function (response) {
   data.lesson = response.data
   console.log(response.data)

  })
}
getLesson()
</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
.lesson-header{
  margin-bottom: 16px;
}
.bread-crumbs{
  font-weight: bold;
  padding: 16px;
  margin-top: -16px;
  margin-left: -16px;
  a{
    display: flex;
    align-items: center;
    font-weight: bold;
    color: #4f6efe;
    font-size: 1.4rem;
    .material-icons{
    font-size: inherit;
    }
  }
  .current-path{
    color: #747d86;
  }
}
.lesson-about{
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  width: 100%;
  .title{
    text-align: center;
    font-size: 2.5rem;
    font-weight: 600;
    color: #6f40fe;
    margin-bottom: 16px;
  }
  .description{
    background: #7a4ffe;
    padding: 8px;
    border-radius: 5px;
    color: #ffffff;
    font-size: 1.2rem;
    width: 100%;
    margin: 0 32px;
  }
}
.lesson-content{
  display: flex;
  justify-content: center;
  padding-top: 0;
  .lesson-content-text{
    max-width: 100%;
    font-size: 1.2rem;
  }
}
.player{
  width: 100%;
  margin-bottom: 32px;
  padding: 0 32px;
  audio{
    width: 100%;
  }
}
@media (min-width: 1200px) {
  .lesson-about{
    .description{
      width: 100%;
    }
  }
}
@media (max-width: 575.98px) {
  .lesson-about .title{
    font-size: 1.8rem;
  }
  .description{
    font-size: 1.1rem!important;
    margin: 0!important;
  }
  .bread-crumbs{
    margin-left: -32px;
    a{
      font-size: 1.2rem;
    }
  }
  .lesson-content{
    .lesson-content-text{
      font-size: 1rem;
    }
  }
  .player{
    padding: 0
  }
}
</style>
