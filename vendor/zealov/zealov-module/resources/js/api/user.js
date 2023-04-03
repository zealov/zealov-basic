import request from '~/utils/request'

export function login(data) {
  return request({
    url: '/login',
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


export function captcha (data) {
    return request({
        url: '/captcha',
        method: 'post',
        data
    })
}
