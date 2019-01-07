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
                                    v-for="item in tags"
                                    :key="item.value"
                                    :label="item.name"
                                    :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-form>
            </div>
            <mavon-editor style="height:inherit" @imgAdd="$imgAdd" ishljs="true" :codeStyle="monokai-sublime" :ishljs="true" v-model="form.body"/>
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



    export default {
        data() {
            return {
                loading: false,
                saveVisible: false,
                tag_ids:[],
                tags: [
                    {
                        'id': '1',
                        'name': 'php',
                        'value': '1'
                    },
                    {
                        'id': '2',
                        'name': 'JavaScript',
                        'value': '2'
                    },
                ],
                form: {
                    title: '',
                    desc: '',
                    tag_id: '',
                    body: ''
                },
            }
        },
        methods: {
            tagChange() {
                var tag_ids = this.tag_ids;
                var tag_id = '';
                tag_ids.forEach(function(c){
                    tag_id = tag_id+c+',';

                });
                tag_id = tag_id.substring(0,tag_id.length-1);
                this.form.tag_id = tag_id;
            },
            // 保存
            save() {
                this.saveVisible = false;
                //需要数据验证
                this.loading = true;
                console.log(this.form)
                api.postJson(api.backUrl+'article/create', this.form)
                    .then(res => {
                        this.loading = false;
                        console.log(res)
                        if (res.data.status == 'success') {
                            this.$message.success('保存成功！');
                            return this.$router.push('/back/article')
                        }
                        this.$message.error('保存失败!');
                    });
            },

            // 绑定@imgAdd event
            $imgAdd(pos, $file){
                // 第一步.将图片上传到服务器.
                var formdata = new FormData();
                formdata.append('image', $file);
                console.log($file,pos);
                axios({
                    url: 'server url',
                    method: 'post',
                    data: formdata,
                    headers: { 'Content-Type': 'multipart/form-data' },
                }).then((url) => {
                    // 第二步.将返回的url替换到文本原位置![...](0) -> ![...](url)
                    /**
                     * $vm 指为mavonEditor实例，可以通过如下两种方式获取
                     * 1. 通过引入对象获取: `import {mavonEditor} from ...` 等方式引入后，`$vm`为`mavonEditor`
                     * 2. 通过$refs获取: html声明ref : `<mavon-editor ref=md ></mavon-editor>，`$vm`为 `this.$refs.md`
                     */
                    $vm.$img2Url(pos, url);
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