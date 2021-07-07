const state = {
  reviewCompanys: null,
}

const getters = {
  reviewCompanys: state => state.reviewCompanys,
}

const mutations = {
  SET_REVIEW_COMPANYS: (state, param) => {
    state.reviewCompanys = param;
  },
}

const actions = {
  async setReviewCompanys({commit}) {
    try {
      const reviewCompanys = await axios.post('/api/reviewCompanySearch');
      console.log(reviewCompanys);
      commit("SET_REVIEW_COMPANYS",reviewCompanys);
    } catch (e) {
      throw e;
    }
  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
