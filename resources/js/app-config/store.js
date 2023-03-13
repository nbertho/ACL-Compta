import { createStore } from "vuex";

import storeState from '@/app-config/store/state.js';
import storeGetters from '@/app-config/store/getters.js';
import storeMutations from '@/app-config/store/mutations.js';
import actions from '@/app-config/store/actions.js';

export default createStore({
  state() {
    return storeState
  },
  getters: storeGetters,
  mutations: storeMutations,
  actions: actions
});