<template>
  <main>
    <section class="current-course">
      <div class="section-title">
        <h4>Активна тема</h4>
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
              <span class="material-icons pointer">where_to_vote</span>
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
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { reactive } from 'vue'

const data = reactive({
  progress: '80%'
})


import { useStore } from '@/store'
const { store } = useStore()
store.ui.primeTitle = 'Дошка'

</script>

<style lang="scss" scoped>
.current-course{
  display: flex;
  justify-content: flex-start;
  align-items: center;
  flex-wrap: wrap;
  .section-title{
    h4{
      width: 100%;
      margin: 16px 0 32px 0;
      color: #c86eff;
      font-weight: bold;
      border-bottom: 3px solid;
    }
  }
}
.cuerse-card{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  width: 100%;
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0px 2px 2px 0px rgba(148,148,148,0.35);
}
.course-logo{
  img{
    width: 320px;
    border-radius: 16px;
  }
}
.course-about{
  padding: 16px;
  flex-grow: 1;
}
.title{
  font-size: 1.3rem;
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
    background: gray;
    height: 16px;
    box-shadow: 0px 0px 4px 0px rgba(148,148,148,1);
    .pointer{
      font-size: 16px;
      color: white;
      margin-left: -8px;
    }
    .progress-liner{
      background: linear-gradient(90deg, #FFEF62 0.66%, #45D800 100%);
      text-align: center;
      height: 16px;
    }
  }
}
.get{
  display: flex;
  padding: 16px;
  justify-content: center;
  .get-items{
    border-radius: 7px;
    flex-wrap: wrap;
    flex-direction: column;
    box-shadow: 0px 0px 4px 0px rgba(148,148,148,1);
    span{
      display: block;
    }
  }
}
@media (min-width: 1200px) {
  .get{
    justify-content: flex-start;
  }
}
</style>
