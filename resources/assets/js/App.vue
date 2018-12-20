<template>
    <div>
        <v-header></v-header>
        <router-view></router-view>
    </div>
</template>
<script>
    import header from './components/home/header';

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