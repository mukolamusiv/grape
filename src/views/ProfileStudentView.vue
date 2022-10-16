<template>
  <main v-if="data.user">
    <section class="Profile p-0">
      <div class="avatar-block">
        <div class="avatar-img">
        <div class="img" v-if="!data.user.photo">
            <img src="@/assets/img/avatar.svg" alt="avatar">
          </div>
          <span class="img" v-if="data.user.photo" :style="{ 'background-image': `url(${store.homeUrl+data.user.photo})` }"></span>
        </div>
      </div>
      <div class="user-about" v-if="!data.edit && !data.editPassword">
        <div class="name">
          <h2>{{data.user.name}} {{data.user.surname}}</h2>
        </div>
        <div  class="role">
          <span v-if="data.user.role_user !== 'katehyt'">учень</span>
          <span v-if="data.user.role_user === 'katehyt'">катехит</span>
        </div>
        <div class="birthday">
          {{data.user.birthday.split('-').reverse().join('.')}}
        </div>
        <div class="email">
          <span class="material-icons">mail</span>
          {{data.user.email}}
        </div>
      </div>
      <div class="get">
        <div class="get-items sun">
            <span class="material-icons">brightness_5</span>
            <span>{{data.user.lumen}}</span>
        </div>
        <div class="get-items water">
            <span class="material-icons">water_drop</span>
            <span>{{data.user.water}}</span>
        </div>
        <div class="get-items energy">
            <span class="material-icons">electric_bolt</span>
            <span>{{data.user.energy}}</span>
        </div>
      </div>
    </section>
    <hr class="mr-0">
    <section class="section-topics">
      <div id="topics-active" class="topics" v-if="data.topicsActive">
        <div class="title">
          <h2>Активні: {{data.topicsActive.length}}</h2>
        </div>
        <div class="topic" v-for="(topic) in data.topicsActive" v-bind:key="topic.id">
          <router-link class="topic-title" :to="{ path: `/topic/${topic.id}`}">
            {{topic.title}}
          </router-link>
          <div class="lessons-wrap">
            <div class="wrap-lesson-card" v-if="topic.lessons_DTO">
              <div class="lesson-card" :class="{'lesson-completed' : lesson.completed}"  v-for="(lesson, index) in topic.lessons_DTO" v-bind:key="lesson.lesson_id">
                <div class="lesson-title">
                  <span>{{index+1}}. {{lesson.title}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="topics-done" class="topics" v-if="data.topicsDone">
        <div class="title">
          <h2 class="cl-gray">Пройдені: {{data.topicsDone.length}}</h2>
        </div>
        <div v-for="(topic) in data.topicsDone" v-bind:key="topic.id">
          <router-link class="topic-title" :to="{ path: `/topic/${topic.id}`}">
            {{topic.title}}; &nbsp;
          </router-link>
        </div>
      </div>
      <div id="topics" class="topics">
        <div class="title">
          <h2 class="cl-blue">Доступні: {{data.topics.length}}</h2>
        </div>
        <div v-for="(topic) in data.topics" v-bind:key="topic.id">
          <router-link class="topic-title" :to="{ path: `/topic/${topic.id}`}">
            {{topic.title}}; &nbsp;
          </router-link>
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { reactive } from 'vue'
import { useRoute } from 'vue-router'
import { useStore } from '@/store'
import axios from 'axios'

const { store } = useStore()
const route = useRoute()

const data = reactive({
  user: null,
  topicsActive: [],
  topicsDone: [],
  topics: [],
})

const getUser = function () {
  axios({
    method: 'GET',
    url: `/api/user/${route.params.id}`,
    data: {}
 }).then(function (response) {
   data.user = response.data
   console.log(response.data)

  })
}

const getTopics = function (url, saveTo) {
  axios({
    method: 'GET',
    url: `/api/${url}/${route.params.id}`,
    data: {}
 }).then(function (response) {
   console.log(saveTo, response.data)
   data[saveTo] = response.data
 })
}
getTopics('user-topics-active', 'topicsActive')
getTopics('user-topics-done', 'topicsDone')
getTopics('user-topics', 'topics')

getUser()
</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
.p-0{
  padding: 0;
}
hr{
  width: 100%;
}
.mr-0{
  margin: 0;
}
.get{
  margin: 0;
}
.Profile{
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 5px;
}
.avatar-block{
  display: flex;
  flex-wrap: wrap;
  flex-direction: column;
  align-items: center;
  padding: 16px;
  .avatar-img{
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
    overflow: hidden;
    .img{
      display: flex;
    justify-content: center;
    align-items: center;
    width: 150px;
    height: 150px;
    font-size: 18px;
    padding: 4px 8px;
    color: inhetir;
    background-position: center;
    background-size: cover;
    }
  }
}
.user-about{
  flex-grow: 1;
  padding: 16px;
  display: flex;
  flex-direction: column;
  align-items: center;
  .name{
    flex-grow: 1;
    h2 {
      font-size: 2rem;
      font-weight: bold;
      .material-icons{
        position: relative;
        top: -10px;
        color: #5186FF;
      }
      .material-icons:hover{
        opacity: 0.8;
      }
    }
  }
  .role{
    font-size: 1.3rem;
  }
  .birthday{
    font-size: 1.3rem;
    font-weight: bold;
  }
  .email{
    display: flex;
    align-items: center;
    color: #174c9a;
    font-weight: bold;
    margin-top: 8px;
    .material-icons{
      padding-right: 4px;
    }
  }
}
.section-topics{
  display: flex;
  flex-direction: column;
  padding: 0;
  .topics{
    padding: 16px;
    display: flex;
    flex-wrap: wrap;
  }
  .title{
    width: 100%;
    display: flex;
    padding: 8px;
  }
}
#topics-active{
  .title h2{
    background-color: #45d800;
    color: white;
  }
  background: #45d80014;
}
#topics-done{
  .title h2{
    background-color: gray;
    color: white;
  }
  background: #00000014;
}
#topics{
  .title h2{
    background-color: #5186ff;
    color: white;
  }
  background: #5186ff1a;
}

.topic{
  width: 50%;
  padding: 8px;
  .topic-title{
    display: block;
    text-align: center;
    font-size: 1.2rem;
    font-weight: bold;
  }
  .lessons-wrap{
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 16px;
    padding-top: 0;
    .lesson-card{
      margin: 8px 0;
      padding: 8px 16px;
      display: flex;
      align-items: center;
      color: #192736;
      background: #1927361f;
      border-radius: 5px;
      .lesson-title{
        display: flex;
        align-items: center;
        font-size: 0.8rem;
        .material-icons{
          margin-right: 8px;
        }
      }
    }
  }
}
</style>
