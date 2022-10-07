<template>
  <section class="wrap" v-if="data.coloringPage">
    <div class="test animate__animated animate__zoomIn">
      <div class="close">
        <span class="material-icons c-pointer cancel" @click="store.ui.lessonTab = 'video'">disabled_by_default</span>
      </div>
      <div class="coloring-page">
        <inline-svg id="coloringPage" :src="data.coloringPage.svg"/>
        <div class="coloring-page-panel">
          <div class="colors">
            <label v-for="(color) in data.colorSelected" v-bind:key="color" :style="{background: color}">
              <div class="color-picker-color" :class="{'selected' : color == data.color}"></div>
              <input type="radio" name="colorPicker" v-model="data.color" :value="color">
            </label>
          </div>
          <div class="primary-colors">
            <div class="color-picker-primary-color" v-for="(color, index) in data.colorPicker.primary" v-bind:key="color" :style="{background: color}" @click="colorPickerSelect(index, color)"></div>
          </div>
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
  color: 'green',
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
        'rgb(255, 20, 20)',
        'rgb(255, 40, 40)',
        'rgb(255, 60, 60)',
        'rgb(255, 80, 80)',
        'rgb(255, 100, 100)',
        'rgb(255, 120, 120)',
        'rgb(255, 140, 140',
        'rgb(255, 160, 160)',
        'rgb(255, 180, 180)',
        'rgb(255, 200, 200)',
        'rgb(255, 220, 220)',
        'rgb(255, 240, 240)',
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
      ],
      [
        'rgb(255, 20, 146)',
        'rgb(255, 40, 166)',
        'rgb(255, 60, 186)',
        'rgb(255, 80, 206)',
        'rgb(255, 100, 226)',
        'rgb(255, 120, 246)',
        'rgb(255, 140, 255)',
        'rgb(255, 160, 255)',
        'rgb(255, 180, 255)',
        'rgb(255, 200, 255)',
        'rgb(255, 220, 255)',
        'rgb(255, 240, 255)'
      ],
      [
        'rgb(255, 158, 148)',
        'rgb(255, 168, 158)',
        'rgb(255, 178, 168)',
        'rgb(255, 188, 178)',
        'rgb(255, 198, 188)',
        'rgb(255, 208, 198)',
        'rgb(255, 218, 208)',
        'rgb(255, 228, 208)',
        'rgb(255, 238, 218)',
      ],
      [
        'rgb(20, 196, 255)',
        'rgb(40, 216, 255)',
        'rgb(60, 236, 255)',
        'rgb(80, 255, 255)',
        'rgb(100, 255, 255)',
        'rgb(120, 255, 255)',
        'rgb(140, 255, 255)',
        'rgb(160, 255, 255)',
        'rgb(180, 255, 255)',
        'rgb(200, 255, 255)',
        'rgb(220, 255, 255)',
        'rgb(240, 255, 255)'
      ],
      [
        'rgb(61, 118, 255)',
        'rgb(81, 138, 255)',
        'rgb(101, 158, 255)',
        'rgb(121, 178, 255)',
        'rgb(141, 198, 255)',
        'rgb(161, 218, 255)',
        'rgb(181, 238, 255)',
        'rgb(201, 255, 255)',
        'rgb(221, 255, 255)',
        'rgb(241, 255, 255)',
      ],
      [
        'rgb(100, 20, 179)',
        'rgb(120, 40, 199)',
        'rgb(140, 60, 219)',
        'rgb(160, 80, 239)',
        'rgb(180, 100, 255)',
        'rgb(200, 120, 255)',
        'rgb(220, 140, 255)',
        'rgb(240, 160, 255)',
        'rgb(255, 180, 255)',
        'rgb(255, 200, 255)',
        'rgb(255, 220, 255)',
        'rgb(255, 240, 255)',
      ],
      [
        'rgb(47, 114, 52)',
        'rgb(67, 134, 72)',
        'rgb(87, 154, 92)',
        'rgb(107, 174, 112)',
        'rgb(127, 194, 132)',
        'rgb(147, 214, 152)',
        'rgb(167, 234, 172)',
        'rgb(187, 254, 192)',
        'rgb(207, 255, 212)',
        'rgb(227, 255, 232)',
        'rgb(247, 255, 252)'
      ],
      [
        'rgb(138, 138, 138)',
        'rgb(158, 158, 158)',
        'rgb(178, 178, 178)',
        'rgb(198, 198, 198)',
        'rgb(218, 218, 218)',
        'rgb(238, 238, 238)'
      ],
      [
        'rgb(151, 85, 25)',
        'rgb(171, 105, 45)',
        'rgb(191, 125, 65)',
        'rgb(211, 145, 85)',
        'rgb(231, 165, 105)',
        'rgb(251, 185, 125)',
        'rgb(255, 205, 145)',
        'rgb(255, 225, 165)',
        'rgb(255, 245, 185)'
      ],
      [
        'rgb(53, 53, 53)',
        'rgb(73, 73, 73)',
        'rgb(93, 93, 93)',
        'rgb(113, 113, 113)',
        'rgb(133, 133, 133)',
        'rgb(153, 153, 153)',
        'rgb(173, 173, 173)',
        'rgb(193, 193, 193)',
        'rgb(213, 213, 213)',
        'rgb(233, 233, 233)',
        'rgb(253, 253, 253)'
      ]
    ]
  },
})
data.colorSelected = data.colorPicker.color[0]
const colorPickerSelect = function (index, color) {
  data.colorSelected = data.colorPicker.color[index]
  data.color = color
}
const getColoringPage = function () {
  axios({
    method: 'GET',
    url: `/api/lesson-coloring-page/${route.params.id}`,
    data: {}
 }).then(function (response) {
   console.log(response.data)
   data.coloringPage = response.data
  })
}
function updateColoringPage() {
  const elem = document.getElementById('coloringPage');
  console.log(elem)
  axios({
    method: 'POST',
    url: `/api/lesson-coloring-page/${route.params.id}`,
    data: {id: data.coloringPage.id, svg: elem}
 }).then(function () {})
}
function clickColoringPage(e) {
  if(e.target.id){
    if(e.target.id != 'Fill-550'){
      e.target.style.fill = data.color
      updateColoringPage()
    }
  }
}

getColoringPage()

document.addEventListener('click', clickColoringPage);
onUnmounted(() => {document.removeEventListener('click', clickColoringPage)})
</script>

<style scoped lang="scss">
@import '@/assets/styles/color-style.scss';
.selected{
  outline: 2px solid gray;
  margin: 3px;
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
  svg{
    max-height: 600px;
    max-width: 100%;
    fill: none!important;
  }
  .coloring-page-panel{
    .colors{
      .color-picker-color{
        width: 40px;
        height: 40px;
      }
      input{
        display: none;
      }
    }
    .primary-colors{
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      .color-picker-primary-color{
        width: 50px;
        height: 50px;
        display: inline-block;
      }
    }
  }
}
@media (max-width: 575.98px) {
  .coloring-page svg{
    max-height: 45vh;
  }
}
</style>
