<template>
    <div class="content content__checkout">
        <Card>
            <template v-slot:description>
                <h1>{{ title }}</h1>
                <p v-if="message" class="checkout-item__checkout-text">{{ message }}</p>
                <table v-if="cart.length > 0">
                    <tr>
                        <th></th>
                        <th>Item</th>
                        <th>Size</th>
                        <th>Amount</th>
                        <th>Cost</th>
                        <th></th>
                    </tr>
                    <tr v-for="cartItem in cart" class="row">
                        <td class="checkout-item__image">
                            <img src="https://via.placeholder.com/100" alt="item image">
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column">
                                <router-link
                                    :to="{name: 'item', params: {slug: cartItem.stock.item.slug, size: cartItem.stock.size}}">
                                    {{ cartItem.stock.item.name }}
                                </router-link>
                                <div class="visible--mobile visible--tablet">Size: {{ cartItem.stock.size }}</div>
                                <div class="visible--mobile">{{ cartItem.amount }}x €{{ cartItem.stock.item.price }}
                                </div>
                            </div>

                        </td>
                        <td class="hidden--mobile hidden--tablet">Size: {{ cartItem.stock.size }}
                        </td>
                        <td class="hidden--mobile">{{ cartItem.stock.size }}x €{{ cartItem.stock.item.price }}</td>
                        <td>€ {{ cartItem.amount * cartItem.stock.item.price }}</td>
                        <td v-if="!purchased" v-on:click="removeItem(cartItem)">
                            <custom-icon
                            name="x"
                            base-class="custom-icon"
                            class="checkout-icon"
                        ></custom-icon></td>
                    </tr>
                    <tr class="row checkout-item__total">
                        <td :colspan="(windowSize >= 768) ? (windowSize >= 1025 ? 4 : 3 ) : 2">Total</td>
                        <td colspan="2" style="padding-left: 0">
                            € {{totalPrice}}
                        </td>
                    </tr>
                </table>
                <div style="float: right;" v-if="!purchased && cart.length > 0">
                    <div class="button button--primary" @click="purchase">Purchase</div>
                </div>
            </template>
        </Card>
    </div>
</template>

<script>
    import Card from '../components/Card'
    import CustomIcon from "vue-icon/lib/vue-feather.esm";

    export default {
        components: {
            Card,
            CustomIcon
        },
        computed: {
            item: function () {
                return id => this.$store.getters.getItemById(id);
            },
            itemSize: function () {
                return cartItem => this.item(cartItem.item_id).stock.find(size => size.id === cartItem.size_id).size;
            },
            totalPrice: function () {
                let price = 0;
                for (let i = 0; i < this.cart.length; i++) {
                    price += this.cart[i].amount * this.cart[i].stock.item.price;
                }
                return price;
            },
            windowSize: function () {
                return window.innerWidth;
            }
        },
        data: function () {
            return {
                title: 'Checkout',
                purchased: false,
                message: '',
                cart: {},
                userId: {}
            }
        },
        methods: {
            purchase: function () {
                this.title = 'Order placed';
                this.purchased = true;
                if (this.$store.dispatch('orderCartItems', this.$store.getters.getUser.id)) {
                    this.title = 'Order placed';
                    this.message = 'Thank you for your order. Please check your mail for payment details.';
                    this.purchased = true;
                } else {
                    this.message = 'Something went wrong, please try again.'
                }
            },
            removeItem: function (item) {
                console.log("removed clicked");
                this.$store.dispatch('removeItemFromCart', item);
                this.loadCart()
            },
            loadCart: function () {
                this.cart = this.$store.getters.getCart;
                if (this.cart.length === 0) this.message = 'You have nothing in your cart, please add first an item to your cart.';
            }
        },
        mounted: function () {
            this.$store.dispatch('fetchCart');
            this.loadCart();
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app";

    .content__checkout {
        max-width: 1200px;
        margin: auto;
    }

    .checkout-item {
        &__image {
            padding: 10px 0;

            img {
                height: 50px;
                width: auto;

                @media all and (min-width: $breakpoint--tablet) {
                    height: 75px;
                }
            }
        }

        &__total {
            font-weight: $font-weight--bold;
        }

        &__checkout-text {
            margin-bottom: 20px;
        }
    }

    .checkout-icon {
        height: $font-size--heading - 5pt;
        width: $font-size--heading - 5pt;
    }
</style>
