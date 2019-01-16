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
                <el-button type="primary" icon="search" @click="addVisible = true">添加标签</el-button>
            </div>
            <el-table v-loading="loading" element-loading-text="加载中..." :data="tags" border class="table"
                      ref="multipleTable">
                <el-table-column type="selection" width="55" align="center"></el-table-column>
                <el-table-column prop="id" label="id" sortable width="80">
                </el-table-column>
                <el-table-column prop="title" label="标签名">
                </el-table-column>
                <el-table-column prop="is_home" label="首页展示" width="80">
                    <template slot-scope="scope">
                        <el-tag type="success" v-if="scope.row.is_home == 1">是</el-tag>
                        <el-tag type="warning" v-else>否</el-tag>
                    </template>
                </el-table-column>
                <el-table-column prop="status" label="状态" width="80">
                    <template slot-scope="scope">
                        <el-tag type="success" v-if="scope.row.status == 1">启用</el-tag>
                        <el-tag type="warning" v-else>禁用</el-tag>
                    </template>
                </el-table-column>
                <el-table-column prop="created_at" label="创建日期" width="160">
                </el-table-column>
                <el-table-column prop="updated_at" label="更新日期" width="160">
                </el-table-column>
                <el-table-column label="操作" width="200" align="center">
                    <template slot-scope="scope">
                        <el-button type="success" v-if="scope.row.status !== 1" icon="el-icon-edit"
                                   @click="editStatus(scope.row.id,1)">启用
                        </el-button>
                        <el-button type="danger" v-else icon="el-icon-edit"
                                   @click="editStatus(scope.row.id,0)">禁用
                        </el-button>
                        <el-dropdown @command="handleCommand($event,scope.row)">
                            <el-button type="primary">
                                更多操作<i class="el-icon-arrow-down el-icon--right"></i>
                            </el-button>
                            <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item command="edit"><i class="el-icon-edit"></i> 编辑</el-dropdown-item>
                                <el-dropdown-item command="delete"><i class="el-icon-delete"></i> 删除</el-dropdown-item>
                            </el-dropdown-menu>
                        </el-dropdown>
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

        <!-- 编辑框 -->
        <el-dialog title="编辑" :visible.sync="editVisible" width="300px" center>
            <el-form ref="form" :model="editData" label-width="80px">
                <el-form-item label="标签名">
                    <el-input v-model="editData.title"></el-input>
                </el-form-item>
                <el-form-item label="首页显示">
                        <el-switch
                                style="display: block"
                                v-model="editData.is_home"
                                active-color="#13ce66"
                                inactive-color="#DCDFE6"
                                active-text="开启"
                                inactive-text="关闭">
                        </el-switch>
                </el-form-item>
                <el-form-item label="状态">
                        <el-switch
                                style="display: block"
                                v-model="editData.status"
                                active-color="#13ce66"
                                inactive-color="#DCDFE6"
                                active-text="启用"
                                inactive-text="禁用">
                        </el-switch>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="editVisible = false">取 消</el-button>
                <el-button type="primary" @click="updateRow">确 定</el-button>
            </span>
        </el-dialog>

        <!-- 新增框 -->
        <el-dialog title="编辑" :visible.sync="addVisible" width="300px" center>
            <el-form ref="form" :model="addData" label-width="80px">
                <el-form-item label="标签名">
                    <el-input v-model="addData.title"></el-input>
                </el-form-item>
                <el-form-item label="首页显示">
                    <el-switch
                            style="display: block"
                            v-model="addData.is_home"
                            active-color="#13ce66"
                            inactive-color="#DCDFE6"
                            active-text="开启"
                            inactive-text="关闭">
                    </el-switch>
                </el-form-item>
                <el-form-item label="状态">
                    <el-switch
                            style="display: block"
                            v-model="addData.status"
                            active-color="#13ce66"
                            inactive-color="#DCDFE6"
                            active-text="启用"
                            inactive-text="禁用">
                    </el-switch>
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

    export default {
        data() {
            return {
                loading: true,
                tags: [],
                cur_page: 1,
                is_search: false,
                editVisible: false,
                delVisible: false,
                addVisible:false,
                total: 1,
                keyword: '',
                deleteId: '',
                editData: {
                    "id": "",
                    "title": "",
                    "is_home": "",
                    "status": ""
                },
                addData:{
                    "title": "",
                    "is_home": false,
                    "status": true
                }
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
                this.loading = true;
                api.fetch(api.backUrl + 'tag?page=' + page + '&keyword=' + keyword)
                    .then(res => {
                        this.total = res.data.total;
                        this.tags = res.data.lists;
                        this.loading = false;
                    })
            },
            handleCommand(command, row) {
                switch (command) {
                    case 'edit':
                        this.handleEdit(row);
                        break;
                    case 'delete':
                        this.handleDelete(row);
                        break;
                }
            },
            handleCurrentChange(index) {
                this.getArticles(index)
            },
            handleEdit(row) {
                this.editData = {
                    "id": row.id,
                    "title": row.title,
                    "is_home": row.is_home == 1 ? true : false,
                    "status": row.status == 1 ? true : false
                };
                this.editVisible = true;
            },
            handleDelete(row) {
                this.delVisible = true;
                this.deleteId = row.id;
            },
            addRow(){
                this.addVisible = false;
                var data = {
                    "title":this.addData.title,
                    "is_home":this.addData.is_home === false ? 0 : 1,
                    "status": this.addData.status === false ? 0 :1
                };
                api.postJson(api.backUrl + 'tag/',data)
                    .then(res => {
                        if (res.status === 'success') {
                            this.$message.success('添加成功！');
                            return this.getArticles()
                        }
                        this.$message.error('添加失败!');
                    })

            },
            deleteRow() {
                this.delVisible = false;
                api.deleteJson(api.backUrl + 'tag/' + this.deleteId)
                    .then(res => {
                        if (res.status === 'success') {
                            this.$message.success('删除成功！');
                            return this.getArticles()
                        }
                        this.$message.error('删除失败!');
                    })
            },
            editStatus(id,status){
                api.putData(api.backUrl + 'tag/' + id,{"status":status})
                    .then(res => {
                        if (res.status === 'success') {
                            this.$message.success('修改成功！');
                            return this.getArticles()
                        }
                        this.$message.error(res.data.data);
                    })
            },
            updateRow() {
                this.editVisible = false;
                var data = this.editData;
                this.editData = {
                    "id": data.id,
                    "title": data.title,
                    "is_home": data.is_home === false ? 0 : 1,
                    "status": data.status === false ? 0 : 1
                };
                api.putData(api.backUrl + 'tag/' + this.editData.id,this.editData)
                    .then(res => {
                        if (res.status === 'success') {
                            this.$message.success('修改成功！');
                            return this.getArticles()
                        }
                        this.$message.error(res.data.data);
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
