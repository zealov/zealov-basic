import axios from 'axios'
import Cookies from 'js-cookie'

// state
export const state = {
    user: null,
    token: Cookies.get('token'),
    role: null
}

// getters
export const getters = {
    user: state => state.user,
    token: state => state.token,
    check: state => state.user !== null,
    role: state => state.role
}

// mutations
export const mutations = {
    SAVE_TOKEN(state, {
        token,
        remember
    }) {
        state.token = token
        Cookies.set('token', token, {expires: remember ? 365 : 7})
    },
    SAVE_ROLE(state, {
        role,
        remember
    }) {
        state.role = role
        Cookies.set('role', role, {expires: remember ? 365 : 7})
    },

    FETCH_USER_SUCCESS(state, {user}) {
        state.user = user
    },

    FETCH_USER_FAILURE(state) {
        state.token = null
        Cookies.remove('token')
    },

    LOGOUT(state) {
        state.user = null
        state.token = null

        Cookies.remove('token')
    },

    UPDATE_USER(state, {user}) {
        state.user = user
    }
}

// actions
export const actions = {
    saveToken({
                  commit,
                  dispatch
              }, payload) {

        commit(SAVE_TOKEN, payload)
    },
    saveRole({commit,dispatch}, payload) {

        commit(SAVE_ROLE, payload)

    },

    async fetchUser({commit}) {
        try {
            await axios.get('/api/user').then(response => {
                commit(FETCH_USER_SUCCESS, {user: response.data.data})
                commit(SAVE_ROLE, {role: response.data.data.role})
            })
        } catch (e) {
            commit(FETCH_USER_FAILURE)
        }
    },

    updateUser({commit}, payload) {
        commit(UPDATE_USER, payload)
    },

    async logout({commit}) {
        try {
            await axios.post('/api/logout')
        } catch (e) {
        }

        commit(LOGOUT)
    },

    async fetchOauthUrl(ctx, {provider}) {
        const {data} = await axios.post(`/api/oauth/${provider}`)

        return data.url
    }
}
