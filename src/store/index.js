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
  user: {
    id: null,
    type: null,
    name: null
  },
  lodlocal: function () {
    if (localStorage.token) {
      store.token = localStorage.token
      axios.defaults.headers.common['Authorization'] = store.token
    }
  },
  logout: function () {
    localStorage.clear()
    store.token = null
    store.router.push('/login')
  }
})

export function useStore () {
  return { store }
}
