<template>
  <main>
    <section class="current-course">
      <div class="section-title">
        <h2 class="cl-2">Активні</h2>
      </div>
      <div class="cuerse-card">
        <div class="course-logo">
          <img src="https://img.wallscloud.net/uploads/cache/337780982/58-1024x576-MM-90.webp" alt="">
        </div>
        <div class="course-about">
          <div class="title">Приготування на Таїнства Покаяння</div>
          <div class="progress">
            <div class="progress-header">
              <div>Пройдено</div> <span class="progress-value">{{data.progress}}</span>
            </div>
            <div class="progress-liner-wrap">
              <div class="progress-liner" :style="{ 'width': data.progress}"></div>
            </div>
          </div>
          <div class="get">
            <div class="get-items sun">
                <span class="material-icons">brightness_5</span>
                <span>15</span>
            </div>
            <div class="get-items water">
                <span class="material-icons">water_drop</span>
                <span>15</span>
            </div>
            <div class="get-items energy">
                <span class="material-icons">electric_bolt</span>
                <span>15</span>
            </div>
          </div>
          <div class="grape-btn-wrap">
            <div class="grape-btn">
              <a href="#">Продовжити</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="section-title">
        <h2>Пройдені</h2>
      </div>

    </section>
  </main>
</template>

<script setup>
import { reactive } from 'vue'

const data = reactive({
  progress: '20%'
})


import { useStore } from '@/store'
const { store } = useStore()
store.ui.primeTitle = 'Дошка'

</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
.section-title{
  width: 100%;
  color: #192736;
  font-weight: 500;
  margin-top: 24px;
  margin-bottom: 24px;
  h2{
    display: inline;
    font-size: 1.4rem;
    padding-left: 4px;
    padding-right: 4px;
    border-bottom: 1px solid #d6b84ebf;
  }
}
.current-course{
  display: flex;
  justify-content: flex-start;
  align-items: center;
  flex-wrap: wrap;
}
.cuerse-card{
  outline: 1px solid #dddcdc;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  width: 100%;
  background: #ffffff;
  border-radius: 5px;
}
.course-logo{
  padding: 16px;
  img{
    width: 320px;
    max-height: 198px;
    max-width: 352px;
    border-radius: 5px;
  }
}
.course-about{
  padding: 16px;
  flex-grow: 1;
}
.title{
  font-size: 1.2rem;
  font-weight: 600;
  color: #6f40fe;
  margin-bottom: 24px;
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
  display: flex;
  justify-content: flex-end;
  align-items: flex-end;
  .grape-btn{
    padding: 8px 16px;
    background: $background-2;
    max-width: fit-content;

  }
}
@media (min-width: 1200px) {
  .get{
    justify-content: flex-start;
  }
}
</style>
