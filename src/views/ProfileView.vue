<template>
  <main>
    <section class="Profile" v-if="store.user">
      <div class="avatar-block">
        <div class="avatar-img">
          <span class="img" v-if="!store.user.photo">
            <img src="@/assets/img/avatar.svg" alt="avatar">
          </span>
          <img :src="store.homeUrl+store.user.photo" alt="">
        </div>
      </div>
      <div class="user-about">
        <div class="name">
        <h2>{{store.user.name}} {{store.user.surname}}</h2>
        </div>
        <div class="role">
          учень
        </div>
        <div class="birthday">
        08.08.2021
        </div>
        <hr>
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
        <div class="profile-edit">
          <div class="avatar-uploade">
            <label>
              <span class="uploade-btn">
                <span class="material-icons">cloud_upload</span>
                Завантажити аватар
              </span>
              <input @change="previewFiles" type="file" class="d-none">
              <span class="form-control" v-if="data.fileName">{{data.fileName}}</span>
            </label>
            <span class="uploade-btn c-pointer" @click="updateAvatar()" v-if="data.fileName">
              <span class="material-icons">check</span>
              Зберегти
            </span>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { reactive } from 'vue'
import { useStore } from '@/store'
import axios from 'axios'

const { store } = useStore()

const data = reactive({
  fileName: null,
  file: null
})

const previewFiles = function (event) {
  data.fileName = event.target.files[0].name
  data.file = event.target.files[0]
}
const updateAvatar = function () {
  const formData = new FormData()
  formData.append('photo', data.file)
  axios({
    method: 'POST',
    url: `api/user-photo/${store.user.id}`,
    data: formData,
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'multipart/form-data',
    }
    }).then(function () {
      store.getUser()
 })
}
</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
hr{
  width: 100%;
}
.Profile{
  width: 100%;
  margin-top: 16px;
  padding: 16px;
  border-radius: 5px;
  outline: 1px solid #dddcdc;
}
.user-about{
  flex-grow: 1;
}
.avatar-block{
  max-width: 100%;
  .avatar-img{
    display: flex;
    justify-content: center;
    background: #e5e5e5;
    height: 360px;
    width: 640px;
    max-width: 100%;
    border-radius: 5px;
    overflow: hidden;
    img{
      height: 100%;
      width: auto;
      max-height: 100%;
    }
  }
}
.user-about{
  padding: 0 16px 16px 16px;
  .name{
    h2 {
      font-size: 2rem;
      font-weight: bold;
    }
  }
  .role{
    font-size: 1.3rem;
  }
  .birthday{
    font-size: 1.3rem;
    font-weight: bold;
  }
}
.avatar-uploade{
  width: 100%;
  display: flex;
  label{
    display: flex;
    .form-control{
      margin: 0 16px;
      padding: 8px;
      border-bottom: 1px solid gray;
    }
  }
}
.uploade-btn{
  display: flex;
  padding: 8px 16px;
  border-radius: 25px;
  outline: 2px solid #5186FF;
  text-align: center;
  .material-icons{
    display: flex;
    align-items: center;
    margin-right: 8px;
  }
}
</style>
