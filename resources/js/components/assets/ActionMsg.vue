<template>
  <div 
    :class="'border border-black mb-4 rounded shadow-sm px-4 pb-4 pt-2 w-3/12 right-6 absolute z-50 ' + bgColorClass"
    v-if="msg !== ''"
  >
    <div class="close cursor-pointer" @click="emitCloseEvent">&nbsp;</div>
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
  methods: {
    emitCloseEvent() {
      this.$emit('resetMsg');
    }
  },
  updated() {
    if (this.msg !== '') {
      setTimeout(() => {
        this.emitCloseEvent();
      }, 3000);
    }
  }
});
</script>

<style scoped>
.close {
  width: 25px;
  height: 25px;
  margin-right: 0;
  margin-left: auto;
}
.close:after{
  content: "\00d7";
  font-size: 25px;
}
</style>
