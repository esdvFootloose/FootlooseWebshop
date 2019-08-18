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
            <tr class="row" v-for="(request, index) in requests">
                <td class="hidden--mobile hidden--tablet">{{ index }}</td>
                <td class="hidden--mobile">{{ request.user.name }}</td>
                <td class="hidden--mobile">{{ request.created_at }}</td>
                <td>{{ request.item }}</td>
                <td>{{ request.gender }}</td>
                <td>{{ request.size }}</td>
                <td>
                    <div class="button" @click="removeRequest(request.id)">Remove</div>
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
                        header: 'Gender',
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
            }
        },
        computed: {
            requests: function () {
                return this.$store.getters.getItemRequests;
            }
        },
        methods: {
            removeRequest: function(itemRequest) {
                this.$store.dispatch('removeItemRequest', itemRequest);
            }
        },
        mounted() {
            if (this.$store.getters.getNrRequests === 0) this.$store.dispatch('fetchRequests');
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
