import Vue from 'vue'
import Router from 'vue-router'
import beforeEach from './beforeEach'
// import { routes as dashboard } from '../dashboard/index'

Vue.use(Router);

const App = resolve => require(['../pages/home/common/Home'], resolve);
const Article = resolve => require(['../pages/home/article/index'], resolve);
const ArticleShow = resolve => require(['../pages/home/article/show'], resolve);
const Category = resolve => require(['../pages/home/category/index'], resolve);

const routes = [
    {
        path: '/',
        redirect: '/index'
    },
    {
        path: '/',
        name: 'App',
        component: App,
        meta: {title: '自述文件'},
        children: [
            {
                path: '/index',
                name: 'index',
                component: Article,
                meta: {title: '首页'}
            },
            {
                path: '/article/:article_id',
                name: 'articleShow',
                component: ArticleShow,
                meta: {title: '文章'}
            },
            {
                path: '/category/:tag_id',
                name: 'category',
                component: Category,
                meta: {title: '分类'}
            },
        ]
    },

];

const router = new Router({
    routes,
    linkActiveClass: 'active',
    linkExactActiveClass: 'active',
    mode: 'history'
    // mode: 'hash'
});
router.beforeEach(beforeEach);

export default router