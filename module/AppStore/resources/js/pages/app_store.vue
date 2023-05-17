<template>
    <div class="content_container" style="margin: 5px">
        <div class="tabs">
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
        <div class="app_store_black">
            <el-row :gutter="20">
                <el-col :span="7">
                    <div class="grid-content bg-purple">
                        <el-card class="box-card">
                            <div slot="header" class="clearfix">
                                <span>Blog简约主题</span>
                                <el-button style="float: right; padding: 3px 0" type="text">安装</el-button>
                            </div>
                            <el-row :gutter="5">
                                <el-col :span="6">
                                    <div class="card_item_img">
                                        <img
                                            src="https://ms-assets.modstart.com/data/image/2022/07/06/12507_zlyy_1885.png"
                                            class="image">
                                    </div>
                                </el-col>
                                <el-col :span="18">
                                    <div>
                                        <div><span class="red p-5">￥49.90</span></div>
                                        <div class="desc d6 p-5">提供纯白的简约博客主题</div>
                                        <div class="desc d6 p-5">版本：V1.2.2</div>
                                    </div>
                                </el-col>
                            </el-row>
                            <el-divider></el-divider>
                            <div>
                                <el-button type="primary" icon="el-icon-plus" plain size="mini">其他版本</el-button>
                            </div>
                        </el-card>
                    </div>
                </el-col>

            </el-row>
        </div>

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
