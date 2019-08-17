<template>
    <div class="content">
        <div class="heading">
            <h1>Orders</h1>
            <div class="heading__search">
                <label class="heading__search-label">Search</label>
                <input type="text" v-model="orderSearch">
            </div>
        </div>
        <table>
            <tr>
                <th v-for="header in tableHeaders"
                    :class="{'hidden--mobile' : header.hideMobile, 'hidden--tablet' : header.hideTablet}">{{
                    header.header }}
                </th>
            </tr>
            <template v-for="order in orders">
                <tr class="row">
                    <td>{{ order.id }}</td>
                    <td>{{ order.user.name }}</td>
                    <td class="hidden--mobile hidden--tablet">{{ order.created_at }}</td>
                    <td>€ {{ orderValue(order.ordered_item) }}</td>
                    <td class="hidden--mobile">{{ order.is_paid ? 'Yes' : 'No'}}</td>
                    <td class="hidden--mobile">{{ order.is_picked_up ? 'Yes' : 'No' }}</td>
                    <td class="hidden--mobile hidden--tablet">{{ order.is_picked_up? order.updated_at : '' }}</td>
                    <td>
                        <div class="button" @click="toggle(order.id)"
                             v-if="opened !== order.id">Edit
                        </div>
                    </td>
                </tr>
                <tr v-if="opened === order.id">
                    <td :colspan="(windowSize >= 768) ? (windowSize >= 1025 ? 8 : 5 ) : 3">
                        <div class="orders__details">
                            <table>
                                <tr>
                                    <th v-for="header in itemTableHeaders"> {{ header.header }}</th>
                                </tr>
                                <tr v-for="item in order.ordered_item">
                                    <td>{{ item.stock.item.name }}</td>
                                    <td>{{ item.stock.item.gender }}</td>
                                    <td>{{ item.stock.size }}</td>
                                    <td>{{ item.amount }}x</td>
                                    <td>
                                        <div class="button" v-if="!item.is_picked_up && order.is_paid"
                                             @click="setChangedItem(item.stock.id, order.id)">Picked up
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="orders__details__buttons">
                                <div class="button button--primary" @click="saveChanges(order.id)" v-if="!order.is_picked_up">Save</div>
                                <div class="button" @click="clearChanges">Cancel</div>
                            </div>
                        </div>
                    </td>
                </tr>
            </template>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data: function () {
            return {
                tableHeaders: [
                    {
                        header: 'Order ID',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: 'Name',
                        hideMobile: false,
                        hideTablet: false
                    },
                    {
                        header: 'Date ordered',
                        hideMobile: true,
                        hideTablet: true,
                    },
                    {
                        header: 'Total (€)',
                        hideMobile: false,
                        hideTablet: false
                    },
                    {
                        header: 'Paid',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: 'Picked up',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: 'Time picked up',
                        hideMobile: true,
                        hideTablet: true
                    },
                    {
                        header: '',
                        hideMobile: false,
                        hideTablet: false
                    }
                ],
                itemTableHeaders: [
                    {
                        header: 'Item',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: 'Type',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: 'Size',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: 'Amount',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: '',
                        hideMobile: true,
                        hideTablet: false
                    },

                ],
                orderSearch: '',
                collapsedData: {},
                showDetails: false,
                opened: null,
                changedData: []
            }
        },
        computed: {
            orders: function () {
                return this.$store.getters.getOrders;
            },

            filteredOrders: function () {
                switch (this.$route.params.query) {
                    case ('ready'):
                        return this.orders.filter(order => {
                            return order.user.name.toLowerCase().includes(this.orderSearch.toLowerCase()) && order.is_paid && !order.is_picked_up;
                        });
                        break;
                    case('new'):
                        return this.orders.filter(order => {
                            return order.user.name.toLowerCase().includes(this.orderSearch.toLowerCase()) && !order.is_picked_up;
                        });
                        break;
                    default:
                        return this.orders.filter(order => {
                            return order.user.name.toLowerCase().includes(this.orderSearch.toLowerCase())
                        });
                        break;
                }

            },
            orderValue: function () {
                return items => {
                    let value = 0;
                    for (let i = 0; i < items.length; i++) {
                        value += items[i].amount * items[i].stock.item.price;
                    }
                    return value;
                }
            },
            windowSize: function () {
                return window.innerWidth;
            }

        },
        methods: {
            toggle(id) {
                this.opened = id;
            },
            setChangedItem(stockID, orderID) {
                let changedItem = {
                    stock_id: stockID,
                    order_id: orderID
                };
                this.changedData.push(changedItem);
                let item = this.orders.find(order => order.id === orderID).ordered_item.find(item => item.stock.id === stockID);
                item.is_picked_up = true;
            },
            saveChanges(orderID) {
                axios.patch('/api/orders/' + orderID, {
                    data: JSON.stringify(this.changedData)
                }).then(result => {
                    this.changedData = [];
                    this.opened = '';
                    this.$store.dispatch('fetchOrders');
                });
            },
            clearChanges() {
                for (let i = 0; i < this.changedData.length; i++) {
                    let item = this.orders.find(order => order.id === this.changedData[i].order_id).ordered_item.find(item => item.stock.id === this.changedData[i].stock_id);
                    item.is_picked_up = false
                }
                this.opened = '';
                this.changedData = [];
            }
        },
        mounted() {
            if (this.$store.getters.getNrOrders === 0) this.$store.dispatch('fetchOrders');
        }
    }
</script>


<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .heading {
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;

        &__search {
            display: flex;
            align-items: center;
            max-width: 150px;
        }

        &__search-label {
            margin-right: 10px;
        }
    }

    .orders {
        &__details {
            font-weight: $font-weight;
            margin-bottom: 30px;

            &__buttons {
                display: flex;
                margin-left: auto;
                width: fit-content;
            }
        }
    }
</style>
