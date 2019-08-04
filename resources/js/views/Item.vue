<template>
    <div class="content content--item">
        <card
                :is-detailed="true"
                image="https://via.placeholder.com/450"
                :large-image="true"
                :title="item.name + ' ' +(item.gender === 'Unisex' ? '' : item.gender.toLowerCase())"
        >
            <template v-slot:description>
                <div class="item__description">
                    <div v-if="item.description">
                        {{ item.description }}
                    </div>
                    <div v-bind:class="{'item__options' : item.description}">
                        <label for="itemSize">Size</label>
                        <select v-model="selectedSize" id="itemSize">
                            <option disabled value="">Select a size</option>
                            <option v-for="size in item.stock">
                                {{size.size}}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="itemAmount">Amount</label>
                        <input type="number" id="itemAmount" v-model="selectedAmount" style="width: 4em"/>
                    </div>
                </div>
                <div class="item__buttons width--full">
                    <Button
                            text="Add to cart"
                            :action="addToCart"
                            :is-primary="true"
                            :is-disabled="!canAddItem"
                            :fixed-width="true"
                    >
                    </Button>
                    <Button v-if="!itemInStock"
                            text="Request item"
                            :action="addToRequests"
                            :is-primary="false"
                    :fixed-width="true"
                    >
                    </Button>
                    <div class="item__buttons__oof-text" v-if=!itemInStock>
                        This article for this amount is out of stock, request the item and we’ll keep you up-to-date on new stock
                        with your size.
                    </div>
                </div>
            </template>
        </card>
    </div>
</template>

<script>
    import Card from "../components/Card";
    import Button from "../components/Button"

    export default {
        components: {
            Card,
            Button
        },
        computed: {
            item: function () {
                return this.$store.getters.getItem(this.$route.params.slug);
            },
            cart: function() {
                return this.$store.getters.getCart;
            },
            canAddItem: function() {
                // Initial case: assure no item can be added or requested
                if (this.selectedSize === '') {
                    return false;
                } else {
                    return this.item.stock.filter(size => size.size === this.selectedSize)[0].stock >= this.selectedAmount && this.selectedAmount > 0;
                }
            },
            itemInStock: function() {
                // Initial case: assure no item can be added or requested
                if (this.selectedSize === '') {
                    return true
                } else {
                    return this.item.stock.filter(size => size.size === this.selectedSize)[0].stock >= this.selectedAmount;
                }
            }

        },
        data: function () {
            return {
                selectedSize: '',
                selectedAmount: 1,
            }
        },
        methods: {
            addToCart: function () {
                let size = this.item.stock.filter(size => size.size === this.selectedSize)[0];
                console.log('size:', size.id);
                let currentCartItem = this.cart.filter(item => item.item_id === this.item.id && item.size_id === size.id);
                let cartItem = {
                    item_id: this.item.id,
                    size_id: size.id,
                    amount: Number(this.selectedAmount)
                };
                if (currentCartItem.length === 0) {
                    this.$store.dispatch("addItemToCart", cartItem);
                } else {
                    this.$store.dispatch("adjustCartItem", cartItem);
                }
            },
            addToRequests: function () {
                let size = this.item.stock.filter(size => size.size === this.selectedSize)[0];
                let requestedItem = {
                    user_id: this.$store.getters.getUser.id,
                    item_id: this.item.id,
                    size_id: size.id,
                };
                this.$store.dispatch('requestItem', requestedItem);
            },
            updateStockInfo: function() {
                this.canAddItem();
                this.itemInStock();
            }
        },
        mounted() {
            if (this.$store.getters.getItems.length === 0) {
                this.$store.dispatch("fetchItems");
            }
            if (this.$route.params.size) {
                this.selectedSize = this.$route.params.size;
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .content {
        &--item {
            @media all and (min-width: $breakpoint--web-large) {
                padding-left: 320px;
                padding-right: 320px;
            }
        }
    }

    .item {
        &__buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin: auto;

            &__oof-text {
                margin: 12px 10px;

                @media all and (min-width: $breakpoint--web) {
                    width: calc(100% - 360px);
                    min-width: 300px;
                }
            }

            @media all and (min-width: $breakpoint--tablet) {
                max-width: 300px;
            }

            @media all and (min-width: $breakpoint--web) {
                position: absolute;
                bottom: 35px;
                width: auto;
                max-width: initial;
                flex-wrap: wrap;
                margin-left: -10px;
                justify-content: flex-start;
            }
        }

        &__options {
            margin-top: 20px;
        }
    }
</style>
