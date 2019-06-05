<template>
    <div class="button" v-bind:class="{'button--primary' : isPrimary}" @click="action">
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

    .button {
        box-shadow: $box-shadow--small;
        color: white;
        text-align: center;
        background: $color--grey;
        width: 150px;
        height: 35px;
        padding: 10px 20px;
        margin: 10px 0;

        &:hover, &:active {
            background: darken($color--grey, 10%);
        }

        &--primary {
            background: $color--red;

            &:hover, &:active {
                background: darken($color--red, 10%);
            }
        }
    }
</style>