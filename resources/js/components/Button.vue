<template>
    <div class="button" v-bind:class="{'button--primary' : isPrimary, 'button--disabled' : isDisabled}" v-on="{ click : !isDisabled ? action : null}">
        {{ text }}
    </div>
</template>

<script>
    export default {
        props: {
            text: String,
            action: Function,
            isPrimary: {
                type: Boolean,
                default: false
            },
            isDisabled: {
                type: Boolean,
                default: false
            }
        },
        computed: {
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";
</style>