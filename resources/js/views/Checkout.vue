<template>
    <div class="content content__checkout">
        <Card>
            <template v-slot:description>
                <h1>{{ title }}</h1>
                <p v-if="purchased">Thank you for your order. Please check your mail for payment details</p>
                <p v-if="cart.length === 0"> You have nothing in your cart, please add first an item to your cart</p>
                <table v-if="cart.length > 0 ">
                    <tr v-for="cartItem in cart" class="row">
                        <td class="checkout-item__image">
                            <img src="https://via.placeholder.com/100" alt="item image">
                        </td>
                        <td>{{ item(cartItem.item_id).name }}</td>
                        <td>Size: {{ item(cartItem.item_id).stock.find(size => size.id === cartItem.size_id).size }}
                        </td>
                        <td>{{ cartItem.amount }}x €{{ item(cartItem.item_id).price }}</td>
                        <td>€ {{ cartItem.amount * item(cartItem.item_id).price }}</td>
                        <td v-if="!purchased" @click="removeItem(cartItem)">X</td>
                    </tr>
                    <tr class="row">
                        <td colspan="4">Total</td>
                        <td colspan="2">
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
            totalPrice: function () {
                let price = 0;
                for (let i = 0; i < this.cart.length; i++) {
                    price += this.cart[i].amount * this.item(this.cart[i].item_id).price;
                }
                return price;
            }
        },
        data: function () {
            return {
                title: 'Checkout',
                purchased: false,
                cart: {}
            }
        },
        methods: {
            purchase: function () {
                this.title = 'Order placed';
                this.purchased = true;
                this.$store.dispatch('clearCart');
            },
            removeItem: function (item) {
                this.$store.dispatch('removeItemFromCart', item);
                this.cart = this.$store.getters.getCart;
            }
        },
        mounted: function () {
            this.cart = this.$store.getters.getCart;
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
                height: 75px;
                width: auto;
            }
        }
    }
</style>
