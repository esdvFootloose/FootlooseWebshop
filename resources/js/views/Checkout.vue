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
                        <th>Remove</th>
                    </tr>
                    <tr v-for="cartItem in cart" class="row">
                        <td class="checkout-item__image">
                            <img src="https://via.placeholder.com/100" alt="item image">
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column">
                                <router-link
                                    :to="{name: 'item', params: {slug: item(cartItem.item_id).slug, size: item(cartItem.item_id).stock.find(size => size.id === cartItem.size_id).size}}">
                                    {{ item(cartItem.item_id).name }}
                                </router-link>
                                <div class="visible--mobile visible--tablet">Size: {{ itemSize(cartItem) }}</div>
                                <div class="visible--mobile">{{ cartItem.amount }}x €{{ item(cartItem.item_id).price }}
                                </div>
                            </div>

                        </td>
                        <td class="hidden--mobile hidden--tablet">Size: {{ itemSize(cartItem) }}
                        </td>
                        <td class="hidden--mobile">{{ cartItem.amount }}x €{{ item(cartItem.item_id).price }}</td>
                        <td>€ {{ cartItem.amount * item(cartItem.item_id).price }}</td>
                        <td v-if="!purchased" @click="removeItem(cartItem)">X</td>
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

    export default {
        components: {
            Card
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
                    price += this.cart[i].amount * this.item(this.cart[i].item_id).price;
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
                this.$store.dispatch('removeItemFromCart', item);
                this.loadCart()
            },
            loadCart: function () {
                this.cart = this.$store.getters.getCart;
                if (this.cart.length === 0) this.message = 'You have nothing in your cart, please add first an item to your cart.';
            }
        },
        mounted: function () {
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
</style>
