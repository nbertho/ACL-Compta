<template>

  <h1 class="text-center text-2xl underline">Paramètres</h1>

  <section class="container mx-auto mt-8">
    <ul class="grid grid-cols-4 gap-4">
      <li 
        v-for="link in addDataLinks" :key="link.path" 
        class="grid grid-flow-col w-auto border border-black mb-4 rounded shadow-sm hover:shadow-gray-600 hover:shadow-lg shadow-gray-600 cursor-pointer p-4"
      >
        <router-link :to="{name: link.ulrPath}" class="px-8 py-4 text-center">{{ link.title }}</router-link>
      </li>
    </ul>
  </section>

</template>

<script>
export default({
  name: 'SettingsPage',
  data() {
    return {
      addDataLinks: [
        { title: "Ajouter un type de séances", ulrPath: 'settingsEditSessionType' },
        { title: "Ajouter un emplacement", ulrPath: 'settingsEditLocations' }
      ]
    }
  }
})
</script>