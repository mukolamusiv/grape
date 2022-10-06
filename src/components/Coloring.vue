<template>
  <section class="wrap" v-if="data.coloringPage">
    <div class="test animate__animated animate__zoomIn">
      <div class="close">
        <span class="material-icons c-pointer cancel" @click="store.ui.lessonTab = 'video'">disabled_by_default</span>
      </div>
      <div class="coloring-page">
        <inline-svg id="coloringPage" :src="data.coloringPage.svg"/>
        <div class="coloring-page-panel">
          <div class="primary-colors">
            <div class="color-picker-primary-color" v-for="(color, index) in data.colorPicker.primary" v-bind:key="color" :style="{background: color}" @click="colorPickerSelect(index)"></div>
          </div>
        </div>
        <div class="colors">
          <label v-for="(color) in data.colorSelected" v-bind:key="color" :style="{background: color}">
            <div class="color-picker-color"></div>
            <input type="radio" name="colorPicker" v-model="data.color" :value="color">
          </label>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { reactive, onUnmounted } from 'vue'
import InlineSvg from 'vue-inline-svg';
import { useRoute } from 'vue-router'
import axios from 'axios'
import { useStore } from '@/store'

const { store } = useStore()
const route = useRoute()

const data = reactive({
  coloringPage: null,
  colorSelected: null,
  colorPicker: {
    primary: [
      'rgb(255, 20, 20)',
      'rgb(255, 145, 20)',
      'rgb(255, 255, 21)',
      'rgb(255, 20, 146)',
      'rgb(255, 158, 148)',
      'rgb(20, 196, 255)',
      'rgb(61, 118, 255)',
      'rgb(100, 20, 179)',
      'rgb(47, 114, 52)',
      'rgb(138, 138, 138)',
      'rgb(151, 85, 25)',
      'rgb(53, 53, 53)'
    ],
    color: [
      [
        'rgb(255 20 20)',
        'rgb(255 40 40)',
        'rgb(255 60 60)',
        'rgb(255 80 80)',
        'rgb(255 100 100)',
        'rgb(255 120 120)',
        'rgb(255 140 140',
        'rgb(255 160 160)',
        'rgb(255 180 180)',
        'rgb(255 200 200)',
        'rgb(255 220 220)',
        'rgb(255 240 240)',
      ],
      [
        'rgb(255, 145, 20)',
        'rgb(255, 165, 40)',
        'rgb(255, 185, 60)',
        'rgb(255, 205, 80)',
        'rgb(255, 225, 100)',
        'rgb(255, 245, 120)',
        'rgb(255, 255, 140)',
        'rgb(255, 255, 160)',
        'rgb(255, 255, 180)',
        'rgb(255, 255, 200)',
        'rgb(255, 255, 220)',
        'rgb(255, 255, 240)',
      ],
      [
        'rgb(255, 255, 21)',
        'rgb(255, 255, 41)',
        'rgb(255, 255, 61)',
        'rgb(255, 255, 81)',
        'rgb(255, 255, 101)',
        'rgb(255, 255, 121)',
        'rgb(255, 255, 141)',
        'rgb(255, 255, 161)',
        'rgb(255, 255, 181)',
        'rgb(255, 255, 201)',
        'rgb(255, 255, 221)',
        'rgb(255, 255, 241)',
      ]
    ]
  },
  color: 'green'
})
data.colorSelected = data.colorPicker.color[0]
const colorPickerSelect = function (index) {
  data.colorSelected = data.colorPicker.color[index]
}
const getColoringPage = function () {
  axios({
    method: 'GET',
    url: `/api/lesson-coloring-page/${route.params.id}`,
    data: {}
 }).then(function (response) {
   console.log(response.data)
   data.coloringPage = response.data
   // data.questionsCount = data.questions.length
   // data.question = data.questions[data.questionNamber]
  })
}
function updateColoringPage() {
  const elem = document.getElementById('coloringPage');
  console.log(elem)
}
function clickColoringPage(e) {
  console.log(e.target)
    e.target.style.fill = data.color
    updateColoringPage()
}

getColoringPage()

document.addEventListener('click', clickColoringPage);
onUnmounted(() => {document.removeEventListener('click', clickColoringPage)})
</script>

<style scoped lang="scss">
@import '@/assets/styles/color-style.scss';
.opacity {
  opacity: 0.5;
}
.main{
  background: #19273678!important;
}
.wrap{
  display: flex;
  justify-content: center;
  padding: 28px;
  height: 100%;
  align-items: flex-start;
}
.test{
  border: 4px solid rgba(0,84,169,.149);
  background: #ffffff;
  border-radius: 5px;
  width: 100%;
  max-width: 768px;
  .close{
    display: flex;
    justify-content: flex-end;
    align-items: center;
    width: 100%;
    .test-number{
      flex-grow: 1;
      padding: 0 8px;
    color: gray;
    }
    .material-icons{
      font-size: 36px;
      margin-top: -4px;
      margin-right: -4px;
    }
  }
}
.coloring-page{
  display: flex;
  flex-direction: column;
  align-items: center;
  .color-picker-color{
    width: 40px;
    height: 40px;
  }
  input{
    display: none;
  }
  svg{
    max-height: 70vh;
    max-width: 100%;
  }
  .color-picker-primary-color{
    width: 50px;
    height: 50px;
    display: inline-block;
  }
}
</style>
