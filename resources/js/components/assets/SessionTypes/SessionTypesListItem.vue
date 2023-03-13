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
        @click.prevent="deleteUser" 
        class="py-2 px-4 bg-red-500 text-white rounded-md text-lg"
      >Supprimer</button>
    </div>
  </div>
</template>

<script>
export default({
  name: 'SessionTypesListItem',
  data() {
    return {
      id: null,
      editable: false,
      dataKeys: []
    }
  },
  props: {
    dataObject: {
      type: Object,
      required: true,
    }
  },
  mounted() {
    this.id = this.dataObject.id;
    let objectKeys = Object.keys(this.dataObject);
    this.dataKeys = objectKeys.filter((elem) => { return elem !== 'id'});;
  }
})
</script>
