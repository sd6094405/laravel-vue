<template>
    <Layout :style="{marginLeft: '200px'}">
        <Header :style="{background: '#fff', boxShadow: '0 2px 3px 2px rgba(0,0,0,.1)'}"></Header>
        <Content :style="{padding: '0 16px 16px'}">
            <Breadcrumb :style="{margin: '16px 0'}">
                <Button type="primary" v-on:click="submitData">保存</Button>
            </Breadcrumb>
            <Card>
                <div id="main" class="card-height">
                    <mavon-editor style="height:inherit" v-model="data"/>
                </div>
            </Card>
        </Content>
    </Layout>
</template>
<script>
    import * as api from '../../../config/httpService'

    export default {
        data() {
            return {
                data: '## 新文章'
            }
        },
        methods: {
            submitData() {
                var data = {
                    'title': 'test',
                    'desc': 'test',
                    'tag_id': '321',
                    'body': this.data,
                    'read': '0'
                };
                api.postData('/api/article', data)
                    .then(res => {
                        console.log(res)
                    })
            }
        },
        mounted() {

        }
    }
</script>
<style scoped>
    .card-height {
        height: 600px;
    }
</style>