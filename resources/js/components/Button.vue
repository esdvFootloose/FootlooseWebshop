<template>
    <div class="button" v-on:click="">
        {{ text }}
    </div>
</template>

<script>
    export default {
        props: [
            'text'
        ]
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .button {
        box-shadow: $box-shadow--small;
        color: white;
        text-align: center;
        background: $color--red;
        width: 150px;
        height: 35px;
        padding: 10px 20px;
        margin: 10px 0;
    }
</style>