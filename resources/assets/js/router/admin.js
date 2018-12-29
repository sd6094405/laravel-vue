import Vue from 'vue'
import Router from 'vue-router'
import beforeEach from './beforeEach'
// import { routes as dashboard } from '../dashboard/index'

Vue.use(Router);

const App = resolve => require(['../pages/back/common/Home'], resolve);
const Login = resolve => require(['../pages/back/login'], resolve);
const DashBoard = resolve => require(['../pages/back/dashboard'], resolve);
const Article = resolve => require(['../pages/back/article/index'],resolve);
const ArticleCreate = resolve => require(['../pages/back/article/create'],resolve);
const ArticleTags = resolve => require(['../pages/back/article/tags'],resolve);
const Setting = resolve => require(['../pages/back/setting/index'],resolve);
const SettingLinks = resolve => require(['../pages/back/setting/links'],resolve);

const routes = [
    {
        path: '/',
        redirect: '/back/dashboard'
    },
    {
        path: '/back',
        redirect: '/back/dashboard'
    },
    {
        path: '/',
        name: 'App',
        component: App,
        meta: {title: '自述文件'},
        children: [
            {
                path: '/back/dashboard',
                name: 'dashboard',
                component: DashBoard,
                meta: {title: '系统首页'}
            },
            {
                path: '/back/article',
                name: 'article',
                component: Article,
                meta: {title: '文章管理'}
            },
            {
                path: '/back/article/create',
                name: 'articleCreate',
                component: ArticleCreate,
                meta: {title: '新文章'}
            },
            {
                path: '/back/article/tags',
                name: 'articleTags',
                component: ArticleTags,
                meta: {title: '标签管理'}
            },
            {
                path: '/back/setting',
                name: 'Setting',
                component: Setting,
                meta: {title: '系统设置'}
            },
            {
                path: '/back/setting/links',
                name: 'SettingLinks',
                component: SettingLinks,
                meta: {title: '友链管理'}
            },
        ]
    },
    {
        path: '/back/login',
        name: 'login',
        component: Login,
        meta: {title: '登录'}
    }

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