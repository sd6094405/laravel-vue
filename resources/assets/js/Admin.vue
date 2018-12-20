<template>
        <div class="layout">
            <v-left></v-left>
            <Layout :style="{marginLeft: '200px'}">
                <Header :style="{background: '#fff', boxShadow: '0 2px 3px 2px rgba(0,0,0,.1)'}"></Header>
                <Content :style="{padding: '0 16px 16px'}">
                    <Breadcrumb :style="{margin: '16px 0'}">
S
                    </Breadcrumb>
                    <Card>
                        <div style="height: 600px">Content</div>
                    </Card>
                </Content>
            </Layout>
            <router-view></router-view>
        </div>
</template>
<script>
    import left from './components/back/left'
    export default {
        data() {
            return {}
        },
        components: {
            'v-left':left
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