<template>
    <div class="col-md-8" v-loading.fullscreen.lock="fullscreenLoading" element-loading-text="加载中...">
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
                fullscreenLoading: true
            }
        },
        methods: {
            getArticle(articleId) {
                this.fullscreenLoading = true;
                var id = articleId.article_id;
                api.fetch('/api/article/' + id)
                    .then(res => {
                        if (res.status == 'success') {
                            res.data.body = marked(res.data.body);
                            this.datas = res.data;
                            this.fullscreenLoading = false;

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
                $(this.$el).on('click', "img", (res) => {
                    var strA = "<a id='yourid' href='" + this.src + "'></a>";
                    console.log(res.currentTarget = '')
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
        top:0;
        left:0;
        position: absolute; /*是相对于前面的容器定位的，此处要放大的图片，不能使用position：relative；以及float，否则会导致z-index无效*/
        z-index: 100;
        transition: all ease 1s;
    }

    .icon-color {
        color: #999;
    }
</style>
