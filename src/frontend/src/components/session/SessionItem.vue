<template>
  <li class="grid grid-flow-col w-auto border border-black mb-4 rounded shadow-sm hover:shadow-gray-600 hover:shadow-lg shadow-gray-600 cursor-pointer p-4">
    <div class="col-span-4 flex flex-col justify-around">
      <p>{{ date }}</p>
      <p>{{ session.session_type.name }} - {{ session.session_type.length }} minutes</p>
    </div>
    <div class="col-span-4 flex flex-col justify-around">
      <p class="text-left">{{ session.patients.lastname }} {{ session.patients.firstname }}</p>
    </div>
    <div class="col-span-4 flex flex-col justify-around">
      <p v-if="this.session.is_present === 1" class="text-green-800 text-left"><strong>Patient présent</strong></p>
      <p v-if="this.session.is_present === 0" class="text-red-800 text-left"><strong>Patient absent</strong></p>
      <p class="text-left">{{ session.session_type.price }} €</p>
    </div>
  </li>
</template>

<script>
export default({
  props: ['session'],
  computed: {
    date() {
      const date = new Date(this.session.date);
      return this.getDateToCorrectFormat(date);
    },
  },
  methods: {
    getDateToCorrectFormat(date) {
      const mois = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre" ]
      let year = date.getFullYear()
      let dayNumber = date.getDate()
      let month = mois[date.getMonth()]
      let weekday = date.toLocaleDateString("fr-FR", { weekday: "long" });
      let hours = date.getHours();
      let minutes = ("0" + date.getMinutes()).slice(-2);
      
      return `${weekday} ${dayNumber} ${month} ${year}, à ${hours}:${minutes}`
}

  },
  mounted() {
    console.log(this.is_present)
  }
});
</script>
