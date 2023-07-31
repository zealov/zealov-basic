<template>
    <div class="content_container no-bg">
        <el-scrollbar>
            <div class="container" style="padding-top: 0; padding-bottom: 0">
                <div class="header_container is-sticky-top">
                    <div class="left">
                        <el-button
                            size="small"
                            type="primary"
                            @click="createChunkDialog = true"
                        ><i class="el-icon-plus"></i> 添加模块</el-button>
                    </div>
                    <div class="right">

                    </div>
                </div>
                <div class="table-list">
                    <el-table :data="tableList">
                        <el-table-column
                            prop="id"
                            :show-overflow-tooltip="true"
                            width="80"
                            align="center"
                            label="ID"
                        >
                        </el-table-column>
                        <el-table-column
                            prop="name"
                            :show-overflow-tooltip="true"
                            min-width="90"
                            label="模块名称"
                        >
                        </el-table-column>
                        <el-table-column
                            prop="type"
                            :show-overflow-tooltip="true"
                            min-width="90"
                            label="类型"
                        >
                            <template slot-scope="scope">
                                {{typeName(scope.row.type)}}
                            </template>

                        </el-table-column>
                        <el-table-column
                            prop="sort"
                            :show-overflow-tooltip="true"
                            min-width="90"
                            label="排序"
                        >
                        </el-table-column>
                        <el-table-column
                            prop="created_at"
                            :show-overflow-tooltip="true"
                            min-width="90"
                            label="创建时间"
                        >
                        </el-table-column>
                        <el-table-column align="center" label="操作" width="240">
                            <template slot-scope="scope">
                                <!-- 编辑 -->
                                <el-button
                                    type="text"
                                    title="编辑"
                                    @click="handleEdit(scope.row)"
                                >
                                    <i class="el-icon-edit"></i>
                                </el-button>
                                <!-- 删除 -->
                                <el-button
                                    type="text"
                                    title="删除"
                                    @click="handleDelete(scope.row.id)"
                                >
                                    <i class="el-icon-delete"></i>
                                </el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </el-scrollbar>
        <!-- 添加block -->
        <el-dialog :visible.sync="createChunkDialog"
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
                        <el-option v-for="item in typeOptions"
                                   :key="item.key"
                                   :label="item.value"
                                   :value="item.key">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="排序" required>
                    <el-input v-model="createChunkForm.sort"
                              placeholder="请输入排序"></el-input>
                </el-form-item>
            </el-form>
            <template #footer>
        <span class="dialog-footer">
          <el-button @click="createChunkDialog = false">取 消</el-button>
          <el-button type="primary"
                     @click="createChunk()">确 定</el-button>
        </span>
            </template>
        </el-dialog>
        <!-- 添加block -->
        <el-dialog :visible.sync="updateChunkDialog"
                   width="560px"
                   custom-class="dialog_tc"
                   :close-on-click-modal="false">
            <el-form :model="updateChunkForm"
                     label-width="80px">
                <el-form-item label="名称" required>
                    <el-input v-model="updateChunkForm.name"
                              placeholder="请输入名称"></el-input>
                </el-form-item>
                <el-form-item label="类型">
                    <el-select v-model="updateChunkForm.type" disabled>
                        <el-option v-for="item in typeOptions"
                                   :key="item.key"
                                   :label="item.value"
                                   :value="item.key">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="排序" required>
                    <el-input v-model="updateChunkForm.sort"
                              placeholder="请输入排序"></el-input>
                </el-form-item>
            </el-form>
            <template #footer>
        <span class="dialog-footer">
          <el-button @click="updateChunkDialog = false">取 消</el-button>
          <el-button type="primary"
                     @click="updateChunk()">确 定</el-button>
        </span>
            </template>
        </el-dialog>

    </div>
</template>
<script>

import {show} from "../../api/navigation";
import {store, type,update,destroy} from "../../api/chunk"
export default {
    props: {
        id: {
            type: String,
            default: '',
        },
    },
    data(){
        return {
            createChunkDialog:false,
            updateChunkDialog:false,
            tableList:[],
            typeOptions:[],
            createChunkForm:{
                name:'',
                type:'',
                sort:0,
                subject_type:'navigations',
                subject_id:'',
            },
            updateChunkForm:{
                id:'',
                name:'',
                type:'',
                sort:0,
                subject_type:'navigations',
                subject_id:'',
            }
        }
    },
    mounted() {
        this.getTypeList()
        console.log(this.id)
        this.getChunk()
    },
    methods:{
        handleEdit(row) {
            console.log(row)
            this.updateChunkForm.id = row.id
            this.updateChunkForm.name = row.name
            this.updateChunkForm.type = row.type
            this.updateChunkForm.sort = row.sort
            this.updateChunkDialog =true
        },
        handleDelete(id){
            this.$confirm('此操作将永久删除, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                destroy(id).then(res=>{
                    this.$message({
                        type: 'success',
                        message: res.message
                    });
                    this.getChunk();
                    this.changeChunk()
                })

            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消删除'
                });
            });
        },
        updateChunk(){
            update(this.updateChunkForm.id,this.updateChunkForm).then((response) => {
                this.$message({
                    message: response.message,
                    type: "success",
                });
                this.getChunk()
                this.updateChunkDialog =false
                this.changeChunk()
            });
        },
        getTypeList(){
            type().then(response=>{
                this.typeOptions = response.data.data
            })
        },
        typeName(key){
            let name = '';
            this.typeOptions.forEach(item=>{
                if(item.key == key){
                   return  name = item.value
                }
            })
            return name
        },
        createChunk(){
            this.createChunkForm.subject_id = this.id
            store(this.createChunkForm).then((response)=>{
                this.$message({
                    message: response.message,
                    type: "success",
                });
                this.createChunkDialog = false
                this.getChunk()
            })
        },
        getChunk(){
            show(this.id).then(response=>{
                this.tableList = response.data.chunk
            })
        },
        changeChunk:function(){
            this.$emit('changeChunk',this.id)//触发transfer方法，this.user 为向父组件传递的数据
        }

    }
}
</script>
