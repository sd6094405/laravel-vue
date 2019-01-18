<template>
    <div>
        <div class="col-md-8" v-loading="loading" element-loading-text="加载中...">
            <div class="article-list">
                <div class="text-center">
                    <h4>{{datas.title}}</h4>
                    <div>
                        <span class="icon-color">创建时间：{{ datas.created_at +''}} </span>
                        <span class="icon-color"> 访问：{{ datas.read }}</span>
                    </div>
                    <br>
                    <hr>
                </div>

                <div id="markdown-main" class="markdown-body" v-html="datas.body" v-highlight></div>
            </div>

        </div>
        <transition name="fade">
            <div :class="{'img-view':isChoose}" @click="closeImg()">
                <!-- 遮罩层 -->
                <div :class="{'img-layer':isChoose}"></div>
                <div :class="{'img':isChoose}">
                    <img :src="imgSrc">
                </div>
            </div>
        </transition>
    </div>
</template>
<script>
    import * as api from '../../../config/httpService'
    import marked from 'marked'
    // import 'github-markdown-css'
    // import 'katex'
    // import VueMarkdown from 'vue-markdown'
    export default {
        data() {
            return {
                datas: '',
                content: '',
                loading: true,
                imgSrc: '',
                isChoose: false,
            }
        },
        methods: {
            closeImg() {
                this.isChoose = false;
                this.imgSrc = '';
            },
            getArticle(articleId) {
                this.loading = true;
                var id = articleId.article_id;
                api.fetch('/api/article/' + id)
                    .then(res => {
                        if (res.status == 'success') {
                            res.data.body = marked(res.data.body);
                            this.datas = res.data;
                            this.loading = false;

                        }
                    })
            }
        },
        components: {
            // VueMarkdown
        },
        mounted() {
            this.getArticle(this.$route.params);
            this.$nextTick(() => {
                $(this.$el).on('click', "img", (e) => {
                    console.log(e)
                    let url = e.target.currentSrc;
                    this.imgSrc = url;
                    this.isChoose = true;
                })
            })
        }
    }
</script>
<style>
    .markdown-body > p > img {
        width: 100% !important;
        height: auto !important;
    }

    img.active {
        width: 100%; /*图片需要放大3倍*/
        top: 0;
        left: 0;
        position: absolute; /*是相对于前面的容器定位的，此处要放大的图片，不能使用position：relative；以及float，否则会导致z-index无效*/
        z-index: 100;
        transition: all ease 1s;
    }

    .icon-color {
        color: #999;
    }

    /*动画*/
    .fade-enter-active,
    .fade-leave-active {
        transition: all .2s linear;
        transform: translate3D(0, 0, 0);
    }

    .fade-enter,
    .fade-leave-active {
        transform: translate3D(100%, 0, 0);
    }


    /* bigimg */

    .img-view {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
    }

    /*遮罩层样式*/
    .img-view .img-layer {
        position: fixed;
        z-index: 999;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.7);
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    /*不限制图片大小，实现居中*/
    .img-view .img img {
        max-width: 100%;
        display: block;
        position: absolute;
        left: 0;
        right: 0;
        margin: auto;
        z-index: 1000;
    }
</style>
