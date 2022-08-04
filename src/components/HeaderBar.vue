<template>
  <header>
    <div class="logo-item">
        <img src="@/assets/img/logo9.png" alt="Grape">
        <span class="text d-1200-flex d-none">«Я виноградина, ви – гілки. Хто перебуває в мені, а я в ньому, – той плід приносить щедро…» Йоана, 15,5</span>
    </div>
    <div class="notifications-panel">
      <div class="notifications">
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
    <div class="nav-btn c-pointer toggle-btn">
        <span class="material-icons toggle-btn" v-if="!store.ui.navOpen" @click="store.ui.navOpen = !store.ui.navOpen">menu</span>
        <span class="material-icons" v-if="store.ui.navOpen" >menu_open</span>
    </div>
    <nav v-if="store.ui.navOpen" class="menu">
      <div class="avatar-block c-pointer">
        <div class="avatar-img">
          <span class="img">М</span>
        </div>
        <div class="name-role-block">
          <div class="user-name">Микола Мисів</div>
          <div  class="role">учень</div>
        </div>
      </div>
      <hr>
    </nav>
  </header>
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
header{
  // box-shadow: 0px 1px 2px 0px rgba(148,148,148,0.15);
  // box-shadow: 0px 0px 4px 2px rgba(153,145,153,0.10);
  // background: white;
  display: flex;
  align-items: center;
  max-width: 100%;
  height: 60px;
  padding: 6px 16px;
}
.logo-item{
  display: flex;
  align-items: center;
  .text{
    width: 400px;
    padding: 5px 15px;
    font-size: 0.7rem;
    color: #00951d7d;
    display: inline-block;
  }
  img{
    height: 40px;
    background: radial-gradient(85.37% 85.37% at 13.41% 14.63%, #f5ff49 0%, #45D800 100%);
  }
}
.notifications-panel{
  flex-grow: 1;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  .notifications{
    display: flex;
    align-items: center;
    justify-content: center;
    .get-items{
          box-shadow: 0px 10px 20px 0px rgb(148 148 148);
    }
  }
}
.nav-btn{
  outline: 2px solid #cbc8c8;
  display: flex;
  padding: 5px;
  border-radius: 16px;
  background: #8300d3;
  color: white;
  box-shadow: 0px 10px 20px 0px rgb(148 148 148);
  .material-icons{
    font-size: 28px;
  }
}
.nav-btn:hover{
  background: #9d68be;
}
nav{
  position: absolute;
  top: 61px;
  right: 16px;
  background: #f6f6f6;
  // box-shadow: 0px 1px 1px 1px rgba(148,148,148,0.20);
  outline: 1px solid #80808038;
  padding: 16px;
  border-radius: 0 0 16px 16px;
  .avatar-block{
    width: fit-content;
    display: flex;
    align-items: center;
    padding: 8px 16px;
    border-radius: 25px;
    .avatar-img{
      display: flex;
      align-items: center;
      .material-icons{
        padding: 3px;
      }
      .img{
        font-size: 18px;
        margin-right: 8px;
        padding: 4px 8px;
        color: #0053ff;
        border-radius: 16px;
        outline: 2px solid #0053ff;
      }
    }
    .name-role-block{
      display: flex;
      flex-direction: column;
      justify-content: center;
      .user-name{
        color: #0053ff;
        font-size: 0.8rem
      }
      .role{
        color: gray;
        font-size: 0.6rem;
      }
    }
  }
  .avatar-block:hover{
    .user-name{
      color: #00951d;
    }
    .img{
      outline: 2px solid #00951d;
      color: #00951d;
    }
  }
}
@media (min-width: 1200px) {
  nav {

  }
}
</style>
