<template>
    <Card>
        <template v-slot:login>
            <form method="POST" action="login">
                <div class="card__fl-logo">
                    <img src="images/Logo_red_text.svg">
                </div>
<!--                                <div class="card__login">-->
<!--                                    <label for="email">Username </label>-->
<!--                                    <input id="email" type="email" name="email" required autocomplete="email" autofocus>-->
<!--                                    <label for="password">Password </label>-->
<!--                                    <input id="password" type="password" name="password" required autocomplete="current-password">-->
<!--                                </div>-->
<!--                                <div class="card__cta-button">-->
<!--                                    <Button text="Login"></Button>-->
<!--                                </div>-->
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">email</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>

                        <!--                        @error('email')-->
                        <!--                        <span class="invalid-feedback" role="alert">-->
                        <!--                                        <strong>{{ $message }}</strong>-->
                        <!--                                    </span>-->
                        <!--                        @enderror-->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">

                        <!--                        @error('password')-->
                        <!--                        <span class="invalid-feedback" role="alert">-->
                        <!--                                        <strong>{{ $message }}</strong>-->
                        <!--                                    </span>-->
                        <!--                        @enderror-->
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </form>

        </template>
    </Card>
</template>

<script>
    import Card from "../components/Card";

    export default {
        components: {
            Card
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