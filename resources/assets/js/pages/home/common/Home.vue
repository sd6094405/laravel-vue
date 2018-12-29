<template>
    <div>
        <v-head></v-head>
        <div class="container">
            <router-view></router-view>
            <v-right></v-right>
        </div>
        <v-footer></v-footer>
    </div>
</template>

<script>
    import vHead from './header.vue';
    import vRight from './right.vue';
    import vFooter from './footer.vue';

    export default {
        data() {
            return {
                tagsList: [],
                collapse: false
            }
        },
        components: {
            vHead, vRight, vFooter
        },
        created() {

        }
    }
</script>
<style>
    .markdown-body {
        box-sizing: border-box;
        min-width: 200px;
        max-width: 980px;
        margin: 0 auto;
        padding: 45px;
    }

    @media (max-width: 767px) {
        .markdown-body {
            padding: 15px;
        }
    }
    .el-pagination li.active {
        background: #F46660 !important;
    }

    .el-pager li.active {
        color: #fff;
    }

    .el-pagination.is-background .btn-next, .el-pagination.is-background .btn-prev, .el-pagination.is-background .el-pager li {
        background-color: #fff;
        border: 1px solid #ddd;
    }
</style>
