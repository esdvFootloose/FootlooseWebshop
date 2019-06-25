<template>
    <div class="content card-grid">
        <slot></slot>
    </div>
</template>

<script>

    export default {
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .card-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        justify-items: center;

        @media all and (min-width: $breakpoint--tablet) {
            grid-template-columns: repeat(2, 1fr);
        }

        @media all and (min-width: $breakpoint--web) {
            grid-template-columns: repeat(5, 1fr);
        }
    }

</style>