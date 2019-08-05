<template>
    <div class="button"
         v-bind:class="{'button--primary' : isPrimary, 'button--disabled' : isDisabled, 'button--fixed-width' : fixedWidth}"
         v-on="buttonFunction">
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
            isDisabled: Boolean,
            fixedWidth: Boolean,
            actionObject: Object,
        },
        computed: {
            buttonFunction: function () {
                if (this.actionObject){
                    return this.actionObject.action;
                } else {
                    return this.isDisabled ? null : this.action;
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";
</style>
