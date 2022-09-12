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
          Урок: "{{data.lesson.title}}"
        </div>
        <div class="lesson-structure">
          <div class="lesson-structure-title">
            Зміст уроку:
          </div>
          <a class="lesson-structure-items active-tab" href="#">Відео-лекція</a>
          <a class="lesson-structure-items" href="#">Тестування</a>
          <a class="lesson-structure-items" href="#">Кросворд</a>
          <a class="lesson-structure-items" href="#">Розмальовка</a>
        </div>
      </div>
    </section>
    <section class="lesson-content">
      <div class="player">
        <video v-if="data.lesson.attachment[1]"
          controls
          preload="auto"
          controlsList="nodownload"
          :src="data.lesson.attachment[1].url">
              Your browser does not support the
              <code>audio</code> element.
        </video>
      </div>
      <div class="description">
        {{data.lesson.description}}
      </div>
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
  font-size: 1.2rem;
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
  .lesson-structure-title{
    font-size: 1.2rem;
    font-weight: bold;
    color: #808080;
    padding: 4px 16px;
  }
  .lesson-structure-items{
    font-size: 1.1rem;
    font-weight: bold;
    padding: 0px 4px;
    margin: 0 8px;
    color: #556efe;
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
  audio{
    width: 100%;
  }
  video{
    width: 100%;
    margin-bottom: -7px;
  }
}
.active-tab{
  border-bottom: 2px solid #6f43fe;
  margin-bottom: 0;
  color: #6f43fe!important;
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
    .lesson-structure-title{
      display: none;
    }
    .lesson-structure-items{
      width: calc(50% - 8px) ;
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
}
</style>
