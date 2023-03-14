<template>
  <div class="border border-black mb-4 rounded shadow-sm shadow-gray-600 p-4 w-auto grid grid-cols-12 gap-4">
    <div class="col-span-10 flex flex-row justify-start ">
      <div v-for="dataKey in dataKeys" :key="dataKey">
        <p class="my-2 mx-4">{{ dataKey }} : {{ dataObject[dataKey] }}</p>
      </div>
    </div>
    <div class="col-span-2 flex flex-row justify-between">
      <button
        @click.prevent="deleteUser" 
        class="py-2 px-4 bg-gray-500 text-white rounded-md text-lg"
      >Modifier</button>

      <button 
        @click.prevent="deleteItem" 
        class="py-2 px-4 bg-red-500 text-white rounded-md text-lg"
      >Supprimer</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import appConstants from '@/app-config/app-constants.js';

export default({
  name: 'LocationListItem',
  data() {
    return {
      id: null,
      editable: false,
      dataKeys: []
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
      if (!window.confirm('Voulez-vous vraiment supprimer cet emplacement? Toute les données associées seront également supprimées')) {
        return;
      }

      const store = this.$store;
      axios.delete(appConstants.api.urlPath + appConstants.api.locationDelete + this.id)
        .then(response => {
          if (!response.data.error) {
            store.dispatch('removeLocation', this.id);            
            this.setSuccessActionMsg("L'emplacement a été supprimé avec succès");
          } else {
            this.setErrorActionMsg("Une erreur est survenue et l'emplacement n'a pas pu être supprimé")
          }
        })
    }
  },
  mounted() {
    this.id = this.dataObject.id;
    let objectKeys = Object.keys(this.dataObject);
    this.dataKeys = objectKeys.filter((elem) => { return elem !== 'id'});
  }
})
</script>
