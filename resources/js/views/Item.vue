<template>
    <div class="content content--item">
        <card
                :is-detailed="true"
                image="https://via.placeholder.com/450"
                :large-image="true"
                :title="item.name + (item.gender === 'M' ? ' male' : item.gender === 'F' ? ' female': '')"
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
                            <option v-for="size in item.sizes">
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
                            :is-disabled="true"
                    >
                    </Button>
                    <Button v-if="true"
                            text="Request item"
                            :action="addToRequests"
                            :is-primary="false">
                    </Button>
                    <div class="item__buttons__oof-text" v-if="true">
                        This article is out of stock, request the item and we’ll keep you up-to-date on new stock
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
                return this.$store.getters.getItem(this.$route.params.slug)
            }

        },
        data: function () {
            return {
                selectedSize: '',
                selectedAmount: 1
            }
        },
        methods: {
            addToCart: function () {

            },
            addToRequests: function () {

            }
        },
        mounted() {
            if (this.$store.getters.getItems.length === 0) {
                this.$store.dispatch("fetchItems");
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