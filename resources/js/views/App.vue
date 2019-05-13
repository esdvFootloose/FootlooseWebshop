<template>
    <div>
        <navigation-bar></navigation-bar>
        <router-view></router-view>
        <footer></footer>
    </div>
</template>

<script>
    import NavigationBar from "../components/NavigationBar";
    import Footer from "../components/Footer";
    export default {
        components: {Footer, NavigationBar}
    }
</script>

<style scoped>
</style>