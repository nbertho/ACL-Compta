import { createStore } from "vuex";

export default createStore({
  state() {
    return {
      patients: [],
      sessions: [],
      session_types: [],
      locations: []
    }
  },
  getters: {
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
    getSessions(state) {
      return state.sessions;
    },
    getSessionsLimited(state) {
      return state.sessions.slice(0, 10);
    },
    getSessionType(state) {
      return state.session_types;
    },
    getLocations(state) {
      return state.locations;
    },
  },
  mutations: {
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
    updatePatient(state, data) {
      const patientIndex = state.patients.findIndex(patient => patient.id == data.id);
      state.patients[patientIndex] = data;
    },
    removePatient(state, patientId) {
      const patientIndex = state.patients.findIndex(patient => patient.id == patientId);
      console.log(patientIndex);
      state.patients.splice(patientIndex, 1);
    },
    addPatient(state, data) {
      state.patients.push(data);
    },
    setSessions(state, data) {
      state.sessions = data;
    },
    setSessionType(state, data) {
      state.session_types = data;
    },
    setLocations(state, data) {
      state.locations = data;
    }
  },
  actions: {
    setPatients({commit}, items) {
      commit('setPatients', items);
    },
    setSinglePatient({commit}, items) {
      commit('setSinglePatient', items);
    },
    setSessions({commit}, items) {
      commit('setSessions', items);
    },
    setSessionType({commit}, items) {
      commit('setSessionType', items);
    },
    setLocations({commit}, items) {
      commit('setLocations', items);
    },
    updatePatient({commit}, item) {
      commit('updatePatient', item);
    },
    removePatient({commit}, item) {
      commit('removePatient', item);
    },
    addPatient({commit}, item) {
      commit('addPatient', item);
    }
  }
});