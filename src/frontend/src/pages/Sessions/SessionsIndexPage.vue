<template>
  <h1 class="text-center text-2xl underline">Mes séances</h1>
  <section class="container mx-auto mt-8">
    <SessionsFilters 
      @filterByFirstName="updateFirstNameFilter"
      @filterByLastName="updateLastNameFilter"
      @filterByDate="updateDateFilter"
      @filterByLocation="updateLocationFilter"
      @resetFilters="resetFilters"
    />
    <ul class="mt-8" v-if="sessions.length !== 0">
      <SessionItem 
        v-for="session in sessions" 
        :key="session.id"
        :session="session"
        @click="$router.push({name: 'sessionDetails', params: {sessionId: session.id}})"
      />
    </ul>
    <div v-else>
      <p class="my-12">Désolé, aucune n'a été trouvée pour le moment</p>
    </div>
  </section>
</template>

<script>
import SessionItem from '@/components/sessions/SessionListItem';
import SessionsFilters from '@/components/filters/SessionsFilters';

export default ({
  name: 'SessionsIndexPage',
  components: { SessionItem, SessionsFilters },
  data() {
    return {
      firstNameFilter: null,
      lastNameFilter: null,
      locationFilter: null,
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
    updateLocationFilter(data) {
      this.locationFilter = data;
    },
    resetFilters() {
      this.firstNameFilter= null;
      this.lastNameFilter= null;
      this.locationFilter = null;
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

      if (this.locationFilter !== null) {
        sessionsArray = sessionsArray.filter(el => {
          return el.session_type.location_id == this.locationFilter;
        })
      }

      return sessionsArray;
    }
  },
})
</script>