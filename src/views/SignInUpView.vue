<template>
  <div class="bg-page">
    <div class="sign-wrap">
      <div class="form animate__animated animate__zoomIn">
        <div class="form-header">
          <img src="@/assets/img/logo.png" alt="">
          <h3 v-if="router.currentRoute.value.name =='Login'">Вхід</h3>
          <h3 v-if="router.currentRoute.value.name =='SignUp'">Реєстрація</h3>
        </div>
<!-- Форма авторизації -->
        <div class="form-sign" v-if="router.currentRoute.value.name =='Login'">
          <div class="form-item">
            <label>
              <span class="material-icons">person</span>
              <input type="email" placeholder="email" v-model="data.email">
            </label>
          </div>
          <div class="form-item">
            <label>
              <span class="material-icons">lock</span>
              <input placeholder="password" :type="data.inputType" v-model="data.password">
              <span class="material-icons show" @click="changeInputType">{{data.inputIcon}}</span>
            </label>
          </div>
          <div class="login-error" v-if="data.errorMessage">
            {{data.errorMessage}}
          </div>
          <div class="form-item login-btn c-pointer" @click="login()">
            Увійти
          </div>
        </div>
<!-- Форма реєстрації -->
        <div class="form-sign" v-if="router.currentRoute.value.name =='SignUp'">
          <div class="form-item">
            <label>
              <span class="input-name">Ім'я</span>
              <input type="text" v-model="data.name">
            </label>
          </div>
          <div class="form-item">
            <label>
              <span class="input-name">Прізвище</span>
              <input type="text" v-model="data.surname">
            </label>
          </div>
          <div class="form-item">
            <label>
              <span class="material-icons">alternate_email</span>
              <input type="email" placeholder="email" v-model="data.email">
            </label>
          </div>
          <div class="form-item">
            <label>
              <span class="material-icons">lock</span>
              <input placeholder="password" :type="data.inputType" v-model="data.password">
              <span class="material-icons show" @click="changeInputType">{{data.inputIcon}}</span>
            </label>
          </div>
          <div class="form-item">
            <label>
              <span class="material-icons">lock</span>
              <input placeholder="confirm password" :type="data.inputType" v-model="data.passwordComfirm">
            </label>
          </div>
          <div class="login-error" v-if="data.errorMessage">
            {{data.errorMessage}}
          </div>
          <div class="form-item login-btn c-pointer" @click="signUp()">
            Зареєструватись
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useRouter} from 'vue-router'
import axios from 'axios'
import { useStore } from '@/store'

const router = useRouter()
const { store } = useStore()

const data = reactive({
  error: false,
  errorMessage: null,
  inputType: 'password',
  inputIcon: 'visibility',
  email: null,
  password: null,
  passwordComfirm: null,
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
      store.token = response.data.access_token
      localStorage.token = store.token
      axios.defaults.headers.common['Authorization'] = `Bearer ${store.token}`
      store.getUser()
      router.push(`/`)
      }).catch(function () {
        data.errorMessage = 'невырний email або пароль!'
        });

  }
  else{
    data.errorMessage = 'необхідно увести email та пароль!'
  }
}
const signUp = function () {
  if (`${data.password}` != `${data.passwordConfirm}`){
    data.errorMessage = 'паролі співпадають!'
  }
  else {
    if(data.email !=null && data.password !=null && data.name !=null && data.surname !=null){
     axios({
       method: 'POST',
       url: '/api/register-user',
       data: {
         name: data.name,
         surname: data.surname,
         email: data.email,
         password: data.password,
      }
     }).then(function () {
       router.push(`/login`)
       }).catch(function () {
         data.errorMessage = 'Упс.. щось зламалось.'
         });

   }
   else{
     data.errorMessage = 'необхідно заповнити всі поля форми!'
   }
  }
}
</script>

<style lang="scss" scoped>
.bg-page{
  display: flex;
   flex-wrap: nowrap;
   justify-content: center;
   height: 100vh;
   width: 100%;
  // background: linear-gradient(#ffdc76, #c58b67);
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
  .form-item{
    padding: 16px 0;
    width: 100%;
    display: flex;
    label{
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
        background-color: #111111;
      }
      input{
        flex-grow: 1;
        width: inherit;
        padding: 8px;
        border: none;
        outline: none;
        display: block;
        line-height: 1.5rem;
        font-size: 1rem;
        color: #111111;
        background-color: #ffffff;
      }
      .show{
        margin: 0!important;
        background: none!important;
        color: #c3c3c3!important;
      }
    }
  }
  .login-btn{
    border: 0;
    margin-top: 32px;
    margin-bottom: 16px;
    display: block;
    text-align: center;
    padding: 8px 15px;
    border-radius: 8px;
    font-weight: bold;
    background-color: #111111;
    color: #acecd9;
  }
  .login-btn:hover{
    background-color: #1e1e1e;
  }
  .login-error{
    font-size: 0.8rem;
    font-style: italic;
    margin-top: -16px;
    position: absolute;
    color: red;
  }
  .input-name{
    position: absolute;
    margin-left: 6px;
    margin-top: -44px;
    color: #757575;
    background: white;
  }
}
</style>
