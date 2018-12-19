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
                    <a class="navbar-brand" href="https://moell.cn">moell</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="http://www.moell.cn/category/1"><span>PHP</span></a></li>
                        <li><a href="http://www.moell.cn/category/3"><span>DB</span></a></li>
                        <li><a href="http://www.moell.cn/category/2"><span>Linux</span></a></li>
                        <li><a href="http://www.moell.cn/category/4"><span>Code</span></a></li>
                        <li><a href="http://www.moell.cn/article/1"><span>博客安装</span></a></li>
                        <li><a href="http://www.moell.cn/about"><span>About</span></a></li>
                    </ul>
                    <form class="navbar-form navbar-right" action="https://moell.cn/search" method="get">
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
    import * as api from '../config/httpService'
    export default {
        methods(){
          function getSystem(){
              api.fetch('/init')
                  .then(res => function(){

              });
          }
        },
        mounted() {

        }
    }
</script>
