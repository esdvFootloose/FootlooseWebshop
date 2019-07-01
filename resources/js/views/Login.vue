<template>
    <div class="content content--login">
        <card
                text-button="Login"
                :action-button="login"
                :is-primary-button=true
                image="images/Logo_red_text.svg"
        >
            <template v-slot:login>
                <input type="hidden" name="_token" :value="csrf">
                <div class="card__login">
                    <label for="email">Username</label>
                    <input id="email" type="email" name="email" v-model="username" required>
                    <label for="password">Password </label>
                    <input id="password" type="password" name="password" v-model="password" @keyup.enter="login" required>
                </div>
                <div v-if="error" class="card__error">{{ error }}</div>
            </template>
        </card>
    </div>
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
                console.log('test');
                let request = {
                    // _token: this.csrf,
                    email: this.username,
                    password: this.password
                };
                this.$store.dispatch('login', request);
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

    .content {
        &--login {
            margin: auto;
            max-width: 500px;
        }
    }

    .card {

        &__login {
            width: 100%;
            margin: 25px 20px 0;


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
    }
</style>