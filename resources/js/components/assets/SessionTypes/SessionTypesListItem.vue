<template>
  <div class="border border-black mb-4 rounded shadow-sm shadow-gray-600 p-4 w-auto grid grid-cols-12 gap-4">
    <div class="col-span-10 flex flex-row justify-around ">
      
      <div>
        <label for="name">Nom</label>
        <p v-if="!editable" class="my-2 mr-4">{{ dataObject.name }}</p>
        <input v-else type="text" name="name" class="border border-gray-300 rounded-md" />
      </div>

      <div>
        <label for="length">Durée</label>
        <p v-if="!editable" class="my-2 mx-4">{{ dataObject.length }} min</p>
        <input v-else type="number" name="length" class="border border-gray-300 rounded-md" />
      </div>

      <div>
        <label for="price">Prix</label>
        <p v-if="!editable" class="my-2 mx-4">{{ dataObject.price }} €</p>
        <input v-else type="number" name="price" class="border border-gray-300 rounded-md" />
      </div>

      <div>
        <label for="location">Emplacement</label>
        <p v-if="!editable" class="my-2 mx-4">{{ locationName }}</p>
        <LocationsInput 
            class="border border-gray-300 rounded px-4 py-2 h-10" 
            attr="location_id"
            @selectOptionChanged="handleMultiselectNewChange"
          />
      </div>

    </div>
    <div class="col-span-2 flex flex-row justify-between" v-if="!editable">
      <button
        @click.prevent="toggleEditable" 
        class="py-2 px-4 bg-gray-500 text-white rounded-md text-lg"
      >Modifier</button>

      <button 
        @click.prevent="deleteItem" 
        class="py-2 px-4 bg-red-500 text-white rounded-md text-lg"
      >Supprimer</button>
    </div>
    <div class="col-span-2 flex flex-row justify-between" v-else>
      <button
        @click.prevent="console.log('TODO')" 
        class="py-2 px-4 bg-gray-500 text-white rounded-md text-lg"
      >Valider</button>

      <button 
      @click.prevent="console.log('TODO')" 
        class="py-2 px-4 bg-red-500 text-white rounded-md text-lg"
      >Annuler</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import appConstants from '@/app-config/app-constants.js';
import LocationsInput from '@/components/assets/Inputs/MultiSelects/Locations/LocationsInput.vue';

export default({
  name: 'SessionTypesListItem',
  components: { LocationsInput },
  data() {
    return {
      id: null,
      name: '',
      description: '',
      length: 0,
      location_id: 0,
      price: 0,
      editable: false,
    }
  },
  inject: ['setErrorActionMsg', 'setSuccessActionMsg'],
  props: {
    dataObject: {
      type: Object,
      required: true,
    }
  },
  methods: {
    deleteItem() {
      if (!window.confirm('Voulez-vous vraiment supprimer ce type de séance? Toute les données associées seront également supprimées')) {
        return;
      }

      const store = this.$store;
      axios.delete(appConstants.api.urlPath + appConstants.api.sessionTypeDelete + this.id)
        .then(response => {
          if (!response.data.error) {
            store.dispatch('removeSessionType', this.id);            
            this.setSuccessActionMsg("Le type de séance a été supprimé avec succès");
          } else {
            this.setErrorActionMsg("Une erreur est survenue et le type de séance n'a pas pu être supprimé")
          }
        })
    },
    toggleEditable() {
      this.editable = !this.editable;
    },
    handleMultiselectNewChange($event) {
      this.location_id = $event;
    }
  },
  computed: {
    locationName() {
      if (this.location_id) {
        const data = this.$store.getters.getLocationById(this.location_id);
        return data.name;
      }
      return '';
    }
  },
  mounted() {
    this.id = this.dataObject.id;
    this.name = this.dataObject.name;
    this.description = this.dataObject.description;
    this.length = this.dataObject.length;
    this.location_id = this.dataObject.location_id;
    this.price = this.dataObject.price;
  }
})
</script>
