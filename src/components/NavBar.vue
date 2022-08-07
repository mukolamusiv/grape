<template>
  <nav @click="tick" v-show="store.ui.navOpen" class="menu animate__animated1 animate__slideInRight1">
    <div class="avatar-block c-pointer">
      <div class="avatar-img">
        <span class="img">
          <img src="@/assets/img/avatar.svg" alt="">
        </span>
      </div>
      <div class="name-role-block">
        <div class="user-name">Микола Мисів</div>
        <div  class="role">учень</div>
      </div>
    </div>
    <hr>
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
  </nav>
</template>

<script setup>
import { onUnmounted } from 'vue'
import { useStore } from '@/store'
const { store } = useStore()

function menuCloseClickOutside(e) {
    if(!e.target.matches('.menu, .menu *, .toggle-btn')) {
        store.ui.navOpen = false
    }
}
document.addEventListener('click', menuCloseClickOutside);
onUnmounted(() => {document.removeEventListener('click', menuCloseClickOutside)})
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
@import '@/assets/styles/color-style.scss';
hr{
  background-color: #ffffff!important;
}
nav{
  overflow-y: scroll;
  max-width: auto!important;
  background: $background-1;
  outline: 1px solid #80808038;
  padding: 16px;
  .avatar-block{
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 8px 16px;
    border-radius: 25px;
    color: #ffffff;
    .avatar-img{
      display: flex;
      align-items: center;
      .material-icons{
        padding: 3px;
      }
      .img{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 150px;
        height: 150px;
        font-size: 18px;
        margin-right: 8px;
        padding: 4px 8px;
        color: inhetir;
        border-radius: 150px;
        outline: 2px solid;
        img{
          height: 150px;
          width: 100px;
        }
      }
    }
    .name-role-block{
      display: flex;
      flex-direction: column;
      justify-content: center;
      .user-name{
        color: inhetit;
        font-size: 1.2rem
      }
      .role{
        color: inherit;
        opacity: 0.6;
        font-size:1rem;
      }
    }
  }
}
@media (min-width: 1200px) {
  nav {

  }
}

.animate__animated1 {
  // position: fixed;
  // position: absolute;
  margin: 0;
  top: 61px;
  right: 16px;
  animation-duration: 0.5s;

  animation-duration: var(--animate-duration);

  animation-fill-mode: both;
}
@keyframes slideInRight {
  from {

    transform: translate3d(100%, 0, 0);
    visibility: visible;
  }

  to {

    transform: translate3d(0, 0, 0);
    visibility: visible;
  }
}
.animate__slideInRight1 {
  animation-name: slideInRight;
}
</style>
