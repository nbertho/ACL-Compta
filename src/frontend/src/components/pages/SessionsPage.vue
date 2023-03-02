<template>
  <h1 class="text-center text-2xl underline">Mes séances</h1>
  <section class="container mx-auto mt-8">
    <SessionsFilters 
      @filterByFirstName="updateFirstNameFilter"
      @filterByLastName="updateLastNameFilter"
      @filterByDate="updateDateFilter"
      @resetFilters="resetFilters"
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
  data() {
    return {
      firstNameFilter: null,
      lastNameFilter: null,
      dateFilter: null,
    }
  },
  methods: {
    updateFirstNameFilter(data) {
      this.firstNameFilter = data;
    },
    updateLastNameFilter(data) {
      this.lastNameFilter = data;
    },
    updateDateFilter(data) {
      this.dateFilter = data;
    },
    resetFilters() {
      this.firstNameFilter= null;
      this.lastNameFilter= null;
      this.dateFilter= null;
    }
  },
  computed: {
    sessions() {
      let sessionsArray = this.$store.getters.getSessions;
      if (this.firstNameFilter !== null) {
        let matchFirstname = this.firstNameFilter.toLowerCase();
        sessionsArray = sessionsArray.filter(el => {
          let firstname = el.patients.firstname.toLowerCase();
          return firstname.startsWith(matchFirstname);
        })
      }

      if (this.lastNameFilter !== null) {
        let matchLastname = this.lastNameFilter.toLowerCase();
        sessionsArray = sessionsArray.filter(el => {
          let lastName = el.patients.lastname.toLowerCase();
          return lastName.startsWith(matchLastname);
        })
      }

      if (this.dateFilter !== null) {
        sessionsArray = sessionsArray.filter(el => {
          return el.date.startsWith(this.dateFilter);
        })
      }

      return sessionsArray;
    }
  },
})
</script>