<template>
    <div class="content_container">
        <el-scrollbar>
            <div class="container" style="padding-top: 0">
                <div class="header_container is-sticky-top">
                    <div class="left">
                        <el-button
                            size="small"
                            type="primary"
                            @click="createFileVisible = true"
                        ><i class="el-icon-plus"></i> 添加文件
                        </el-button
                        >
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
                            min-width="40%"
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
                            sortable
                            min-width="90"
                            align="center"
                            label="创建时间"
                        >
                        </el-table-column>
                        <el-table-column
                            prop="label"
                            :show-overflow-tooltip="true"
                            align="center"
                            min-width="90"
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
                            align="center"
                            label="操作"
                            width="280"
                        >
                            <template slot-scope="scope">
                                <!-- 编辑 -->
                                <el-button
                                    type="text"
                                    title="编辑"
                                    @click="handleEdit(scope.row)"
                                >
                                    <i class="el-icon-edit"></i>
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
        <!-- 添加文件 -->
        <el-dialog
            custom-class="dialog_tc"
            title="添加"
            :visible.sync="createFileVisible"
            width="560px"
            :close-on-click-modal="false"
        >
            <el-form
                ref="createForm"
                :model="createFileForm"
                label-width="80px"
                size="medium"
            >
                <el-form-item
                    label="图片"
                    class="upload_thumb"
                    prop="path"
                >
                    <el-upload
                        class="uploadThumbImg"
                        :headers="headers"
                        :action="action"
                        :show-file-list="false"
                        :on-success="successUpload"
                        :before-upload="beforeUpload"
                        :data="uploadData"
                    >
                        <img
                            v-if="createFileForm.path"
                            :src="imageUrlPreview"
                            class="thumb"
                        />
                        <i v-else class="el-icon-plus"></i>
                    </el-upload>
                    <div class="el-upload__tip">
                        支持JPG/PNG格式，
                        <br/>图片大小不超过10MB
                    </div>
                </el-form-item>
                <el-form-item
                    prop="name"
                    label="名称"
                    required
                    :error="createError.name ? createError.name[0] : ''"
                >
                    <el-input
                        type="text"
                        placeholder="请输入导航名称"
                        v-model="createFileForm.name"
                    ></el-input>
                </el-form-item>
                <el-form-item
                    prop="description"
                    label="简介"
                    :error="createError.description ? createError.description[0] : ''"
                >
                    <el-input
                        type="textarea"
                        v-model="createFileForm.description"
                        placeholder="请输入简介"
                        maxlength="500"
                        show-word-limit
                        :rows="3"
                    ></el-input>
                </el-form-item>
                <el-form-item
                    prop="url"
                    label="导航网址"
                    :error="createError.url ? createError.url[0] : ''"
                >
                    <el-input
                        type="text"
                        placeholder="例：www.zealov.com"
                        v-model="createFileForm.url"
                    ></el-input>
                </el-form-item>
                <el-form-item
                    prop="published"
                    label="状态"
                    :error="createError.published ? createError.published[0] : ''"
                >
                    <el-switch
                        active-value="1"
                        inactive-value="0"
                        v-model="createFileForm.published"
                    >
                    </el-switch>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
        <el-button @click="createFileVisible = false">取消</el-button>
        <el-button
            type="primary"
            :loading="createLoading"
            @click="createFile('createForm')"
        >保存</el-button
        >
      </span>
        </el-dialog>
        <!-- 修改导航 -->
        <el-dialog
            custom-class="dialog_tc"
            title="修改"
            :visible.sync="updateFileVisible"
            width="560px"
            :close-on-click-modal="false"
        >
            <el-form
                ref="updateForm"
                :model="updateFileForm"
                label-width="80px"
                size="medium"
            >

                <el-form-item
                    label="缩略图"
                    class="upload_thumb"
                    prop="path"
                >
                    <el-upload
                        class="uploadThumbImg"
                        :headers="headers"
                        :action="action"
                        :show-file-list="false"
                        :on-success="successUploadEdit"
                        :before-upload="beforeUploadEdit"
                        :data="uploadData"
                    >
                        <img
                            v-if="updateFileForm.path"
                            :src="editImageUrlPreview"
                            class="thumb"
                        />
                        <i v-else class="el-icon-plus"></i>
                    </el-upload>
                    <div class="el-upload__tip">
                        支持JPG/PNG格式
                        <br/>图片大小不超过10MB
                    </div>
                </el-form-item>
                <el-form-item
                    prop="name"
                    label="名称"
                    required
                    :error="updateError.name ? updateError.name[0] : ''"
                >
                    <el-input
                        type="text"
                        placeholder="请输入导航名称"
                        v-model="updateFileForm.name"
                    ></el-input>
                </el-form-item>

                <el-form-item
                    prop="redirect"
                    label="导航地址"
                    :error="updateError.redirect ? updateError.redirect[0] : ''"
                >
                    <el-input
                        type="text"
                        placeholder="请输入地址"
                        v-model="updateFileForm.redirect"
                    ></el-input>
                </el-form-item>


                <el-form-item
                    prop="description"
                    label="简介"
                    :error="updateError.description ? updateError.description[0] : ''"
                >
                    <el-input
                        type="textarea"
                        v-model="updateFileForm.description"
                        placeholder="请输入简介"
                        maxlength="500"
                        show-word-limit
                        :rows="3"
                    ></el-input>
                </el-form-item>
                <el-form-item
                    prop="published"
                    label="状态"
                    :error="updateError.published ? updateError.published[0] : ''"
                >
                    <el-switch
                        :active-value="1"
                        :inactive-value="0"
                        v-model="updateFileForm.published"
                    >
                    </el-switch>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
        <el-button @click="updateFileVisible = false">取消</el-button>
        <el-button
            type="primary"
            :loading="updateLoading"
            @click="updateFile('updateForm')"
        >保存</el-button
        >
      </span>
        </el-dialog>
    </div>
</template>
<script>
import {index, store,show,update} from "../../api/file";
import {getToken} from "@/utils/auth";
import {getBaseApi, getBaseHost,formatSize} from "@/utils/index";


export default {
    data() {
        return {
            loadingTable:false,
            total: 0,
            offset: 1,
            limit: 10,
            total_pages: 5,
            expandedKeys: [],
            draggable: false,
            headers: {},
            action: "",
            uploadData: {},
            createFileVisible: false,
            updateFileVisible: false,
            loading: false,
            tableData: [],
            createLoading: false,
            updateLoading: false,
            createError: {},
            updateError: {},
            imageUrlPreview: "",
            editImageUrlPreview: "",
            createFileForm: {
                name: "",
                path: "",
                redirect:"",
                description: "",
                published: true,
                sort: 0,
            },
            updateFileForm: {
                id: "",
                name: "",
                path: "",
                redirect:"",
                description: "",
                published: true,
                sort: "",
            },
        };
    },
    mounted() {
        this.setAction();
        this.getList()
        this.setHeader()
    },
    methods: {
        toFormatSize(size){
            return formatSize(size)
        },
        complete(path){
           return  getBaseHost() + path;
        },
        handleEdit(row) {
            console.log(row)
            this.updateError = {};
            show(row.id).then((response) => {
                const {data} = response;
                this.updateFileVisible = true;
                this.updateFileForm = data;

                this.updateLoading = false;
                this.editImageUrlPreview =
                    getBaseHost() + data.path;
            });
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
        createFile(formName){
            this.createLoading = true;
            this.createError = {};
            store(this.createFileForm)
                .then((response) => {
                    this.$message({
                        message: response.message,
                        type: "success",
                    });
                    this.resetCreateForm(formName);
                    this.createFileVisible = false;
                    this.getList()
                })
                .catch((reason) => {
                    const { data } = reason;
                    if (reason.code === 422) {
                        this.createError = data;
                    }
                })
                .finally(() => {
                    this.createLoading = false;
                });
        },
        resetCreateForm(formName) {
            this.$refs[formName].resetFields();
        },
        updateFile(){
            this.updateError = {};
            this.updateLoading = true;
            update(this.updateFileForm.id, this.updateFileForm)
                .then((response) => {
                    this.$message({
                        message: response.message,
                        type: "success",
                    });
                    this.updateFileVisible = false;
                    this.getList()
                })
                .catch((reason) => {
                    const { data } = reason;
                    if (reason.code === 422) {
                        this.updateError = data;
                    }
                })
                .finally(() => {
                    this.updateLoading = false;
                });
        },
        setHeader() {
            this.headers = {
                Authorization: "Bearer " + getToken(),
            };
        },
        setAction() {
            this.action = getBaseApi() + "/blog/file/upload";
        },

        // 上传成功
        successUpload(response, file, fileList) {
            this.imageUrlPreview = getBaseHost() + response.data.path;
            this.createFileForm.size =file.size
            this.createFileForm.path = response.data.path;
        },
        beforeUpload(file) {
            const directory = "/file";
            this.uploadData.directory = directory;
            this.createFileForm.name =file.name
        },

        // 上传成功
        successUploadEdit(response, file, fileList) {
            this.editImageUrlPreview = ''
            this.editImageUrlPreview = getBaseHost() + response.data.path;
            this.updateFileForm.size =file.size
            this.updateFileForm.path = response.data.path;

        },
        beforeUploadEdit(file) {
            let directory = "/file";
            this.uploadData.directory = directory;
            this.updateFileForm.name =file.name
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
