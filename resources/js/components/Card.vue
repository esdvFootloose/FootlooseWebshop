<template>
    <div class="card">
        <div class="card__image" v-if="image">
            <img :src="image" :alt="imageText" />
        </div>
        <slot name="login"></slot>
        <div class="card__item-heading" v-if="textHeading">
            {{ textHeading }}
        </div>
        <div class="card__item-subheading" v-if="textSubheading">
            {{ textSubheading }}
        </div>
        <slot></slot>
        <div class="card__cta-button" v-if="actionButton">
            <Button
                :text="textButton"
                :action="actionButton"
                :is-primary="isPrimaryButton"
            ></Button>
        </div>
        <div class="card__cta-button" v-if="routeName">
            <router-link
                tag="div"
                class="button button--primary"
                :to="{ name: routeName, params: routeParams}"
                >More</router-link
            >
        </div>
    </div>
</template>

<script>
import Button from "./Button";
export default {
    components: {
        Button
    },
    props: {
        // Button props
        textButton: String,
        actionButton: Function,
        isPrimaryButton: Boolean,
        routeName: String,
        routeParams: Object,
        // Heading and subheading props
        textHeading: String,
        textSubheading: String,
        // Image props
        image: String,
        imageText: String
    }
};
</script>

<style lang="scss" scoped>
@import "../../sass/app.scss";

.card {
    box-shadow: $box-shadow--large;
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    justify-content: stretch;
    margin: 0 10px;
    border: $border--grey;
    padding: 20px 25px;
    position: relative;

    &__image {
        width: 100%;
        margin-bottom: 5px;

        img {
            display: block;
            margin: auto;
            width: 100%;
            max-width: 250px;
            height: auto;
        }
    }

    &__item-heading {
        width: 100%;
        font-size: $font-size-heading;
        margin-bottom: 10px;
    }

    &__item-subheading {
        width: 100%;
        color: $color--grey;
        margin-bottom: 15px;
    }

    &__cta-button {
        width: 100%;
        position: relative;
        left: 50%;
        margin-left: -70px;
    }

    @media all and (min-width: $breakpoint--tablet) {
        margin: 20px auto;
        padding: 20px 20px;
    }
}
</style>
