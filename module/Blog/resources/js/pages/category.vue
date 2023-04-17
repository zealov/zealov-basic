<template>
    <div class="content_container">
        <el-scrollbar>
            <div class="container" style="padding-top: 0">
                <div class="header_container is-sticky-top">
                    <div class="left">
                        <el-button
                            size="small"
                            type="primary"
                            @click="createCategoryVisible = true"
                        ><i class="el-icon-plus"></i> 添加分类
                        </el-button
                        >
                        <el-button
                            size="small"
                            type="warning"
                            @click="draggable = true"
                        ><i class="el-icon-rank"></i> 调整排序
                        </el-button
                        >
                        <el-button
                            size="small"
                            type="danger"
                            @click="saveSortData"
                            v-show="draggable == true"
                        >保存排序
                        </el-button>
                        <el-button
                            size="small"
                            type="danger"
                            plain
                            @click="draggable = false"
                            v-show="draggable == true"
                        >取消
                        </el-button
                        >
                    </div>
                </div>
                <div class="tree-list">
                    <div class="tree-header">
                        <div class="cell title">分类名称</div>
                        <div class="cell title">标 识</div>
                        <div class="cell title">状 态</div>
                        <div class="cell edit">操作</div>
                    </div>
                    <el-tree
                        :data="tableData"
                        node-key="id"
                        :draggable="draggable"
                        :allow-drop="allowDrop"
                        :default-expand-all="true"
                        icon-class="el-icon-arrow-right"
                        :default-expanded-keys="expandedKeys"
                        :class="{ 'is-drag': draggable }"
                        :expand-on-click-node="false"
                        @node-drag-start="handleDragStart"
                        @node-drag-enter="handleDragEnter"
                        @node-drag-leave="handleDragLeave"
                        @node-drag-over="handleDragOver"
                        @node-drag-end="handleDragEnd"
                        @node-drop="handleDrop"
                    >
            <span class="custom-tree-node" slot-scope="{ node, data }">
              <span class="cell title" :title="data.id">{{ data.name }}</span>
              <span class="cell title" :title="data.id">{{ data.label }}</span>
              <span class="cell title" >
                <div v-if="data.published==1">
                  <el-tag>已启用</el-tag>
                </div>
                <div v-else-if="data.published==0">
                  <el-tag type="danger">已禁用</el-tag>
                </div>
              </span>
              <span class="cell edit">
                <el-button
                    title="添加子分类"
                    type="text"
                    @click="createChildren(data)"
                >
                  <i class="el-icon-plus"></i>
                </el-button>
                <el-button
                    title="编辑"
                    type="text"
                    @click="handleEdit(data)"
                >
                  <i class="el-icon-edit"></i>
                </el-button>
                <el-button
                    title="删除"
                    type="text"
                    @click="() => handleRemove(node, data)"
                >
                  <i class="el-icon-delete"></i>
                </el-button>
              </span>
            </span>
                    </el-tree>
                </div>
            </div>
        </el-scrollbar>
        <!-- 添加分类 -->
        <el-dialog
            custom-class="dialog_tc"
            title="添加分类"
            :visible.sync="createCategoryVisible"
            width="560px"
            :close-on-click-modal="false"
        >
            <el-form
                ref="createForm"
                :model="createCategoryForm"
                label-width="80px"
                size="medium"
            >
                <el-form-item
                    label="上级分类"
                    prop="parent_id"
                    :error="createError.parent_id ? createError.parent_id[0] : ''"
                >
                    <el-cascader
                        v-model="createCategoryForm.parent_id"
                        :options="category_options"
                        clearable
                        filterable
                        :props="{
              checkStrictly: true,
              label: 'name',
              value: 'id',
              expandTrigger: 'click',
            }"
                        placeholder="请选择上级分类"
                    >
                        <template slot-scope="{ node, data }">
                            <span>{{ data.name }}</span>
                            <span v-if="!node.isLeaf"> ({{ data.children.length }}) </span>
                        </template>
                    </el-cascader>
                </el-form-item>
                <el-form-item
                    prop="name"
                    label="分类名称"
                    required
                    :error="createError.name ? createError.name[0] : ''"
                >
                    <el-input
                        type="text"
                        placeholder="请输入分类名称"
                        v-model="createCategoryForm.name"
                    ></el-input>
                </el-form-item>

                <el-form-item
                    prop="label"
                    label="分类标识"
                    required
                    :error="createError.label ? createError.label[0] : ''"
                >
                    <el-input
                        type="text"
                        placeholder="限英文字母,设定后不可修改"
                        v-model="createCategoryForm.label"
                    ></el-input>
                </el-form-item>
                <el-form-item
                    label="缩略图"
                    class="upload_thumb"
                    prop="image_path"
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
                            v-if="createCategoryForm.image_path"
                            :src="imageUrlPreview"
                            class="thumb"
                        />
                        <i v-else class="el-icon-plus"></i>
                    </el-upload>
                    <div class="el-upload__tip">
                        支持JPG/PNG格式，建议尺寸800*450px或16:9
                        <br />图片大小不超过1MB
                    </div>
                </el-form-item>

                <el-form-item
                    prop="description"
                    label="简介"
                    :error="createError.description ? createError.description[0] : ''"
                >
                    <el-input
                        type="textarea"
                        v-model="createCategoryForm.description"
                        placeholder="请输入简介"
                        maxlength="500"
                        show-word-limit
                        :rows="3"
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
                        v-model="createCategoryForm.published"
                    >
                    </el-switch>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
        <el-button @click="createCategoryVisible = false">取消</el-button>
        <el-button
            type="primary"
            :loading="createLoading"
            @click="createCategory('createForm')"
        >确定</el-button
        >
      </span>
        </el-dialog>
        <!-- 修改分类 -->
        <el-dialog
            custom-class="dialog_tc"
            title="修改分类"
            :visible.sync="updateCategoryVisible"
            width="560px"
            :close-on-click-modal="false"
        >
            <el-form
                ref="updateForm"
                :model="updateCategoryForm"
                label-width="80px"
                size="medium"
            >
                <el-form-item
                    label="上级分类"
                    prop="parent_id"
                    :error="updateError.parent_id ? updateError.parent_id[0] : ''"
                >
                    <el-cascader
                        v-model="updateCategoryForm.parent_id"
                        :options="category_options"
                        clearable
                        filterable
                        :props="{
              checkStrictly: true,
              label: 'name',
              value: 'id',
              expandTrigger: 'click',
            }"
                        placeholder="请选择上级分类"
                    >
                        <template slot-scope="{ node, data }">
                            <span>{{ data.name }}</span>
                            <span v-if="!node.isLeaf"> ({{ data.children.length }}) </span>
                        </template>
                    </el-cascader>
                </el-form-item>
                <el-form-item
                    prop="name"
                    label="分类名称"
                    required
                    :error="updateError.name ? updateError.name[0] : ''"
                >
                    <el-input
                        type="text"
                        placeholder="请输入分类名称"
                        v-model="updateCategoryForm.name"
                    ></el-input>
                </el-form-item>

                <el-form-item
                    prop="label"
                    label="分类标识"
                    required
                    :error="updateError.label ? updateError.label[0] : ''"
                >
                    <el-input
                        type="text"
                        placeholder="限英文字母,设定后不可修改"
                        v-model="updateCategoryForm.label"
                    ></el-input>
                </el-form-item>
                <el-form-item
                    label="缩略图"
                    class="upload_thumb"
                    prop="image_path"
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
                            v-if="updateCategoryForm.image_path"
                            :src="editImageUrlPreview"
                            class="thumb"
                        />
                        <i v-else class="el-icon-plus"></i>
                    </el-upload>
                    <div class="el-upload__tip">
                        支持JPG/PNG格式，建议尺寸800*450px或16:9
                        <br />图片大小不超过1MB
                    </div>
                </el-form-item>

                <el-form-item
                    prop="description"
                    label="简介"
                    :error="updateError.description ? updateError.description[0] : ''"
                >
                    <el-input
                        type="textarea"
                        v-model="updateCategoryForm.description"
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
                        v-model="updateCategoryForm.published"
                    >
                    </el-switch>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
        <el-button @click="updateCategoryVisible = false">取消</el-button>
        <el-button
            type="primary"
            :loading="updateLoading"
            @click="updateCategory('updateForm')"
        >修改</el-button
        >
      </span>
        </el-dialog>
    </div>
</template>
<script>
import { category, create, show, update, destroy,updateSort } from "../api/category";
import { getToken } from "@/utils/auth";
import {getBaseApi, getBaseHost} from "@/utils/index";
var diguiList = [];
var i = 0;
export default {
    data() {
        return {
            expandedKeys: [],
            draggable: false,
            allowDrop(draggingNode, dropNode, type) {
                if (draggingNode.level === dropNode.level) {
                    if (draggingNode.parent.id === dropNode.parent.id) {
                        // 向上拖拽 || 向下拖拽
                        return type === "prev" || type === "next";
                    }
                } else {
                    // 不同级进行处理
                    return false;
                }
            },
            headers: {},
            action: "",
            uploadData: {},
            createCategoryVisible: false,
            updateCategoryVisible: false,
            category_options: [],
            loading: false,
            tableData: [],
            createLoading: false,
            updateLoading: false,
            createError: {},
            updateError: {},
            imageUrlPreview: "",
            editImageUrlPreview: "",
            createCategoryForm: {
                name: "",
                label: "",
                parent_id: [0],
                image_path: "",
                description: "",
                published: true,
                sort: 0,
            },
            updateCategoryForm: {
                id: "",
                name: "",
                label: "",
                parent_id: "",
                image_path: "",
                description: "",
                published: "",
                sort: "",
            },
        };
    },
    mounted() {
        this.getCategory();
        this.setAction();
        this.setHeader()
    },
    methods: {
        setHeader() {
            this.headers = {
                Authorization: "Bearer " + getToken(),
            };
        },
        updateSort: function(data) {
            //递归提取现有的列表顺序
            this.diguiData(data)
            let that = this;
            let promise = new Promise(function(resolve, reject) {
                that.diguiData(data);
                resolve();
            });
            promise.then(() => {
                let params = {
                    sortData: diguiList,
                };
                updateSort(params).then((urlResult) => {
                    if (urlResult.code == 200) {
                        this.$message({
                            message: "成功",
                            type: "success", //success//warning
                        });
                    }
                });
            });
        },
        diguiData: function(data) {
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                diguiList[i] = {
                    id: element.id,
                    sort: i,
                };
                i++;
                if (element.children) {
                    this.diguiData(element.children);
                }
            }
        },
        handleRemove(node, data) {
            if (data.children != "undefined" && data.children != null) {
                this.$message({
                    type: "warning",
                    message: '该分类下存在子分类，请先删除子分类！！！',
                });
                return;
            } else {
                this.$confirm(
                    '确定要删除么？',
                    '提示',
                    {
                        confirmButtonText: "确定",
                        cancelButtonText: "取消",
                        type: "warning",
                    }
                )
                    .then(() => {
                        destroy(data.id)
                            .then(() => {
                                this.$message({
                                    type: "success",
                                    message: "删除成功!",
                                });
                                this.getCategory();
                            })
                            .catch((reason) => {
                                const { data } = reason.response;
                                if (data.code !== 200) {
                                    this.$message({
                                        type: "info",
                                        message: data.message,
                                    });
                                }
                            });
                    })
                    .catch(() => {
                        this.$message({
                            type: "info",
                            message: '取消删除',
                        });
                    });
            }
        },
        updateCategory() {
            this.updateError = {};
            this.updateLoading = true;
            const parent_id = this.updateCategoryForm.parent_id;
            if (parent_id instanceof Array) {
                this.updateCategoryForm.parent_id = parent_id.slice(-1)[0];
            }
            update(this.updateCategoryForm.id, this.updateCategoryForm)
                .then((response) => {
                    this.$message({
                        message: response.message,
                        type: "success",
                    });
                    this.updateCategoryVisible = false;
                    this.getCategory();
                })
                .catch((reason) => {
                    const { data } = reason.response;
                    if (data.code === 422) {
                        this.updateError = data.data;
                    }
                })
                .finally(() => {
                    this.updateLoading = false;
                });
        },
        handleEdit(row) {
            this.updateError = {};
            show(row.id).then((response) => {
                const { data } = response;
                this.updateCategoryVisible = true;
                this.updateCategoryForm = data;
                let parent_id = [];
                parent_id = this.parentData([], data.parent_id, this.category_options);
                this.updateCategoryForm.parent_id =
                    parent_id.length == 0 ? [0] : parent_id;
                this.updateLoading = false;
                this.editImageUrlPreview =
                    getBaseHost() + data.image_path;
            });
        },

        createChildren(data) {
            this.createCategoryVisible = true;
            let parent_id = [];
            parent_id = this.parentData([], data.id, this.category_options);
            this.createCategoryForm.parent_id =
                parent_id.length == 0 ? [0] : parent_id;
        },
        parentData(parent_id, cur, category_options) {
            category_options.forEach((element) => {
                if (cur == element.id) {
                    if (cur != 0) {
                        parent_id.unshift(element.id);
                        this.parentData(
                            parent_id,
                            element.parent_id,
                            this.category_options
                        );
                    }
                } else if (element.children instanceof Array) {
                    this.parentData(parent_id, cur, element.children);
                }
            });
            return parent_id;
        },
        //保存排序
        saveSortData: function() {
            this.draggable = false;
            this.updateSort(this.tableData);
        },
        createCategory(formName) {
            this.createLoading = true;
            this.createError = {};
            const parent_id = this.createCategoryForm.parent_id;
            if (parent_id instanceof Array) {
                this.createCategoryForm.parent_id = parent_id.slice(-1)[0];
            }
            create(this.createCategoryForm)
                .then((response) => {
                    this.$message({
                        message: response.message,
                        type: "success",
                    });
                    this.resetCreateForm(formName);
                    this.getCategory();
                    this.createCategoryVisible = false;
                })
                .catch((reason) => {
                    const { data } = reason.response;
                    if (data.code === 422) {
                        this.createError = data.data;
                    }
                })
                .finally(() => {
                    this.createLoading = false;
                });
        },
        // 上传成功
        successUpload(response, file, fileList) {
            this.imageUrlPreview = getBaseHost() + response.data.path;
            this.createCategoryForm.image_path = response.data.path;
        },
        beforeUpload(file) {
            const directory = "/category";
            this.uploadData.directory = directory;
            this.uploadData.name = file.name;
        },
        // 上传成功
        successUploadEdit(response, file, fileList) {
            this.editImageUrlPreview = getBaseHost() + response.data.path;
            this.updateCategoryForm.image_path = response.data.path;
        },
        beforeUploadEdit(file) {
            const directory = "/category";
            this.uploadData.directory = directory;
            this.uploadData.name = file.name;
        },
        setAction() {
            this.action = getBaseApi() + "/blog/file/upload";
        },
        resetCreateForm(formName) {
            this.$refs[formName].resetFields();
        },
        getCategory() {
            this.loading = true;
            const requestData = {};
            category(requestData)
                .then((response) => {
                    const { data } = response;
                    this.loading = false;
                    this.tableData = JSON.parse(JSON.stringify(data.category));
                    this.category_options = JSON.parse(JSON.stringify(data.category));
                    this.category_options.unshift({
                        id: 0,
                        name: "顶级分类",
                    });
                })
                .catch((reason) => {
                    this.loading = false;
                    this.tableData = [];
                    this.total = 0;
                });
        },
        handleDragStart(node, ev) {
        },
        handleDragEnter(draggingNode, dropNode, ev) {
        },
        handleDragLeave(draggingNode, dropNode, ev) {
        },
        handleDragOver(draggingNode, dropNode, ev) {
        },
        //拖拽结束   after 、 before 、 none
        handleDragEnd(draggingNode, dropNode, dropType, ev) {
        },
        handleDrop(draggingNode, dropNode, dropType, ev) {
        },
    }
}
</script>
