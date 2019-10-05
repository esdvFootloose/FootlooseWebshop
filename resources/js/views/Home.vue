<template>
    <div class="content">
        <card-grid>
            <card
                v-for="item in items"
                :key="item.id"
                text-button="Details"
                route-name="item"
                :route-params="{'slug' :item.slug}"
                :is-primary-button="true"
                :image="item.image"
                :text-heading="item.name + ' ' +(item.gender === 'Unisex' ? '' : item.gender.toLowerCase())"
                :text-subheading="getSizesAsText(item.stock)"
            >
            </card>
        </card-grid>
    </div>
</template>

<script>
import CardGrid from "../components/CardGrid";
import Card from "../components/Card";

export default {
    components: {
        CardGrid,
        Card
    },
    computed: {
        items: function() {
            return this.$store.getters.getItems;
        }
    },
    methods: {
        getSizesAsText: function(sizes) {
            let sizesString = "";
            for (let i = 0; i < sizes.length; i++) {
                if (sizes[i].size !== null) {
                    sizesString += sizes[i].size;
                    if (i !== sizes.length - 1) {
                        sizesString += ", ";
                    }
                }
            }
            return sizesString !== ""
                ? "Available sizes: " + sizesString
                : "One size for all";
        },

    },
    mounted() {
        if (this.$store.getters.getItems.length === 0) {
            this.$store.dispatch("fetchItems");
        }
    }
};
</script>

<style lang="scss" scoped>
</style>
