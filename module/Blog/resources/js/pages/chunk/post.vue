<template>
    <div class="content_container no-bg">
        <el-scrollbar>
            <div class="container" style="padding-top: 0; padding-bottom: 0">
                <div class="header_container is-sticky-top">
                    <div class="left">
                        <el-button
                            size="small"
                            type="primary"
                            @click="CreateCategoryDialog = true"
                        ><i class="el-icon-s-operation"></i>按分类添加</el-button>
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
                            label="文章标题"
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
        <!-- 绑定分类 -->
        <el-dialog
            :visible.sync="CreateCategoryDialog"
            width="560px"
            custom-class="dialog_tc"
            :close-on-click-modal="false"
        >
            <el-form :model="createCategoryForm">
                <el-form-item required >
                    <el-cascader
                        v-model="createCategoryForm.categories"
                        :options="categoryOptions"
                        clearable
                        filterable
                        :props="{
                              expandTrigger: 'click',
                              label: 'name',
                              checkStrictly: true,
                              value: 'id',
                            }"
                        placeholder="请选择分类"
                    >
                    </el-cascader>
                </el-form-item>
            </el-form>
            <template #footer>
        <span class="dialog-footer">
          <el-button @click="CreateCategoryDialog = false">取 消</el-button>
          <el-button type="primary" @click="createCategoryRelationship()">确 定</el-button>
        </span>
            </template>
        </el-dialog>
    </div>
</template>
<script>
import { category } from "../../api/category";
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
            CreateCategoryDialog:false,
            createCategoryForm:{
                categories:'',
            },
            categoryOptions:[],
            tableList:[],
            current_page:1,
            total: 0,
            per_page: 10,
            total_pages: 5,
        }
    },
    mounted() {
        console.log(this.id)
        this.getCategoryList()
        this.getEntityList()
    },
    methods:{
        //分页操作
        handleSizeChange(val) {
            this.current_page = val;
            this.getEntityList();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.getEntityList();
        },
        getCategoryList() {
            category().then((response)=>{
                let {data} = response
                this.categoryOptions = data.category
            })

        },
        createCategoryRelationship(){
            let createForm = {
                chunk_id:this.id,
                relationship_type:"categories",
                relationship_id:this.createCategoryForm.categories.slice(-1)[0],
            }
            relationship(createForm).then((response)=>{
                this.$message({
                    message: response.message,
                    type: "success",
                });
                this.CreateCategoryDialog=false
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
