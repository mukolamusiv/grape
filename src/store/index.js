import { reactive } from 'vue'
import axios from 'axios'

const store = reactive({
  homeUrl: 'https://grape.chasoslov.info',
  token: null,
  router: null,
  ui: {
    navOpen: false,
    primeTitle: null,
    secondTitle: null,
    loding: false
  },
  user: {
    id: null,
    session: null,
    type: null,
    name: null
  },
  lodlocal: function () {
    if (localStorage.token) {
      store.user.name = localStorage.name
      store.user.type = localStorage.type
      store.token = localStorage.token
      axios.defaults.headers.common['Authorization'] = store.token
    }
  },
  logout: function () {
    localStorage.clear()
    store.user.name = null
    store.user.type = null
    store.token = null
    store.router.push('/login')
  }
})

export function useStore () {
  return { store }
}
