export default {

  // Patients
  setPatients({commit}, items) {
    commit('setPatients', items);
  },
  setSinglePatient({commit}, items) {
    commit('setSinglePatient', items);
  },
  addPatient({commit}, item) {
    commit('addPatient', item);
  },
  removePatient({commit}, item) {
    commit('removePatient', item);
  },
  updatePatient({commit}, item) {
    commit('updatePatient', item);
  },


  // Sessions
  setSessions({commit}, items) {
    commit('setSessions', items);
  },


  // Sessions Types
  setSessionType({commit}, items) {
    commit('setSessionType', items);
  },
  addSessionType({commit}, item) {
    commit('addSessionType', item)
  },


  // Locations
  setLocations({commit}, items) {
    commit('setLocations', items);
  },
  addLocation({commit}, item) {
    commit('addLocation', item)
  },


}