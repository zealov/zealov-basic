import Vue from 'vue'
import store from '~/store'
import Meta from 'vue-meta'
import Router from 'vue-router'
import {sync} from 'vuex-router-sync'
import NProgress from 'nprogress' // progress bar
import basic from '~/layouts/basic'
import {getToken} from '~/utils/auth'
import {getLabelRoute} from '~/utils'
import getPageTitle from '~/utils/get-page-title'
Vue.use(Meta)
Vue.use(Router)
NProgress.configure({ showSpinner: false }) // NProgress Configuration
// The middleware for every page of the application.
const globalMiddleware = ['check-auth']

// Load middleware modules dynamically.

export const constantRoutes = [
    {
        path: '/admin/login',
        component: () => import('~/pages/login.vue').then(m => m.default || m),
        hidden: true
    },
    {
        label: 'sys',
        path: '/',
        component: basic,
        redirect: '/admin/home',
        children: [
            {
                path: '/admin/home',
                name: '首页',
                component: () => import('~/pages/welcome.vue').then(m => m.default || m),
                meta: {title: '首页', icon: 'el-icon-house', affix: true}
            }
        ]
    },
    // { path: '*', component: () => import(/* webpackChunkName: '' */ `~/pages/errors/404.vue`).then(m => m.default || m) }
]
const router = createRouter()

sync(store, router)

export default router


function createRouter() {
    const router = new Router({
        scrollBehavior: () => ({ y: 0 }),
        mode: 'history',
        routes: constantRoutes
    })

    router.beforeEach(beforeEach)
    router.afterEach(afterEach)

    return router
}

const whiteList = ['/admin/login'] // no redirect whitelist
let isToken = true

async function beforeEach(to, from, next) {
    // start progress bar
    NProgress.start()
    // set page title
    document.title = getPageTitle(to.meta.title)
    const hasToken = getToken()
    if (typeof hasToken != 'undefined') {
        console.log(to.path)
        if (to.path === '/admin/login') {
            next({path: '/admin/home'})
        } else {
            if (isToken) {
                try {
                    const {accessedRoutes} = await store.dispatch('user/getInfo')
                    console.log(2222222)
                    console.log(accessedRoutes)
                    //获取当前访问路由的标签
                    const label = getLabelRoute(to.path, accessedRoutes)
                    console.log(label)
                    const accessRoutes = await store.dispatch(
                        'permission/generateRoutes',
                        {routes: accessedRoutes, label: label},
                    )
                    console.log(333333)
                    store.commit('user/SET_ACCESSEDROUTE', accessRoutes)

                    accessRoutes.forEach(res => {

                        router.addRoute(res)
                    })
                    console.log(accessRoutes, 'accessRoutes')
                    isToken = false //将isToken赋为 false ，否则会一直循环，崩溃
                    next({
                        ...to, // next({ ...to })的目的,是保证路由添加完了再进入页面 (可以理解为重进一次)
                        replace: true, // 重进一次, 不保留重复历史
                    })
                } catch (error) {
                    console.log(error)
                    console.log(12321323)
                    // Message.error(error || 'Has Error')
                    next(`/admin/login?redirect=${to.path}`)
                }
            } else {
                next()
            }

        }
    } else {
        if (whiteList.indexOf(to.path) !== -1) {
            // in the free login whitelist, go directly
            next()
        } else {
            // other pages that do not have permission to access are redirected to the login page.
            next(`/admin/login?redirect=${to.path}`)
            NProgress.done()
        }
    }
}

async function afterEach(to, from, next) {
    await router.app.$nextTick()

    // router.app.$loading.finish()
}

