<template>
  <h1 class="text-center text-2xl underline">Mes patients</h1>
  <section class="container mx-auto mt-8">
    <PatientsFilter
      @filterByFirstName="updateFirstNameFilter"
      @filterByLastName="updateLastNameFilter"
      @filterByDob="updateDobFilter"
      @resetFilters="resetFilters"
    />
    <ul class="mt-8 grid grid-cols-3 gap-4" v-if="patients.length !== 0">
      <PatientListItem
        v-for="patient in patients" :key="patient.id"
        :patient="patient"
      />
    </ul>
    <div v-else>
      <p class="my-12">Désolé, aucun patient n'a été trouvé</p>
    </div>
  </section>
</template>

<script>
import PatientsFilter from '@/components/filters/PatientsFilters.vue';
import PatientListItem from '@/components/patients/PatientListItem.vue';
export default ({
  name: 'PatientsIndexPage',
  components: {PatientsFilter, PatientListItem},
  data() {
    return {
      firstNameFilter: null,
      lastNameFilter: null,
      dobFilter: null
    }
  },
  methods: {
    updateFirstNameFilter(data) {
      this.firstNameFilter = data;
    },
    updateLastNameFilter(data) {
      this.lastNameFilter = data;
    },
    updateDobFilter(data) {
      this.dobFilter = data;
    },
    resetFilters() {
      this.firstNameFilter= null;
      this.lastNameFilter= null;
      this.dobFilter= null;
    }
  },
  computed: {
    patients() {
      let patientsArray = this.$store.getters.getPatients;
      
      if (this.firstNameFilter !== null) {
        let matchFirstname = this.firstNameFilter.toLowerCase();
        patientsArray = patientsArray.filter(el => {
          let firstname = el.firstname.toLowerCase();
          return firstname.startsWith(matchFirstname);
        })
      }

      if (this.lastNameFilter !== null) {
        let matchLastname = this.lastNameFilter.toLowerCase();
        patientsArray = patientsArray.filter(el => {
          let lastName = el.lastname.toLowerCase();
          return lastName.startsWith(matchLastname);
        })
      }

      if (this.dobFilter !== null) {
        patientsArray = patientsArray.filter(el => {
          console.log(el);
          if (el.birth_date) {
            return el.birth_date.startsWith(this.dobFilter);
          }
        })
      }

      return patientsArray;
    }
  }
})
</script>