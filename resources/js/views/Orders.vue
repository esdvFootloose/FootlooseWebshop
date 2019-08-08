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
            <template v-for="(filterValue, key, keyIndex) in filteredOrders">
                <tr class="row">
                    <td v-for="(value, key, index) in filterValue"
                        :class="{'hidden--mobile' : tableHeaders[index].hideMobile, 'hidden--tablet' : tableHeaders[index].hideTablet}">
                        {{ (value === 0 || value === 1) && index > 0 ? (value === 0 ? 'false' : 'true') : value }}
                    </td>
                    <td>
                        <div class="button" @click="toggle(filterValue.order_id)"
                             v-if="opened !== filterValue.order_id">Edit
                        </div>
                    </td>
                </tr>
                <tr v-if="opened === filterValue.order_id">
                    <td :colspan="(windowSize >= 768) ? (windowSize >= 1025 ? 8 : 5 ) : 3">
                        <div class="orders__details">
                            <table>
                                <tr>
                                    <th v-for="header in itemTableHeaders"> {{ header.header }}</th>
                                </tr>
                                <tr v-for="(item, index) in mockupTableDataItems">
                                    <td v-for="attribute in item">
                                        <div class="button" v-if=" attribute === false" @click="setPickedUp(item, index)">Picked up</div>
                                        <template v-if="attribute !== false && attribute !== true">
                                            {{ attribute }}
                                        </template>
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
    import Button from "../components/Button";

    export default {
        components: {Button},
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
                mockupTableData: [
                    {
                        'order_id': 1,
                        'name': 'John Doe',
                        'data_ordered': '29-11-2019',
                        'total': 65,
                        'paid': 0,
                        'picked_up': 0,
                        'Time picked up': '30-11-2019 10:31'
                    },
                    {
                        'order_id': 2,
                        'name': 'John Dee',
                        'data_ordered': '29-11-2019',
                        'total': 65,
                        'paid': 0,
                        'picked_up': 0,
                        'Time picked up': '30-11-2019 10:31'
                    },
                    {
                        'order_id': 3,
                        'name': 'John Doe',
                        'data_ordered': '29-11-2019',
                        'total': 65,
                        'paid': 0,
                        'picked_up': 0,
                        'Time picked up': '30-11-2019 10:31'
                    },
                    {
                        'order_id': 4,
                        'name': 'John Doe',
                        'data_ordered': '29-11-2019',
                        'total': 65,
                        'paid': 0,
                        'picked_up': 0,
                        'Time picked up': '30-11-2019 10:31'
                    },
                    {
                        'order_id': 5,
                        'name': 'John Doe',
                        'data_ordered': '29-11-2019',
                        'total': 65,
                        'paid': 0,
                        'picked_up': 0,
                        'Time picked up': '30-11-2019 10:31'
                    },
                    {
                        'order_id': 6,
                        'name': 'John Doe',
                        'data_ordered': '29-11-2019',
                        'total': 65,
                        'paid': 0,
                        'picked_up': 0,
                        'Time picked up': '30-11-2019 10:31'
                    },
                    {
                        'order_id': 7,
                        'name': 'John Doe',
                        'data_ordered': '29-11-2019',
                        'total': 65,
                        'paid': 0,
                        'picked_up': 0,
                        'Time picked up': '30-11-2019 10:31'
                    },
                    {
                        'order_id': 8,
                        'name': 'John Doe',
                        'data_ordered': '29-11-2019',
                        'total': 65,
                        'paid': 0,
                        'picked_up': 0,
                        'Time picked up': '30-11-2019 10:31'
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
                return this.mockupTableData.filter(order => {
                    return order.name.toLowerCase().includes(this.orderSearch.toLowerCase())
                });
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
                console.log(index);
                console.log(this.mockupTableDataItems);
                this.mockupTableDataItems[index].picked_up = true;
            }

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
