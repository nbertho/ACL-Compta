<template>
  <section>
    <div>
      <div class="grid grid-cols-2">
        <div class="flex">
          <button @click="toggleDisplay" class="mr-16 py-2 px-4 bg-slate-600 text-white rounded-md text-lg">{{ filtersTitle }}</button>
          <button v-if="activeFilters !== ''" @click="resetFilters" class="py-2 px-4 bg-slate-600 text-white rounded-md text-lg">Effacer les filtres</button>
        </div>
        <div class="flex justify-end">
          <button @click="$router.push({name: 'help'})" class="btn py-2 px-4 bg-slate-600 text-white rounded-md text-lg">Ajouter une scéance</button>
        </div>
      </div>
      <p v-if="activeFilters !== ''" class="text-left p-4">Filtres actifs :{{ activeFilters }}</p>
    </div>
    <div v-if="isShown" class="grid grid-flow-col gap-4">

      <div class="col-span-4 flex flex-col">
        <label class="text-center" for="firstname">Prénom</label>
        <input type="text" name="firstname" v-model="firstName" @input="handleFirstNameInput" class="border border-gray-300 rounded-md" />
      </div>
      
      <div class="col-span-4 flex flex-col">
        <label class="text-center" for="lastname">Nom de famille</label>
        <input type="text" name="lastname" v-model="lastName" @input="handleLastNameInput" class="border border-gray-300 rounded-md" />
      </div>
      
      <div class="col-span-4 flex flex-col">
        <label class="text-center" for="date">Date</label>
        <input type="date" name="date" v-model="date" @input="handleDateNameInput" class="border border-gray-300 rounded-md" />
      </div>
    </div>
  </section>
</template>

<script>
export default ({
  name: 'SessionsFilters',
  data() {
    return {
      isShown: false,
      firstName: '',
      lastName: '',
      date: null
    }
  },
  methods: {
    resetFilters() {
      this.firstName= '';
      this.lastName= '';
      this.date= null;
      this.$emit('resetFilters');
    },
    toggleDisplay() {
      this.isShown = !this.isShown;
    },
    handleFirstNameInput() {
      this.$emit('filterByFirstName', this.firstName);
    },
    handleLastNameInput() {
      this.$emit('filterByLastName', this.lastName);
    },
    handleDateNameInput() {
      if (this.date === '') {
        this.date = null;
      }
      this.$emit('filterByDate', this.date);
    },
  },
  computed: {
    filtersTitle() {
      return (this.isShown) ? 'Cacher les filtres' : 'Afficher les filtres' ;
    },
    activeFilters() {
      let activeFilters = [];
      if (this.firstName !== '') {
        activeFilters.push('Prénom : ' + this.firstName)
      }
      if (this.lastName !== '') {
        activeFilters.push('Nom de famille : ' + this.lastName)
      }
      if (this.date !== null) {
        activeFilters.push('Date : ' + this.date)
      }
      return activeFilters.join(', ');
    }
  },
})
</script>
