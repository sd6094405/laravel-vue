import Vue from 'vue'
import Router from 'vue-router'
import beforeEach from './beforeEach'
// import { routes as dashboard } from '../dashboard/index'

Vue.use(Router);

const App = resolve => require(['../admin'], resolve);
const Index = resolve => require(['../pages/back/dashboard'], resolve);

const Article = resolve => require(['../pages/back/article/index'], resolve);
const ArticleCreate = resolve => require(['../pages/back/article/create'], resolve);


const routes = [
    {
        path: '/', name: 'App', component: App, redirect: {name: 'home'}
        // children: [
        //     {
        //         // 当 /user/:id/profile 匹配成功，
        //         // UserProfile 会被渲染在 User 的 <router-view> 中
        //         path: '/index',
        //         name:'index',
        //         component: Index,
        //         meta: {title: '首页'}
        //     }
        // ]
    },
    {path: '/back/index', name: 'home', component: Index, meta: {title: '首页'}},
    {path: '/back/article', name: 'article', component: Article, meta: {title: '文章列表'}},
    {path: '/back/article/create', name: 'articleCreate', component: ArticleCreate, meta: {title: '新文章'}},

    // {path: '/article/:article_id', name: 'article', component: Article, meta: {title: '文章'}},
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