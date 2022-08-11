<template>
  <header>
    <div class="logo-item">
        <img src="@/assets/img/logo2.png" alt="Grape">
        <span class="text d-1200-flex d-none">«Я виноградина, ви – гілки. Хто перебуває в мені, а я в ньому, – той плід приносить щедро…» Йоана, 15,5</span>
    </div>
    <div class="nav-btn c-pointer toggle-btn">
        <span class="material-icons toggle-btn" v-if="!store.ui.navOpen" @click="store.ui.navOpen = !store.ui.navOpen">menu</span>
        <span class="material-icons" v-if="store.ui.navOpen" >menu_open</span>
    </div>
  </header>
</template>

<script setup>
import { useStore } from '@/store'
// import axios from 'axios'
const { store } = useStore()


</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
@import '@/assets/styles/color-style.scss';
header{
  position: fixed;
  display: flex;
  align-items: center;
  width: 100%;
  height: 60px;
  padding: 16px;
  background: $background-1;
}
.logo-item{
  display: flex;
  align-items: center;
  flex-grow: 1;
  .text{
    width: 400px;
    padding: 5px 15px;
    font-size: 0.7rem;
    color: $color2;
    display: inline-block;
  }
  img{
    height: 48px;
  }
}
.nav-btn{
  display: flex;
  padding: 5px;
  border-radius: 8px;
  background: $background-1;
  color: $color2;
  .material-icons{
    font-size: 24px;
  }
}
.nav-btn:hover{
  background: $background-1-hover;
  transition: 0.3s;
}
</style>
