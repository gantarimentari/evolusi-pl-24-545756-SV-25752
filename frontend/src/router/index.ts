import { createRouter, createWebHistory } from 'vue-router'
import App from '../App.vue'
import Home from '../views/Home.vue'

const routes = [
  {
    path: '/',
    name: 'App',
    component: App,
  },
  {
    path: '/Home',
    name: 'Home',
    component: Home,
  },
]

export default createRouter({
  history: createWebHistory(),
  routes,
})