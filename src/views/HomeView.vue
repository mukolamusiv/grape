<template>
  <main v-if="store.user">
    <topics v-if="store.user.role_user != 'katehyt'"/>
    <classroom v-if="store.user.role_user === 'katehyt'"/>
  </main>
</template>

<script setup>
import { useStore } from '@/store'
import Topics from '@/views/TopicsView.vue'
import Classroom from '@/views/ClassroomView.vue'
const { store } = useStore()

</script>

<style lang="scss" scoped>

</style>
