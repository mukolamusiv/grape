<template>
  <main v-if="data.lesson" class="main">
    <section class="lesson-header">
      <div class="bread-crumbs">
        <router-link :to="{ path: `/topic/${data.lesson.topic.id}`}">
          <span class="material-icons">reply</span>
          <span>Тема: "{{data.lesson.topic.title.substring(0, 20)}}<span v-if="data.lesson.topic.title.length>20">..</span>"</span>
        </router-link>
      </div>
      <div class="lesson-about">
        <div class="title">
          Урок: "{{data.lesson.title}}"
        </div>
      </div>
    </section>
    <section class="lesson-content">
      <div class="lesson-content-text" v-html="data.lesson.text"></div>
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
  lesson: null,
})
const getLesson = function () {
  axios({
    method: 'GET',
    url: `/api/lesson-teacher/${route.params.id}`,
    data: {}
 }).then(function (response) {
   data.lesson = response.data
   console.log(response.data)
 }).catch(function (error) {
     store.error(error.request.status)
 })
}

getLesson()

</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
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
}
.lesson-about{
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  width: 100%;
  .title{
    width: 100%;
    text-align: center;
    font-size: 2.5rem;
    font-weight: 600;
    color: #6f40fe;
  }
}
.lesson-content{
  display: flex;
  justify-content: center;
  padding-top: 0;
  flex-wrap: wrap;
  .lesson-content-text{
    width: 100%;
    font-size: 1.2rem;
  }
}
@media (min-width: 1200px) {
  .lesson-about{
    .lesson-structure{
      border-radius: 5px;
      margin: 0 24px 0 32px;
    }
  }
  .lesson-content{
    flex-wrap: nowrap;
    padding: 0 40px 0 48px;
  }
}
@media (max-width: 575.98px) {
  .bread-crumbs{
    margin-left: -32px;
    a{
      font-size: 1.2rem;
    }
  }
  .lesson-about .title{
    font-size: 1.8rem;
  }
}
</style>
