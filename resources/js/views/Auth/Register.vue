<template>
  <div class="login mt-5">
    <div class="card">
      <div class="card-header">
        Register
      </div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="email">Name</label>
            <input
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.name }"
              id="name"
              v-model="details.name"
              placeholder="Enter name"
            />
            <div class="invalid-feedback" v-if="errors.name">
              {{ errors.name[0] }}
            </div>
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input
              type="email"
              class="form-control"
              :class="{ 'is-invalid': errors.email }"
              id="email"
              v-model="details.email"
              placeholder="Enter email"
            />
            <div class="invalid-feedback" v-if="errors.email">
              {{ errors.email[0] }}
            </div>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              class="form-control"
              :class="{ 'is-invalid': errors.password }"
              id="password"
              v-model="details.password"
              placeholder="Password"
            />
            <div class="invalid-feedback" v-if="errors.password">
              {{ errors.password[0] }}
            </div>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm password</label>
            <input
              type="password"
              class="form-control"
              id="confirm_password"
              v-model="details.confirm_password"
              placeholder="Confirm password"
            />
          </div>
		  <div class="form-group">
            <label for="is_admin">Is Admin</label>
            <input
              type="checkbox"
              class="form-control is-admin"
              id="user_admin"
              v-model="details.is_admin"
            />
          </div>
          <button type="button" @click="register" class="btn btn-primary">
            Register
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Home",

  data: function() {
    return {
      details: {
        name: null,
        email: null,
        password: null,
        confirm_password: null,
		is_admin: null,
      }
    };
  },

  computed: {
    ...mapGetters(["errors"])
  },

  mounted() {
    this.$store.commit("setErrors", {});
  },

  methods: {
    ...mapActions("auth", ["sendRegisterRequest"]),

    register: function() {
      this.sendRegisterRequest(this.details).then(() => {
        this.$router.push({ name: "Home" });
      });
    }
  }
};
</script>
<style scoped>
.is-admin {
	width:  20px;;
}
</style>
