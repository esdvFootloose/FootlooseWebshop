<template>
    <div class="card-grid" :class="{'card-grid--dashboard' : isDashboard}">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            isDashboard: {
                type: Boolean,
                default: false
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .card-grid {
        display: grid;
        gap: 14px 14px;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));

        &--dashboard {
            margin: 30px 0;
            grid-template-columns: repeat(1, 1fr);

            @media all and (min-width: $breakpoint--tablet) {
                grid-template-columns: repeat(2, 1fr);
            }

            @media all and (min-width: $breakpoint--web) {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media all and (min-width: $breakpoint--tablet) {
            gap: 16px 16px;
        }

        @media all and (min-width: $breakpoint--web) {
            gap: 18px 18px;
        }
    }

</style>
