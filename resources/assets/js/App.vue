<template>
    <div>
        <v-header></v-header>
        <router-view></router-view>
    </div>
</template>
<script>
    import header from './components/header';
    import body from './components/body';
    import footer from './components/footer'

    export default {
        data() {
            return {}
        },
        components: {
            'v-header': header,
        },
        computed: {},
        methods: {},
        mounted() {
        },
    }
</script>