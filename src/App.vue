<template>
  <div v-if="store.ui.loding" class="loding-progress"></div>
  <header-bar v-if="router.currentRoute.value.name!=='Login'"/>
  <router-view/>
</template>

<style lang="scss">
  @import '@/assets/styles/bootstrap-reboot.css';
  @import '@/assets/styles/main-style.scss';
</style>

<script setup>
import HeaderBar from '@/components/HeaderBar.vue'
import { watch } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useStore } from '@/store'
import axios from 'axios'

const route = useRoute()

const router = useRouter()
const { store } = useStore()
store.router = router
store.lodlocal()
axios.defaults.baseURL = store.homeUrl

// router.beforeEach(async (to) => {
//   if (to.matched.some(record => record.meta.forAuthorized)) {
//     if (!store.token) {
//       return '/login'
//     }
//   }
//   if (to.name === 'Login' && store.token) {
//     return '/'
//   }
// })

watch(route, () => {
  store.ui.collapseSidebar = true
})
</script>
