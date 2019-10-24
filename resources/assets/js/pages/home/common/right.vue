<template>
  <div class="col-md-4" style="margin-top: 15px">
    <div class="panel panel-default author">
      <div class="panel-heading">
        <h3 class="panel-title">咸鱼王</h3>
      </div>
      <div class="panel-body">
        <div class="row text-center">
          <img
            src="https://blog-1257809211.cos.ap-chengdu.myqcloud.com/imgs/profile_photo.jpg"
            class="img-circle author-avatar"
            alt="User Image"
          />
        </div>
        <div class="row text-center author-footer">
          <span class="icon-github" style="padding-left:20px;">
            <!-- <a href="https://github.com/sd6094405/laravel-vue" target="_blank">GitHub</a> -->
          </span>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">标签</h3>
      </div>
      <div class="panel-body">
        <span style="padding: 5px;" v-for="tag in tags">
          <router-link :to="{name:'category',params:{ tag_id:tag.id }}">
            <span>{{tag.title}}</span>
          </router-link>
        </span>
      </div>
    </div>
    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">文章</div>

      <!-- List group -->
      <!-- <ul class="list-group">
                <li class="list-group-item" style="">
                    <span class="badge">8330</span>
                    <a href="https://hhbcode.cn/article/36" target="_blank">
                        Laravel-Vue-Blog 安装文档...
                    </a>
                </li>
      </ul>-->
    </div>
    <!-- <div class="panel panel-default"> -->
    <!-- Default panel contents -->
    <!-- <div class="panel-heading">友情链接</div> -->

    <!-- List group -->
    <!-- <ul class="list-group"> -->

    <!-- <li class="list-group-item"> -->
    <!-- <a href="https://laravel.com" target="_blank">Laravel</a> -->
    <!-- </li> -->
    <!-- <li class="list-group-item"> -->
    <!-- <a href="https://v2mm.tech" target="_blank">V2MM 自由职业者社区</a> -->
    <!-- </li> -->
    <!-- </ul> -->
    <!-- </div> -->
  </div>
</template>
<style scoped>
.panel-default {
  border-radius: 15px 15px 0 0;
}

.panel-default > .panel-heading {
  border-radius: 15px 15px 0 0;
}
</style>
<script>
import { postData, baseUrl } from "../../../config/httpService";

export default {
  data() {
    return {
      tags: []
    };
  },
  methods: {
    getTags() {
      postData(baseUrl + "tags").then(res => {
        if (res.status !== "error") {
          this.tags = res.data;
        }
      });
    }
  },
  created() {
    this.getTags();
  }
};
</script>