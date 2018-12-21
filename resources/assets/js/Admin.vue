<template>
        <div class="layout">
            <v-header></v-header>
            <v-left></v-left>
            <router-view></router-view>
        </div>
</template>
<script>
    import left from './components/back/left'
    import header from './components/back/header'
    import {Layout , Header , Content,Breadcrumb ,Card,Sider,Menu,Icon} from 'iview'
    export default {
        data() {
            return {}
        },
        components: {
            'v-left':left,
            'v-header':header,
            'Layout':Layout,
            'Header':Header,
            'Content':Content,
            'Breadcrumb':Breadcrumb,
            'Card':Card,
            'Sider':Sider,
            'Menu':Menu,
            'Icon':Icon
        },
        computed: {},
        methods: {},
        mounted() {
        },
    }
</script>
<style scoped>
    .layout {
        border: 1px solid #d7dde4;
        background: #f5f7f9;
        position: relative;
        border-radius: 4px;
        overflow: hidden;
    }

    .layout-header-bar {
        background: #fff;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .1);
    }

</style>