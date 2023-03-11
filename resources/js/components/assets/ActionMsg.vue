<template>
  <div 
    :class="'border border-black mb-4 rounded shadow-sm p-4 w-3/12 right-6 absolute z-50 ' + bgColorClass"
    v-if="msg !== ''"
  >
    <p>{{ msg }}</p>
    <ul v-if="errors" class="pl-4">
      <li v-for="error in errors" :key="error" class="list-disc">{{ error }}</li>
    </ul>
  </div>
</template>

<script>
export default({
  name: 'ActionMsg',
  props: {
    msg: {
      required: true,
      type: String,
    },
    errors: {
      required: false,
      type: Array,
    },
    bgColorClass: {
      required: false,
      type: String,
      default: 'bg-green-400'
    }
  },
  updated() {
    if (this.msg !== '') {
      setTimeout(() => {
        this.$emit('resetMsg');
      }, 5000);
    }
  }
});
</script>
