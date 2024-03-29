import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'Dashboard',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/TopicsView.vue')
  },
  {
    path: '/topic/:id',
    name: 'Topic',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/TopicView.vue')
  },
  {
    path: '/lesson/:id',
    name: 'Lesson',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/LessonView.vue')
  },
  {
    path: '/profile',
    name: 'Profile',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/ProfileView.vue')
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "about" */ '../views/SignInUpView.vue')
  },
  {
    path: '/forget-password',
    name: 'ForgetPassword',
    component: () => import(/* webpackChunkName: "about" */ '../views/SignInUpView.vue')
  },
  {
    path: '/signup/:catechist?',
    name: 'SignUp',
    component: () => import(/* webpackChunkName: "about" */ '../views/SignInUpView.vue')
  },
  {
    path: '/materials',
    name: 'Materials',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/MaterialsView.vue')
  },
  {
    path: '/topic-materials/:id',
    name: 'TopicMaterials',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/TopicMaterialsView.vue')
  },
  {
    path: '/lesson-materials/:id',
    name: 'LessonMaterials',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/LessonMaterialsView.vue')
  },
  {
    path: '/classroom',
    name: 'Classroom',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/ClassroomView.vue')
  },
  {
    path: '/profile-student/:id',
    name: 'ProfileStudent',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/ProfileStudentView.vue')
  },
  {
    path: '/new-answers',
    name: 'NewAnswers',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/NewAnswersView.vue')
  },
  {
    path: '/archive-answers',
    name: 'ArchiveAnswers',
    meta: {
      forAuthorized: true,
    },
    component: () => import(/* webpackChunkName: "about" */ '../views/ArchiveAnswersView.vue')
  },
  { path: '/:pathMatch(.*)*', component: () => import(/* webpackChunkName: "about" */ '../views/404View.vue') }
]

const scrollBehavior = (to, from, savedPosition) => {
  if (to.hash) {
    setTimeout(() => {
      const element = document.getElementById(to.hash.replace(/#/, ''))
      if (element && element.scrollIntoView) {
        element.scrollIntoView({block: 'start', behavior: 'smooth'})
      }
    }, 150)

    return {el: to.hash};
  }
  else if (savedPosition) {
    return savedPosition
  }
  return {top: 0}
}

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  scrollBehavior,
  routes,
})

export default router
