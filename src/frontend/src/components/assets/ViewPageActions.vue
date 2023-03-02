<template>
  <div class="grid grid-cols-3">
    <div class="flex justify-between" v-if="editMode">
      <input type="submit" class="py-2 px-4 bg-slate-600 text-white rounded-md text-lg cursor-pointer" value="Valider les changements">
      <button @click="cancelChanges" class="py-2 px-4 bg-slate-600 text-white rounded-md text-lg">Annuler</button>
    </div>
    <div v-else>
      <button @click="toggleEditMode" class="py-2 px-4 bg-slate-600 text-white rounded-md text-lg">Modifier</button>
    </div>
    <div>&nbsp;</div>
    <button class="py-2 px-4 bg-red-500 text-white rounded-md text-lg">Supprimer l'utilisateur</button>
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
    }
  }
})
</script>