<template>
  <div class="content content--login">
    <card
      :text-button="buttonText"
      :action-button="login"
      :is-primary-button="true"
      image="/images/Logo_red_text.svg"
    >
      <template v-slot:underneathImage>
        <input type="hidden" name="_token" :value="csrf" />
        <div class="card__login">
        <div class="login login__message">Login using your footloose website account</div>
          <label for="email">Username</label>
          <input
            class="input-focus"
            id="email"
            type="email"
            name="email"
            v-model="username"
            required
          />
          <label for="password">Password</label>
          <input
            class="input-focus"
            id="password"
            type="password"
            name="password"
            v-model="password"
            @keyup.enter="login"
            required
          />
          <div v-if="codeRequired">
            <label for="code">2FA</label>
            <input
              class="input-focus"
              id="code"
              type="number"
              name="code"
              v-model="code"
              @keyup.enter="login"
              required
            />
          </div>
          <div v-if="loginError">
            <p class="login login__error">Something went wrong, please try again</p>
          </div>
        </div>
      </template>
    </card>
  </div>
</template>

<script>
import Card from "../components/Card";

export default {
  components: {
    Card
  },
  computed: {
    loginError: function() {
      this.buttonText = "Login";
      return this.$store.getters.getError;
    }
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      username: "",
      password: "",
      code: "",
      codeRequired: false,
      buttonText: "Login"
    };
  },
  methods: {
    login() {
      let request;
      if (this.code != "") {
        request = {
          username: this.username,
          password: this.password,
          code: this.code
        };
      } else {
        request = {
          username: this.username,
          password: this.password
        };
      }
      this.$store.dispatch("login", request);
      this.buttonText = "Logging in...";
    }
  },
  mounted: function() {
    if (this.$store.getters.isLoggedIn) {
      this.$router.push({ name: "home" });
    }
    if (this.$route.params.admin === "admin") {
      this.codeRequired = true;
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../../sass/app.scss";

.login {
  text-align: center;
  &__error {
    color: $color--red;
  }

  &__message {
    margin-bottom: 30px;
  }
}

.content {
  &--login {
    margin: auto;
    max-width: 650px;
  }
}

.card {
  &__login {
    width: 100%;
    padding: 25px 10px 0;

    label {
      color: $color--grey;
    }

    input {
      width: 100%;
      margin-top: 5px;
      margin-bottom: 15px;
    }
  }

  &__error {
    width: 100%;
    color: $color--red;
  }
}
</style>
