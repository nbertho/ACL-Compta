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
      return state.patients;
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
    letLocations(state) {
      return state.locations;
    }
  },
  mutations: {
    setPatients(state, data) {
      state.patients = data;
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
    setSessions({commit}, items) {
      commit('setSessions', items);
    },
    setSessionType({commit}, items) {
      commit('setSessionType', items);
    },
    setLocations({commit}, items) {
      commit('setLocations', items);
    }
  }
});