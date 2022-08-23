import { reactive } from 'vue'
import axios from 'axios'

const store = reactive({
  homeUrl: 'https://grape.chasoslov.info',
  token: null,
  router: null,
  ui: {
    navOpen: false,
    loding: false
  },
  user: null,
  getUser: function (){
    axios({
      method: 'GET',
      url: '/api/get-user',
      data: {}
    }).then(function (response) {
      store.user = response.data
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
  }
})

export function useStore () {
  return { store }
}
