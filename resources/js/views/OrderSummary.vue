<template>
    <div class="content content__checkout">
        <Card>
            <template v-slot:description>
                <h1>Order overview</h1>
                <p v-if="message" class="checkout-item__checkout-text">{{ message }}</p>
                <a :href="paymentLink" v-if="paymentLink">{{ paymentLink }}</a>
                <table>
                    <tr>
                        <th></th>
                        <th>Item</th>
                        <th>Size</th>
                        <th>Amount</th>
                        <th>Cost</th>
                    </tr>
                    <tr v-for="item in order.ordered_item" class="row">
                        <td class="checkout-item__image">
                            <img :src="item.stock.item.image" alt="item image">
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column">
                                <router-link
                                    :to="{name: 'item', params: {slug: item.stock.item.slug, size: item.stock.size}}">
                                    {{ item.stock.item.name }}
                                </router-link>
                                <div class="visible--mobile visible--tablet">Size: {{ item.stock.size }}</div>
                                <div class="visible--mobile">{{ item.amount }}x €{{ item.stock.item.price }}
                                </div>
                            </div>

                        </td>
                        <td class="hidden--mobile hidden--tablet">Size: {{ item.stock.size }}
                        </td>
                        <td class="hidden--mobile">{{ item.amount }}x €{{ item.stock.item.price }}</td>
                        <td>€ {{ item.amount * item.stock.item.price }}</td>
                    </tr>
                    <tr class="row checkout-item__total">
                        <td :colspan="(windowSize >= 768) ? (windowSize >= 1025 ? 4 : 3 ) : 2">Total</td>
                        <td colspan="2" style="padding-left: 0">
                            € {{totalPrice}}
                        </td>
                    </tr>
                </table>
            </template>
        </Card>
    </div>
</template>

<script>
    import Card from "../components/Card";

    export default {
        name: "Order",
        components: {Card},
        computed: {
            order: function () {
                return this.$store.getters.getOrder;
            },
            windowSize: function () {
                return window.innerWidth;
            },
            totalPrice: function () {
                let price = 0;
                for (let i = 0; i < this.order.ordered_item.length; i++) {
                    price += this.order.ordered_item[i].amount * this.order.ordered_item[i].stock.item.price;
                }
                return price;
            },
            message: function() {
                if (this.order.is_paid){
                    return "Your order has been paid"
                } else {
                    return 'Your order has not been paid yet. Please pay here by clicking on this link:';
                }
            },
           paymentLink: function() {
                return this.order.payment_url;
           }
        },

        mounted() {
            this.$store.dispatch('fetchOrder', this.$route.params.id);
            if (this.$store.getters.getOrder === null) {
                this.$store.dispatch('fetchOrder', {id: this.$route.params.id});
            }
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
