import Vue from 'vue'
import store from '~/store'
import Meta from 'vue-meta'
import Router from 'vue-router'
import { sync } from 'vuex-router-sync'
import basic from '~/layouts/basic'
import {getLabelRoute} from '~/utils'
Vue.use(Meta)
Vue.use(Router)

// The middleware for every page of the application.
const globalMiddleware = [ 'check-auth']

// Load middleware modules dynamically.
const routeMiddleware = resolveMiddleware(
    require.context('~/middleware', false, /.*\.js$/)
)
export const constantRoutes=  [
    {
        path: '/',
        component: basic,
        redirect: '/admin/admin/index1',
        children: [
            {
                path: '/admin/admin/index1',
                name: '首页',
                component: () => import('~/pages/welcome.vue').then(m => m.default || m),
                meta: { title: '首页', icon: 'el-icon-house', affix: true }
            }
        ]
    }
    // { path: '*', component: () => import(/* webpackChunkName: '' */ `~/pages/errors/404.vue`).then(m => m.default || m) }
]
const router = createRouter()

sync(store, router)

export default router


function createRouter () {
    const router = new Router({
        scrollBehavior,
        mode: 'history',
        routes:constantRoutes
    })

    router.beforeEach(beforeEach)
    router.afterEach(afterEach)

    return router
}

let isToken = true
async function beforeEach (to, from, next) {
    if(isToken){
        console.log(1223)
        const { accessedRoutes } = await store.dispatch('user/getInfo')
        console.log(accessedRoutes)
        //获取当前访问路由的标签
        const label = getLabelRoute(to.path,accessedRoutes)
        console.log(label)
        const accessRoutes = await store.dispatch(
            'permission/generateRoutes',
            {routes:accessedRoutes,label:label},
        )

        store.commit('user/SET_ACCESSEDROUTE', accessRoutes)

        accessRoutes.forEach(res=>{

            router.addRoute(res)
        })
        console.log(accessRoutes,'accessRoutes')
        isToken = false //将isToken赋为 false ，否则会一直循环，崩溃
        next({
            ...to, // next({ ...to })的目的,是保证路由添加完了再进入页面 (可以理解为重进一次)
            replace: true, // 重进一次, 不保留重复历史
        })
    }

    let components = []

    try {
        // Get the matched components and resolve them.
        components = await resolveComponents(
            router.getMatchedComponents({ ...to })
        )
    } catch (error) {
        if (/^Loading( CSS)? chunk (\d)+ failed\./.test(error.message)) {
            window.location.reload(true)
            return
        }
    }

    if (components.length === 0) {
        return next()
    }

    // Start the loading bar.
    if (components[components.length - 1].loading !== false) {
        router.app.$nextTick(() => router.app.$loading.start())
    }

    // Get the middleware for all the matched components.
    const middleware = getMiddleware(components)
    // Load async data for all the matched components.
    await asyncData(components)


    // Call each middleware.
    callMiddleware(middleware, to, from, (...args) => {
        // Set the application layout only if "next()" was called with no args.
        if (args.length === 0) {
            router.app.setLayout(components[0].layout || '')
        }

        next(...args)
    })
}

/**
 * @param  {Array} components
 * @return {Promise<void>
 */
async function asyncData (components) {
    for (let i = 0; i < components.length; i++) {
        const component = components[i]

        if (!component.asyncData) {
            continue
        }

        const dataFn = component.data

        try {
            const asyncData = await component.asyncData()

            component.data = function () {
                return {
                    ...(dataFn ? dataFn.apply(this) : {}),
                    ...asyncData
                }
            }
        } catch (e) {
            component.layout = 'error'

            console.error('Failed to load asyncData', e)
        }
    }
}

/**
 * Global after hook.
 *
 * @param {Route} to
 * @param {Route} from
 * @param {Function} next
 */
async function afterEach (to, from, next) {
    await router.app.$nextTick()

    router.app.$loading.finish()
}

/**
 * Call each middleware.
 *
 * @param {Array} middleware
 * @param {Route} to
 * @param {Route} from
 * @param {Function} next
 */
function callMiddleware (middleware, to, from, next) {
    const stack = middleware.reverse()
    const _next = (...args) => {
        // Stop if "_next" was called with an argument or the stack is empty.
        if (args.length > 0 || stack.length === 0) {
            if (args.length > 0) {
                router.app.$loading.finish()
            }

            return next(...args)
        }

        const { middleware, params } = parseMiddleware(stack.pop())
        if (typeof middleware === 'function') {
            middleware(to, from, _next, params)
        } else if (routeMiddleware[middleware]) {
            routeMiddleware[middleware](to, from, _next, params)
        } else {
            throw Error(`Undefined middleware [${middleware}]`)
        }
    }

    _next()
}

/**
 * @param  {String|Function} middleware
 * @return {Object}
 */
function parseMiddleware (middleware) {
    if (typeof middleware === 'function') {
        return { middleware }
    }

    const [name, params] = middleware.split(':')

    return { middleware: name, params }
}

/**
 * Resolve async components.
 *
 * @param  {Array} components
 * @return {Array}
 */
function resolveComponents (components) {
    return Promise.all(components.map(component => {
        return typeof component === 'function' ? component() : component
    }))
}

/**
 * Merge the the global middleware with the components middleware.
 *
 * @param  {Array} components
 * @return {Array}
 */
function getMiddleware (components) {
    const middleware = [...globalMiddleware]
    components.filter(c => c.middleware).forEach(component => {
        if (Array.isArray(component.middleware)) {
            middleware.push(...component.middleware)
        } else {
            middleware.push(component.middleware)
        }
    })

    return middleware
}

/**
 * Scroll Behavior
 *
 * @link https://router.vuejs.org/en/advanced/scroll-behavior.html
 *
 * @param  {Route} to
 * @param  {Route} from
 * @param  {Object|undefined} savedPosition
 * @return {Object}
 */
function scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
        return savedPosition
    }

    if (to.hash) {
        return { selector: to.hash }
    }

    const [component] = router.getMatchedComponents({ ...to }).slice(-1)

    if (component && component.scrollToTop === false) {
        return {}
    }

    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve({ x: 0, y: 0 })
        }, 190)
    })
}

/**
 * @param  {Object} requireContext
 * @return {Object}
 */
function resolveMiddleware (requireContext) {
    return requireContext.keys()
        .map(file =>
            [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)]
        )
        .reduce((guards, [name, guard]) => (
            { ...guards, [name]: guard.default }
        ), {})
}
