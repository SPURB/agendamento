import Vue from 'vue'
import VueRouter from 'vue-router'
import Agendamento from '../views/Agendamento'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Agendamento',
    component: Agendamento
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
