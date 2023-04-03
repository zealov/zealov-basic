<template>
    <div class="content_container no-bg">
        <el-scrollbar>
            welcome22222222222222222222

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
        // this.getUserInfo()
    },
    methods: {
        handleOpen(key, keyPath) {
            console.log(key, keyPath);
        },
        handleClose(key, keyPath) {
            console.log(key, keyPath);
        },
        getUserInfo() {
            getInfo().then(res => {
            })
        }
    }
}
</script>
<style>
.el-menu-vertical-demo:not(.el-menu--collapse) {
    width: 200px;
    min-height: 400px;
}
</style>
