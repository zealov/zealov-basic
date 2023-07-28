<template>
    <div class="content_container no-bg">
        <el-scrollbar>
            <div class="container" style="padding-top: 0; padding-bottom: 0">
                <div class="header_container is-sticky-top">
                    <div class="left">
                        <el-button
                            size="small"
                            type="primary"
                            @click="SelectFileDialog = true"
                        ><i class="el-icon-s-operation"></i>选择文件</el-button>
                    </div>
                    <div class="right">

                    </div>
                </div>
                <div class="table-list">
                    <el-table :data="tableList">
                        <el-table-column
                            prop="id"
                            :show-overflow-tooltip="true"
                            width="100"
                            align="center"
                            label="ID"
                        >
                        </el-table-column>
                        <el-table-column
                            align="center"
                            label="缩略图"
                            prop="path"
                            width="120"
                        >
                            <template slot-scope="scope">
                                <img
                                    v-if="scope.row.path"
                                    :src="scope.row.path"
                                    class="thumbImg"
                                />
                                <img v-else src="images/demo.jpg" class="thumbImg" />
                            </template>
                        </el-table-column>

                        <el-table-column
                            prop="name"
                            :show-overflow-tooltip="true"
                            min-width="30%"
                            label="名称"
                        ><template slot-scope="scope">
                            <el-link
                                :href="complete(scope.row.path)"
                                target="_blank"
                                type="primary"
                            >
                                {{ scope.row.name }}
                            </el-link>
                        </template>
                        </el-table-column>
                        <el-table-column
                            align="center"
                            :show-overflow-tooltip="true"
                            label="大小"
                            prop="size"
                            min-width="90"
                        >
                            <template slot-scope="scope">
                                {{ toFormatSize(scope.row.size) }}
                            </template>
                        </el-table-column>
                        <el-table-column
                            prop="created_at"
                            :show-overflow-tooltip="true"
                            min-width="90"
                            sortable
                            align="center"
                            label="创建时间"
                        >
                        </el-table-column>
                        <el-table-column
                            prop="label"
                            :show-overflow-tooltip="true"
                            min-width="90"
                            align="center"
                            label="状态"
                        >
                            <template slot-scope="scope">
                                <el-tag
                                    v-if="scope.row.published == 1"
                                    type="success"
                                    size="small"
                                    style="margin: 0 3px"
                                >已发布</el-tag>
                                <el-tag v-else type="info" size="small" style="margin: 0 3px">未发布</el-tag>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="操作" width="130">
                            <template slot-scope="scope">
                                <el-button
                                    size="mini"
                                    type="primary"
                                    @click="removeRelationship(scope.row)"
                                >移除</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </el-scrollbar>
        <!-- 选择页面 -->
        <el-dialog
            :visible.sync="SelectFileDialog"
            width="1200px"
            custom-class="dialog_tc"
            :close-on-click-modal="false"
        >
            <div class="table-list">
                <div
                    style="height:500px"
                >
                    <el-table
                        ref="multipleTable"
                        v-loading="listLoading"
                        :data="tableData"
                        element-loading-text="Loading"
                        fit
                        highlight-current-row
                        row-key="id"
                        default-expand-all
                        :tree-props="{children: 'children', hasChildren: 'hasChildren'}"
                        @selection-change="handleSelectionChange"
                        max-height="500px"
                    >
                        <el-table-column
                            type="selection"
                            width="55"
                            :selectable="selectable"
                        >
                        </el-table-column>
                        <el-table-column
                            prop="id"
                            :show-overflow-tooltip="true"
                            width="100"
                            align="center"
                            label="ID"
                        >
                        </el-table-column>
                        <el-table-column
                            align="center"
                            label="缩略图"
                            prop="path"
                            width="180"
                        >
                            <template slot-scope="scope">
                                <img
                                    v-if="scope.row.path"
                                    :src="scope.row.path"
                                    class="thumbImg"
                                />
                                <img v-else src="images/demo.jpg" class="thumbImg" />
                            </template>
                        </el-table-column>

                        <el-table-column
                            prop="name"
                            :show-overflow-tooltip="true"
                            min-width="30%"
                            label="名称"
                        ><template slot-scope="scope">
                            <el-link
                                :href="complete(scope.row.path)"
                                target="_blank"
                                type="primary"
                            >
                                {{ scope.row.name }}
                            </el-link>
                        </template>
                        </el-table-column>
                        <el-table-column
                            align="center"
                            :show-overflow-tooltip="true"
                            label="大小"
                            prop="size"
                            min-width="90"
                        >
                            <template slot-scope="scope">
                                {{ toFormatSize(scope.row.size) }}
                            </template>
                        </el-table-column>
                        <el-table-column
                            prop="created_at"
                            :show-overflow-tooltip="true"
                            min-width="90"
                            sortable
                            align="center"
                            label="创建时间"
                        >
                        </el-table-column>
                        <el-table-column
                            prop="label"
                            :show-overflow-tooltip="true"
                            min-width="90"
                            align="center"
                            label="状态"
                        >
                            <template slot-scope="scope">
                                <el-tag
                                    v-if="scope.row.published == 1"
                                    type="success"
                                    size="small"
                                    style="margin: 0 3px"
                                >已发布</el-tag>
                                <el-tag v-else type="info" size="small" style="margin: 0 3px">未发布</el-tag>
                            </template>
                        </el-table-column>

                        <!-- 空状态 -->
                        <div
                            slot="empty"
                            class="empty-wrap"
                        >
                            <div class="empty-panel">
                                <div class="img-box">
                                    <img
                                        src="/images/empty.png"
                                        alt=""
                                    >
                                </div>
                                <div class="info">暂无内容~</div>
                            </div>
                        </div>
                    </el-table>
                </div>

                <!-- 分页 -->
                <div class="footer_container is-sticky-bottom">
                    <el-pagination
                        @size-change="handleSizeChange"
                        @current-change="handleCurrentChange"
                        :current-page="offset"
                        :pager-count="total_pages"
                        :page-size="limit"
                        layout="total, prev, pager, next, jumper"
                        :total="total"
                    ></el-pagination>
                </div>
            </div>
            <template #footer>
        <span class="dialog-footer">
          <el-button @click="SelectFileDialog = false">取 消</el-button>
          <el-button type="primary" @click="createFileRelationship()">确 定</el-button>
        </span>
            </template>
        </el-dialog>
    </div>
</template>
<script>
import { all } from "../../api/page";
import {index} from "../../api/file";
import { relationship } from "../../api/chunk";
import {entity,remove} from "../../api/relationship";
import {getBaseApi, getBaseHost,formatSize} from "@/utils/index";
export default {
    props: {
        id: {
            type: Number,
            default: 1,
        },
    },
    data(){
        return {

            listLoading: false,
            tableData:[],
            multipleSelection: [],
            SelectFileDialog:false,
            pageOptions:[],
            tableList:[],
            offset:1,
            total: 0,
            limit: 10,
            total_pages: 5,
        }
    },
    mounted() {
        console.log(this.id)
        this.getFileList()
        this.getEntityList()
    },
    methods:{
        removeRelationship(data){
            let requestData = {
                subject_type:'chunks',
                subject_id:this.id,
                relationship_type:'files',
                relationship_id:data.id,
            }
            remove(requestData).then((response)=>{
                this.$message({
                    message: response.message,
                    type: "success",
                });
                this.getEntityList()
            })
        },
        toFormatSize(size){
          return formatSize(size)
        },
        complete(path){
            return  getBaseHost() + path;
        },
        selectable(row) {
            //   return !row.show
            //   console.log(!row.status)
            return !row.status
        },
        handleSelectionChange(val) {
            this.multipleSelection = val
        },
        //分页操作
        handleSizeChange(val) {
            this.offset = val;
            this.getFileList();
        },
        handleCurrentChange(val) {
            this.offset = val;
            this.getFileList();
        },
        getFileList() {
            const request = {
                offset: this.offset,
                limit: this.limit,
                order: 'descending',
            }
            index(request).then((response)=>{
                let {data} = response
                this.tableData = data.data
            })

        },
        createFileRelationship(){
            console.log(this.multipleSelection)
            let relationship_ids = []
            this.multipleSelection.forEach(item=>{
                 relationship_ids.push(item.id)
            })
            let createForm = {
                chunk_id:this.id,
                relationship_type:"files",
                relationship_id:relationship_ids.join(','),
            }
            relationship(createForm).then((response)=>{
                this.$message({
                    message: response.message,
                    type: "success",
                });
                this.SelectFileDialog=false
                this.getEntityList()
            })
        },
        getEntityList(){
            let requestData = {
                limit:this.per_page,
                offset:this.offset,
                subject_type:'chunks',
                subject_id:this.id,
            }
            entity(requestData).then((response)=>{
                let {data} = response
                this.tableList = data.data
                this.total = data.total
                console.log(response)
            })
        }
    }
}
</script>
