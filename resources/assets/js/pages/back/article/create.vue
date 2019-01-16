<template>
    <div class="table" v-loading="loading">
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-cascades"></i> 新文章</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">

            <div class="form-box">
                <el-form ref="form" :model="form" label-width="100px">
                    <el-form-item label="标题：">
                        <el-input v-model="form.title"></el-input>

                    </el-form-item>
                    <el-form-item label="描述信息：">
                        <el-input type="textarea"
                                  :rows="5"
                                  placeholder="请输入内容"
                                  v-model="form.desc"></el-input>
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
                          v-model="form.body"/>
            <div class="handle-box">
                <el-button type="primary" @click="saveVisible = true">保存</el-button>
            </div>
        </div>
        <!-- 弹出框 -->
        <el-dialog title="提示" :visible.sync="saveVisible" width="30%">
            <span class="dialog">
                确认保存?
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="saveVisible = false">取 消</el-button>
                <el-button type="primary" @click="save">确 定</el-button>
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
                loading: false,
                saveVisible: false,
                tag_ids: [],
                tags: [],
                form: {
                    title: '',
                    desc: '',
                    tag_id: '',
                    body: ''
                },
            }
        },
        created(){
          this.getTags();
        },
        methods: {
            tagChange() {
                var tag_ids = this.tag_ids;
                var tag_id = '';
                tag_ids.forEach(function (c) {
                    tag_id = tag_id + c + ',';

                });
                tag_id = tag_id.substring(0, tag_id.length - 1);
                this.form.tag_id = tag_id;
            },
            getTags() {
                api.fetch(api.backUrl + 'tag?all=1')
                    .then(res => {
                        this.tags = res.data.lists;
                    })
            },
            // 保存
            save() {
                this.saveVisible = false;
                //需要数据验证
                this.loading = true;
                api.postJson(api.backUrl + 'article', this.form)
                    .then(res => {
                        this.loading = false;
                        if (res.status == 'success') {
                            this.$message.success('保存成功！');
                            return this.$router.push('/back/article')
                        }
                        this.$message.error('保存失败!');
                    });
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