<template>
    <div class="navigation-bar__container">
        <nav class="navigation-bar">
            <router-link :to="{name: 'items'}" class="logo">
                <img src="/images/Logo_red_notext.svg">
            </router-link>
            <div class="navigation-bar__menu-toggle" v-on:click="showMenu = !showMenu">
                <menu-bars class="navigation-bar__menu-toggle__icon"></menu-bars>
            </div>
            <div class="navigation-bar__menu" :class="{'navigation-bar__menu--visible' : showMenu}">
                <router-link :to="{name: 'dashboard'}" class="navigation-bar__menu-item" tag="div">Dashboard
                </router-link>
                <router-link :to="{name: 'items'}" class="navigation-bar__menu-item" tag="div">Home</router-link>
                <router-link :to="{name: 'orders'}" class="navigation-bar__menu-item" tag="div">Orders</router-link>
                <router-link :to="{name: 'cart'}" class="navigation-bar__menu-item" tag="div">Shopping cart
                </router-link>
            </div>
        </nav>
    </div>
</template>

<script>
    import {Menu} from 'vue-feather-icon'

    export default {
        components: {
            MenuBars: Menu.default,
        },
        data: function () {
            return {
                'showMenu': false,
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    $height: 60px;

    .navigation-bar {
        color: white;
        flex-direction: column;
        position: relative;
        display: flex;
        width: 100%;

        @media all and (min-width: 1280px) {
            align-items: center;
            flex-direction: unset;
        }

        &__container {
            display: flex;
            align-content: center;
            background: $color--black;
            position: fixed;
            justify-content: center;
            top: 0;
            height: $height;
            width: 100%;
        }

        &__menu {
            background: $color--grey;
            display: none;

            &--visible {
                display: initial;
            }

            @media all and (min-width: 1280px) {
                display: flex;
                flex-direction: row;
                justify-content: center;
                position: fixed;
                right: 0;
                margin-right: 40px;
                background: none;
            }
        }

        &__menu-item {
            display: flex;
            align-items: center;
            justify-content: center;
            height: $height;
            padding: 0 25px;
            color: white;
            text-decoration: none;

            &:hover, &--active {
                background: darken($color--grey, 10%);
            }
        }

        &__menu-toggle {
            position: absolute;
            right: 10px;
            top: 0;
            height: $height;
            padding: 20px;

            &__icon {
                width: 24px;
                height: 24px;
                stroke: white;
                stroke-width: 2;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            @media all and (min-width: 1280px) {
                display: none;
            }
        }
    }

    .logo {
        margin: 0 auto;
        height: 60px;
        padding: 10px 0;

        img {
            /*margin: 0 auto;*/
            height: 40px;
            width: auto;
        }

        @media all and (min-width: 1280px) {
            margin-left: 40px;
        }
    }
</style>

