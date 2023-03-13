<template>
    <select :name="attr" v-model="session_type_id">
      <option value="0">&nbsp;</option>
      <option v-for="session in sessionsType" :key="session.id" :value="session.id">{{ session.name }}</option>
    </select>
</template>

<script>
export default ({
  name: 'SessionsTypesInput',
  data() {
    return {
      session_type_id: null
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
    this.session_type_id = this.currentValue;
  },
  computed: {
    sessionsType() {
      return this.$store.getters.getSessionType;
    },
  }
})
</script>