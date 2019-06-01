<template>
    <div class="footer footer__container">
        <div class="footer footer__logo">
            <img src="images/Logo_red_text.svg">
        </div>
        <div class="footer footer__description footer__text">
            Footloose is a student dance association in Eindhoven. This webshop is for members to buy Footloose
            merchandise. For our regular site, click <a href="https://esdvfootloose.nl">here</a>. For questions, please
            mail to
            <a href="mailto:kleding@esdvfootloose.nl">kleding@esdvfootloose.nl</a>
        </div>
        <div class="footer footer__address footer__text">
            <p>
                E.S.D.V. Footloose
            </p>
            <br>
            <p>
                De lampendriessen 31
            </p>

            <p>
                5612 AH Eindhoven
            </p>
            <br>
            <p>
                IBAN: NL85ABNA0593527771 <br>
                Account holder: ESDV Footloose <br>
                KVK-nummer: 40239742 <br>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Footer"
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .footer {
        background: $color--black;
        color: white;
        position: relative;
        z-index: 0;

        &__container {
            background: $color--black;
            width: 100%;
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: 0;


            display: grid;
            grid-template-areas: 'logo' 'description' 'address ';
            row-gap: 5%;
            grid-template-columns: 1fr;

            @media all and (min-width: $breakpoint--tablet) {
                grid-template-areas: '. . logo logo. .' '. description description address address .';
                row-gap: 0;
                column-gap: 5%;
                grid-template-columns: repeat(6, 1fr);
            }

            @media all and (min-width: $breakpoint--web) {
                grid-template-areas: '. logo description address .';
                row-gap: 0;
                column-gap: 5%;
                grid-template-columns: repeat(5, 1fr);
            }
        }

        &__logo {
            grid-area: logo;
            padding: 5%;

            img {
                display: block;
                margin: 0 auto;
                max-width: 180px;
                height: auto;

                @media all and (min-width: $breakpoint--web) {
                    padding: 10% 0;
                    max-width: 250px;
                }
            }
        }

        &__text {
            padding: 5%;

            @media all and (min-width: $breakpoint--tablet) {
                padding: 5%;
            }

            @media all and (min-width: $breakpoint--web) {
                padding: 10% 0;
            }
        }


        &__description {
            grid-area: description;
        }

        &__address {
            grid-area: address;
        }

        a, a:link {
            text-decoration: none;
            color: #1E9CEB;
        }

    }

</style>