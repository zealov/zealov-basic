<template>
    <div>
        <el-scrollbar>
            <div class="container" style="padding-top: 0; padding-bottom: 0">
                <div class="header_container is-sticky-top">
                    <div class="left">
                        <el-button
                            size="small"
                            type="primary"
                        ><i class="el-icon-s-operation"></i> 绑定分类</el-button>
                        <el-button size="small" type="primary"
                        ><i class="el-icon-s-operation"></i>添加单个文章</el-button>
                    </div>
                    <div class="right">

                    </div>
                </div>
            </div>
        </el-scrollbar>
    </div>
</template>
<script>
export default {
    props: {
        id: {
            type: Number,
            default: 1,
        },
    },
    mounted() {
        console.log(this.id)
    },
}
</script>
