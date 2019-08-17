<template>
    <div class="content">
        <div class="heading">
            <h1>Stocks</h1>
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
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.gender }}</td>
                <td>€ {{ item.price }}</td>
                <td>
                    <table class="stock-table__stocks">
                        <tr v-for="size in item.stock" class="stock-table__stocks__row">
                            <td>
                                {{ size.size }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="stock-table__stocks">
                        <tr v-for="size in item.stock" class="stock-table__stocks__row">
                            <td>
                                {{ size.stock }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="stock-table__stocks">
                        <tr v-for="size in item.stock" class="stock-table__stocks__row">
                            <td>
                                {{ size.stock }}
                            </td>
                        </tr>
                    </table>
                </td>



                <td class="stock-table--centered">
                    <router-link :to="{name: 'stock', params: {id: item.id}}" tag="div" class="button">Edit</router-link>
                </td>
            </tr>
        </table>
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
                        hideTablet: true
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
            filteredStocks: function () {
                return this.stocks.filter(stock => {
                    return stock.name.toLowerCase().includes(this.stocksSearch.toLowerCase())
                });
            }
        },
        mounted() {
            if (this.$store.getters.getItemsDashboard.length === 0) {
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

        td {
            vertical-align: top;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        &--centered {
            padding: auto;
            margin: auto;
        }


        &__stocks {
            margin-top: -5px;
            margin-bottom: 0;

            td {
                padding: 5px;
            }

            &__row {
                height: initial;
            }
        }

    }
</style>
