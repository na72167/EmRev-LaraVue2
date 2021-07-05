import Vue from 'vue'
import Vuex from 'vuex'

import header from '@/store/modules/header'
import tool from '@/store/modules/tool'
import users from '@/store/modules/users'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    header,
    tool,
    users
  }
})

export default store
