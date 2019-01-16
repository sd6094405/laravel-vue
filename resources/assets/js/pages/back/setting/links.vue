<template>
    <div class="table">
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-cascades"></i> 友链管理</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <div class="handle-box">
                <el-input v-model="keyword" placeholder="筛选关键词" class="handle-input mr10"></el-input>
                <el-button type="primary" icon="search" @click="search">搜索</el-button>
                <el-button type="primary" icon="search" @click="refresh">重置</el-button>
                <el-button type="success" icon="search" @click="addVisible = true">添加友链</el-button>

            </div>
            <el-table v-loading="loading" element-loading-text="加载中..." :data="links" border class="table"
                      ref="multipleTable">
                <el-table-column type="selection" width="55" align="center"></el-table-column>
                <el-table-column prop="id" label="id" sortable width="80">
                </el-table-column>
                <el-table-column prop="title" label="标题" width="160">
                </el-table-column>
                <el-table-column prop="url" label="url地址">
                    <template slot-scope="scope">
                        <a :href="scope.row.url"
                           target="_blank">{{scope.row.url}}</a>
                    </template>
                </el-table-column>
                <el-table-column prop="weight" label="排序权重" width="160">
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


        <el-dialog title="编辑友链" width="70%" :visible.sync="editVisible">
            <el-form>
                <div class="form-box">
                    <el-form ref="form" :model="Data" label-width="100px">
                        <el-form-item label="标题：">
                            <el-input v-model="Data.title"></el-input>
                        </el-form-item>
                        <el-form-item label="URL地址：">
                            <el-input v-model="Data.url"></el-input>
                        </el-form-item>
                        <el-form-item label="排序权重：">
                            <el-input v-model="Data.weight"></el-input>
                        </el-form-item>
                    </el-form>
                </div>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="editVisible = false">取 消</el-button>
                <el-button type="primary" @click="editRow">确 定</el-button>
            </div>
        </el-dialog>
        <!-- 新增框 -->
        <el-dialog title="新增友链" :visible.sync="addVisible" width="500px" center>
            <el-form ref="form" :model="Data" label-width="80px">
                <el-form-item label="友链名">
                    <el-input v-model="Data.title"></el-input>
                </el-form-item>
                <el-form-item label="URL地址：">
                    <el-input v-model="Data.url"></el-input>
                </el-form-item>
                <el-form-item label="排序权重：">
                    <el-input v-model="Data.weight"></el-input>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="addVisible = false">取 消</el-button>
                <el-button type="primary" @click="addRow">确 定</el-button>
            </span>
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
                links: [],
                cur_page: 1,
                is_search: false,
                editVisible: false,
                delVisible: false,
                addVisible:false,
                total: 1,
                keyword: '',
                deleteId: '',
                Data:{
                    "id":"",
                    "title":"",
                    "url":"",
                    "weight":""
                },
            }
        },
        created() {
            this.getLinks();
        },
        mounted() {

        },
        computed: {},
        methods: {
            search() {
                this.getLinks(1, this.keyword)
            },
            refresh() {
                this.keyword = '';
                this.getLinks();
            },
            getLinks(page = 1, keyword = '') {
                this.loading = true;
                api.fetch(api.backUrl + 'setting/links?page=' + page + '&keyword=' + keyword)
                    .then(res => {
                        this.total = res.data.data.total;
                        this.links = res.data.data.lists;
                        this.loading = false;
                    })
            },
            handleCurrentChange(index) {
                this.getLinks(index)
            },
            handleEdit(index,row) {
                this.Data ={
                    "id":row.id,
                    "title":row.title,
                    "url":row.url,
                    "weight":row.weight
                };
                this.editVisible = true;
            },
            handleDelete(index, row) {
                this.delVisible = true;
                this.deleteId = row.id;
            },
            editRow(){
                this.editVisible = false;
                api.putData(api.backUrl + 'setting/links/'+this.Data.id,this.Data)
                    .then(res => {
                        if (res.data.status == 'success') {
                            this.$message.success('编辑成功！');
                            return this.getLinks()
                        }
                        this.$message.error('编辑失败!');
                    })
            },
            deleteRow() {
                this.delVisible = false;
                api.deleteJson(api.backUrl + 'setting/links/' + this.deleteId)
                    .then(res => {
                        if (res.data.status == 'success') {
                            this.$message.success('删除成功！');
                            return this.getLinks()
                        }
                        this.$message.error('删除失败!');
                    })
            },
            addRow(){
                this.addVisible = false;
                api.postJson(api.backUrl + 'setting/links',this.Data)
                    .then(res => {
                        if (res.data.status == 'success') {
                            this.$message.success('添加成功！');
                            return this.getLinks()
                        }
                        this.$message.error('添加失败!');
                    })

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
