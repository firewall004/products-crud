import axios from "axios";

export default {
  namespaced: true,

  state: {
    userData: null
  },

  getters: {
    user: state => state.userData
  },

  mutations: {
    setUserData(state, user) {
      state.userData = user;
    }
  },

  actions: {
    getUserData({ commit }) {
      axios
        .get("user")
        .then(response => {
          commit("setUserData", response.data.data);
        })
        .catch(() => {
          localStorage.removeItem("authToken");
        });
    },
    sendLoginRequest({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios
        .post("api/login/" + data.userType, data)
        .then(response => {
          commit("setUserData", response.data.data.user);
          localStorage.setItem("authToken", response.data.data.token);
        })
		.catch(function (error) {
			console.log(error);
		});
    },
    sendRegisterRequest({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios
        .post("api/register", data)
        .then(response => {
          commit("setUserData", response.data.data.user);
          localStorage.setItem("authToken", response.data.data.token);
        });
    },
    sendLogoutRequest({ commit }) {
      axios.get("api/logout").then(() => {
        commit("setUserData", null);
        localStorage.removeItem("authToken");
      });
    },
  }
};
