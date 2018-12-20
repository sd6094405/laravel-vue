<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <!--文章数据-->
                <ol class="article-list">
                    <li v-for="article in articles">
                        <h2 class="title">
                            <router-link :to="{name:'article',query:article.id }">
                                {{article.title}}
                            </router-link>
                            <!--<a  :href="'/article/'+article.id">-->
                            <!--{{article.title}}-->
                            <!--</a>-->

                        </h2>
                        <p class="desc">
                            {{article.desc}}
                        </p>
                        <p class="info">
                    <span>
                        <i class="glyphicon glyphicon-calendar"></i>{{article.created_at}}
                    </span>
                            &nbsp;
                            <span>
                        <i class="glyphicon glyphicon-th-list"></i>
                        <a href="https://moell.cn/category/1" target="_blank">
                            php
                        </a>
                    </span>
                            <span>
                        <i class="glyphicon glyphicon-eye-open"></i> {{article.read}} views
                    </span>
                        </p>
                    </li>
                </ol>

                <!--分页-->
                <ul class="pagination" role="navigation">

                    <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                        <span class="page-link" aria-hidden="true">‹</span>
                    </li>


                    <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                    <li class="page-item"><a class="page-link" href="https://moell.cn?page=2">2</a></li>
                    <li class="page-item"><a class="page-link" href="https://moell.cn?page=3">3</a></li>


                    <li class="page-item">
                        <a class="page-link" href="https://moell.cn?page=2" rel="next" aria-label="Next »">›</a>
                    </li>
                </ul>

            </div>
            <v-right></v-right>
        </div>
    </div> <!-- /container -->
</template>

<script>
    import * as api from '../config/httpService'
    import right from './right'

    export default {
        data() {
            return {
                articles: ''

            }
        },
        components: {
            'v-right': right,
        },
        mounted() {
            api.fetch('/article')
                .then(res => {
                    if (res.data.code == 200) {
                        this.articles = res.data.data.lists;
                    }
                })
        }
    }
</script>
