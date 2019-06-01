<template>
<p>Home</p>
</template>

<script>
    export default {

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