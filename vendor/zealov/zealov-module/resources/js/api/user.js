import request from '~/utils/request'

export function login(data) {
  return request({
    url: '/login',
    method: 'post',
    data
  })
}

export function jaccountLogin(data) {
  return request({
    url: '/jaccountLogin',
    method: 'post',
    data
  })
}

export function getInfo(data) {
  return request({
    url: '/me',
    method: 'post',
    data
  })
}

export function logout() {
  return request({
    url: '/logout',
    method: 'post'
  })
}

export function jaccountLogout(data) {
  return request({
    url: '/jaccountLoginOut',
    method: 'post',
    data
  })
}

export function refresh() {
  return request({
    url: '/refresh',
    method: 'post'
  })
}

export function users(data) {
  return request({
    url: '/users',
    method: 'post',
    data
  })
}

export function user(data) {
  return request({
    url: '/user',
    method: 'post',
    data
  })
}

export function deleted(data) {
  return request({
    url: '/user/delete',
    method: 'post',
    data
  })
}

export function create(data) {
  return request({
    url: '/user/create',
    method: 'post',
    data
  })
}

export function update(data) {
  return request({
    url: '/user/update',
    method: 'post',
    data
  })
}
export function captcha (data) {
    return request({
        url: '/captcha',
        method: 'post',
        data
    })
}
