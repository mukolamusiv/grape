<template>
  <main>
    <section class="current-courses" id="topics-active" v-if="data.topicsActive">
      <div class="section-title">
        <h2>Активні {{data.topicsActive.length}}</h2>
      </div>
      <div class="cuerse-wrap" v-for="(topic) in data.topicsActive" v-bind:key="topic.id">
        <div class="cuerse fit-content">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
          </div>
          <div class="course-about">
            <div class="title">{{topic.title}}</div>
            <div class="description">{{topic.description}}</div>
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
            <div class="grape-btn-wrap">
              <div class="grape-btn">
                <a href="#">Розпочати</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="topics-done" v-if="data.topicsDone">
      <div class="section-title">
        <h2 class="cl-gray">Пройдені {{data.topicsDone.length}}</h2>
      </div>
      <div class="cuerse-wrap" v-for="(topic) in data.topicsDone" v-bind:key="topic.id">
        <div class="cuerse fit-content">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
          </div>
          <div class="course-about">
            <div class="title">{{topic.title}}</div>
            <div class="description">{{topic.description}}</div>
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
            <div class="grape-btn-wrap">
              <div class="grape-btn">
                <a href="#">Розпочати</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="topics" v-if="data.topics">
      <div class="section-title">
        <h2 class="cl-blue">Доступні теми {{data.topics.length}}</h2>
      </div>
      <div class="cuerse-wrap" v-for="(topic) in data.topics" v-bind:key="topic.id">
        <div class="cuerse fit-content">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
          </div>
          <div class="course-about">
            <div class="title">{{topic.title}}</div>
            <div class="description">{{topic.description}}</div>
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
            <div class="grape-btn-wrap">
              <div class="grape-btn">
                <a href="#">Розпочати</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { reactive } from 'vue'
import { useStore } from '@/store'
import axios from 'axios'

const data = reactive({
  topicsActive: null,
  topicsDone: null,
  topics: null,
  progress: '20%',
  progress100: '100%'
})
const { store } = useStore()
store.ui.primeTitle = 'Дошка'
const getTopicsActive = function () {
  axios({
    method: 'GET',
    url: '/api/topics-active',
    data: {}
 }).then(function (response) {
   console.log(response.data)
   data.topicsActive = response.data
 })
}
const getTopicsDone = function () {
  axios({
    method: 'GET',
    url: '/api/topics-done',
    data: {}
 }).then(function (response) {
   console.log(response.data)
   data.topicsDone = response.data
 })
}
const getTopics = function () {
  axios({
    method: 'GET',
    url: '/api/topics',
    data: {}
 }).then(function (response) {
   console.log(response.data)
   data.topics = response.data
 })
}
getTopicsActive()
getTopicsDone()
getTopics()
</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
.section-title{
  width: 100%;
  color: #192736;
  font-weight: 500;
  padding-top: 24px;
  padding-bottom: 8px;
  h2{
    display: inline;
    font-size: 1.9rem;
    padding-left: 4px;
    padding-right: 4px;
    border-bottom: 3px solid;
  }
}
.current-courses{
  display: flex;
  justify-content: flex-start;
  align-items: center;
  flex-wrap: wrap;
}
.cuerse-wrap{
  padding: 16px;
  width: 100%;
  .cuerse{
    display: flex;
    flex-wrap: wrap;
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
  }
  .get{
    margin-top: 26px;
  }
  .progress{
    width: 100%;
    .progress-header{
      display: flex;
      color: #017605;
      font-size: 0.8rem;
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



#topics-active{
  .cuerse{
    outline-color: #45d800;
  }
  .section-title h2{
    color: #45d800;
  }
}
#topics-done{
  .cuerse{
    outline-color: gray;
  }
  .section-title h2{
    color: gray;
  }
}
#topics{
  .cuerse{
    outline-color: #5186ff;
  }
  .section-title h2{
    color: #5186ff;
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
@media (min-width: 1920px) {
  .current-courses{
    .cuerse-wrap{
      width: 100%;
      padding: 16px;
      .get{
        justify-content: flex-start;
      }
    }
  }
  .cuerse-wrap{
    width: 25%;
    padding: 16px;
    .course-logo{
      display: flex;
      align-items: center;
      img{
      max-width: 100%;
      width: auto;
      height: 247px;
      }
    }
  }
}
</style>
