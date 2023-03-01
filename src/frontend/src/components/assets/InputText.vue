<template>
  <section class="border border-gray-700 mb-4 rounded shadow-sm p-4">
    <div v-if="editMode">
      <label class="block underline mb-2" :for="attr"><strong>{{ text }}</strong></label>
      <input 
        :name="attr" 
        :id="attr" 
        :type="inputType" 
        :value="value" 
        class="border border-gray-300 rounded p-4"
      />
    </div>
    <div v-else>
      <p class="underline mb-2"><strong>{{ text }}</strong></p>
      <p class="p-4">{{ value }}</p>
    </div>
  </section>
</template>

<script>
export default ({
  name: 'InputText',
  props: {
    attr: {
      type: String,
      required: true
    },
    inputType: {
      type: String,
      required: false,
      default: 'text'
    },
    text: {
      type: String,
      required: true
    },
    value: {
      required: true
    },
    editMode: {
      type: Boolean,
      required: false,
      default: true
    }
  }
})
</script>