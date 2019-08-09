<template>
    <div class="content">
        <Card>
            <template v-slot:description>
                <h1>{{ title }}</h1>
                <p v-if="purchased">Thank you for your order. Please check your mail for payment details</p>
                <table>
                    <tr v-for="cartItem in cart" class="row">
                        <td class="checkout-item__image">
                            <img src="https://via.placeholder.com/100" alt="item image">
                        </td>
                        <td>{{ item(cartItem.item_id).name }}</td>
                        <td>Size: {{ item(cartItem.item_id).stock.find(size => size.id === cartItem.size_id).size }}</td>
                        <td>{{ cartItem.amount }}x €{{ item(cartItem.item_id).price }}</td>
                        <td>€ {{ cartItem.amount * item(cartItem.item_id).price }}</td>
                        <td v-if="!purchased">X</td>
                    </tr>
                    <tr class="row">
                        <td colspan="4">Total</td>
                        <td colspan="2">€ {{totalPrice}}</td>
                    </tr>
                </table>
                <div style="float: right;" v-if="!purchased">
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
            cart: function () {
                return this.$store.getters.getCart;
            },
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
                purchased: false
            }
        },
        methods: {
            purchase: function () {
                this.title = 'Order placed';
                this.purchased = true;
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app";

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
