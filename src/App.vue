<template>
  <div class="page-wrap">
   <header-bar v-if="router.currentRoute.value.name!=='Login' && router.currentRoute.value.name!=='SignUp'"/>
   <router-view/>
  </div>
 <nav-bar v-if="router.currentRoute.value.name!=='Login' && router.currentRoute.value.name!=='SignUp'"/>
</template>

<style lang="scss">
  @import '@/assets/styles/bootstrap-reboot.css';
  @import '@/assets/styles/main-style.scss';
</style>

<script setup>
import HeaderBar from '@/components/HeaderBar.vue'
import NavBar from '@/components/NavBar.vue'
import { watch } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useStore } from '@/store'
import axios from 'axios'

const route = useRoute()
const router = useRouter()
const { store } = useStore()

store.router = router
axios.defaults.baseURL = store.homeUrl
// axios.defaults.widthCredentials = true
store.lodlocal()



router.beforeEach(async (to) => {
  if (to.matched.some(record => record.meta.forAuthorized)) {
    if (!store.token) {
      return '/login'
    }
  }
  if (to.name === 'Login' && store.token) {
    return '/'
  }
})

watch(route, () => {
  store.ui.navOpen = false
})
</script>
