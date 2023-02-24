<template>
  <TheHeader />
  <body class="py-8">
    <router-view></router-view>
  </body>
</template>

<script>
import axios from 'axios';
import TheHeader from './components/templates/TheHeader'

export default {
  name: 'App',
  components: {
    TheHeader
  },
  mounted() {
    const store = this.$store;
    axios.get('http://localhost:80/api/sessions')
    .then(response => {
      store.dispatch('setSessions', response.data.data);
    });
    axios.get('http://localhost:80/api/patients')
    .then(response => {
      store.dispatch('setPatients', response.data.data);
    })

  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
