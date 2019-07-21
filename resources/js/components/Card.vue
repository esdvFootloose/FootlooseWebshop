<template>
    <div class="card" v-bind:class="{'card--description' : isDetailed}">
        <div v-bind:class="{'width--full' : !isDetailed, 'width--tablet-full' : isDetailed}">
            <div class="card__image"
                 v-bind:class="{'card__image--large' : largeImage, 'width--full' : centerImage, 'card__image--description': isDetailed}"
                 v-if="image">
                <img :src="image" :alt="imageText"/>
            </div>
            <slot name="underneathImage"></slot>
        </div>
        <div v-bind:class="{'width--full' : !isDetailed, 'card__text--description' : isDetailed}">
            <h1 class="card__title" v-if="title">{{ title }}</h1>
            <slot name="description"></slot>
            <div class="card__item-heading" v-if="textHeading">
                {{ textHeading }}
            </div>
            <div class="card__item-subheading" v-if="textSubheading">
                {{ textSubheading }}
            </div>
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
                >{{ textButton }}
                </router-link
                >
            </div>
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
            imageText: String,
            centerImage: {
                type: Boolean,
                default: true
            },
            largeImage: {
                type: Boolean,
                default: false
            },
            // Card type
            isDetailed: {
                type: Boolean,
                default: false
            },
            title: String
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
            margin-bottom: 5px;

            img {
                display: block;
                margin: auto;
                width: 100%;
                max-width: 250px;
                height: auto;
            }

            &--large {
                img {
                    max-width: 350px !important;
                }
            }

            &--description {
                padding-bottom: 15px;
                width: 100%;

                @media all and (min-width: $breakpoint--web) {
                    padding-top: 40px;
                    padding-bottom: 40px;
                    width: auto;
                }
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
            width: fit-content;
            position: relative;
            display: block;
            margin: 0 auto;
        }

        &__title {
            margin-bottom: 10px;
        }

        &__text--description {
            width: 100%;
            flex-grow: 1;
            flex-wrap: nowrap;
            position: relative;

            @media all and (min-width: $breakpoint--tablet) {
                max-width: 450px;
                margin: auto;
            }

            @media all and (min-width: $breakpoint--web) {
                max-width: initial;
                margin: initial;
                padding: 0 40px;
                width: calc(100% - 350px);
            }
        }

        &--description {
            padding: 20px 25px;

            @media all and (min-width: $breakpoint--web) {
                padding: 40px 60px !important;
            }
        }

        @media all and (min-width: $breakpoint--tablet) {
            margin: 20px auto;
            padding: 20px 20px;
        }




    }
</style>
