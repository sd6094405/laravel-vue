<template>
    <div class="col-md-8" v-loading.fullscreen.lock="fullscreenLoading" element-loading-text="加载中...">
        <div class="article-list">
            <div class="text-center">
                <h3>{{datas.title}}</h3>
                <div>
                    <span class="icon-color">创建时间：{{ datas.created_at +''}} </span>
                    <span class="icon-color"> 访问：{{ datas.read }}</span>
                </div>
                <br>
                <hr>
            </div>
            <!--<div v-html="datas.body" class="markdown-body" >{{datas.body}}</div>-->
            <vue-markdown v-highlight class="markdown-body"  :source="datas.body"></vue-markdown>
        </div>
    </div>
</template>
<script>
    import * as api from '../../../config/httpService'
    import 'github-markdown-css'
    import 'highlight.js'
    import 'katex'
    import VueMarkdown from 'vue-markdown'
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
                        if (res.data.status == 'success') {
                            this.datas = res.data.data;
                            this.fullscreenLoading = false;

                        }
                    })
            }
        },
        components:{
            VueMarkdown
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
