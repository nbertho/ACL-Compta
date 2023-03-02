import { createRouter, createWebHistory } from 'vue-router';

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      name: 'home',
      path: '/',
      component: () => import('../components/pages/HomePage')
    },
    {
      name: 'patients',
      path: '/patients',
      component: () => import('../components/pages/PatientsPage')
    },
    {
      name: 'add-patient',
      path: '/patient/new',
      component: () => import('../components/pages/NewPatientForm')
    },
    {
      name: 'patientDetails',
      path: '/patients/:patientId',
      component: () => import('../components/pages/PatientDetails')
    },
    {
      name: 'sessions',
      path: '/sessions',
      component: () => import('../components/pages/SessionsPage')    
    },
    {
      name: 'help',
      path: '/help',
      component: () => import('../components/pages/HelpPage')   
     }
  ],
  scrollBehavior(comesFrom, goesTo, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    }
    return { left: 0 , top: 0}
  }
});