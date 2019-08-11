<template>
    <div class="navigation-bar__container">
        <nav class="navigation-bar">
            <router-link :to="{name: 'home'}" class="logo">
                <img src="/images/Logo_red_notext.svg"/>
            </router-link>
            <div
                class="navigation-bar__menu-toggle navigation-bar__menu-toggle--menu-bars"
                v-if="loggedIn"
                v-on:click="showMenu = !showMenu"
            >
                <custom-icon
                    name="menu"
                    base-class="custom-icon"
                    class="navigation-bar__menu-toggle__icon navigation-bar__menu-toggle__icon--menu-bars"
                ></custom-icon>
            </div>
            <div
                class="navigation-bar__menu"
                v-if="loggedIn"
                :class="{'navigation-bar__menu--visible' : showMenu}"
            >
                <a href="https://www.esdvfootloose.nl" class="navigation-bar__menu-item">Association</a>
                <router-link
                    :to="{name: 'dashboard'}"
                    v-if="isAdmin"
                    class="navigation-bar__menu-item"
                    tag="div"
                    v-on:click.native="closeMenu"
                >Dashboard
                </router-link>
                <router-link
                    :to="{name: 'home'}"
                    class="navigation-bar__menu-item"
                    tag="div"
                    v-on:click.native="closeMenu"
                >Store
                </router-link>
                <router-link
                    :to="{name: 'orders'}"
                    class="navigation-bar__menu-item"
                    tag="div"
                    v-on:click.native="closeMenu"
                >Orders
                </router-link>
                <router-link
                    :to="{name: 'cart'}"
                    class="navigation-bar__dropdown"
                    tag="div"
                    v-on:click.native="closeMenu"
                >
                    <div class="navigation-bar__menu-item">
                        <custom-icon
                            name="shopping-cart"
                            base-class="custom-icon"
                            class="navigation-bar__menu-toggle__icon"
                        >
                        </custom-icon>
                    </div>
                    <div class="navigation-bar__dropdown-content" v-if="cartItems.length > 0">
                        <template v-for="cartItem in cartItems">
                            <router-link
                                :to="{name: 'item', params: {slug: item(cartItem.item_id).slug, size: item(cartItem.item_id).stock.find(size => size.id === cartItem.size_id).size}}"
                            >
                                {{ item(cartItem.item_id).name }}
                                {{ item(cartItem.item_id).gender }}
                                {{ cartItem.amount + 'x ' + itemSize(cartItem) }}
                            </router-link>
                        </template>
                    </div>
                </router-link>
                <div v-on:click="logout" class="navigation-bar__menu-item">Log out</div>
            </div>
        </nav>
    </div>
</template>

<script>
    import customIcon from "vue-icon/lib/vue-feather.esm";

    export default {
        components: {
            customIcon
        },
        data: function () {
            return {
                showMenu: false,
                baseClass: "v-icon"
            };
        },
        methods: {
            closeMenu: function () {
                this.showMenu = false;
            },
            logout: function () {
                this.$store
                    .dispatch("logout")
                    .then(() => this.$router.push({name: "login"}));
            }
        },
        computed: {
            loggedIn: function () {
                return this.$store.getters.isLoggedIn;
            },
            isAdmin: function () {
                return this.$store.getters.isAdmin;
            },
            cartItems: function () {
                return this.$store.getters.getCart;
            },
            item: function () {
                return id => this.$store.getters.getItemById(id);
            },
            itemSize: function () {
                return cartItem => this.item(cartItem.item_id).stock.find(size => size.id === cartItem.size_id).size;
            },
        }
    };
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

            &:hover,
            &--active {
                background: darken($color--grey, 10%);
            }
        }

        &__menu-toggle {
            position: absolute;
            right: 10px;
            top: 0;
            height: $navigation-bar-height;
            padding: 22px;

            &__icon {
                width: 16px;
                height: 16px;
                stroke: white;
                stroke-width: 2;
                stroke-linecap: round;
                stroke-linejoin: round;

                &--menu-bars {
                    width: 24px;
                    height: 24px;
                }
            }

            &--menu-bars {
                padding: 18px;
            }

            @media all and (min-width: $breakpoint--web) {
                display: none;
            }
        }

        &__dropdown {
            &:hover,
            &--active {
                background: darken($color--grey, 10%);
                color: white;

                .navigation-bar__menu-item {
                    color: white;
                }
            }

            &:hover {
                .navigation-bar__dropdown-content {
                    display: block;
                }
            }
        }

        &__dropdown-content {
            display: none;
            position: absolute;
            background: white;
            transform: translateX(-1px);
            border-left: 1px solid darken($color--grey, 10%);
            border-bottom: 1px solid darken($color--grey, 10%);
            border-right: 1px solid darken($color--grey, 10%);
            z-index: 1;
            width: max-content;
            line-height: 1.6;
            overflow-y: scroll;

            a {
                color: $color--black;
                text-decoration: none;
                display: block;
                text-align: left;
                padding: 0 10px;

                &:hover {
                    background: darken($color--grey, 10%);
                    color: white;
                }
            }

            &--last {
                right: 0;
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

