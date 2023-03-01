<template>
  
  <section class="container m-auto">
    <ViewPageActions @toggle-edit="toggleEditMode" :editMode="editMode" />
  </section>

  <form @submit.prevent class="container mt-8 m-auto grid grid-cols-12 gap-4">

    <InputText class="col-span-4" attr="firstname" :value="firstname" text="Prénom" :editMode="editMode" />
    <InputText class="col-span-4" attr="lastname" :value="lastname" text="Nom" :editMode="editMode" />
    <InputText class="col-span-4" attr="national_number" :value="national_number" text="Numéro national" :editMode="editMode" />
    
    <InputText class="col-span-3" attr="birth_date" :value="birth_date" text="Date de naissance" inputType="date" :editMode="editMode" />
    <InputText class="col-span-3" attr="phone" :value="phone" text="Téléphone" inputType="tel" :editMode="editMode" />
    <InputText class="col-span-3" attr="nationality" :value="nationality" text="Nationalité" :editMode="editMode" />
    <InputText class="col-span-3" attr="mutuality" :value="mutuality" text="Mutualité" :editMode="editMode" />

    
    <InputText class="col-span-4" attr="languages_spoken_at_home" :value="languages_spoken_at_home" text="Langues parlés à la maison" :editMode="editMode" />
    <InputText class="col-span-4" attr="school" :value="school" text="Ecole" :editMode="editMode" />
    <InputText class="col-span-4" attr="school_year" :value="school_year" text="Année scolaire" :editMode="editMode" />
    
    

    <InputTextArea class="col-span-6" attr="address" :value="address" text="Addresse" :editMode="editMode" />
    <InputTextArea class="col-span-6" attr="contacts" :value="contacts" text="Contacts" :editMode="editMode" />
    <InputTextArea class="col-span-6" attr="family" :value="family" text="Famille" :editMode="editMode" />

    <InputTextArea class="col-span-6" attr="educational_background" :value="educational_background" text="Background scolaire" :editMode="editMode" />
    <InputTextArea class="col-span-6" attr="medical_background" :value="medical_background" text="Background médicale" :editMode="editMode" />
    <InputTextArea class="col-span-6" attr="hobbies" :value="hobbies" text="Hobbies" :editMode="editMode" />

    <InputTextArea class="col-span-6" attr="description" :value="description" text="Description" :editMode="editMode" />

  </form>
</template>

<script>
import axios from 'axios';
import appConstants from '../../app-config/app-constants';
import InputText from '../assets/InputText';
import InputTextArea from '../assets/InputTextArea';
import ViewPageActions from '../assets/ViewPageActions';

export default({
  name: 'PatientDetails',
  components: { InputText, ViewPageActions, InputTextArea },
  data() {
    return {
      editMode: false,
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
  },
  mounted() {
    const id = this.$route.params.patientId;
    const patient = this.$store.getters.getPatientById(id);
    if (patient) {
      this.updateData(patient);
    } 
    else if (this.$store.state.patients.length == 0) {
      // TODO Await for store being updated with await/async
      const store = this.$store;
      axios.get(appConstants.api.urlPath + appConstants.api.patientFind + this.$route.params.patientId)
        .then(response => {
          if (!response.data.error) {
            store.dispatch('setSinglePatient', response.data.data);
            this.updateData(response.data.data);
          }
        });
    }
  },
  methods: {
    toggleEditMode() {
      this.editMode = !this.editMode;
    },
    updateData(patient) {
      this.address = patient.address;
      this.birth_date = patient.birth_date;
      this.contacts = patient.contacts;
      this.description = patient.description;
      this.educational_background = patient.educational_background;
      this.family = patient.family;
      this.firstname = patient.firstname;
      this.follow_up_reasons = patient.follow_up_reasons;
      this.hobbies = patient.hobbies;
      this.languages_spoken_at_home = patient.languages_spoken_at_home;
      this.lastname = patient.lastname;
      this.medical_background = patient.medical_background;
      this.mutuality = patient.mutuality;
      this.national_number = patient.national_number;
      this.nationality = patient.nationality;
      this.phone = patient.phone;
      this.school = patient.school;
      this.school_year = patient.school_year;
    }
  }
})
</script>
