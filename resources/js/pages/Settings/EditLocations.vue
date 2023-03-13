<template>
  <h1 class="text-center text-2xl underline">Emplacements des cabinets</h1>
  <section class="container mx-auto mt-8">

    <div class="border border-black mb-4 rounded shadow-sm shadow-gray-600 p-4 w-auto grid grid-cols-12 gap-4">
      <div class="col-span-10 flex flex-row justify-start ">
        <div class="mx-4">
          <input class="border border-gray-300 rounded px-4 py-2" name="name" placeholder="Nom"  type="text" v-model="newName" >
        </div>
        <div class="mx-4">
          <input class="border border-gray-300 rounded px-4 py-2 w-96"  name="address" placeholder="Adresse" type="text" v-model="newAddress">
        </div>
      </div>
      <div class="col-span-2 flex flex-row justify-between">
        <button
          @click.prevent="addLocation" 
          class="py-2 px-4 bg-gray-500 text-white rounded-md text-lg"
        >Ajouter</button>
        <button
          @click.prevent="resetNewForm" 
          class="py-2 px-4 bg-gray-500 text-white rounded-md text-lg"
        >Effacer</button>
      </div>
    </div>
    <hr class="mt-4 mb-8 border border-gray-600">
    <LocationListItem
      v-for="location in locations"
      :key="location.id"
      :dataObject="location"
    />
  </section>
</template>

<script>
import axios from 'axios';
import appConstants from '@/app-config/app-constants.js';
import LocationListItem from '@/components/assets/Locations/LocationListItem.vue';


export default({
  name: 'EditLocations',
  inject: ['setErrorActionMsg', 'setSuccessActionMsg'],
  components: { LocationListItem },
  data() {
    return {
      newName: '',
      newAddress: ''
    }
  },
  computed: {
    locations() {
      return this.$store.getters.getLocations;
    }
  },
  methods: {
    addLocation() {
      const store = this.$store;
      axios.post(appConstants.api.urlPath + appConstants.api.locationCreate, {
        name: this.newName,
        address: this.newAddress
      })
      .then(response => {
        if (!response.data.error) {
          store.dispatch('addLocation', response.data.data);
          window.scrollTo({ top: 0, behavior: 'smooth' });
          this.setSuccessActionMsg("Emplacement créé avec succès");
          this.resetNewForm();
        }
        else {
          window.scrollTo({ top: 0, behavior: 'smooth' });
          this.setErrorActionMsg("Attention, une erreur est survenue avec le(s) champ(s) suivant(s):", response.data.data.fields);
        }
      })
    },
    resetNewForm() {
      this.newName = '';
      this.newAddress =  '';
    }
  }
})
</script>