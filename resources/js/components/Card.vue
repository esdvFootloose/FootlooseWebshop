<template>
    <div class="card">
        <slot name="login"></slot>
        <slot></slot>
    </div>
</template>

<script>
    export default {
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .card {
        box-shadow: $box-shadow--large;
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: stretch;
        margin: 0 10px;
        border: $border--grey;
        padding: 20px 25px;


        @media all and (min-width: $breakpoint--tablet) {
            margin: 20px auto;
            padding: 20px 50px;

        }
    }

</style>