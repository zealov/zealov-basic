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
                            width="55"
                            align="center"
                            label="ID"
                        >
                        </el-table-column>
                        <el-table-column
                            prop="name"
                            :show-overflow-tooltip="true"
                            min-width="40%"
                            label="页面标题"
                        >
                        </el-table-column>
                    </el-table>
                </div>
                <div class="footer_container is-sticky-bottom">
                    <el-pagination
                        @size-change="handleSizeChange"
                        @current-change="handleCurrentChange"
                        :current-page="current_page"
                        :pager-count="total_pages"
                        :page-size="per_page"
                        layout="total, prev, pager, next, jumper"
                        :total="total"
                    ></el-pagination>
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
                        @select="selectFun"
                        @select-all="selectAllFun"
                        max-height="500px"
                    >
                        <el-table-column
                            type="selection"
                            width="55"
                            :selectable="selectable"
                        >
                            <!-- @select="selectFun"
                                  @select-all="selectAllFun" -->
                            <!-- :selectable="selectable" -->
                        </el-table-column>
                        <el-table-column
                            label="ID"
                            min-width="180px"
                            prop="id"
                            show-overflow-tooltip
                        >
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

                <!-- <div class="ala-table_foot">
                  <el-pagination @size-change="handleSizeChange"
                                 @current-change="handleCurrentChange"
                                 :current-page="currentPage"
                                 :page-sizes="[ 20, 50, 100]"
                                 :page-size="10"
                                 layout="total, sizes, prev, pager, next, jumper"
                                 :total="100">
                  </el-pagination>
                </div> -->
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
import { relationship } from "../../api/chunk";
import {entity} from "../../api/relationship";
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
            createFileForm:{
                page_id:'',
            },
            pageOptions:[],
            tableList:[],
            current_page:1,
            total: 0,
            per_page: 10,
            total_pages: 5,
        }
    },
    mounted() {
        console.log(this.id)
        this.getFileAll()
        this.getEntityList()
    },
    methods:{
        selectable(row) {
            //   return !row.show
            //   console.log(!row.status)
            return !row.status
        },
        selectFun(selection, row) {
            this.setRowIsSelect(row)
        },
        selectAllFun(selection) {
            console.log(selection)
            let isAllSelect = this.checkIsAllSelect()
            this.tableData.forEach((item) => {
                item.isSelect = isAllSelect
                this.$refs.multipleTable.toggleRowSelection(item, !isAllSelect)
                this.selectFun(selection, item)
            })
        },
        handleSelectionChange(val) {
            console.log(val)
            this.multipleSelection = val
        },
        //分页操作
        handleSizeChange(val) {
            this.current_page = val;
            this.getEntityList();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.getEntityList();
        },
        getFileAll() {
            all().then((response)=>{
                let {data} = response
                this.pageOptions = data.data
            })

        },
        createFileRelationship(){
            let createForm = {
                chunk_id:this.id,
                relationship_type:"pages",
                relationship_id:this.createFileForm.page_id,
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
                offset:this.current_page,
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
