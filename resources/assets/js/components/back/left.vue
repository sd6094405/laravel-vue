<template>
    <Sider :style="{position: 'fixed', height: '100vh', left: 0, overflow: 'auto'}">
        <Menu active-name="1-2" theme="dark" width="auto" :open-names="['1']">
            <Submenu name="1">
                <template slot="title">
                    <Icon type="ios-analytics"/>
                    统计分析
                </template>
                <MenuItem name="1-1">流量分析</MenuItem>
                <MenuItem name="1-2">时段分析</MenuItem>
            </Submenu>
            <Submenu name="2">
                <template slot="title">
                    <Icon type="ios-book"/>
                    内容管理
                </template>

                    <MenuItem name="2-1" to="/back/article">
                        文章管理
                    </MenuItem>

                <MenuItem name="2-2" to="/back/comment">
                        评论管理
                </MenuItem>

            </Submenu>
            <Submenu name="3">
                <template slot="title">
                    <Icon type="md-settings"/>
                    系统设置
                </template>
                <MenuItem name="3-1">基本设置</MenuItem>
                <MenuItem name="3-2">菜单设置</MenuItem>
            </Submenu>
        </Menu>
    </Sider>
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
