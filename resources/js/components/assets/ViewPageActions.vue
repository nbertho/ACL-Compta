<template>
  <div>
    <div class="flex justify-between w-6/12 ml-0" v-if="editMode">
      <button @click.prevent="cancelChanges" class="py-2 px-4 bg-slate-600 text-white rounded-md text-lg">Annuler</button>
      <input type="submit" class="py-2 px-4 bg-slate-600 text-white rounded-md text-lg cursor-pointer" value="Valider les changements">
      <button @click.prevent="deleteUser" class="py-2 px-4 bg-red-500 text-white rounded-md text-lg">Supprimer l'utilisateur</button>
    </div>
    <div v-else>
      <button @click="toggleEditMode" class="py-2 px-4 bg-slate-600 text-white rounded-md text-lg">Modifier</button>
    </div>
  </div>
</template>

<script>
export default ({
  name: 'ViewPageActions',
  props: {
    editMode: {
      type: Boolean,
      required: true
    }
  },
  methods: {
    toggleEditMode() {
      this.$emit('toggle-edit');
    },
    cancelChanges() {
      this.$emit('cancel-changes');
    },
    deleteUser() {
      this.$emit('delete-user');
    },    
  }
})
</script>