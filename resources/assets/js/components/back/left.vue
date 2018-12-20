<template>
    <div class="container">
        <Sider :style="{position: 'fixed', height: '100vh', left: 0, overflow: 'auto'}">
            <Menu active-name="1-2" theme="dark" width="auto" :open-names="['1']">
                <Submenu name="1">
                    <template slot="title">
                        <Icon type="ios-analytics" />
                        首页
                    </template>
                    <MenuItem name="1-1">数据统计</MenuItem>
                    <MenuItem name="1-2"></MenuItem>
                    <MenuItem name="1-3">Option 3</MenuItem>
                </Submenu>
                <Submenu name="2">
                    <template slot="title">
                        <Icon type="ios-book" />
                        文章
                    </template>
                    <MenuItem name="2-1">管理文章</MenuItem>
                    <MenuItem name="2-2">新文章</MenuItem>
                </Submenu>
                <Submenu name="3">
                    <template slot="title">
                        <Icon type="md-settings" />
                        系统设置
                    </template>
                    <MenuItem name="3-1">基本设置</MenuItem>
                    <MenuItem name="3-2">菜单设置</MenuItem>
                </Submenu>
            </Menu>
        </Sider>
    </div>
</template>
<script>
    export default {
        data() {
            return {}
        },
        components: {},
        computed: {},
        methods: {},
        mounted() {
        },
    }
</script>
