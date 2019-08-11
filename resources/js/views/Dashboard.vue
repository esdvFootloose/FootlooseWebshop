<template>
    <div class="content">
        <div class="dashboard__container">
            <card-grid class="width--full" :is-dashboard="true">
                <card :full-fillable="true">
                    <template v-slot:underneathImage>
                        <router-link :to="{name: 'orders', params:{query: 'new'}}" tag="div" class="dashboard__tile">
                            <h1>{{ nrPlacedOrders }}</h1>
                            Placed orders
                        </router-link>
                    </template>
                </card>
                <card :full-fillable="true">
                    <template v-slot:underneathImage>
                        <router-link :to="{name: 'item-requests'}" tag="div" class="dashboard__tile">
                            <h1>{{ nrItemRequests }}</h1>
                            Item requests
                        </router-link>
                    </template>
                </card>
                <card :full-fillable="true">
                    <template v-slot:underneathImage>
                        <router-link :to="{name: 'stocks', params:{query: 'noStock'}}" tag="div"
                                     class="dashboard__tile">
                            <h1>{{ nrItemsOutOfStock }}</h1>
                            Items out of stock
                        </router-link>
                    </template>
                </card>
                <card :full-fillable="true">
                    <template v-slot:underneathImage>
                        <router-link :to="{name: 'orders', params:{query: 'ready'}}" tag="div" class="dashboard__tile">
                            <h1>{{ nrReadyForPickup }}</h1>
                            Ready for pickup
                        </router-link>
                    </template>
                </card>
            </card-grid>
            <card-grid class="width--full" :is-dashboard="true">
                <card :full-fillable="true">
                    <template v-slot:underneathImage>
                        <router-link :to="{name: 'stocks'}" tag="div" class="dashboard__tile">
                            Stocks
                        </router-link>
                    </template>
                </card>
                <card :full-fillable="true">
                    <template v-slot:underneathImage>
                        <router-link :to="{name: 'orders'}" tag="div" class="dashboard__tile">
                            Orders
                        </router-link>
                    </template>
                </card>
                <card :full-fillable="true">
                    <template v-slot:underneathImage>
                        <router-link :to="{name: 'item-requests'}" tag="div" class="dashboard__tile">
                            Item requests
                        </router-link>
                    </template>
                </card>
            </card-grid>
        </div>
    </div>
</template>

<script>
    import CardGrid from "../components/CardGrid";
    import Card from "../components/Card";

    export default {
        components: {
            CardGrid,
            Card
        },
        computed: {
            nrPlacedOrders: function () {
                return this.$store.getters.getNrPlacedOrders;
            },
            nrItemRequests: function () {
                return this.$store.getters.getNrRequests;
            },
            nrItemsOutOfStock: function () {
                return this.$store.getters.getNrItemsOutOfStock;
            },
            nrReadyForPickup: function () {
                return this.$store.getters.getNrReadyforPickup;
            },
            getOrders: function () {
                return this.$store.getters.getOrders;
            },
            getRequests: function (){
                return this.$store.getters.getRequests;
            }
        },
        mounted() {
            this.$store.dispatch('fetchAllDashboard');
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .dashboard {

        &__container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        &__tile {
            padding: 20px 0;
            text-align: center;
            font-weight: bold;

            & h1 {
                color: $color--red;
                text-align: center;
                font-size: 72px;
                font-weight: bold;
            }
        }
    }


</style>
