<template>
    <div class="content">
        <Card>
            <template v-slot:login>
                <form autocomplete="off" method="post" action="login">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="card__fl-logo">
                        <img src="images/Logo_red_text.svg">
                    </div>
                    <div class="card__login">
                        <label for="email">Username </label>
                        <input id="email" type="email" name="email" required>
                        <label for="password">Password </label>
                        <input id="password" type="password" name="password" required>
                    </div>
                    <div class="card__cta-button">
                        <Button text="Login"></Button>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </form>

            </template>
        </Card>
    </div>
</template>

<script>
    import Card from "../components/Card";

    export default {
        components: {
            Card
        },

        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

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
                width: 200px;
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

        &__cta-button {
            width: 100%;
            position: relative;
            left: 50%;
            margin-left: -70px;
        }
    }
</style>