<template>
  <h1 class="text-center text-2xl underline">Types de séances</h1>
  <section class="container mx-auto mt-8">

    <div class="border border-black mb-4 rounded shadow-sm shadow-gray-600 p-4 w-auto grid grid-cols-12 gap-4">
      <div class="col-span-10 flex flex-row justify-start ">
        
        <div class="mx-4">
          <input class="border border-gray-300 rounded px-4 py-2 h-10" name="newName" placeholder="Nom"  type="text" v-model="newName" >
        </div>

        <div class="mx-4">
          <input class="border border-gray-300 rounded px-4 py-2 h-10" name="newDescription" placeholder="Description"  type="text" v-model="newDescription" >
        </div>

        <div class="mx-4">
          <input class="border border-gray-300 rounded px-4 py-2 h-10" name="newLength" placeholder="Durée (minutes)"  type="number" v-model="newLength" >
        </div>

        <div class="mx-4">
          <input class="border border-gray-300 rounded px-4 py-2 h-10" name="newPrice" placeholder="Prix"  type="number" v-model="newPrice" >
        </div>

        <div class="mx-4">
          <InputMultiselectLocations 
            class="border border-gray-300 rounded px-4 py-2 h-10" 
            attr="location_id"
            @selectOptionChanged="handleMultiselectNewChange"
          />
        </div>
      </div>
      <div class="col-span-2 flex flex-row justify-between">
        <button
          @click.prevent="addSessionType" 
          class="py-2 px-4 bg-gray-500 text-white rounded-md text-lg"
        >Ajouter</button>
        <button
          @click.prevent="resetNewForm" 
          class="py-2 px-4 bg-gray-500 text-white rounded-md text-lg"
        >Effacer</button>
      </div>
    </div>

    <SettingsListActions
      v-for="session in sessions"
      :key="session.id"
      :dataObject="session"
    />
  </section>
</template>

<script>
import axios from 'axios';
import appConstants from '@/app-config/app-constants.js';
import SettingsListActions from '@/components/assets/SettingsListActions.vue';
import InputMultiselectLocations from '@/components/assets/InputMultiselectLocations.vue';

export default({
  name: 'EditSessionTypes',
  inject: ['setErrorActionMsg', 'setSuccessActionMsg'],
  components: { SettingsListActions, InputMultiselectLocations },
  data() {
    return {
      newName: '',
      newDescription: '',
      newLength: '',
      newPrice: '',
      newLocation_id: 0,
    }
  },
  computed: {
    sessions() {
      return this.$store.getters.getSessionType;
    }
  },
  methods: {
    addSessionType() {
      const store = this.$store;
      axios.post(appConstants.api.urlPath + appConstants.api.sessionTypeCreate, {
        name: this.newName,
        description: this.newDescription,
        length: this.newLength,
        price: this.newPrice,
        location_id: this.newLocation_id,
      })
      .then(response => {
        console.log(response)
        if (!response.data.error) {
          store.dispatch('addSessionType', response.data.data);
          window.scrollTo({ top: 0, behavior: 'smooth' });
          this.setSuccessActionMsg("Type créé avec succès");
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
      this.newDescription = '';
      this.newLength = '';
      this.newPrice = '';
      this.newLocation_id = 0;
    },
    handleMultiselectNewChange($event) {
      this.newLocation_id = $event;
    }
  }
})
</script>