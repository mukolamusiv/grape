<template>
  <main>
    <div class="title-page">
      Мій клас
    </div>
    <div class="classroom">
      <router-link :to="{ path: `/profile-student/${user.id}`}" class="classroom-item" v-for="(user, index) in data.classroom" v-bind:key="user.id">
        <div>{{index+1}})</div>
        <div class="name">{{user.surname}} {{user.name}}</div>
        <div>{{user.birthday.split('-').reverse().join('.')}}</div>
        <div>{{user.email}}</div>
        <div class="get">
          <div class="get-items sun" v-if="user.lumen">
              <span class="material-icons">brightness_5</span>
              <span>{{user.lumen}}</span>
          </div>
          <div class="get-items water">
              <span class="material-icons">water_drop</span>
              <span>{{user.water}}</span>
          </div>
          <div class="get-items energy">
              <span class="material-icons">electric_bolt</span>
              <span>{{user.energy}}</span>
          </div>
        </div>
      </router-link>
    </div>
  </main>
</template>

<script setup>
import { reactive } from 'vue'
import axios from 'axios'
import { useStore } from '@/store'
const { store } = useStore()

const data = reactive({
  classroom: null,
})
const getClassroom = function () {
  axios({
    method: 'GET',
    url: `/api/classroom/1`,
    data: {}
 }).then(function (response) {
   data.classroom = response.data
  }).catch(function (error) {
     store.error(error.request.status)
  })
}
getClassroom()
</script>

<style lang="scss" scoped>
main{
  padding: 16px;
}
.title-page{
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  font-size: 2.5rem;
  font-weight: 600;
  color: #6f40fe;
  margin-bottom: 16px;
}
.classroom{
  width: 100%;
  .classroom-item{
    width: 100%;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    color: #192736;
    background: #f0f1f2;
    border-radius: 5px;
    margin-bottom: 8px;
    div{
      padding: 8px;
      font-size: 1.1rem;
    }
    .name{
      min-width: 300px;
    }
  }
  .classroom-item:hover{
    color: #6f40fe;
  }
}
.get{
  margin: 0;
  flex-grow: 1;
  display: flex;
  justify-content: flex-end;
  .get-items{
    flex-direction: row;
    padding: 4px!important;
    font-size: 1rem!important;
    line-height: 1rem;
    margin: 0;
    margin-left: 8px;
    .material-icons{
      font-size: inherit;
    }
  }
}

</style>
