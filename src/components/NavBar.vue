<template>
  <nav @click="tick" v-show="store.ui.navOpen" class="menu animate__animated animate__slideInRight" v-if="store.user">
    <router-link to="/profile" class="avatar-block c-pointer">
      <div class="avatar-img">
        <span class="img" v-if="!store.user.photo">
          <img src="@/assets/img/avatar.svg" alt="avatar">
        </span>
        <span class="img" v-if="store.user.photo" :style="{ 'background-image': `url(${store.homeUrl+store.user.photo})` }"></span>
      </div>
      <div class="name-role-block">
        <div class="user-name">
          {{store.user.name}} {{store.user.surname}}
        </div>
        <div  class="role">
          <span v-if="store.user.role_user != 'katehyt'">учень</span>
          <span v-if="store.user.role_user === 'katehyt'">катехит</span>
          <span class="material-icons">manage_accounts</span>
        </div>
      </div>
    </router-link>
    <hr>
    <div class="get-wrap">
      <div class="get">
        <div class="get-items sun">
            <span class="material-icons">brightness_5</span>
            <span>{{store.user.lumen}}</span>
        </div>
        <div class="get-items water">
            <span class="material-icons">water_drop</span>
            <span>{{store.user.water}}</span>
        </div>
        <div class="get-items energy">
            <span class="material-icons">electric_bolt</span>
            <span>{{store.user.energy}}</span>
        </div>
      </div>
      <hr>
    </div>
    <h4>Навігація</h4>
    <hr>
    <!-- Навігація учня -->
    <div class="grape-links-wrap">
      <div class="grape-link">
        <router-link to="/"><span class="material-icons">topic</span><span>Теми</span></router-link>
      </div>
      <div class="grape-link" v-if="store.user.role_user === 'katehyt'">
        <router-link to="/classroom"><span class="material-icons">group</span><span>Мій клас</span></router-link>
      </div>
      <div class="grape-link" v-if="store.user.role_user === 'katehyt'">
        <router-link to="/open-question"><span class="material-icons">article</span><span>Повні відповіді</span></router-link>
      </div>
      <div class="grape-link">
        <router-link to="/profile"><span class="material-icons">badge</span><span>Мій профіль</span></router-link>
      </div>
      <div class="grape-link" @click="store.logout()">
        <a href="#">
          <span class="material-icons">exit_to_app</span>
          Вихід
        </a>
      </div>
    </div>
    <hr>
    <div class="wrap-rewards">
      <h4>Нагороди</h4>
      <hr>
      <div class="awards" v-if="store.user.awards">
        <div class="awards-item c-pointer" v-for="(award) in store.user.awards" v-bind:key="award.id" :title="award.title">
          <div class="wrap-award-img" :class="{'received' : award.completed}" >
            <span class="award-img" :style="{ 'background-image': `url(${award.icon})` }"></span>
          </div>
        </div>
      </div>
      <hr class="mrt-8">
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
.mrt-8{
  margin-top: 8px;
}
nav{
  position: fixed;
  min-width: 280px;
  width: 280px;
  max-width: 100%;
  height: calc(100vh - 60px);
  overflow-y: scroll;
  top: 60px;
  right: 0;
  margin: 0;
  overflow-y: scroll;
  max-width: auto!important;
  background: $background-1;
  padding: 16px;
  color: #ffffff;
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
      margin-bottom: 24px;
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
        background-position: center;
        background-size: cover;
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
        font-size: 1.3rem;
      }
      .role{
        color: #747d86;
        font-size:1rem;
        display: flex;
        .material-icons{
          display: flex;
          align-items: center;
          font-size: 1.5rem;
          margin-left: 8px;
          color: #ffad00;
          display: flex;
          opacity: 0.6;
        }
      }
    }
  }
  .avatar-block:hover{
    .role span{
      opacity: 1;
    }
  }
  .grape-link{
    padding: 8px 16px;
    margin-bottom: 8px;
    a{
      font-size: 1.2rem;
      display: flex;
      align-items: center;
      // justify-content: center;
      color: #cfcfcf;
      .material-icons{
        display: block;
        font-size: inherit;
        margin-right: 16px;
        }
    }
  }
  .grape-link:hover{
    background: #21344861;
  }
  h4{
    opacity: 0.4;
    text-align: center;
    font-size: 1.2rem;
  }
}
.awards{
  display: flex;
  flex-wrap: wrap;
  max-width: 100%;
  padding: 8px;
  .awards-item{
    padding: 0 8px;
    margin-bottom: 16px;
  }
  .wrap-award-img{
    width: 95px;
    height: 95px;
    padding: 3px;
    border-radius: 50px;
    border: 5px solid gray;
    overflow: hidden;
    opacity: 0.2;
  }
  .award-img{
    width: 100%;
    height: 100%;
    display: block;
    background-size: cover;
    border-radius: 50px;
  }
  .received{
    border-color: green;
    opacity: 1;
  }
}



.animate__animated {
  animation-duration: 0.5s;
}
</style>
