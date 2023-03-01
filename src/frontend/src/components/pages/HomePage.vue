<template>
  <h1 class="text-center text-2xl underline">Accueil</h1>
  <section class="container mx-auto mt-8">
    <h2 class="text-xl underline mb-4">Mes dernières séances</h2>
    <ul>
      <SessionsItem 
        v-for="session in latestSessions" 
        :key="session.id"
        :session="session"
      />
    </ul>
  </section>
</template>

<script>
import SessionsItem from '../session/SessionItem.vue';
export default ({
  name: 'HomePage',
  components: {SessionsItem},
  data() {
    return {
      dataLoaded: false,
    }
  },
  computed: {
    latestSessions() {
      return this.$store.getters.getSessionsLimited;
    }
  }
})
</script>