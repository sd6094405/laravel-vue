<template>
    <div>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="https://www.hehongbo.cn">hhb</a>-->
                    <router-link :to="{name:'index'}"><span class="navbar-brand">Laravel-Vue</span></router-link>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <router-link :to="{name:'index'}"><span>首页</span></router-link>
                        </li>
                        <li v-for="tag in tags">
                            <router-link :to="{name:'category',params:{ tag_id:tag.id }}"><span>{{tag.title}}</span>
                            </router-link>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right" action="https://www.hehongbo.cn/search" method="get">
                        <div class="input-group input-group-sm">
                            <input type="search" class="search-field form-control" value="" name="keyword"
                                   placeholder="Search">
                            <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <p>
                </p>
                <div class="text-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="to-animate fadeInUp animated color-white">
                                做一只会翻身的咸鱼 😍
                            </h3>
                        </div>
                    </div>
                </div>
                <p></p>
            </div>
        </div>
    </div>
</template>

<script>
    import {postData, baseUrl} from '../../../config/httpService'

    export default {
        data() {
            return {
                tags: [],

            }
        },
        methods: {
            getTags() {
                postData(baseUrl + 'tags')
                    .then(res => {
                        if (res.status !== 'error') {
                            this.tags = res.data;
                        }
                    });
            }
        },
        created() {
            this.getTags();
        }
    }
</script>
<style scoped>
    .navbar-default .navbar-toggle {
        border-color: #F46660;
    }

    .navbar-default .navbar-toggle:focus, .navbar-default .navbar-toggle:hover {
        background-color: #F46660;
        border-color: #F46660 !important;
    }
</style>