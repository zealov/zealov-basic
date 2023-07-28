<template>
    <div class="content_container">
        <el-tabs v-model="activeTab"
                 class="tabs fixed-top">
            <el-tab-pane label="模块列表"
                         name="basic">

            </el-tab-pane>
            <el-tab-pane v-for="chunk in chunks"
                         :key="chunk.id"
                         :label="chunk.name"
                         :name="chunk.id+chunk.name">
                <template v-if="chunk.type == 'posts'">
                    <Post :id="chunk.id" v-if="activeTab ==chunk.id+chunk.name "></Post>
                </template>
                <template v-if="chunk.type == 'pages'">
                    <Page :id="chunk.id" v-if="activeTab ==chunk.id+chunk.name "></Page>
                </template>
                <template v-if="chunk.type == 'files'">
                    <File :id="chunk.id" v-if="activeTab ==chunk.id+chunk.name "></File>
                </template>
            </el-tab-pane>
        </el-tabs>
        <!-- 添加chunk -->
        <el-button size="small"
                   type="text"
                   class="topic-add-button"
                   @click="addDialog = true"><i class="el-icon-plus"></i></el-button>
        <!-- 添加block -->
        <el-dialog :visible.sync="addDialog"
                   width="560px"
                   custom-class="dialog_tc"
                   :close-on-click-modal="false">
            <el-form :model="createChunkForm"
                     label-width="80px">
                <el-form-item label="名称" required>
                    <el-input v-model="createChunkForm.name"
                              placeholder="请输入名称"></el-input>
                </el-form-item>
                <el-form-item label="类型">
                    <el-select v-model="createChunkForm.type">
                        <el-option v-for="item in typeList"
                                   :key="item.key"
                                   :label="item.value"
                                   :value="item.key">
                        </el-option>
                    </el-select>
                </el-form-item>
            </el-form>
            <template #footer>
        <span class="dialog-footer">
          <el-button @click="addDialog = false">取 消</el-button>
          <el-button type="primary"
                     @click="createChunk()">确 定</el-button>
        </span>
            </template>
        </el-dialog>
    </div>
</template>
<script>
import {show} from "../../api/navigation";
import {type,store} from "../../api/chunk";
import Post from '../chunk/post'
import Page from '../chunk/page'
import File from '../chunk/file'
export default {
    data(){
        return {
            navigation_id:'',
            activeTab:'basic',
            addDialog:false,
            chunks:[],
            typeList:[],
            createChunkForm:{
                name:'',
                type:'',
                subject_type:'navigations',
                subject_id:'',
            }
        }

    },
    mounted() {
        this.navigation_id =this.createChunkForm.subject_id = this.$route.params.id
        this.getChunk(this.navigation_id)
        this.getTypeList()
    },
    components: {
        Post,
        Page,
        File,
    },
    methods: {
        getChunk(id) {
            this.updateError = {};
            show(id).then((response) => {
                const {data} = response;
                this.chunks = data.chunk
            });
        },
        getTypeList(){
            type().then((response) => {
                const {data} = response;
                this.typeList = data.data
            });
        },
        createChunk(){
            store(this.createChunkForm).then((response)=>{
                this.$message({
                    message: response.message,
                    type: "success",
                });
                this.addDialog = false
                this.getChunk(this.navigation_id)
            })
        }
    }
}
</script>
