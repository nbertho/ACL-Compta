<template>
  <h1 class="text-center text-2xl underline">Mes séances</h1>
  <section class="container mx-auto mt-8">
    <SessionsFilters 
    
    />
    <ul class="mt-8" v-if="sessions.length !== 0">
      <SessionItem 
        v-for="session in sessions" 
        :key="session.id"
        :session="session"
      />
    </ul>
    <div v-else>
      <p class="my-12">Désolé, aucune n'a été trouvée pour le moment</p>
    </div>
  </section>
</template>

<script>
import SessionItem from '../session/SessionItem.vue';
import SessionsFilters from '../filters/SessionsFilters.vue';

export default ({
  name: 'SessionPage',
  components: { SessionItem, SessionsFilters },
  computed: {
    sessions() {
      return this.$store.getters.getSessions
    }
  }
})
</script>