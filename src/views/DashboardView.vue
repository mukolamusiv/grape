<template>
  <main>
    <section class="current-courses" id="topics-active" v-if="data.topicsActive">
      <div class="section-title">
        <h2>Активні: {{data.topicsActive.length}}</h2>
      </div>
      <topic-card :topics="data.topicsActive"/>
    </section>
    <section id="topics-done" v-if="data.topicsDone">
      <div class="section-title">
        <h2 class="cl-gray">Пройдені: {{data.topicsDone.length}}</h2>
      </div>
      <topic-card :topics="data.topicsDone"/>
    </section>
    <section id="topics" v-if="data.topics">
      <div class="section-title">
        <h2 class="cl-blue">Доступні: {{data.topics.length}}</h2>
      </div>
      <topic-card :topics="data.topics"/>
    </section>
  </main>
</template>

<script setup>
import TopicCard from '@/components/TopicCard.vue'
import { reactive } from 'vue'
import axios from 'axios'

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
   console.log(saveTo, response.data)
   data[saveTo] = response.data
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
    margin-top: 26px;
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



#topics-active{
  // .cuerse{
  //   outline-color: #45d800;
  // }
  .section-title h2{
    // color: #45d800;
    background-color: #45d800;
    color: white;
  }
  background: #45d80014;
}
#topics-done{
  // .cuerse{
  //   outline-color: gray;
  // }
  .section-title h2{
    // color: gray;
    background-color: gray;
    color: white;
  }
  background: #00000014;
}
#topics{
  // .cuerse{
  //   outline-color: #5186ff;
  // }
  .section-title h2{
    // color: #5186ff;
    background-color: #5186ff;
    color: white;
  }
  background: #5186ff1a;
}
// @media (min-width: 1920px) {
//   .current-courses{
//     .cuerse-wrap{
//       width: 100%;
//       padding: 16px;
//       .cuerse{
//         flex-direction: row;
//       }
//       .get{
//         justify-content: flex-start;
//       }
//     }
//   }
//   .cuerse-wrap{
//     width: 25%;
//     padding: 16px;
//     .course-logo{
//       display: flex;
//       align-items: center;
//       img{
//       max-width: 100%;
//       width: auto;
//       height: 247px;
//       }
//     }
//   }
// }
</style>
