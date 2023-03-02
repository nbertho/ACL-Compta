<template>
  <section class="container mx-auto mt-8">
    <button @click="this.editMode = !this.editMode" class="mr-16 py-2 px-4 bg-slate-600 text-white rounded-md text-lg">Modifier</button>
    <form 
      @submit.prevent="handleForm"
      class="container m-auto"
    >
      <div class="mt-8">
        <table class="w-full">
          <tbody v-if="!editMode">
            <tr class="border-2 border-gray-800">
              <th class="text-left p-4">Patient</th>
              <td class="p-4">
                <router-link :to="{name: 'patientDetails', params: {patientId: session.patient_id}}">
                  {{ session.patients.firstname }} {{ session.patients.lastname }}
                </router-link>
              </td>
            </tr>
            <tr class="border-2 border-gray-800">
              <th class="text-left p-4">Date</th>
              <td class="p-4">
                <p>{{ formattedDate }}</p>
              </td>
            </tr>
            <tr class="border-2 border-gray-800">
              <th class="text-left p-4">Durée</th>
              <td class="p-4">
                <p>{{ session.session_type.length }} min</p>
              </td>
            </tr>
            <tr class="border-2 border-gray-800">
              <th class="text-left p-4">Type de séance</th>
              <td class="p-4">
                <p>{{ session.session_type.name }}</p>
                <p v-if="session.session_type.description">{{ session.session_type.description }}</p>
              </td>
            </tr>
            <tr class="border-2 border-gray-800">
              <th class="text-left p-4">Présence</th>
              <td class="p-4">
                <p v-if="session.is_present == 1">Présent</p>
                <p v-else>Absent</p>
              </td>
            </tr>
          </tbody>

          <tbody v-else>
            <tr class="border-2 border-gray-800">
              <th class="text-left p-4">Patient</th>
              <td class="p-4">
                TODO_PATIENT_DROPDOWN
              </td>
            </tr>
            <tr class="border-2 border-gray-800">
              <th class="text-left p-4">Date</th>
              <td class="p-4">
                TODO_DATE_INPUT
              </td>
            </tr>
            <tr class="border-2 border-gray-800">
              <th class="text-left p-4">Durée</th>
              <td class="p-4">
                TODO_SESSION_LENGTH_INPUT
              </td>
            </tr>
            <tr class="border-2 border-gray-800">
              <th class="text-left p-4">Type de séance</th>
              <td class="p-4">
                <InputMultiselectSessionsType attr="session_type_id" :currentValue="session.session_type_id" />
              </td>
            </tr>
            <tr class="border-2 border-gray-800">
              <th class="text-left p-4">Présence</th>
              <td class="p-4">
                TODO_IS_PRESENT_CHECKBOX
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </form>
  </section>
</template>

<script>
import InputMultiselectSessionsType from '@/components/assets/InputMultiselectSessionsType';
export default({
  name: 'SessionDetailsPage',
  components: { InputMultiselectSessionsType },
  data() {
    return {
      editMode: false,
    }
  },
  computed: {
    session() {
      const id = this.$route.params.sessionId;
      const session = this.$store.getters.getSessionById(id);
      if (session) {
        return session;
      } else {
        return {
          id: '',
          date: '',
          patient_id: '',
          session_type_id: '',
          is_present: '',
          patients: {},
          session_type: {}

        }
      }
    },
    formattedDate() {
      if (this.session.date) {
        const date = new Date(this.session.date);
        const mois = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre" ]
        let year = date.getFullYear()
        let dayNumber = date.getDate()
        let month = mois[date.getMonth()]
        let weekday = date.toLocaleDateString("fr-FR", { weekday: "long" });
        let hours = date.getHours();
        let minutes = ("0" + date.getMinutes()).slice(-2);
        
        return `Séance du ${weekday} ${dayNumber} ${month} ${year}, à ${hours}:${minutes}`
      }
      else {
        return '';
      }
    }
  },
})
</script>