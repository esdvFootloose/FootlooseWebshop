<template>
    <div>
        <navigation-bar></navigation-bar>
        <router-view></router-view>
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
