import { createRouter, createWebHistory } from 'vue-router';

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      name: 'home',
      path: '/',
      component: () => import('@/pages/HomePage.vue')
    },
    {
      name: 'patients',
      path: '/patients',
      component: () => import('@/pages/Patients/PatientsIndexPage.vue')
    },
    {
      name: 'addPatient',
      path: '/patient/new',
      component: () => import('@/pages/Patients/PatientNewPage.vue')
    },
    {
      name: 'patientDetails',
      path: '/patients/:patientId',
      component: () => import('@/pages/Patients/PatientDetailsPage.vue')
    },
    {
      name: 'sessions',
      path: '/sessions',
      component: () => import('@/pages/Sessions/SessionsIndexPage.vue')    
    },
    {
      name: 'sessionDetails',
      path: '/session/:sessionId',
      component: () => import('@/pages/Sessions/SessionDetailsPage.vue')
    },
    {
      name: 'help',
      path: '/help',
      component: () => import('@/pages/HelpPage.vue')   
     }
  ],
  scrollBehavior(comesFrom, goesTo, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    }
    return { left: 0 , top: 0}
  }
});