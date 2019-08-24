<template>
    <div class="content">
        <div class="heading">
            <h1>{{ $route.params.query === 'noStock' ? 'Out of stock' : 'Stocks'}}</h1>
            <div class="heading__search">
                <label class="heading__search-label">Search</label>
                <input type="text" v-model="stocksSearch">
            </div>
        </div>

        <table class="stock-table">
            <tr>
                <th v-for="header in tableHeaders"
                    :class="{'hidden--mobile' : header.hideMobile, 'hidden--tablet' : header.hideTablet}">{{
                    header.header }}
                </th>
            </tr>
            <tr class="row" v-for="item in filteredStocks">
                <td class="hidden--mobile" :class="{'stock-table--align-top' : item.stock.length > 1}">{{ item.id }}</td>
                <td :class="{'stock-table--align-top' : item.stock.length > 1}">{{ item.name }}</td>
                <td :class="{'stock-table--align-top' : item.stock.length > 1}">{{ item.gender }}</td>
                <td :class="{'stock-table--align-top' : item.stock.length > 1}">€ {{ item.price }}</td>
                <td :class="{'stock-table--align-top' : item.stock.length > 1}">
                    <table class="stock-table__stocks"
                           :class="{'stock-table__stocks--no-margin' : item.stock.length < 2}">
                        <tr v-for="size in item.stock" class="stock-table__stocks__row">
                            <td>
                                {{ size.size }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="hidden--mobile" :class="{'stock-table--align-top' : item.stock.length > 1}">
                    <table class="stock-table__stocks"
                           :class="{'stock-table__stocks--no-margin' : item.stock.length < 2}">
                        <tr v-for="size in item.stock" class="stock-table__stocks__row">
                            <td>
                                {{ size.stock }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td :class="{'stock-table--align-top' : item.stock.length > 1}" class="visible--mobile">
                    <table class="stock-table__stocks"
                           :class="{'stock-table__stocks--no-margin' : item.stock.length < 2}">
                        <tr v-for="size in item.stock" class="stock-table__stocks__row">
                            <td>
                                {{ size.stock }}
                            </td>
                            <td>
                                /
                            </td>
                            <td>
                                {{ numberOrdered(size.ordered_item) + size.stock}}
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="hidden--mobile" :class="{'stock-table--align-top' : item.stock.length > 1}">
                    <table class="stock-table__stocks"
                           :class="{'stock-table__stocks--no-margin' : item.stock.length < 2}">
                        <tr v-for="size in item.stock" class="stock-table__stocks__row">
                            <td>
                                {{ numberOrdered(size.ordered_item) + size.stock}}
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="stock-table--centered">
                    <router-link :to="{name: 'stock', params: {id: item.id}}" tag="div" class="button">Edit
                    </router-link>
                </td>
            </tr>
        </table>
        <div>
            <router-link :to="{name: 'stock'}" tag="div" class="button button--primary align--right">Add new</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                tableHeaders: [
                    {
                        header: 'Item ID',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: 'Name',
                        hideMobile: false,
                        hideTablet: false
                    },
                    {
                        header: 'Gender',
                        hideMobile: false,
                        hideTablet: false
                    },
                    {
                        header: 'Price',
                        hideMobile: false,
                        hideTablet: false
                    },
                    {
                        header: 'Sizes',
                        hideMobile: false,
                        hideTablet: false
                    },
                    {
                        header: 'Available',
                        hideMobile: false,
                        hideTablet: false
                    },
                    {
                        header: 'Total',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: '',
                        hideMobile: false,
                        hideTablet: false
                    }
                ],
                stocksSearch: ''
            }
        },
        computed: {
            stocks: function () {
                return this.$store.getters.getItemsDashboard;
            },
            totalStocks: function() {
                return this.$store.getters.getStocks;
            },
            filteredStocks: function () {
                if (this.$route.params.query === 'noStock') {
                    return this.stocks.filter(item => {
                        return item.name.toLowerCase().includes(this.stocksSearch.toLowerCase()) && item.stock.filter(size => size.stock === 0).length > 0
                    });
                } else {
                    return this.stocks.filter(item => {
                        return item.name.toLowerCase().includes(this.stocksSearch.toLowerCase())
                    });
                }
            },
            numberOrdered: function() {
                return stock => {
                    let totalOrdered = 0;
                    for (let i = 0; i < stock.length; i++) {
                        totalOrdered += stock[i].amount;
                    }
                    return totalOrdered;
                }
            }
        },
        mounted() {
            if (this.$store.getters.getNrItemsDashboard === 0) {
                this.$store.dispatch("fetchItemsDashboard");
            }
        }

    }
</script>


<style lang="scss" scoped>
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

    .stock-table {
        &--align-top {
            vertical-align: top;
            padding-top: 15px !important;
            padding-bottom: 15px !important;
        }

        &__stocks {
            margin-bottom: 0;
            margin-top: -5px;

            &--no-margin {
                margin-top: 0;
            }

            td {
                padding: 5px;
            }

            &__row {
                height: initial;
            }
        }
    }
</style>
