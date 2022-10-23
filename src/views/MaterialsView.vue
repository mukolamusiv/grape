<template>
  <main>
    <section class="current-courses" id="topics-active" v-if="data.topics">
      <div class="title-page">
      Матеріали
      </div>
      <div class="cuerse-wrap" v-for="(topic) in data.topics" v-bind:key="topic.id">
        <router-link :to="{ path: `/topic-materials/${topic.id}`}" class="cuerse">
          <div class="course-logo">
            <img :src="`${store.homeUrl + topic.photo}`" alt="">
          </div>
          <div class="course-about">
            <div class="title">{{topic.title}}</div>
            <div class="description">
              {{topic.description.substring(0, 255)}}
            </div>
          </div>
        </router-link>
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
  topics: null,
})

const getTopics = function () {
  axios({
    method: 'GET',
    url: `/api/topics-teacher`,
    data: {}
 }).then(function (response) {
   console.log(response.data)
   data.topics = response.data
 }).catch(function (error) {
    store.error(error.request.status)
 })
}
getTopics()
</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
.title-page{
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  font-size: 2.5rem;
  font-weight: 600;
  color: #6f40fe;
}
.cuerse-wrap{
  padding: 16px;
  width: 100%;
  .cuerse{
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100%;
    background: #ffffff;
    border-radius: 5px;
    outline: 1px solid #dddcdc;
  }
  .course-logo{
    display: flex;
    align-items: center;
    img{
    max-width: 100%;
    border-radius: 5px;
    }
  }
  .course-about{
    flex-grow: 1;
    padding: 16px;
    display: flex;
    flex-direction: column;
  }
  .title{
    text-align: center;
    font-size: 1.4rem;
    line-height: 1.4rem;
    font-weight: 600;
    color: #6f40fe;
    margin-bottom: 16px;
  }
  .description{
    background: #7a4ffe;
    padding: 8px;
    border-radius: 5px;
    color: #ffffff;
    font-size: 1rem;
    margin-bottom: 16px;
  }
  .get{
    margin-top: 0;
  }
  .progress{
    width: 100%;
    flex-grow: 1;
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
  .grape-btn-wrap{
    margin-top: 16px;
    flex-grow: 1;
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    .grape-btn{
      padding: 8px 16px;
      border-radius: 25px;
      outline: 2px solid #5186FF;
      text-align: center;
      a{
        color: #5186FF!important;
        font-weight: bold;
      }
    }
  }
  .get{
    margin-bottom: 8px;
  }
}
@media (min-width: 768px) {
  .cuerse-wrap{
    width: 50%;
    padding: 16px;
  }
 }
@media (min-width: 1200px) {
  .cuerse-wrap{
    width: 25%;
    padding: 16px;
  }
}
</style>
