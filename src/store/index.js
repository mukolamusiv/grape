import { reactive } from 'vue'
import axios from 'axios'

const store = reactive({
  homeUrl: 'https://grape.chasoslov.info',
  token: null,
  router: null,
  ui: {
    navOpen: false,
    lessonTab: 'video'
  },
  user: null,
  getUser: function (){
    axios({
      method: 'GET',
      url: '/api/get-user',
      data: {}
    }).then(function (response) {
      store.user = response.data
    }).catch(function (error) {
       store.error(error.request.status)
    })
  },
  lodlocal: function () {
    if (localStorage.token) {
      store.token = localStorage.token
      axios.defaults.headers.common['Authorization'] = `Bearer ${store.token}`
      store.getUser()
    }
  },
  logout: function () {
    localStorage.clear()
    store.token = null
    store.user = null
    store.router.push('/login')
  },
  error: function (status) {
    if(status >= 400 && status < 500){
      store.logout()
    }
    if(status >= 500){
    store.router.push('/')
    }
  },
})

export function useStore () {
  return { store }
}
