<template>
  <main>
    <section class="current-courses" id="topics-active" v-if="data.topicsActive">
      <div class="section-title">
        <h2>Активні: {{data.topicsActive.length}}</h2>
      </div>
      <topic-cards :topics="data.topicsActive" :linkTitle="`Продовжити`"/>
    </section>
    <section id="topics-done" v-if="data.topicsDone">
      <div class="section-title">
        <h2 class="cl-gray">Пройдені: {{data.topicsDone.length}}</h2>
      </div>
      <topic-cards :topics="data.topicsDone" :linkTitle="`Переглянути`"/>
    </section>
    <section id="topics" v-if="data.topics">
      <div class="section-title">
        <h2 class="cl-blue">Доступні: {{data.topics.length}}</h2>
      </div>
      <topic-cards :topics="data.topics" :linkTitle="`Розпочати`"/>
    </section>
  </main>
</template>

<script setup>
import TopicCards from '@/components/TopicCards.vue'
import { reactive } from 'vue'
import axios from 'axios'
import { useStore } from '@/store'
const { store } = useStore()

const data = reactive({
  topicsActive: null,
  topicsDone: null,
  topics: null,
  progress: '20%',
  progress100: '100%'
})

const getTopics = function (url, saveTo) {
  axios({
    method: 'GET',
    url: `/api/${url}`,
    data: {}
 }).then(function (response) {
   data[saveTo] = response.data
 }).catch(function (error) {
    store.error(error.request.status)
 })
}

getTopics('topics-active', 'topicsActive')
getTopics('topics-done', 'topicsDone')
getTopics('topics', 'topics')
</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
.section-title{
  width: 100%;
  color: #192736;
  font-weight: 500;
  margin: 16px 0;
  h2{
    display: inline;
    font-size: 1.9rem;
    padding-left: 32px;
    padding-right: 32px;
    border-bottom: 3px solid;
    border-radius: 5px 5px 0 0;
  }
}
#topics-active{
  .section-title h2{
    background-color: #45d800;
    color: white;
  }
  background: #45d80014;
}
#topics-done{
  .section-title h2{
    background-color: gray;
    color: white;
  }
  background: #00000014;
}
#topics{
  .section-title h2{
    background-color: #5186ff;
    color: white;
  }
  background: #5186ff1a;
}
</style>
