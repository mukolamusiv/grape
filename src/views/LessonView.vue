<template>
  <main v-if="data.lesson" class="main" :class="{blackout: store.ui.lessonTab === 'test' }">
    <section class="lesson-header" v-if="store.ui.lessonTab === 'video'">
      <div class="bread-crumbs">
        <router-link :to="{ path: `/topic/${data.lesson.topic_id}`}">
          <span class="material-icons">reply</span>
          <span>Тема: "{{data.lesson.topic_title.substring(0, 20)}}<span v-if="data.lesson.topic_title.length>20">..</span>"</span>
        </router-link>
      </div>
      <div class="lesson-about">
        <div class="title">
          Урок: "{{data.lesson.title}}"
        </div>
        <div class="lesson-structure" v-if="data.lesson.video_completed">
          <a class="lesson-structure-item cl-done" href="#">
            <span class="material-icons lecture">movie</span>
            Відео-лекція
            <span class="material-icons accept" v-if="data.lesson.video_completed">task_alt</span>
          </a>
          <a class="lesson-structure-item" href="#" @click="store.ui.lessonTab = 'test'">
            <span class="material-icons test">quiz</span>
            Тестування
            <span class="material-icons accept"  v-if="data.lesson.question_completed">task_alt</span>
          </a>
          <a class="lesson-structure-item" href="#">
            <span class="material-icons find-couple">gesture</span>
            Підбери пару
            <span class="material-icons accept"  v-if="data.lesson.find_couple_completed">task_alt</span>
          </a>
          <a class="lesson-structure-item" href="#">
            <span class="material-icons crossword">border_all</span>Кросворд
            <span class="material-icons accept"  v-if="data.lesson.crossword_completed">task_alt</span>
          </a>
          <a class="lesson-structure-item" href="#">
            <span class="material-icons coloring">palette</span>
            Розмальовка
            <span class="material-icons accept"  v-if="data.lesson.coloring_page_completed">task_alt</span>
          </a>
        </div>
        <!-- <div class="lesson-structure" v-if="!data.lesson.check_video">
          <div class="lesson-message">
          Переглянь відео-лекцію, щоб розблокувати інші завдання уроку!
          </div>
        </div> -->
      </div>
    </section>
    <section class="lesson-content" v-if="store.ui.lessonTab === 'video'">
      <!-- <div class="player" v-if="data.video.url" :class="{'timeline-hidden' : !data.lesson.check_video}"> -->
      <div class="player" v-if="data.lesson.video_url" :class="{'timeline-hidden' : !data.lesson.video_completed}">
        <video
          @ended="videoViewed()"
          controls
          preload="auto"
          controlsList="nodownload"
          :src="data.lesson.video_url">
              Your browser does not support the
              <code>audio</code> element.
        </video>
      </div>
      <div class="description">
        {{data.lesson.description}}
      </div>
    </section>
    <test v-if="store.ui.lessonTab === 'test'"/>
  </main>
</template>

<script setup>
import { reactive} from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import Test from '@/components/Test.vue'
import { useStore } from '@/store'

const { store } = useStore()
const route = useRoute()

const data = reactive({
  lesson: null,
})
store.ui.lessonTab = 'video'
const getLesson = function () {
  axios({
    method: 'GET',
    url: `/api/lesson/${route.params.id}`,
    data: {}
 }).then(function (response) {
   data.lesson = response.data
   console.log(response.data)
 })
}
const videoViewed = function () {
  if(!data.lesson.video_completed){
    axios({
      method: 'PUT',
      url: `/api/lesson-check-video/${route.params.id}`,
      data: {}
    }).then(function () {
      getLesson()
    })
 }
}
getLesson()
</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
.accept{
  margin-left: 8px;
  margin-right: 0!important;
}
.blackout{
 background: #192736b8;
}
.timeline-hidden{
  video::-webkit-media-controls-timeline{
    display: none!important;
  }
}
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
  justify-content: center;
  flex-wrap: wrap;
  width: 100%;
  .title{
    width: 100%;
    text-align: center;
    font-size: 2.5rem;
    font-weight: 600;
    color: #6f40fe;
    margin-bottom: 16px;
  }
}
.description{
  padding: 16px 24px;
  border-radius: 5px;
  background: #e8b6041c;
  color: #192736;
  font-size: 1.1rem;
  font-style: italic;
  width: 100%;
  margin: 0 32px;
}
.lesson-structure{
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  align-items: center;
  padding: 12px;
  border-radius: 5px;
  // outline: 1px solid #7a4ffe;
  background: #efefef;
  .lesson-message{
    text-align: center;
    width: 100%;
    font-size: 1.1rem;
    font-weight: bold;
    color: #808080;
    padding: 4px 16px;
  }
  .lesson-structure-item{
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    font-size: 1.1rem;
    font-weight: bold;
    padding: 0px 4px;
    margin: 8px;
    color: #556efe;
    .material-icons{
      margin-right: 8px;
      width: 24px;
    }
  }

}
.lesson-content{
  display: flex;
  justify-content: center;
  padding-top: 0;
  flex-wrap: wrap;
  .lesson-content-text{
    max-width: 100%;
    font-size: 1.2rem;
  }
}
.player{
  width: 100%;
  padding: 0 32px;
  overflow: hidden;
  audio{
    width: 100%;
  }
  video{
    width: 100%;
    margin-bottom: -7px;
  }
}
.crossword{
  color: #212529;
}
.coloring{
  color: #e95222;
}
.lecture{
  color: #355373;
}
.find-couple{
  color: #fb00dd;
}
.test{
  color: #198754;
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
  .description{
    max-width: 40%;
    flex-grow: 1;
    border-radius: 5px 0 0 5px;
    margin: 0;
  }
  .player{
    flex-grow: 1;
    height: auto;
    padding: 0 32px 0 0;
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
  .lesson-structure{
    margin: 0;
    // flex-direction: column;
    justify-content: center;
    .lesson-structure-item{
      width: calc(100% - 8px) ;
      padding: 4px;
      margin: 4px;
      text-align: center;
    }
  }
  .description{
    font-size: 1.1rem!important;
    margin: 0!important;
  }
  .lesson-content{
    .lesson-content-text{
      font-size: 1rem;
    }
  }
  .player{
    padding: 0;
    margin-bottom: 32px;
  }
  .accept {
    margin-left: auto;
    margin-right: 0!important;
  }
}
</style>
