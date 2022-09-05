<template>
  <main v-if="data.topic">
    <section class="header-topic">
      <div class="cuerse">
        <div class="course-logo">
            <img :src="`${store.homeUrl + data.topic.photo}`" alt="">
          <div class="get">
            <div class="get-items sun">
                <span class="material-icons">brightness_5</span>
                <span>{{data.topic.lumen}}</span>
            </div>
            <div class="get-items water">
                <span class="material-icons">water_drop</span>
                <span>{{data.topic.water}}</span>
            </div>
          </div>
        </div>
        <div class="course-about">
            <div class="title">Тема: "{{data.topic.title}}"</div>
          <div class="description">
            {{data.topic.description.substring(0, 255)}}
          </div>
        </div>
        <div class="progress" v-if="data.topic.status !== undefined">
          <div class="progress-header">
            <div>Пройдено</div> <span class="progress-value">{{data.topic.status}}%</span>
          </div>
          <div class="progress-liner-wrap">
            <div class="progress-liner" :style="{ 'width': `${data.topic.status}%`}"></div>
          </div>
        </div>
      </div>
    </section>
    <section class="start-panel" v-if="data.topic.status == undefined">
      <span class="btn" @click="startTopic()">
        Розпочати тему
      </span>
    </section>
    <section class="lessons-wrap" :class="{ opacity: data.topic.status == undefined }">
      <div class="lessons-title">
        Зміст теми:
      </div>
      <div class="wrap-lesson-card" v-if="data.topic.status == undefined">
        <div class="lesson-card" v-for="(lesson, index) in data.topic.lessons" v-bind:key="lesson.lesson_id">
          <div class="lesson-title">
            <span class="material-icons">play_lesson</span>
            <span>{{index+1}}. {{lesson.title}}</span>
          </div>
        </div>
      </div>
      <div class="wrap-lesson-card" v-if="data.topic.status !== undefined">
        <router-link class="lesson-card" :to="{ path: `/lesson/${lesson.lesson_id}`}" v-for="(lesson, index) in data.topic.lessons" v-bind:key="lesson.lesson_id">
          <div class="lesson-title">
            <span class="material-icons">play_lesson</span>
            <span>{{index+1}}. {{lesson.title}}</span>
          </div>
        </router-link>
      </div>
    </section>
  </main>
</template>

<script setup>
import { reactive } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import { useStore } from '@/store'
const { store } = useStore()

const route = useRoute()


const data = reactive({
  topic: null,
})
const getTopic = function () {
  axios({
    method: 'GET',
    url: `/api/topic/${route.params.id}}`,
    data: {}
 }).then(function (response) {
   data.topic = response.data
   console.log(response.data)

  })
}
const startTopic = function () {
  axios({
    method: 'PUT',
    url: `/api/start-topic/${route.params.id}`,
  }).then(function (response) {
   console.log(response.data)
   getTopic()

  })
}
getTopic()

</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
.opacity{
  opacity: 0.6;
}
.header-topic{
  .title{
    text-align: center;
    font-size: 2.5rem;
    font-weight: 600;
    color: #6f40fe;
    margin-bottom: 16px;
  }
  .cuerse{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    width: 100%;
  }
  .course-logo{
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    padding: 16px;
    img, .img{
      display: block;
      border-radius: 5px;
      width: 400px;
      height: 200px;
      background-position: center;
      background-size: cover;
    }
  }
  .course-about{
    padding: 0 16px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

  }
  .description{
    width: 100%;
    background: #7a4ffe;
    padding: 8px;
    border-radius: 5px;
    color: #ffffff;
    font-size: 1.2rem;
  }
  .progress{
    width: 100%;
    padding: 16px;
    .progress-header{
      display: flex;
      color: #017605;
      font-size: 1rem;
      div{
        flex-grow: 1
      }
      .progress-value{
        font-weight: bold;
      }
    }
    .progress-liner-wrap{
      width: 100%;
      display: flex;
      background: #80808021;
      // background: #1927361f;
      height: 16px;
      .progress-liner{
        background: #45D800;
        text-align: center;
        height: 16px;
      }
    }
  }
  .get{
    margin: 0;
    position: relative;
    margin-top: -70px;
    right: 0;
  }
}
.start-panel{
  justify-content: center;
  .btn{
    font-size: 1.5rem;
    }
}
.lessons-wrap{
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 16px;
  padding-top: 0;
  .lessons-title{
    padding: 0 16px;
    margin-bottom: 8px;
    font-size: 2rem;
    line-height: 2rem;
    font-weight: bold;
    color: #192736;
  }
  .lesson-card{
    margin: 8px 16px;
    margin-left: 32px;
    padding: 8px 16px;
    display: flex;
    align-items: center;
    color: #192736;
    background: #1927361f;
    border-radius: 5px;
    .lesson-title{
      display: flex;
      align-items: center;
      font-size: 1.1rem;
      .material-icons{
        margin-right: 8px;
      }
    }
  }
}
@media (min-width: 992px) {
  .header-topic .description{
    width: calc(100vw - 510px);
  }
}
@media (min-width: 1400px) {
  .header-topic .description{
    width: calc(100vw - 780px);
  }
}
@media (max-width: 575.98px) {
  .header-topic{
    padding-top: 0;
    padding-bottom: 0;
    .course-logo{
      padding-top: 0;
    }
    .title{
      font-size: 1.8rem;
      padding-top: 16px;
    }
    .description{
      font-size: 1.1rem;
    }
  }
  .lessons-wrap{
    // padding: 0;
    .lessons-title{
      font-size: 1.5rem;
    }
  }
}
.lesson-done{
  background: #45d800!important;
  color: #ffffff!important;
}
</style>
