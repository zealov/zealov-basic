<template>
    <div class="content_container no-bg">
        <el-scrollbar>
            <div class="container" style="padding-top: 0; padding-bottom: 0">
                <!-- 头部 -->
                <div class="header_container is-sticky-top">
                    <div class="left">
                        <el-button
                            size="small"
                            type="primary"
                            @click="createPost"
                        ><i class="el-icon-plus"></i> 添加文章
                        </el-button
                        >
                    </div>
                    <div class="right">
                        <div class="filter">
                            <el-form :inline="true" size="small">
                                <el-form-item>
                                    <el-input
                                        placeholder="请输入文章标题"
                                        v-model="filter.keywords"
                                        clearable
                                    >
                                    </el-input>
                                </el-form-item>
                                <el-form-item>
                                    <el-button size="small" @click="getList()"
                                    ><i class="el-icon-search"></i
                                    ></el-button>
                                </el-form-item>
                            </el-form>
                        </div>
                    </div>
                </div>
                <!-- 列表 -->
                <div class="table-list" v-loading="loadingTable">
                    <el-table :data="tableData" >
                        <el-table-column
                            prop="id"
                            :show-overflow-tooltip="true"
                            width="100"
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
                        <el-table-column
                            prop="created_at"
                            :show-overflow-tooltip="true"
                            min-width="15%"
                            sortable
                            align="center"
                            label="创建时间"
                        >
                        </el-table-column>
                        <el-table-column
                            prop="label"
                            :show-overflow-tooltip="true"
                            min-width="15%"
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
                        <el-table-column
                            prop="label"
                            :show-overflow-tooltip="true"
                            min-width="15%"
                            align="center"
                            label="状态"
                        >
                            <template slot-scope="scope">
                                <el-tag
                                    v-if="scope.row.pinned == 2"
                                    type="success"
                                    size="small"
                                    style="margin: 0 3px"
                                >已置顶</el-tag>
                                <el-tag v-else type="info" size="small" style="margin: 0 3px">未置顶</el-tag>
                            </template>
                        </el-table-column>
                        <el-table-column
                            align="center"
                            label="操作"
                            width="280"
                        >
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

        </el-scrollbar>
    </div>
</template>
<script>
import {index,destroy} from '../../api/post'

export default {
    data() {
        return {
            filter: {
                keywords: '',
            },
            loadingTable:false,
            total: 0,
            offset: 1,
            limit: 15,
            total_pages: 5,
            tableData:[
            ]
        }
    },
    mounted() {
        this.getList();
    },
    methods: {
        createPost(){
            this.$router.push({name:'blog.post.create'})
        },
        getList(){
            const request = {
                offset: this.offset,
                limit: this.limit,
                order: 'descending',
            }
            index(request).then(res=>{
                this.tableData = res.data.data;
                this.total = res.data.total;
            })
        },
        //编辑跳转
        redirectEdit(id) {
            this.$router.push({ path: "/admin/blog/post_edit/"+id});
        },
        deletePost(id){
            this.$confirm('此操作将永久删除该文章, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                destroy(id).then(res=>{
                    this.$message({
                        type: 'success',
                        message: res.message
                    });
                    this.getList();
                })

            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消删除'
                });
            });
        },
        //分页操作
        handleSizeChange(val) {
            this.offset = val;
            this.getList();
        },
        handleCurrentChange(val) {
            this.offset = val;
            this.getList();
        },
    }
}
</script>
