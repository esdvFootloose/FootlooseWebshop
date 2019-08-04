<template>
    <div class="content">
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
                    {{ (value === 0 || value === 1) && index > 0 ? (value === 0 ? 'false' : 'true') : value }}
                </td>
                <td >
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
                tableHeader: ['Order ID', 'Name', 'Date ordered', 'Total (€)', 'Paid', 'Picked up', 'Time picked up', ''],
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
                        'name': 'John Doe',
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

</style>
