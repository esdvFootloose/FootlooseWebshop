<template>
    <div class="content">
        <card
            :is-detailed="true"
            image="https://via.placeholder.com/450"
            :large-image="true"
        >
            <template v-slot:underneathImage class="width--full">
                <div class="button button--fixes-width align--center">Upload image</div>
            </template>
            <template v-slot:description>
                <div class="labeled-form">
                    <div class="stock__field">
                        <label class="stock__label">Name</label>
                        <input type="text" class="stock__input" v-model="item.name"/>
                    </div>
                    <div class="stock__field">
                        <label>Description</label>
                        <textarea class="stock__input stock__input__description" v-model="item.description"></textarea>
                    </div>
                    <div class="stock__field">
                        <label>Gender</label>
                        <div class="stock__input">
                            <input type="radio" id="male" value="Male" v-model="item.gender" style="width: 20px;">
                            <label for="male">Male</label>
                            <input type="radio" id="female" value="Female" v-model="item.gender" style="width: 20px;">
                            <label for="female">Female</label>
                            <input type="radio" id="unisex" value="Unisex" v-model="item.gender" style="width: 20px;">
                            <label for="unisex">Unisex</label>
                        </div>
                    </div>

                    <div class="stock__input__container">
                        <div>
                            <label class="stock__input__center-aligned">Available from</label>
                        </div>
                        <div style="padding: 0 5px;">
                            <input style="width: 90%;" type="date" v-model="item.available_from"/>
                        </div>

                        <div>
                            <label class="stock__input__center-aligned">Available to</label>
                        </div>
                        <div style="padding: 0 5px;">
                            <input style="width: 90%;" type="date" v-model="item.available_to"/>
                        </div>
                    </div>
                    <div class="hline"></div>
                    <div class="stock__field">
                        <div class="stock__input stock__stock-table">
                            <table width="100%">
                                <tr>
                                    <th width="50%">Size</th>
                                    <th width="50%">Stock</th>
                                </tr>
                                <tr v-for="(value, key) in item.stock">
                                    <td>
                                        <select v-model="item.stock[key].size">
                                            <option v-for="size in allSizes" :value="size">
                                                {{ size }}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" style="width: 95%;" v-model="item.stock[key].stock">
                                    </td>
                                </tr>
                                <tr class="hline">
                                    <td colspan="2">
                                        <div class="button align--center" @click="addSize" v-if="item.stock.length < 6">
                                            Add Size
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div style="margin-left:auto; display: flex; width: fit-content">
                    <div class="button button--primary button--fixed-width">Save</div>
                    <div class="button button--fixed-width">Cancel</div>
                </div>
            </template>
        </card>
    </div>
</template>

<script>
    // Todo: sort sizes by available sizes
    import Card from "../components/Card";

    export default {
        components: {Card},
        computed: {
            item: function () {
                return this.$store.getters.getDashboardItem(this.$route.params.slug);
            }
        },
        data: function () {
            return {
                allSizes: []
            }
        },
        methods: {
            addSize: function () {
                if (this.item.stock.length < 6) {
                    let newSize = {
                        'item_id': this.item.id,
                        'size': this.allSizes[0],
                        'stock': 0,
                    };
                    this.item.stock.push(newSize);
                }
            }
        },
        mounted() {
            if (this.$route.params.length > 0) {
                if (this.$store.getters.getNrItemsDashboard === 0) {
                    this.$store.dispatch('fetchItemsDashboard');
                }
            }
            this.allSizes = this.$store.getters.getAllSizes;

        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .stock {
        width: 100%;

        &__field {
            margin-bottom: 20px;
            display: flex;
        }

        &__input {
            display: inline-flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
            width: calc(100% - 145px);

            label {
                margin: 8px;
            }

            &__description {
                padding: 5px 10px;
                border: none;
                border-bottom: 1px solid lightgrey;
                font-size: 11pt;
                width: 100%;
                height: fit-content;
            }

            &__container {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap
            }

            &__center-aligned {
                display: flex;
                align-items: center;
            }
        }

        &__stock-table {
            margin: auto;
            @media all and (min-width: $breakpoint--web) {
                margin-left: 140px;
            }
        }
    }

    .hline {
        width: 100%;
        margin: 10px auto;
        border-top: 1px solid $color--light-grey;
    }
</style>
