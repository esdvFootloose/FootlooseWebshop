<template>
    <div class="button" v-bind:class="{'button--primary' : isPrimary}" @click.left.exact="action">
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
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";
</style>