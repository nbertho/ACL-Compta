<template>
  <li 
    class="grid grid-flow-col w-auto border border-black mb-4 rounded shadow-sm hover:shadow-gray-600 hover:shadow-lg shadow-gray-600 cursor-pointer p-4"
    @click="goToUserPage"
  >
    <div class="col-span-4 flex flex-col justify-around">
      <p><strong>{{ patient.lastname }}</strong> {{ patient.firstname }}</p>
      <p>NISS : {{ patient.national_number }}</p>
    </div>
    <div class="col-span-4 flex flex-col justify-around">
    </div>
    <div class="col-span-4 flex flex-col justify-around">
      <p>Année: {{ patient.birth_date.slice(0, 4) }}</p>
    </div>
  </li>
</template>

<script>
export default ({
  props: ['patient'],
  methods: {
    goToUserPage() {
      this.$router.push({name: 'patientDetails', params: {patientId: this.patient.id}})
    }
  }
})
</script>