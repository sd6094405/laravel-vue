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
            <el-table :data="articles" border class="table" ref="multipleTable">
                <el-table-column type="selection" width="55" align="center"></el-table-column>
                <el-table-column prop="id" label="id" sortable width="80">
                </el-table-column>
                <el-table-column prop="title" label="标题">
                </el-table-column>
                <el-table-column prop="tag_id" label="分类" width="140">
                </el-table-column>
                <el-table-column prop="read" label="阅读数" width="80">
                </el-table-column>
                <el-table-column prop="created_at" label="创建日期" width="120">
                </el-table-column>
                <el-table-column prop="updated_at" label="更新日期" width="120">
                </el-table-column>
                <el-table-column label="操作" width="200" align="center">
                    <template slot-scope="scope">
                        <el-button  icon="el-icon-edit" @click="handleEdit(scope.$index, scope.row)">编辑
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
    </div>
</template>

<script>
    import * as api from '../../../config/httpService'

    export default {
        data() {
            return {
                articles: [],
                cur_page: 1,
                is_search: false,
                editVisible: false,
                delVisible: false,
                total: 1,
                keyword: '',
                deleteId: '',
            }
        },
        created() {
        },
        mounted() {
            this.getArticles();
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
            getArticles(page = 1, keyword = '') {
                api.fetch(api.backUrl + 'article?page=' + page + '&keyword=' + keyword)
                    .then(res => {
                        this.total = res.data.data.total;
                        this.articles = res.data.data.lists;
                    })
            },
            handleCurrentChange(index) {
                this.getArticles(index)
            },
            handleEdit(index, row) {

            },
            handleDelete(index, row) {
                this.delVisible = true;
                this.deleteId = row.id;
            },
            deleteRow() {
                this.delVisible = false;
                api.deleteJson(api.backUrl + 'article/' + this.deleteId)
                    .then(res => {
                        if (res.data.status == 'success') {
                            this.$message.success('删除成功！');
                            return this.getArticles()
                        }
                        this.$message.error('删除失败!');
                    })
            }

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
