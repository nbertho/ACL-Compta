<template>
  <h1 class="text-center text-2xl underline">Ajouter un patient</h1>
  <form 
    @submit.prevent="handleForm"
    class="container m-auto"
  >
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


      <InputTextArea class="col-span-6" attr="address" :value="patient.address" text="Addresse" :editMode="editMode" />
      <InputTextArea class="col-span-6" attr="contacts" :value="patient.contacts" text="Contacts" :editMode="editMode" />
      <InputTextArea class="col-span-6" attr="family" :value="patient.family" text="Famille" :editMode="editMode" />

      <InputTextArea class="col-span-6" attr="educational_background" :value="patient.educational_background" text="Background scolaire" :editMode="editMode" />
      <InputTextArea class="col-span-6" attr="medical_background" :value="patient.medical_background" text="Background médicale" :editMode="editMode" />
      <InputTextArea class="col-span-6" attr="hobbies" :value="patient.hobbies" text="Hobbies" :editMode="editMode" />

      <InputTextArea class="col-span-6" attr="follow_up_reasons" :value="patient.follow_up_reasons" text="Raisons du suivi" :editMode="editMode" />
      <InputTextArea class="col-span-6" attr="description" :value="patient.description" text="Description" :editMode="editMode" />
      <div class="col-span-10">&nbsp;</div>
      <button type="submit" class="col-span-2 py-2 px-4 bg-green-400 text-white rounded-md text-lg">Ajouter</button>
    </div>

  </form>
</template>

<script>
import axios from 'axios';
import appConstants from '@/app-config/app-constants.js';
import InputText from '@/components/assets/InputText.vue';
import InputTextArea from '@/components/assets/InputTextArea.vue';

export default({
  name: 'PatientNewPage',
  components: { InputText, InputTextArea },
  data() {
    return {
      editMode: true,
      patient: {
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
  },
  inject: ['setErrorActionMsg', 'setSuccessActionMsg'],
  methods: {
    handleForm(event) {
      const formData = new FormData(event.target);
      const store = this.$store;
      const router = this.$router;
      let postObject = {};
      formData.forEach((value, key) => {
        if (!value) {
          value = '';
        }
        postObject[key] = value;
      });

      axios.post(appConstants.api.urlPath + appConstants.api.patientCreate, postObject)
        .then(response => {
          if (!response.data.error) {
            store.dispatch('addPatient', response.data.data);
            router.push({ name: 'patientDetails', params: { patientId: response.data.data.id } })
            this.setSuccessActionMsg("Le patient a bien été créé");
          }
          else {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            this.setErrorActionMsg("Attention, une erreur est survenue avec les champs suivants:", response.data.data.fields);
          }
        })
    },
  }
})
</script>
