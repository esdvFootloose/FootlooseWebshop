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
                    <td>{{ order.created_at }}</td>
                    <td>€ {{ orderValue(order.ordered_item) }}</td>
                    <td>{{ order.is_paid ? 'Yes' : 'No'}}</td>
                    <td>{{ order.is_picked_up ? 'Yes' : 'No' }}</td>
                    <td>{{ order.is_picked_up? order.updated_at : '' }}</td>
                    <td>
                        <div class="button" @click="toggle(order.order_id)"
                             v-if="opened !== order.order_id">Edit
                        </div>
                    </td>
                </tr>
                <tr v-if="opened === order.order_id">
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
                                        <div class="button" v-if="!item.is_picked_up" @click="setPickedUp(order.order_id, order.stock_id)">Picked up</div>
                                    </td>
                                </tr>
                            </table>
                            <div class="orders__details__buttons">
                                <div class="button button--primary">Save</div>
                                <div class="button" @click="opened = ''">Cancel</div>
                            </div>
                        </div>
                    </td>
                </tr>
            </template>
        </table>
    </div>
</template>

<script>

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
                        hideTablet: false
                    },
                    {
                        header: 'Total (€)',
                        hideMobile: false,
                        hideTablet: false
                    },
                    {
                        header: 'Paid',
                        hideMobile: true,
                        hideTablet: true
                    },
                    {
                        header: 'Picked up',
                        hideMobile: true,
                        hideTablet: true
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
                mockupTableDataItems: [
                    {
                        item: 'T-Shirt',
                        sex: 'Male',
                        size: 'M',
                        amount: '1',
                        picked_up: false
                    },
                    {
                        item: 'Sweater',
                        sex: 'Female',
                        size: 'S',
                        amount: '1',
                        picked_up: false
                    },
                    {
                        item: 'Shoebag',
                        sex: 'Unisex',
                        size: 'M',
                        amount: '2',
                        picked_up: true
                    },
                ],
                orderSearch: '',
                collapsedData: {},
                showDetails: false,
                opened: null
            }
        },
        computed: {
            orders: function () {
                return this.$store.getters.getOrders;
            },
            filteredOrders: function () {
                return this.orders.filter(order => {
                    return this.order.name.toLowerCase().includes(this.orderSearch.toLowerCase())
                });
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
            setPickedUp: function(item, index) {
                let pickedUpItem = {

                };
                // TODO implement this function in store
                // this.$store.dispatch("setItemPicketUp", pickedUpItem);
                this.mockupTableDataItems[index].picked_up = true;
            }
        },
        mounted() {
            if (this.$store.getters.getOrders.length === 0) this.$store.dispatch('fetchOrders');
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
