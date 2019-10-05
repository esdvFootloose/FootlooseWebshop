<template>
    <div class="content">
        <card
            :is-detailed="true"
            :image="item.image"
            :large-image="true"
        >
            <template v-slot:underneathImage class="width--full">
                <div class="stock__input__file-input align--center">
                    <label for="image-upload" class="button button--fixes-width button--secondary button--disabled align--center">Upload image</label>
                    <input type="file" id="image-upload" ref="productImage" style="display: none" @change="handleFileUpload" disabled>
                </div>
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
                        <label>Price</label>
                        <input type="number" class="stock__input" v-model="item.price"/>
                    </div>
                    <div class="stock__field">
                        <label>Gender</label>
                        <div class="stock__input">
                            <div>
                                <input type="radio" id="male" value="Male" v-model="item.gender" style="width: 20px;">
                                <label for="male">Male</label>
                            </div>
                            <div>

                                <input type="radio" id="female" value="Female" v-model="item.gender"
                                       style="width: 20px;">
                                <label for="female">Female</label>
                            </div>
                            <div>
                                <input type="radio" id="unisex" value="Unisex" v-model="item.gender"
                                       style="width: 20px;">
                                <label for="unisex">Unisex</label>
                            </div>
                        </div>
                    </div>

                    <div class="stock__input__container">
                        <div>
                            <label class="stock__input__center-aligned">Available from</label>
                        </div>
                        <div class="stock__input__availability">
                            <input type="date" v-model="item.available_from"/>
                        </div>

                        <div>
                            <label class="stock__input__center-aligned">Available to</label>
                        </div>
                        <div class="stock__input__availability">
                            <input type="date" v-model="item.available_to"/>
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
                    <div class="button button--primary button--fixed-width" @click="saveStock">Save</div>
                    <div class="button button--fixed-width" @click="goBack">Cancel</div>
                </div>
            </template>
        </card>
    </div>
</template>

<script>
    // Todo: sort sizes by available sizes
    import Card from "../components/Card";
    import axios from "axios";

    export default {
        components: {Card},
        computed: {
            item: function () {
                if (this.$route.params.slug) {
                    return this.$store.getters.getDashboardItem(this.$route.params.slug);
                } else {
                    return this.newItem;
                }
            }
        },
        data: function () {
            return {
                allSizes: [],
                newItem: {
                    name: '',
                    description: '',
                    gender: '',
                    available_from: '',
                    available_to: '',
                    stock: []
                },
                itemImage: []
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
            },
            saveStock: function () {
                // let stocks = this.item.stock;
                //
                // delete this.item.image;
                // delete this.item.stock;
                //
                // let formData = new FormData();
                // for (let prop in this.item) {
                //     if (this.item[prop] === null) this.item[prop] = "";
                //     formData.append(prop, this.item[prop]);
                // }
                // console.log("appending image");
                // for (let i = 0; i < this.itemImage.length; i++) {
                //     let file = this.itemImage[i];
                //     formData.append('image[' + i + ']', file);
                // }
                // formData.append('image[0]', this.itemImage);
                // console.log(stocks.length);
                // for (let j = 0; j < stocks.length; j++) {
                //     let itemStock = stocks[j];
                //     formData.append('stock[' + j + ']', itemStock);
                // }

                // console.log(formData);
                // axios.patch('/api/items/' + this.item.id, formData).then(result => {
                //     this.$store.dispatch('fetchItems');
                //     this.$store.dispatch('fetchAllDashboard');
                // }).catch(error => {
                //     console.log(error);
                // });
                // for (let i = 0; i < this.item.image.length; i++) {
                //     let file = this.image[i]
                // }
                if (!this.item.id) {
                    axios.post('/api/items', this.item).then(result => {
                        this.$store.dispatch('fetchItems');
                        this.$store.dispatch('fetchAllDashboard');
                    }).catch(error => {
                        console.log(error);
                    });
                } else {
                    axios.patch('/api/items/' + this.item.id, this.item).then(result => {
                        this.$store.dispatch('fetchItems');
                        this.$store.dispatch('fetchAllDashboard');
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            handleFileUpload: function () {
                console.log(this.$refs.productImage.files);
                this.itemImage = this.$refs.productImage.files[0];
            },
            goBack: function () {
                this.$router.go(-1);
            }
        },
        mounted() {
            if (this.$route.params.slug) {
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
            display: flex;
            justify-content: space-evenly;
            flex-wrap: nowrap;
            flex-direction: column;
            width: calc(100% - 100px);

            @media all and (min-width: $breakpoint--web) {

            }

            @media all and (min-width: $breakpoint--web) {
                flex-direction: row;
            }

            label {
                margin: 8px;
            }

            &__file-input {
                width: fit-content;
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

            &__availability {
                width: calc(100% - 100px);
                padding: 0 5px;
            }

            &__center-aligned {
                display: flex;
                align-items: center;
            }
        }

        &__stock-table {
            margin: auto;
            @media all and (min-width: $breakpoint--web) {
                margin-left: 100px;
            }
        }
    }

    .hline {
        width: 100%;
        margin: 10px auto;
        border-top: 1px solid $color--light-grey;
    }
</style>
