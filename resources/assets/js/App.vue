<template>
    <div>
        <v-header></v-header>
        <v-body></v-body>
        <router-view></router-view>
        <v-footer></v-footer>
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
            'v-body': body,
            'v-footer': footer
        },
        computed: {},
        methods: {},
        mounted() {
        },
    }
</script>