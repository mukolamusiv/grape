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
            <span class="btn " v-if="!data.file">
              <span class="material-icons">cloud_upload</span>
              Змінити аватар
            </span>
            <input @change="previewFiles" type="file" class="d-none">
          </label>
          <div class="submit-panel">
            <span class="btn  accept" @click="updateAvatar()" v-if="data.file">
              <span class="material-icons">check</span>
              Зберегти
            </span>
            <span class="btn  cancel" @click="data.file = null, data.img = null" v-if="data.file">
              <span class="material-icons">backspace</span>
              Відмінити
            </span>
          </div>
        </div>
      </div>
      <div class="user-about" v-if="!data.edit && !data.editPassword">
        <div class="name">
          <h2>
            {{store.user.name}} {{store.user.surname}}
            <span class="material-icons c-pointer" @click="startEdit()">settings</span>
          </h2>
        </div>
        <div class="role">
          <span v-if="store.user.role_user != 'katehyt'">учень</span>
          <span v-if="store.user.role_user === 'katehyt'">катехит</span>
        </div>
        <div class="birthday">
          {{store.user.birthday.split('-').reverse().join('.')}}
        </div>
        <div class="email">
          <span class="material-icons">mail</span>
          {{store.user.email}}
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
        <span class="btn " @click="data.editPassword = true">
          <span class="material-icons">password</span>
          Змінити пароль
        </span>
      </div>
      <form class="edit-profile" v-if="data.edit" @submit.prevent="updateProfile()">
        <div class="form-item">
          <span class="input-name">Ім'я</span>
          <label>
            <input type="text" v-model="data.updateProfile.name" required>
          </label>
        </div>
        <div class="form-item">
          <span class="input-name">Прізвище</span>
          <label>
            <input type="text" v-model="data.updateProfile.surname" required>
          </label>
        </div>
        <div class="form-item">
          <span class="input-name">Дата народження</span>
          <label>
            <input type="date" v-model="data.updateProfile.birthday" required>
          </label>
        </div>
        <div class="submit-panel">
          <button type="submit">
            <span class="btn  accept">
              <span class="material-icons">check</span>
              Зберегти
            </span>
          </button>
          <span class="btn  cancel" @click="data.edit = false">
            <span class="material-icons">backspace</span>
            Відмінити
          </span>
        </div>
      </form>
      <form class="edit-profile" v-if="data.editPassword" @submit.prevent="updatePassword(), data.errorMessage = false">
        <div class="form-item">
          <span class="input-name">Старий пароль</span>
          <label>
            <input :type="data.inputType" v-model="data.oldPassword" required>
            <span class="material-icons show" @click="changeInputType()">{{data.inputIcon}}</span>
          </label>
        </div>
        <div class="form-item">
          <span class="input-name">Новий пароль</span>
          <label>
            <input :type="data.inputType" v-model="data.newPassword" minlength="8" required>
            <span class="material-icons show" @click="changeInputType()">{{data.inputIcon}}</span>
          </label>
        </div>
        <div class="error cancel" v-if="data.errorMessage">
          невірний старий пароль!
        </div>
        <div class="submit-panel">
          <button type="submit">
            <span class="btn  accept">
              <span class="material-icons">check</span>
              Зберегти
            </span>
          </button>
          <span class="btn  cancel" @click="data.editPassword = false">
            <span class="material-icons">backspace</span>
            Відмінити
          </span>
        </div>
      </form>
    </section>
  </main>
</template>

<script setup>
import { reactive } from 'vue'
import { useStore } from '@/store'
import axios from 'axios'

const { store } = useStore()

const data = reactive({
  edit: false,
  file: null,
  img: null,
  updateProfile: {
    name: null,
    surname: null,
    birthday: null
  },
  oldPassword: null,
  newPassword: null,
  inputIcon: 'visibility',
  inputType: 'password',
  errorMessage: false
})
const startEdit = function () {
  data.edit = true
  data.updateProfile.name = store.user.name
  data.updateProfile.surname = store.user.surname
  data.updateProfile.birthday = store.user.birthday
}
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
    }).catch(function (error) {
       store.error(error.request.status)
    })
}
const updateProfile = function () {
  axios({
    method: 'PUT',
    url: `api/user/${store.user.id}`,
    data: {
      name: data.updateProfile.name,
      surname: data.updateProfile.surname,
      birthday: data.updateProfile.birthday,
    }
    }).then(function () {
      data.editPassword = false
    }).catch(function (error) {
       store.error(error.request.status)
    })
}
const updatePassword = function () {
  axios({
    method: 'PUT',
    url: `api/update-password/${store.user.id}`,
    data: {
      old_password: data.oldPassword,
      password: data.newPassword,
      password_confirmation: data.newPassword,
    }
    }).then(function () {
      store.logout()
      // data.editPassword = false
      // data.errorMessage = false
    }).catch(function () {
      // store.error(error.request.status)
      data.errorMessage = true
    })
}
const changeInputType = function () {
  if(data.inputType == 'password') {
    data.inputType = 'text'
    data.inputIcon = 'visibility_off'
  }
  else {
    data.inputType = 'password'
    data.inputIcon = 'visibility'
  }
}
</script>

<style lang="scss" scoped>
@import '@/assets/styles/color-style.scss';
.error{
  width: 100%;
  margin-bottom: 16px;
}
hr{
  width: 100%;
}
.get{
  margin: 0;
}
.Profile{
  width: 100%;
  display: flex;
  justify-content: center;
  border-radius: 5px;
}
.avatar-block{
  display: flex;
  flex-wrap: wrap;
  flex-direction: column;
  align-items: center;
  padding: 16px;
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
    background-position: center;
    background-size: cover;
    }
  }
}
.user-about, .edit-profile{
  flex-grow: 1;
  padding: 16px;
  display: flex;
  flex-direction: column;
  align-items: center;
  .name{
    h2 {
      font-size: 2rem;
      font-weight: bold;
      .material-icons{
        position: relative;
        top: -10px;
        color: #5186FF;
      }
      .material-icons:hover{
        opacity: 0.8;
      }
    }
  }
  .role{
    font-size: 1.3rem;
  }
  .birthday{
    font-size: 1.3rem;
    font-weight: bold;
  }
  .email{
    display: flex;
    align-items: center;
    color: #174c9a;
    font-weight: bold;
    margin-top: 8px;
    .material-icons{
      padding-right: 4px;
    }
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
.form-item{
  font-size: 1.2rem;
  z-index: 0;
}
.show{
  margin: 0!important;
  background: none!important;
  color: #c3c3c3!important;
}
</style>
