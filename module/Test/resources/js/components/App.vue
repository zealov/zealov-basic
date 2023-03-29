<template>
    <div id="app">
        <loading ref="loading"/>

        <transition name="page" mode="out-in">
            <component :is="layout" v-if="layout"/>
        </transition>
    </div>
</template>

<script>
import Loading from './loading/loading'
import getPageTitle from '~/utils/get-page-title'
// Load layout components dynamically.
const requireContext = require.context('~/layouts', false, /.*\.vue$/)

const layouts = requireContext.keys()
    .map(file =>
        [file.replace(/(^.\/)|(\.vue$)/g, ''), requireContext(file)]
    )
    .reduce((components, [name, component]) => {
        components[name] = component.default || component
        return components
    }, {})

export default {
    el: '#app',
    components: {
        Loading
    },

    data: () => ({
        layout: null,
        defaultLayout: 'default'
    }),

    metaInfo() {
        const appName = window.config.appName
        const title = getPageTitle(this.$route.meta.title,appName)
        return {
            title: title,
        }
    },

    mounted() {
        this.$loading = this.$refs.loading
    },

    methods: {
        /**
         * Set the application layout.
         *
         * @param {String} layout
         */
        setLayout(layout) {
            if (!layout || !layouts[layout]) {
                layout = this.defaultLayout
            }

            this.layout = layouts[layout]
        }
    }
}
</script>
