<template>
    <div class="content_container no-bg">
        <el-scrollbar>
            11111111

        </el-scrollbar>
    </div>
</template>
<script>


import {getInfo} from '~/api/user'

export default {
    layout: 'basic',
    data() {
        return {
            data: {

            },
            isCollapse: true

        }
    },
    mounted() {
    },
    methods: {
    }
}
</script>
<style>
.el-menu-vertical-demo:not(.el-menu--collapse) {
    width: 200px;
    min-height: 400px;
}
</style>
