<template>
    <div class="content">
        <div class="heading">
            <h1>Item Requests</h1>
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
                    :class="{'hidden--mobile' : tableHeaders[index].hideMobile, 'hidden--tablet' : tableHeaders[index].hideTablet}">
                    {{ value }}
                </td>
                <td>
                    <Button text="Remove"></Button>
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
                        header: 'Request ID',
                        hideMobile: true,
                        hideTablet: true
                    },
                    {
                        header: 'Name',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: 'Date requested',
                        hideMobile: true,
                        hideTablet: false
                    },
                    {
                        header: 'Item',
                        hideMobile: false,
                        hideTablet: false
                    },
                    {
                        header: 'Sex',
                        hideMobile: false,
                        hideTablet: false
                    },
                    {
                        header: 'Size',
                        hideMobile: false,
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
                        'request_id': 1,
                        'name': 'John Doe',
                        'date_requested': '29-11-2019',
                        'item': 'T-Shirt',
                        'sex': 'Male',
                        'Size': 'M',

                    },
                    {
                        'request_id': 2,
                        'name': 'John Doe',
                        'date_requested': '29-11-2019',
                        'item': 'T-Shirt',
                        'sex': 'Male',
                        'Size': 'M',

                    },
                    {
                        'request_id': 3,
                        'name': 'John Doe',
                        'date_requested': '29-11-2019',
                        'item': 'T-Shirt',
                        'sex': 'Male',
                        'Size': 'M',

                    },
                    {
                        'request_id': 4,
                        'name': 'John Doe',
                        'date_requested': '29-11-2019',
                        'item': 'T-Shirt',
                        'sex': 'Male',
                        'Size': 'M',

                    },
                    {
                        'request_id': 5,
                        'name': 'John Doe',
                        'date_requested': '29-11-2019',
                        'item': 'T-Shirt',
                        'sex': 'Male',
                        'Size': 'M',

                    },
                    {
                        'request_id': 6,
                        'name': 'John Doe',
                        'date_requested': '29-11-2019',
                        'item': 'T-Shirt',
                        'sex': 'Male',
                        'Size': 'M',

                    },
                    {
                        'request_id': 7,
                        'name': 'John Doe',
                        'date_requested': '29-11-2019',
                        'item': 'T-Shirt',
                        'sex': 'Male',
                        'Size': 'M',

                    },
                    {
                        'request_id': 8,
                        'name': 'John Doe',
                        'date_requested': '29-11-2019',
                        'item': 'T-Shirt',
                        'sex': 'Male',
                        'Size': 'M',

                    }
                ]
            }
        },
        computed: {
            orders: function () {
                return this.$store.getters.orders;
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
