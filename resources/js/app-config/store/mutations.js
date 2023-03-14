export default {
  
  // Patients
  setPatients(state, data) {
    state.patients = data;
  },
  setSinglePatient(state, data) {
    const i = state.patients.findIndex(patient => patient.id == data.id);
    if (i > -1) {
      state.patients[i] = data;
    }
    else {
      state.patients.push(data);
    }
  },
  addPatient(state, data) {
    state.patients.push(data);
  },
  removePatient(state, patientId) {
    const patientIndex = state.patients.findIndex(patient => patient.id == patientId);
    state.patients.splice(patientIndex, 1);
  },
  updatePatient(state, data) {
    const patientIndex = state.patients.findIndex(patient => patient.id == data.id);
    state.patients[patientIndex] = data;
  },

  
  // Sessions
  setSessions(state, data) {
    state.sessions = data;
  },


  // Sessions Types
  setSessionType(state, data) {
    state.session_types = data;
  },
  addSessionType(state, data) {
    state.session_types.push(data);
  },

  
  // Locations
  setLocations(state, data) {
    state.locations = data;
  },
  addLocation(state, data) {
    state.locations.push(data);
  },
  removeLocation(state, locationId) {
    const locationIndex = state.locations.findIndex(location => location.id == locationId);
    state.locations.splice(locationIndex, 1);
  }
}