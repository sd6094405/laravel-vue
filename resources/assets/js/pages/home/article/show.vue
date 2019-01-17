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

            <div class="markdown-body" v-html="datas.body" v-highlight></div>
        </div>
    </div>
</template>
<script>
    import * as api from '../../../config/httpService'
    // import marked from 'marked'
    // import 'github-markdown-css'
    // import 'katex'
    // import VueMarkdown from 'vue-markdown'
    export default {
        data() {
            return {
                datas: '',
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
            this.getArticle(this.$route.params)
        }
    }
</script>
<style scoped>

    .icon-color {
        color: #999;
    }
</style>
