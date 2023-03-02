import { createRouter, createWebHistory } from 'vue-router';

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      name: 'home',
      path: '/',
      component: () => import('@/pages/HomePage')
    },
    {
      name: 'patients',
      path: '/patients',
      component: () => import('@/pages/Patients/PatientsIndexPage')
    },
    {
      name: 'addPatient',
      path: '/patient/new',
      component: () => import('@/pages/Patients/PatientNewPage')
    },
    {
      name: 'patientDetails',
      path: '/patients/:patientId',
      component: () => import('@/pages/Patients/PatientDetailsPage')
    },
    {
      name: 'sessions',
      path: '/sessions',
      component: () => import('@/pages/Sessions/SessionsIndexPage')    
    },
    {
      name: 'sessionDetails',
      path: '/session/:sessionId',
      component: () => import('@/pages/Sessions/SessionDetailsPage')
    },
    {
      name: 'help',
      path: '/help',
      component: () => import('@/pages/HelpPage')   
     }
  ],
  scrollBehavior(comesFrom, goesTo, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    }
    return { left: 0 , top: 0}
  }
});