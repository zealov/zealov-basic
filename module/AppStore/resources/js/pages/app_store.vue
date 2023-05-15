<template>
    <div class="content_container" style="margin: 5px">
        <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane name="appstore" label="模块市场">
            </el-tab-pane>
            <el-tab-pane name="installed" label="已安装">
            </el-tab-pane>
            <el-tab-pane name="enabled" label="已启用">
            </el-tab-pane>
            <el-tab-pane name="disabled" label="已禁用">
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>


export default {
    data() {
        return {
            activeName: 'appstore'
        }
    },
    created() {

    },
    methods: {
        handleClick(tab, event) {
            console.log(tab, event);
        }

    }
}
</script>
