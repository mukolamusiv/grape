<template>
  <main v-if="data.topic">
    <section class="header-topic">
      <div class="cuerse">
        <div class="course-logo">
            <img :src="`${store.homeUrl + data.topic.photo}`" alt="">
          <div class="get">
            <div class="get-items sun">
                <span class="material-icons">brightness_5</span>
                <span>15</span>
            </div>
            <div class="get-items water">
                <span class="material-icons">water_drop</span>
                <span>15</span>
            </div>
          </div>
        </div>
        <div class="course-about">
            <div class="title">Тема: "{{data.topic.title}}"</div>
          <div class="description">
            {{data.topic.description.substring(0, 255)}}
          </div>
        </div>
        <div class="progress">
          <div class="progress-header">
            <div>Пройдено</div> <span class="progress-value">{{data.topic.status}}%</span>
          </div>
          <div class="progress-liner-wrap">
            <div class="progress-liner" :style="{ 'width': `${data.topic.status}%`}"></div>
          </div>
        </div>
      </div>
    </section>
    <section class="start-panel">
      <span class="btn accept" @click="startTopic()">
        Розпочати тему
      </span>
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
   console.log(data.topic.status)

  })
}
const startTopic = function () {
  axios({
    method: 'PUT',
    url: `/api/start-topic/${route.params.id}`,
  }).then(function (response) {
   data.topic = response.data
   console.log(response.data)

  })
}
getTopic()

</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
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
      // max-width: 100%;
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
</style>
