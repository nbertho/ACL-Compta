<template>
  <TheHeader />
  <body class="py-8">
    <router-view></router-view>
  </body>
</template>

<script>
import axios from 'axios';
import appConstants from './app-config/app-constants';
import TheHeader from './components/templates/TheHeader';

export default {
  name: 'App',
  components: {
    TheHeader
  },
  mounted() {
    const store = this.$store;
    axios.get(appConstants.api.urlPath + appConstants.api.sessionsList)
    .then(response => {
      store.dispatch('setSessions', response.data.data);
    });
    axios.get(appConstants.api.urlPath + appConstants.api.patientsList)
    .then(response => {
      store.dispatch('setPatients', response.data.data);
    });
    axios.get(appConstants.api.urlPath + appConstants.api.locationsList)
    .then(response => {
      store.dispatch('setLocations', response.data.data);
    });
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
textarea {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  height: 100%;
  width: 100%;
}
</style>
