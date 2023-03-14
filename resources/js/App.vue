<template>
  <TheHeader />
  <body class="py-8">
    <ActionMsg 
      :msg="actionMsg"
      :errors="errorFields"
      :bgColorClass="bgColor"
      @resetMsg="resetActionMsg"
    />
    <router-view></router-view>
  </body>
</template>

<script>
import axios from 'axios';
import appConstants from '@/app-config/app-constants.js';
import TheHeader from '@/components/templates/TheHeader.vue';
import ActionMsg from '@/components/assets/ActionMsg.vue';

export default {
  name: 'App',
  components: {
    TheHeader,
    ActionMsg
  },
  data() {
    return {
      actionMsg: '',
      errorFields: [],
      bgColor: ''
    }
  },
  methods: {
    resetActionMsg() {
      this.actionMsg = '';
      this.errorFields = [];
      this.bgColor = ''
    },
    setErrorActionMsg(message, errorFields = []) {
      this.resetActionMsg();
      this.actionMsg = message;
      this.errorFields = errorFields;
      this.bgColor = 'bg-red-400';
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    setSuccessActionMsg(message) {
      this.resetActionMsg();
      this.actionMsg = message;
      this.bgColor = 'bg-green-400';
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  },
  provide() {
    return {
      setErrorActionMsg: this.setErrorActionMsg,
      setSuccessActionMsg: this.setSuccessActionMsg,
    }
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

    axios.get(appConstants.api.urlPath + appConstants.api.sessionTypeList)
    .then(response => {
      store.dispatch('setSessionType', response.data.data);
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
