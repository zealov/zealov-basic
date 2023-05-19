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
                                <el-button style="float: right; padding: 3px 0" type="text" @click="doInstall()">安装</el-button>
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
        <el-dialog :visible.sync="commandDialogShow"
                   :show-close="commandDialogFinish"
                   :close-on-press-escape="false"
                   :close-on-click-modal="false"
                   append-to-body>
            <div slot="title">
                <div class="ub-text-bold ub-text-primary">
                    <i class="el-icon-sort"></i>
                    {{ commandDialogTitle }}
                </div>
            </div>
            <div class="dialog-block">
                <div v-for="(msg,msgIndex) in commandDialogMsgs" v-html="msg"></div>
                <div v-if="!commandDialogFinish">
                    <i class="el-icon-loading"></i>
                    当前操作已运行 {{ commandDialogRunElapse }} s ...
                </div>
                <div v-else>
                    <i class="el-icon-circle-check"></i>
                    操作已运行完成
                </div>
            </div>
            <div class="dialog_footer" v-if="commandDialogFinish">
                <el-button type="danger" @click="commandDialogShow=false" size="mini">关闭</el-button>
            </div>
        </el-dialog>
    </div>

</template>

<script>
import {custom} from '../api/appStore'

export default {
    data() {
        return {
            activeName: 'appstore',
            commandDialogShow: false,
            commandDialogFinish: true,
            commandDialogTitle: '',
            commandDialogMsgs: [],
            commandDialogRunElapse:0
        }
    },
    mounted() {
        setInterval(() => {
            this.commandDialogRunElapse = parseInt(((new Date()).getTime() - this.commandDialogRunStart) / 1000)
        }, 1000)
    },
    methods: {
        handleClick(tab, event) {
            console.log(tab, event);
        },
        doInstall() {
            let module={
                name:'blog',
                title:'Blog简约主题',
                latestVersion:'1.2.2',
                _isLocal:false
            }
            this.doCommand('install', {
                module: module.name,
                version: module.latestVersion,
                isLocal: module._isLocal
            }, null, `安装模块 ${module.title}（${module.name}） V${module.latestVersion}`)
        },
        doCommand(command, data, step, title) {
            step = step || null
            title = title || null
            if (null === step) {
                this.commandDialogMsgs = []
                this.commandDialogShow = true
                this.commandDialogFinish = false
            }
            if (title) {
                this.commandDialogTitle = title
                this.commandDialogMsgs.push('<i class="el-icon-minus"></i> ' + title)
            }
            this.commandDialogRunStart = (new Date()).getTime()
            this.commandDialogRunElapse = 0
            custom(command,{
                token: this.storeApiToken,
                step: step,
                data: JSON.stringify(data)
            }).then(res=>{
                console.log(res,'res')
                if (Array.isArray(res.data.msg)) {
                    this.commandDialogMsgs = this.commandDialogMsgs.concat(res.data.msg)
                } else {
                    this.commandDialogMsgs.push(res.data.msg)
                }
                if (res.data.finish) {
                    this.commandDialogFinish = true
                    this.doLoad()
                    return
                } else {
                    setTimeout(() => {
                        this.doCommand(res.data.command, res.data.data, res.data.step)
                    }, 1000)
                }
            }).catch(res=>{
                this.commandDialogMsgs.push('<i class="iconfont icon-close ub-text-danger"></i> <span class="ub-text-danger">' + res.msg + '</span>')
                this.commandDialogFinish = true
                return true
            })

        },

    },
    doLoad() {

    },
}
</script>
