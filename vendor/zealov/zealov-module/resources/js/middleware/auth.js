import store from '~/store'
import Cookies from 'js-cookie'
import {getToken} from '~/utils/auth'

export default async (to, from, next) => {
    const hasToken = getToken()
    console.log(hasToken, 'hasToken1')
    if (typeof hasToken == 'undefined') {
        console.log(hasToken, 'hasToken2')
        Cookies.set('intended_url', to.path)
        next({path: '/admin/login'})
    } else {
        next()
    }
}
