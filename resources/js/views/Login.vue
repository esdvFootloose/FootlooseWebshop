<template>
    <card>
        <template v-slot:login>
            <input type="hidden" name="_token" :value="csrf">
            <div class="card__fl-logo">
                <img src="images/Logo_red_text.svg">
            </div>
            <div class="card__login">
                <label for="email">Username</label>
                <input id="email" type="email" name="email" v-model="username" required>
                <label for="password">Password </label>
                <input id="password" type="password" name="password" v-model="password" required>
            </div>
            <div v-if="error" class="card__error">{{ error }}</div>
            <div class="card__cta-button">
                <Button text="Login" :action="login" is-primary></Button>
            </div>
        </template>
    </card>
</template>

<script>
    import Card from "../components/Card";
    import Button from "../components/Button"

    export default {
        components: {
            Card,
            Button
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                username: '',
                password: '',
                error: ''
            }
        },
        methods: {
            login() {
                let request = {
                    // _token: this.csrf,
                    email: this.username,
                    password: this.password
                };
                this.$store.dispatch('login', request).then(() => {
                    this.$router.push({ name: 'home' });
                });
            }
        },
        mounted: function() {
            if (this.$store.getters.isLoggedIn) {
                this.$router.push({name: 'home'});
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .card {

        &__fl-logo {
            width: 100%;
            margin-bottom: 20px;

            img {
                display: block;
                margin: auto;
                width: 100%;
                max-width: 200px;
                height: auto;
            }
        }

        &__login {
            width: 100%;

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
            /*text-align: center;*/

        }

        &__cta-button {
            width: 100%;
            position: relative;
            left: 50%;
            margin-left: -70px;
        }
    }
</style>