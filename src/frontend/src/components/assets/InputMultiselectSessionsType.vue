<template>
    <select :name="attr" v-model="session_type_id">
      <option v-for="session in sessionsType" :key="session.id" :value="session.id">{{ session.name }}</option>
    </select>
</template>

<script>
export default ({
  name: 'InputMultiselectSessionsType',
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
    currentSession() {
      if (this.currentValue) {
        return this.$store.getters.getSessionTypeById(this.currentValue);
      } else {
        return null;
      }
    },
    sessionsType() {
      return this.$store.getters.getSessionType;
    },
  }
})
</script>