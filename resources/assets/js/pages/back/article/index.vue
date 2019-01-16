<template>
    <div class="table">
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-cascades"></i> 文章管理</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <div class="handle-box">
                <el-input v-model="keyword" placeholder="筛选关键词" class="handle-input mr10"></el-input>
                <el-button type="primary" icon="search" @click="search">搜索</el-button>
                <el-button type="primary" icon="search" @click="refresh">重置</el-button>
            </div>
            <el-table v-loading="loading" element-loading-text="加载中..." :data="articles" border class="table"
                      ref="multipleTable">
                <el-table-column type="selection" width="55" align="center"></el-table-column>
                <el-table-column prop="id" label="id" sortable width="80">
                </el-table-column>
                <el-table-column prop="title" label="标题">
                </el-table-column>
                <el-table-column label="标签" width="180">
                    <template slot-scope="scope">
                        <span style="margin: 2px;" v-for="id in scope.row.tag_id.split(',')">
                            <el-tag :type="id % 2 === 0 ? 'success' : 'primary'" >
                                {{ showTag(id) }}
                            </el-tag>
                        </span>
                    </template>
                </el-table-column>
                <el-table-column prop="read" label="阅读数" width="80">
                </el-table-column>
                <el-table-column prop="created_at" label="创建日期" width="120">
                </el-table-column>
                <el-table-column prop="updated_at" label="更新日期" width="120">
                </el-table-column>
                <el-table-column label="操作" width="200" align="center">
                    <template slot-scope="scope">
                        <el-button icon="el-icon-edit" @click="handleEdit(scope.$index, scope.row)">编辑
                        </el-button>
                        <el-button type="danger" icon="el-icon-delete"
                                   @click="handleDelete(scope.$index, scope.row)">删除
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <div class="pagination">
                <el-pagination background @current-change="handleCurrentChange" layout="prev, pager, next"
                               :total="total">
                </el-pagination>
            </div>
        </div>

        <!-- 删除提示框 -->
        <el-dialog title="提示" :visible.sync="delVisible" width="300px" center>
            <div class="del-dialog-cnt">删除不可恢复，是否确定删除？</div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="delVisible = false">取 消</el-button>
                <el-button type="primary" @click="deleteRow">确 定</el-button>
            </span>
        </el-dialog>


        <el-dialog title="编辑文章" width="70%" :visible.sync="editVisible">
            <el-form>
                <div class="form-box">
                    <el-form ref="form" :model="editData" label-width="100px">
                        <el-form-item label="标题：">
                            <el-input v-model="editData.title"></el-input>

                        </el-form-item>
                        <el-form-item label="描述信息：">
                            <el-input type="textarea"
                                      :rows="5"
                                      placeholder="请输入内容"
                                      v-model="editData.desc"></el-input>
                        </el-form-item>
                        <el-form-item label="标签：">
                            <el-select @change="tagChange()" v-model="tag_ids" multiple placeholder="请选择">
                                <el-option
                                        v-for="(tag,index) in tags"
                                        :key="index"
                                        :label="tag.title"
                                        :value="tag.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-form>
                </div>
                <mavon-editor style="height:inherit;width: auto;" ref=md @imgAdd="$imgAdd" :ishljs="true"
                              v-model="editData.body"/>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="editVisible = false">取 消</el-button>
                <el-button type="primary" @click="editRow">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    import * as api from '../../../config/httpService'
    import * as cosService from '../../../api/api'
    import * as util from '../../../utils/util'
    export default {
        data() {
            return {
                loading: true,
                articles: [],
                cur_page: 1,
                is_search: false,
                editVisible: false,
                delVisible: false,
                total: 1,
                keyword: '',
                deleteId: '',
                tags: [],
                tag_ids:[],
                editData:{
                    "id":"",
                    "title":"",
                    "desc":"",
                    "tag_id":"",
                    "body":"",
                }

            }
        },
        created() {
            this.getArticles();
            this.getTags();
        },
        mounted() {

        },
        computed: {},
        methods: {
            search() {
                this.getArticles(1, this.keyword)
            },
            refresh() {
                this.keyword = '';
                this.getArticles();
            },
            tagChange() {
                var tag_ids = this.tag_ids;
                var tag_id = '';
                tag_ids.forEach(function (value) {
                    tag_id = tag_id + value + ',';
                });
                tag_id = tag_id.substring(0, tag_id.length - 1);
                this.editData.tag_id = tag_id;
            },
            getTags() {
                api.fetch(api.backUrl + 'tag?all=1')
                    .then(res => {
                        this.tags = res.data.lists;
                    })
            },
            showTag(row) {
                var title = '';
                this.tags.forEach(function (value) {
                    if (value.id == row) {
                        title = value.title
                    }
                });
                return title;
            },
            getArticles(page = 1, keyword = '') {
                this.loading = true;
                api.fetch(api.backUrl + 'article?page=' + page + '&keyword=' + keyword)
                    .then(res => {
                        this.total = res.data.total;
                        this.articles = res.data.lists;
                        this.loading = false;
                    })
            },
            handleCurrentChange(index) {
                this.getArticles(index)
            },
            handleEdit(index,row) {
                this.editData ={
                    "id":row.id,
                    "title":row.title,
                    "desc":row.desc,
                    "tag_id":row.tag_id,
                    "body":row.body,
                };
                this.tag_ids = row.tag_id.split(',');
                for(var i = 0;i<this.tag_ids.length;i++){
                    this.tag_ids[i] = parseInt(this.tag_ids[i]);
                }
                this.editVisible = true;
            },
            handleDelete(index, row) {
                this.delVisible = true;
                this.deleteId = row.id;
            },
            editRow(){
              this.editVisible = false;
              api.putData(api.backUrl + 'article/'+this.editData.id ,this.editData)
                  .then(res => {
                      if (res.status == 'success') {
                          this.$message.success('编辑成功！');
                          return this.getArticles()
                      }
                      this.$message.error('编辑失败!');
                  })
            },
            deleteRow() {
                this.delVisible = false;
                api.deleteJson(api.backUrl + 'article/' + this.deleteId)
                    .then(res => {
                        if (res.status == 'success') {
                            this.$message.success('删除成功！');
                            return this.getArticles()
                        }
                        this.$message.error('删除失败!');
                    })
            },
            // 绑定@imgAdd event
            $imgAdd(pos, $file) {

                var file = $file.name.split('.');
                var NewName = util.make_rand(36);
                var params = {
                    "signUrl": "",
                    "file": file,
                    "fileName": 'imgs/' + NewName + '.' + file[1]
                };
                var $vm = this;
                cosService.getSign({"name": params.fileName})
                    .then(res => {
                        params.signUrl = res.data;
                        cosService.putObject(params.signUrl, util.dataURLtoFile($file.miniurl))
                            .then(res => {
                                if (res.statusText = 'OK') {
                                    $vm.$refs.md.$img2Url(pos, 'http://blog-1257809211.cos.ap-chengdu.myqcloud.com/'+ params.fileName);
                                }
                            })
                    });
            },

        }
    }

</script>

<style scoped>
    .handle-box {
        margin-bottom: 20px;
    }

    .handle-select {
        width: 120px;
    }

    .handle-input {
        width: 300px;
        display: inline-block;
    }

    .del-dialog-cnt {
        font-size: 16px;
        text-align: center
    }

    .table {
        width: 100%;
        font-size: 14px;
    }

    .red {
        color: #ff0000;
    }
</style>
