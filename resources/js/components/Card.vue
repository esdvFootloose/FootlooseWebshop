<template>
    <div class="card">
        <slot name="login"></slot>
    </div>
</template>

<script>
    import Button from '../components/Button.vue';

    export default {
        components: {
            Button
        }
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
        width: 400px;
        margin: 0 auto;
        border: $border--grey;
        padding: 20px 50px;
    }
</style>