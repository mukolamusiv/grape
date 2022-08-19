<template>
  <main>
    <section class="Profile" v-if="store.user">
      <div class="avatar-block">
        <div class="avatar-img">
        <div class="img" v-if="!store.user.photo">
            <img src="@/assets/img/avatar.svg" alt="avatar">
          </div>
          <span class="img" v-if="store.user.photo && !data.img" :style="{ 'background-image': `url(${store.homeUrl+store.user.photo})` }"></span>
          <span class="img" v-if="data.img" :style="{ 'background-image': `url(${data.img})` }"></span>
        </div>
        <div class="avatar-uploade">
          <label>
            <span class="uploade-btn" v-if="!data.file">
              <span class="material-icons">cloud_upload</span>
              Змінити аватар
            </span>
            <input @change="previewFiles" type="file" class="d-none">
          </label>
          <span class="uploade-btn c-pointer accept" @click="updateAvatar()" v-if="data.file">
            <span class="material-icons">check</span>
            Зберегти
          </span>
          <span class="uploade-btn c-pointer cancel" @click="data.file = null, data.img = null" v-if="data.file">
            <span class="material-icons">backspace</span>
            Відмінити
          </span>
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
  edit: {
    name: false,
    birthday: false
  },
  file: null,
  img: null
})

const previewFiles = function (event) {
  data.file = event.target.files[0]
  data.img = URL.createObjectURL(data.file)
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
      data.file = null
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
  display: flex;
  justify-content: center;
  padding: 16px;
  border-radius: 5px;
  // outline: 1px solid #dddcdc;
}
.user-about{
  flex-grow: 1;
}
.avatar-block{
  display: flex;
  flex-wrap: wrap;
  flex-direction: column;
  align-items: center;
  margin-bottom: 16px;
  .avatar-img{
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
    overflow: hidden;
    .img{
      display: flex;
    justify-content: center;
    align-items: center;
    width: 300px;
    height: 300px;
    font-size: 18px;
    padding: 4px 8px;
    color: inhetir;
    // border-radius: 150px;
    background-position: center;
    background-size: cover;
    }
  }
}
.user-about{
  padding: 0 16px 16px 16px;
  display: flex;
  flex-direction: column;
  align-items: center;
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
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  border-radius: 25px;
  margin-top: 16px;
  label{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    .form-control{
      margin: 0 16px;
      padding: 8px;
      max-width: 250px;
      overflow: hidden;
      max-height: 40px;
      border-bottom: 1px solid gray;
    }
  }
}
.uploade-btn{
  display: flex;
  padding: 8px 16px;
  border-radius: 25px;
  color: #5186FF;
  outline: 2px solid #5186FF;
  text-align: center;
  margin: 0 4px;
  .material-icons{
    display: flex;
    align-items: center;
    margin-right: 8px;
  }
}
.accept{
  outline-color: #20c997;
  color: #20c997;
}
.cancel{
  outline-color: #c62f2f;
  color: #c62f2f;
}
</style>
