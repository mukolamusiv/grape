<template>
  <main>
    <section class="current-courses" id="current-courses">
      <div class="section-title">
        <h2 class="cl-yellow">Активні</h2>
      </div>
      <div class="cuerse-wrap">
        <div class="cuerse">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
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
      </div>
      <div class="cuerse-wrap">
        <div class="cuerse">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
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
      </div>
      <div class="cuerse-wrap">
        <div class="cuerse">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
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
      </div>
    </section>
    <section id="passed-courses">
      <div class="section-title">
        <h2 class="cl-gray">Пройдені</h2>
      </div>
      <div class="cuerse-wrap">
        <div class="cuerse fit-content">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
          </div>
          <div class="course-about">
            <div class="title">Приготування на Таїнства Покаяння</div>
            <div class="progress">
              <div class="progress-header">
                <div>Пройдено</div> <span class="progress-value">{{data.progress100}}</span>
              </div>
              <div class="progress-liner-wrap">
                <div class="progress-liner" :style="{ 'width': data.progress100}"></div>
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
                <a href="#">Переглянути</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="cuerse-wrap">
        <div class="cuerse fit-content">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
          </div>
          <div class="course-about">
            <div class="title">Приготування на Таїнства Покаяння</div>
            <div class="progress">
              <div class="progress-header">
                <div>Пройдено</div> <span class="progress-value">{{data.progress100}}</span>
              </div>
              <div class="progress-liner-wrap">
                <div class="progress-liner" :style="{ 'width': data.progress100}"></div>
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
                <a href="#">Переглянути</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="available-courses">
      <div class="section-title">
        <h2 class="cl-blue">Доступні теми</h2>
      </div>
      <div class="cuerse-wrap">
        <div class="cuerse fit-content">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
          </div>
          <div class="course-about">
            <div class="title">Приготування на Таїнства Покаяння</div>
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
                <a href="#">Розпочати</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="cuerse-wrap">
        <div class="cuerse fit-content">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
          </div>
          <div class="course-about">
            <div class="title">Приготування на Таїнства Покаяння</div>
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
                <a href="#">Розпочати</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="cuerse-wrap">
        <div class="cuerse fit-content">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
          </div>
          <div class="course-about">
            <div class="title">Приготування на Таїнства Покаяння</div>
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
                <a href="#">Розпочати</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="cuerse-wrap">
        <div class="cuerse fit-content">
          <div class="course-logo">
            <img src="@/assets/img/default-course-logo.png" alt="">
          </div>
          <div class="course-about">
            <div class="title">Приготування на Таїнства Покаяння</div>
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
                <a href="#">Розпочати</a>
              </div>
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
  progress: '20%',
  progress100: '100%'
})


import { useStore } from '@/store'
const { store } = useStore()
store.ui.primeTitle = 'Дошка'

</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
// .fit-content{
//   width: fit-content;
// }
.section-title{
  width: 100%;
  color: #192736;
  font-weight: 500;
  padding-top: 24px;
  padding-bottom: 8px;
  h2{
    display: inline;
    font-size: 1.9rem;
    padding-left: 4px;
    padding-right: 4px;
    border-bottom: 3px solid;
  }
}
.current-courses{
  display: flex;
  justify-content: flex-start;
  align-items: center;
  flex-wrap: wrap;
}
.cuerse-wrap{
  padding: 16px;
  width: 100%;
  .cuerse{
    display: flex;
    flex-wrap: wrap;
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
    margin-top: 16px;
    flex-grow: 1;
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    .grape-btn{
      padding: 8px 16px;
      border-radius: 25px;
      outline: 1px solid #5186FF;
      max-width: fit-content;
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



#current-courses{
  .cuerse{
    outline-color: #e8b604;
  }
}
#passed-courses{
  .cuerse{
    outline-color: gray;
  }
}
#available-courses{
  .cuerse{
    outline-color: #5186ff;
  }
}
@media (min-width: 768px) {
  .cuerse-wrap{
    width: 50%;
    padding: 16px;
  }
 }
@media (min-width: 1200px) {
  .cuerse-wrap{
    width: 25%;
    padding: 16px;
  }
}
@media (min-width: 1920px) {
  .current-courses{
    .cuerse-wrap{
      width: 100%;
      padding: 16px;
      .get{
        justify-content: flex-start;
      }
    }
  }
  .cuerse-wrap{
    width: 25%;
    padding: 16px;
    .course-logo{
      display: flex;
      align-items: center;
      img{
      max-width: 100%;
      width: auto;
      height: 247px;
      }
    }
  }
}
</style>
