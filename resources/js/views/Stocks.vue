<template>
    <div class="content">
        <div class="heading">
            <h1>Stocks</h1>
            <div class="heading__search">
                <label class="heading__search-label">Search</label>
                <input type="text" v-model="stocksSearch">
            </div>
        </div>

        <table>
            <tr>
                <th v-for="header in tableHeaders"
                    :class="{'hidden--mobile' : header.hideMobile, 'hidden--tablet' : header.hideTablet}">{{
                    header.header }}
                </th>
            </tr>
            <tr v-for="order in mockupTableData">
                <td v-for="(value, key, index) in order"
                    :class="{'hidden--mobile' : tableHeaders[index].hideMobile, 'hidden--tablet' : tableHeaders[index].hideTablet}"
                >
                    {{ value }}
                </td>
                <td>
                    <Button text="Edit"></Button>
                </td>
            </tr>
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
                        header: 'Sex',
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
                mockupTableData: [
                    {
                        'item_id': 1,
                        'name': 'T-Shirt',
                        'sex': 'M',
                        'price': 15,
                        'sizes': 'S',
                        'available': 5,
                        'total': 10
                    },
                    {
                        'item_id': 2,
                        'name': 'T-Shirt',
                        'sex': 'M',
                        'price': 15,
                        'sizes': 'S',
                        'available': 5,
                        'total': 10
                    },
                    {
                        'item_id': 3,
                        'name': 'T-Shirt',
                        'sex': 'M',
                        'price': 15,
                        'sizes': 'S',
                        'available': 5,
                        'total': 10
                    },
                    {
                        'item_id': 4,
                        'name': 'T-Shirt',
                        'sex': 'M',
                        'price': 15,
                        'sizes': 'S',
                        'available': 5,
                        'total': 10
                    },
                    {
                        'item_id': 5,
                        'name': 'T-Shirt',
                        'sex': 'M',
                        'price': 15,
                        'sizes': 'S',
                        'available': 5,
                        'total': 10
                    },
                    {
                        'item_id': 6,
                        'name': 'T-Shirt',
                        'sex': 'M',
                        'price': 15,
                        'sizes': 'S',
                        'available': 5,
                        'total': 10
                    },
                    {
                        'item_id': 7,
                        'name': 'T-Shirt',
                        'sex': 'M',
                        'price': 15,
                        'sizes': 'S',
                        'available': 5,
                        'total': 10
                    },
                    {
                        'item_id': 8,
                        'name': 'T-Shirt',
                        'sex': 'M',
                        'price': 15,
                        'sizes': 'S',
                        'available': 5,
                        'total': 10
                    }
                ],
                stocksSearch: ''
            }
        },
        computed: {
            stocks: function () {
                return this.$store.getters.getItemsDashboard;
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
</style>
