<template>
  <div class="bg-page">
    <div class="sign-wrap">
      <div class="form animate__animated animate__zoomIn">
        <div class="form-header">
          <img src="@/assets/img/logo.png" alt="">
          <h3 v-if="router.currentRoute.value.name === 'Login'">Вхід</h3>
          <h3 v-if="router.currentRoute.value.name === 'SignUp'">Реєстрація</h3>
          <h3 v-if="router.currentRoute.value.name === 'ForgotPassword'">Відновлення</h3>
        </div>
<!-- Форма авторизації -->
        <form class="form-sign" v-if="router.currentRoute.value.name === 'Login'" @submit.prevent="login()">
          <div class="form-item">
            <label>
              <span class="material-icons">person</span>
              <input type="email" placeholder="email" v-model="data.email" required>
            </label>
          </div>
          <div class="form-item">
            <label>
              <span class="material-icons">lock</span>
              <input placeholder="password" :type="data.inputType" v-model="data.password" required>
              <span class="material-icons show" @click="changeInputType">{{data.inputIcon}}</span>
            </label>
          </div>
          <div class="login-error" v-if="data.errorMessage">
            {{data.errorMessage}}
          </div>
          <button type="submit" class="form-item login-btn c-pointer">
            Увійти
          </button>
          <router-link class="signup-link cancel" to="/forget-password" v-if="data.errorMessage">Забув пароль?</router-link>
          <router-link class="signup-link" to="/signup">Зареєструватись</router-link>
        </form>
        <!-- Форма відновлення -->
        <form class="form-sign" v-if="router.currentRoute.value.name === 'ForgetPassword'" @submit.prevent="ForgetPassword()">
          <div class="form-item">
            <label>
              <span class="material-icons">person</span>
              <input type="email" placeholder="email" v-model="data.email" required>
            </label>
          </div>
          <div class="login-error accept" v-if="data.errorMessage">
            {{data.errorMessage}}
          </div>
          <button type="submit" class="form-item login-btn c-pointer">
            Відновити
          </button>
          <router-link class="signup-link" to="/login">Повернутись до логіну</router-link>
          <router-link class="signup-link" to="/signup">Зареєструватись</router-link>
        </form>
        <!-- Форма реєстрації -->
        <form class="form-sign" v-if="router.currentRoute.value.name === 'SignUp'" @submit.prevent="signUp()">
          <div class="form-item">
            <span class="input-name">Ім'я</span>
            <label>
              <input type="text" v-model="data.name" required>
            </label>
          </div>
          <div class="form-item">
            <span class="input-name">Прізвище</span>
            <label>
              <input type="text" v-model="data.surname" required>
            </label>
          </div>
          <div class="form-item">
            <span class="input-name">Дата народження</span>
            <label>
              <input type="date" v-model="data.birthday" required>
            </label>
          </div>
          <div class="form-item">
            <label>
              <span class="material-icons">alternate_email</span>
              <input type="email" placeholder="email" v-model="data.email" required>
            </label>
          </div>
          <div class="form-item">
            <label>
              <span class="material-icons">lock</span>
              <input placeholder="password" type="text" v-model="data.password" minlength="8" required>
            </label>
          </div>
          <div class="login-error" v-if="data.errorMessage">
            {{data.errorMessage}}
          </div>
          <button type="submit" class="form-item login-btn">
            Зареєструватись
          </button>
          <router-link class="signup-link" to="/login">В мене вже є аккаунт</router-link>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, watch } from 'vue'
import { useRouter} from 'vue-router'
import { useRoute } from 'vue-router'
import axios from 'axios'
import { useStore } from '@/store'

const router = useRouter()
const route = useRoute()
const { store } = useStore()

const data = reactive({
  errorMessage: null,
  inputType: 'password',
  inputIcon: 'visibility',
  email: null,
  password: null,
  name: null,
  surname: null
})

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

const login = function () {
  if(data.email !=null && data.password !=null){
    axios({
      method: 'POST',
      url: '/api/login-user',
      data: {
        email: data.email,
        password: data.password,
     }
    }).then(function (response) {
      store.token = response.data.token
      localStorage.token = store.token
      axios.defaults.headers.common['Authorization'] = `Bearer ${store.token}`
      store.getUser()
      router.push(`/`)
      }).catch(function () {
        data.errorMessage = 'невірний email або пароль!'
        });

  }
  else{
    data.errorMessage = 'необхідно увести email та пароль!'
  }
}
const ForgetPassword = function () {
  axios({
    method: 'POST',
    url: '/api/forget-passwords',
    data: { email: data.email }
   }).then(function () {
     data.errorMessage = 'Дані для входу успішно надіслано на Вашу поштову скриньку!'
   }).catch(function () {
       data.errorMessage = 'Упс.. щось зламалось.'
     })
}
const signUp = function () {
  axios({
     method: 'POST',
     url: '/api/register-user',
     data: {
       name: data.name,
       surname: data.surname,
       email: data.email,
       password: data.password,
       birthday: data.birthday,
       catechist: route.params.catechist
    }
   }).then(function () {
     router.push(`/login`)
     data.errorMessage = null
   }).catch(function () {
       data.errorMessage = 'Упс.. щось зламалось.'
     })
}
watch(route, () => {
 data.errorMessage = null
})
</script>

<style lang="scss" scoped>
h3{
  font-size: 2rem;
}
.bg-page{
  display: flex;
  flex-wrap: nowrap;
  justify-content: center;
  height: 100vh;
  width: 100%;
  overflow: scroll;
  background: linear-gradient(#7e78ff, #c17e55);
  background-image: url(@/assets/img/login-bg.jpg);
}
.sign-wrap{
  width: 95%;
  max-width: 390px;
  display: flex;
  align-items: center;
  justify-content: center;
  .form{
    box-shadow: 0px 0px 50px 0px rgba(90,166,255,1);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    width: 100%;
    padding: 32px;
    padding-top: 0;
    border-radius: 32px;
    background: #ffffff;
    .form-header{
      margin-top: -50px;
      display: flex;
      flex-direction: column;
      align-items: center;
      img{
        width: 100px;
      }
      h3{
        margin: 32px 0 16px 0;
      }
    }
    .form-sign{
      width: 100%;
    }
  }
  .login-btn{
    display: flex;
    align-items: center;
    border: 0;
    margin-top: 32px;
    margin-bottom: 16px;
    display: block;
    text-align: center;
    padding: 8px 15px;
    border-radius: 8px;
    font-weight: bold;
    background-color: #111;
    color: #acecd9;
  }
  .login-btn:hover{
    background-color: #0e161f;
  }
  .login-error{
    font-size: 0.8rem;
    font-style: italic;
    margin-top: -16px;
    position: absolute;
    color: red;
  }
}
label{
  z-index: 1;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  outline: 1px solid #92919c69;
  border-radius: 8px;
  .material-icons{
    display: block;
    margin: -1px 0 -1px -1px;
    padding: 7px;
    border-radius: 8px 0 0 8px;
    color: #ffffff;
    font-size: 28px;
    background-color: #111;
  }
  input{
    flex-grow: 1;
    width: inherit;
    padding: 8px;
    font-size: inherit;
    border: none;
    outline: none;
    display: block;
    line-height: 1.5rem;
    color: #111111;
    background-color: #ffffff;
  }
  .show{
    margin: 0!important;
    background: none!important;
    color: #c3c3c3!important;
  }
}
.signup-link{
  display: block;
  text-align: center;
  font-size: 1rem;
}
</style>
