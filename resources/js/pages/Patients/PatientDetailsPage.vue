<template>

  <form 
    @submit.prevent="handleForm"
    class="container m-auto"
  >
    <ViewPageActions 
      @toggle-edit="toggleEditMode" 
      @cancel-changes="handleCancelChanges"
      @delete-user="deleteCurrentUser"
      :editMode="editMode" 
    />

    <div class="py-3">
      <h1 class="text-4xl text-center underline">{{ patient.firstname }} {{ patient.lastname }}</h1>
    </div>

    <div class="mt-8  grid grid-cols-12 gap-4">
      <InputText class="col-span-4" attr="lastname" :value="patient.lastname" text="Nom" :editMode="editMode" />
      <InputText class="col-span-4" attr="firstname" :value="patient.firstname" text="Prénom" :editMode="editMode" />
      <InputText class="col-span-4" attr="national_number" :value="patient.national_number" text="Numéro national" :editMode="editMode" />
      
      <InputText class="col-span-3" attr="birth_date" :value="patient.birth_date" text="Date de naissance" inputType="date" :editMode="editMode" />
      <InputText class="col-span-3" attr="phone" :value="patient.phone" text="Téléphone" inputType="tel" :editMode="editMode" />
      <InputText class="col-span-3" attr="nationality" :value="patient.nationality" text="Nationalité" :editMode="editMode" />
      <InputText class="col-span-3" attr="mutuality" :value="patient.mutuality" text="Mutualité" :editMode="editMode" />

      
      <InputText class="col-span-4" attr="languages_spoken_at_home" :value="patient.languages_spoken_at_home" text="Langues parlés à la maison" :editMode="editMode" />
      <InputText class="col-span-4" attr="school" :value="patient.school" text="Ecole" :editMode="editMode" />
      <InputText class="col-span-4" attr="school_year" :value="patient.school_year" text="Année scolaire" :editMode="editMode" />


      <InputTextArea class="col-span-6" attr="address" :value="patient.address" text="Adresse" :editMode="editMode" />
      <InputTextArea class="col-span-6" attr="contacts" :value="patient.contacts" text="Contacts" :editMode="editMode" />
      <InputTextArea class="col-span-6" attr="family" :value="patient.family" text="Famille" :editMode="editMode" />

      <InputTextArea class="col-span-6" attr="educational_background" :value="patient.educational_background" text="Background scolaire" :editMode="editMode" />
      <InputTextArea class="col-span-6" attr="medical_background" :value="patient.medical_background" text="Background médicale" :editMode="editMode" />
      <InputTextArea class="col-span-6" attr="hobbies" :value="patient.hobbies" text="Hobbies" :editMode="editMode" />

      <InputTextArea class="col-span-6" attr="follow_up_reasons" :value="patient.follow_up_reasons" text="Raisons du suivi" :editMode="editMode" />
      <InputTextArea class="col-span-6" attr="description" :value="patient.description" text="Description" :editMode="editMode" />
    </div>

  </form>
</template>

<script>
import axios from 'axios';
import appConstants from '@/app-config/app-constants.js';
import InputText from '@/components/assets/Inputs/InputText.vue';
import InputTextArea from '@/components/assets/Inputs/InputTextArea.vue';
import ViewPageActions from '@/components/assets/ViewPageActions.vue';

export default({
  name: 'PatientDetailsPage',
  components: { InputText, ViewPageActions, InputTextArea },
  data() {
    return {
      editMode: false,
    }
  },
  computed: {
    patient() {
      const id = this.$route.params.patientId;
      const patient = this.$store.getters.getPatientById(id);
      if (patient) {
        return patient;
      } else {
        return {
          address: '',
          birth_date: '',
          contacts: '',
          description: '',
          educational_background: '',
          family: '',
          follow_up_reasons: '',
          firstname: '',
          lastname: '',
          hobbies: '',
          languages_spoken_at_home: '',
          medical_background: '',
          mutuality: '',
          national_number: '',
          nationality: '',
          phone: '',
          school: '',
          school_year: '',
        }
      }
    }
  },
  inject: ['setErrorActionMsg', 'setSuccessActionMsg'],
  methods: {
    toggleEditMode() {
      this.editMode = !this.editMode;
    },
    handleForm(event) {
      if (!window.confirm('Voulez-vous vraiment sauvegarder vos changements?')) {
        return;
      }

      const formData = new FormData(event.target);
      const store = this.$store;
      let putObject = {};
      formData.forEach((value, key) => {
        if (!value) {
          value = '';
        }
        putObject[key] = value
      });
      axios.put(appConstants.api.urlPath + appConstants.api.patientUpdate + this.$route.params.patientId, putObject)
        .then(response => {
          if (!response.data.error) {
            this.editMode = false;
            putObject['id'] = this.$route.params.patientId;
            store.dispatch('updatePatient', putObject);
          } else {
            console.log(response)
          }
        });
    },
    deleteCurrentUser() {
      if (!window.confirm('Voulez-vous vraiment supprimer ce patient?')) {
        return;
      }
      const fullName = this.patient.firstname + ' ' + this.patient.lastname;
      const store = this.$store;
      axios.delete(appConstants.api.urlPath + appConstants.api.patientDelete + this.$route.params.patientId)
        .then(response => {
          if (!response.data.error) {
            store.dispatch('removePatient', this.$route.params.patientId);
            this.$router.push({name: 'patients'});
            this.setSuccessActionMsg('Le patient ' + fullName + ' a été supprimé avec succès');
          } else {
            console.log(response)
          }
        })
    },
    handleCancelChanges() {
      if (window.confirm('Voulez-vous vraiment annuler vos changements?')) {
        this.editMode = false;
      } else {
        this.editMode = true;
      }
    },
  }
})
</script>
