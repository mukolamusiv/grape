<template>
  <div class="cuerse-wrap" v-for="(topic) in topics" v-bind:key="topic.id">
    <div class="cuerse fit-content">
      <div class="course-logo">
        <img :src="`${store.homeUrl + topic.photo}`" alt="">
      </div>
      <div class="course-about">
        <div class="title">{{topic.title}}</div>
        <div class="description">
          {{topic.description.substring(0, 255)}}
        </div>
        <div class="get">
          <div class="get-items sun">
              <span class="material-icons">brightness_5</span>
              <span>{{topic.lumen}}</span>
          </div>
          <div class="get-items water">
              <span class="material-icons">water_drop</span>
              <span>{{topic.water}}</span>
          </div>
        </div>
        <div class="progress" v-if="topic.status != undefined">
          <div class="progress-header">
            <div>Пройдено</div> <span class="progress-value">{{topic.status}}%</span>
          </div>
          <div class="progress-liner-wrap">
            <div class="progress-liner" :style="{ 'width': `${topic.status}%`}"></div>
          </div>
        </div>
        <div class="grape-btn-wrap" v-if="linkTitle">
          <router-link :to="{ path: `/topic/${topic.topic_id}`}">
            <div class="grape-btn">
              {{linkTitle}}
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import { useStore } from '@/store'
const { store } = useStore()
defineProps({
  topics: null,
  linkTitle: null
})
</script>

<style scoped lang="scss">
@import '@/assets/styles/color-style.scss';
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
