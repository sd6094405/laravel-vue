<template>
    <div>
        <v-head></v-head>
        <div class="container">
            <div class="meau-gotop-box wap" @click="backTop" style="right: 16px; bottom: 80px; z-index: 99;">
                <span id="backtop"
                      class="btn-meau"
                      title="返回顶部"
                      style="display: flex;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="12">
                    <path d="M9.314 0l9.313 9.314-2.12 2.121-7.193-7.192-7.193 7.192L0 9.314z" fill="#FFF"
                          fill-rule="evenodd"></path>
                </svg>
            </span>
            </div>
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
        methods: {
            backTop() {
                let that = this;
                let timer = setInterval(() => {
                    let ispeed = Math.floor(-that.scrollTop / 5);
                    document.documentElement.scrollTop = document.body.scrollTop = that.scrollTop + ispeed;
                    if (that.scrollTop === 0) {
                        clearInterval(timer)
                    }
                });
            },
            // 为了计算距离顶部的高度，当高度大于60显示回顶部图标，小于60则隐藏
            scrollToTop() {
                let that = this;
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop
                that.scrollTop = scrollTop
                if (that.scrollTop > 60) {
                    that.btnFlag = true
                } else {
                    that.btnFlag = false
                }
            }

        },
        mounted() {
            window.addEventListener('scroll', this.scrollToTop)
        },
        destroyed() {
            window.removeEventListener('scroll', this.scrollToTop)
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

    .meau-gotop-box.wap {
        width: 40px;
        height: 40px;
    }

    .meau-gotop-box {
        position: fixed;
        width: 46px;
        text-align: center;
    }

    .meau-gotop-box.wap .btn-meau {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    .meau-gotop-box.wap .btn-meau:hover {
        background-color: rgba(1, 1, 1, 0.5);
    }


    .meau-gotop-box .btn-meau {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        height: 44px;
        width: 100%;
        background-color: #ccc;
        border-radius: 2px;
        cursor: pointer;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        transition: background .3s ease-in-out;
        -webkit-transition: background .3s ease-in-out;
        outline: 0;
    }

</style>
