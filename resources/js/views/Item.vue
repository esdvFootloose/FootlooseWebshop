<template>
    <div class="content">
        <card
                :is-detailed="true"
                image="https://via.placeholder.com/450"
                :large-image="true"
                :title="item.name + (item.gender === 'M' ? ' male' : item.gender === 'F' ? ' female': '')"
        >
            <template v-slot:description>
                <div>
                    <div v-if="item.description">
                        {{ item.description }}
                    </div>
                    <div v-bind:class="{'item__options' : item.description}" >
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
                        <input type="number" id="itemAmount" v-model="selectedAmount" style="width: 10%;"/>
                    </div>
                </div>
                <div class="item__buttons width--full">
                    <Button
                            text="Add to cart"
                            :action="addToCart"
                            is-primary="true"
                            :is-disabled="true"
                    >
                    </Button>
                    <Button v-if="true"
                            text="Request item"
                            :action="addToRequests"
                            :is-primary="false">
                    </Button>
                    <div style="width: 300px; margin: 12px 10px" v-if="true">
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

    .item {
        &__buttons {
            display: flex;
            flex-wrap: wrap;
            margin-left: -10px;

            @media all and (min-width: $breakpoint--web) {
                position: absolute;
                bottom: 75px;
            }
        }

        &__options {
            margin-top: 20px;
        }
    }
</style>