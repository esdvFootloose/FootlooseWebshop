<template>
    <div class="content">
        <p>Home</p>
        <card-grid>
            <card v-for="item in items" :key="item.id">
                <template>
                    <div>
                        <img src="https://via.placeholder.com/150">
                    </div>
                    <div>
                        {{item.name + " " + (item.gender === 'M'? 'male' : (item.gender === 'F'? 'female': 'unisex'))}}
                        <div v-if="item.sizes[0].size !== null">
                            <p>In sizes:</p>
                            <span v-for="(value, index) in item.sizes">{{ value.size + (index < item.sizes.length -1 ? ', ' : '') }} </span>
                        </div>
                    </div>
                    <div class="card__cta-button">
                        <Button text="More" :action="loadItem" is-primary></Button>
                    </div>
                </template>
            </card>
        </card-grid>

    </div>
</template>

<script>
    import CardGrid from "../components/CardGrid";
    import Card from "../components/Card";
    import Button from "../components/Button"

    export default {
        components: {
            CardGrid,
            Card,
            Button
        },
        computed: {
            items: function () {
                return this.$store.getters.getItems;
            }
        },
        methods: {
            loadItem: function (id) {
            }
        },
        mounted() {
            if (this.$store.getters.getItems.length === 0) {
                this.$store.dispatch('fetchItems');
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .card {

        &__fl-logo {
            width: 100%;
            margin-bottom: 20px;

            img {
                display: block;
                margin: auto;
                width: 200px;
                height: auto;
            }
        }

        &__login {
            width: 100%;

            label {
                color: $color--grey;
            }

            input {
                width: 100%;
                margin-top: 5px;
                margin-bottom: 15px;
            }

        }

        &__cta-button {
            width: 100%;
            position: relative;
            left: 50%;
            margin-left: -70px;
        }
    }
</style>