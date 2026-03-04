import { createRouter, createWebHistory } from 'vue-router'

import BasicsIntroduction from '../views/BasicsIntroduction.vue'
import ComponentPractice from '../views/ComponentPractice.vue'
// import FormHandling from '../views/FormHandling.vue'
// import CRMDashboard from '../views/CRMDashboard.vue'
import UserSection from '../components/UserSection.vue'

const routes = [
  { path: '/', redirect: '/basics' },
  { path: '/basics', component: BasicsIntroduction },
  { path: '/components', component: ComponentPractice },
  //{ path: '/forms', component: FormHandling },
  { path: '/users', component: UserSection },
]

export default createRouter({
  history: createWebHistory(),
  routes,
})
