<template>
    <div class="card-grid">
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
        gap: 14px 14px;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));

        @media all and (min-width: $breakpoint--tablet) {
            gap: 16px 16px;

        }

        @media all and (min-width: $breakpoint--web) {
            gap: 18px 18px;
        }
    }

</style>