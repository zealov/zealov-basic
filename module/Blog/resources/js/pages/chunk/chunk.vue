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
                                    @click="redirectEdit(scope.row.id)"
                                >
                                    <i class="el-icon-edit"></i>
                                </el-button>
                                <!-- 删除 -->
                                <el-button
                                    type="text"
                                    title="删除"
                                    @click="deletePost(scope.row.id)"
                                >
                                    <i class="el-icon-delete"></i>
                                </el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </el-scrollbar>

    </div>
</template>
<script>

import {show} from "../../api/navigation";
import {type} from "../../api/chunk"
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
            tableList:[],
            typeOptions:[]
        }
    },
    mounted() {
        this.getTypeList()
        console.log(this.id)
        show(this.id).then(response=>{
            this.tableList = response.data.chunk
        })
    },
    methods:{
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
        }

    }
}
</script>
