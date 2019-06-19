<template>
    <div>
        <navigation-bar></navigation-bar>
        <div class="content">
            <router-view></router-view>
        </div>
        <fl-footer></fl-footer>
    </div>
</template>

<script>
    import NavigationBar from "../components/NavigationBar";
    import FlFooter from "../components/Footer";

    export default {
        components: {FlFooter, NavigationBar}
    }
</script>
