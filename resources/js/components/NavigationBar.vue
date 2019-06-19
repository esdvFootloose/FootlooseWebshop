<template>
    <div class="navigation-bar__container">
        <nav class="navigation-bar">
            <router-link :to="{name: 'home'}" class="logo">
                <img src="/images/Logo_red_notext.svg">
            </router-link>
            <div class="navigation-bar__menu-toggle" v-if="loggedIn" v-on:click="showMenu = !showMenu">
                <custom-icon name="menu" base-class="custom-icon"
                             class="navigation-bar__menu-toggle__icon"></custom-icon>
            </div>
            <div class="navigation-bar__menu" v-if="loggedIn" :class="{'navigation-bar__menu--visible' : showMenu}">
                    <router-link :to="{name: 'dashboard'}" v-if="isAdmin" class="navigation-bar__menu-item" tag="div"
                                 v-on:click.native=closeMenu>Dashboard
                    </router-link>
                    <router-link :to="{name: 'home'}" class="navigation-bar__menu-item" tag="div"
                                 v-on:click.native=closeMenu>Home
                    </router-link>
                    <router-link :to="{name: 'orders'}" class="navigation-bar__menu-item" tag="div"
                                 v-on:click.native=closeMenu>Orders
                    </router-link>
                    <router-link :to="{name: 'cart'}" class="navigation-bar__menu-item" tag="div"
                                 v-on:click.native=closeMenu>
                        <custom-icon name="shopping-cart" base-class="custom-icon"
                                     class="navigation-bar__menu-toggle__icon"></custom-icon>
                    </router-link>
            </div>
        </nav>
    </div>
</template>

<script>
    import customIcon from 'vue-icon/lib/vue-feather.esm'

    export default {
        components: {
            customIcon,
        },
        data: function () {
            return {
                showMenu: false,
                baseClass: 'v-icon',
            }
        },
        methods: {
            closeMenu: function () {
                this.showMenu = false;
            }
        },
        computed: {
            loggedIn: function () {
                return this.$store.getters.isLoggedIn;
            },
            isAdmin: function() {
                return this.$store.getters.isAdmin;
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";


    .navigation-bar {
        color: white;
        flex-direction: column;
        position: relative;
        z-index: 1;
        display: flex;
        width: 100%;

        @media all and (min-width: $breakpoint--web) {
            align-items: center;
            flex-direction: unset;
        }

        &__container {
            grid-area: navigation-bar;
            display: flex;
            align-content: center;
            background: $color--black;
            position: sticky;
            justify-content: center;
            top: 0;
            height: $navigation-bar-height;
            width: 100%;
            z-index: 1;
        }

        &__menu {
            background: $color--grey;
            display: none;

            &--visible {
                display: initial;
            }

            @media all and (min-width: $breakpoint--web) {
                display: flex;
                flex-direction: row;
                justify-content: center;
                position: sticky;
                right: 0;
                margin-right: 40px;
                background: none;
            }
        }

        &__menu-item {
            display: flex;
            align-items: center;
            justify-content: center;
            height: $navigation-bar-height;
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
            height: $navigation-bar-height;
            padding: 20px;

            &__icon {
                width: 16px;
                height: 16px;
                stroke: white;
                stroke-width: 2;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            @media all and (min-width: $breakpoint--web) {
                display: none;
            }
        }
    }

    .logo {
        margin: 0 auto;
        height: 60px;
        padding: 10px 0;

        img {
            height: 40px;
            width: auto;
        }

        @media all and (min-width: $breakpoint--web) {
            margin-left: 40px;
        }
    }
</style>

