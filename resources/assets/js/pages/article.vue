<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 article-list">
                
            </div>
        </div>
    </div> <!-- /container -->
</template>
<script>
    import * as api from '../config/httpService'
    import right from '../components/right'
    export default {
        data() {
            return {
                datas: ''
            }
        },
        methods:{
          getArticle(articleId){
              var id = articleId.article_id;
              api.fetch('/api/article/'+id)
                  .then(res=>{
                      if(res.data.code == 200){
                          this.datas = res.data.data
                      }
                  })
          }
        },
        mounted() {
            this.getArticle(this.$route.params)
        }
    }
</script>
