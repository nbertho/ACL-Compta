<template>
    <select :name="attr" v-model="location_id">
      <option value="0">&nbsp;</option>
      <option v-for="location in locations" :key="location.id" :value="location.id">{{ location.name }}</option>
    </select>
</template>

<script>
export default ({
  name: 'InputMultiselectLocations',
  data() {
    return {
      location_id: null
    }
  },
  props: {
    attr: {
      type: String,
      required: true
    },
    currentValue: {
      required: false
    }
  },
  mounted() {
    this.location_id = this.currentValue;
  },
  computed: {
    locations() {
      return this.$store.getters.getLocations;
    },
  },
  watch: {
    location_id() {
      this.$emit('selectOptionChanged', this.location_id);
    }
  }
})
</script>