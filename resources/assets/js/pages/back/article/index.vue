<template>
    <Layout :style="{marginLeft: '200px'}">
        <Header :style="{background: '#fff', boxShadow: '0 2px 3px 2px rgba(0,0,0,.1)',fontSize:'18px'}">文章管理</Header>
        <Content :style="{padding: '0 16px 16px'}">

            <Breadcrumb :style="{margin: '16px 0'}">
                <Input suffix="ios-search" placeholder="请输入数据" style="width: auto"/>
                <Button type="primary" :to="{name:'articleCreate'}">新文章</Button>
            </Breadcrumb>
            <!--<Table border :columns="columns" :data="data">-->
                <!--<template slot-scope="{ row }" slot="name">-->
                    <!--<strong>{{ row.name }}</strong>-->
                <!--</template>-->
                <!--<template slot-scope="{ row, index }" slot="action">-->
                    <!--<Button type="info" size="small" style="margin-right: 5px" @click="show(index)">编辑</Button>-->
                    <!--<Button type="error" size="small" @click="remove(index)">删除</Button>-->
                <!--</template>-->
            <!--</Table>-->

        </Content>
    </Layout>
</template>
<script>
    import * as api from '../../../config/httpService'

    export default {
        data() {
            return {
                columns: [
                    {
                        title: 'id',
                        slot: 'id'
                    },
                    {
                        title: '标题',
                        key: 'title'
                    },
                    {
                        title: '阅读量',
                        key: 'read'
                    },
                    {
                        title: '创建时间',
                        key: 'created_at'
                    },
                    {
                        title: '操作',
                        slot: 'action',
                        width: 150,
                        align: 'center'
                    }
                ],
                data: [
                    {
                        id: '1',
                        title: 'Docker',
                        read: '65628',
                        created_at: '2018-12-21 16:24:37'
                    },
                    {
                        id: '2',
                        title: 'Linux',
                        read: '65628',
                        created_at: '2018-12-21 16:24:37'
                    },
                    {
                        id: '3',
                        title: 'GoLang',
                        read: '65628',
                        created_at: '2018-12-21 16:24:37'
                    },
                    {
                        id: '4',
                        title: 'PHP',
                        read: '65628',
                        created_at: '2018-12-21 16:24:37'
                    }
                ]
            }
        },
        methods: {
            show(index) {
                this.$Modal.info({
                    title: '文章信息',
                    content: `id：${this.data[index].id}<br>title：${this.data[index].title}<br>read：${this.data[index].read}<br>created_at：${this.data[index].created_at}`
                })
            },
            remove(index) {
                this.data.splice(index, 1);
            }
        }
    }
</script>
