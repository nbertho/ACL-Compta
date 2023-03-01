<template>
  <section class="border border-black mb-4 rounded shadow-sm p-4">
    <div v-if="editMode">
      <label class="block underline mb-2" :for="attr">{{ text }}</label>
      <textarea 
        :name="attr" 
        :id="attr" 
        :value="value"
        rows="4" 
        cols="50"
        class="border border-gray-300 rounded p-4"
      ></textarea>
    </div>
    <div v-else>
      <p class="underline mb-2"><strong>{{ text }}</strong></p>
      <div v-html="value.replace(/(?:\r\n|\r|\n)/g, '<br>')"></div>
    </div>
  </section>
</template>

<script>
export default ({
  name: 'InputTextArea',
  props: {
    attr: {
      type: String,
      required: true
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
  },
})
</script>