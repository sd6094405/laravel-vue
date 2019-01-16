<template>
    <div class="col-md-8" v-loading="loading" element-loading-text="加载中...">
        <!--文章数据-->
        <ol class="article-list" v-for="article in articles">
            <li>
                <h4 class="title">
                    <router-link :to="{name:'articleShow',params:{ article_id:article.id }}">
                        {{article.title}}
                    </router-link>
                </h4>
                <p class="desc">
                    {{article.desc}}
                </p>
                <p class="info">
                    <span>
                        <i class="glyphicon glyphicon-time"></i>{{article.created_at}}
                    </span>
                    &nbsp;
                    <span>
                        <i class="glyphicon glyphicon-th-list"></i>
                        <a href="https://moell.cn/category/1" target="_blank">
                            php
                        </a>
                    </span>
                    <span>
                        <i class="glyphicon glyphicon-eye-open"></i> {{article.read}} 阅读
                    </span>
                </p>
            </li>
        </ol>
        <!--分页-->
        <div class="pagination">
            <el-pagination background @current-change="handleCurrentChange" layout="prev, pager, next" :total="total">
            </el-pagination>
        </div>

    </div>
</template>

<script>
    import * as api from '../../../config/httpService'

    export default {
        data() {
            return {
                articles: '',
                total: 10,
                form: {
                    page: 1,
                    pageSize: 10
                },
                loading: true,
                tag_id:'',
            }
        },
        methods:{
            handleCurrentChange(c) {
                this.form.page = c;
                this.tagId();
            }
        },
        computed: {
            tagId() {
                this.loading = true;
                let parmas = {
                    page: this.form.page,
                    pageSize: this.form.pageSize
                };
                let urlPage = this.$route.query.page;
                if (urlPage) {
                    parmas.page = urlPage
                }
                var tag_id = this.$route.params.tag_id;
                api.fetch(api.baseUrl + 'category/'+tag_id)
                    .then(res => {
                        if (res.code === 200) {
                            this.articles = res.data.lists;
                            this.total = res.data.total;
                        }
                        this.loading = false;
                    })
            }
        },
        watch:{
            tagId(){

            }
        }
    }
</script>
