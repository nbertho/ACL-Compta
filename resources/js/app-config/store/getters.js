export default {

  // Patients
  getPatients(state) {
    return state.patients.sort((a, b) => {
      const aLastName = a.lastname.toLowerCase();
      const bLastName = b.lastname.toLowerCase();
      return aLastName.localeCompare(bLastName)
    });
  },
  getPatientById: (state) => (id) => {
    return state.patients.find(patient => patient.id == id);
  },


  // Sessions
  getSessions(state) {
    return state.sessions;
  },
  getSessionsLimited(state) {
    return state.sessions.slice(0, 10);
  },
  getSessionById : (state) => (id) => {
    return state.sessions.find(session => session.id == id);
  },


  // Sessions Types
  getSessionType(state) {
    return state.session_types;
  },
  getSessionTypeById: (state) => (id) => {
    return state.session_types.find(session => session.id == id);    
  },


  // Locations
  getLocations(state) {
    return state.locations;
  },
}