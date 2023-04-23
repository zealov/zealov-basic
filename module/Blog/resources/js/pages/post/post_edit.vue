<template>
    <div class="content_container no-bg">
        <el-scrollbar>
            <div class="container">
                <div class="page-title">新建文章</div>
                <div>
                    <el-row>
                        <el-form :model="updateForm" :rules="rules" ref="form" label-width="100px">
                            <el-col :span="10">
                                <el-form-item label="标题" required :error="updateError.name ? updateError.name[0] : ''">
                                    <el-input
                                        v-model="updateForm.name"
                                        placeholder="请输入文章标题"
                                    ></el-input>
                                </el-form-item>
                                <el-form-item label="副标题" :error="updateError.sub_name ? updateError.sub_name[0] : ''">
                                    <el-input
                                        v-model="updateForm.sub_name"
                                        placeholder="请输入文章副标题"
                                    ></el-input>
                                </el-form-item>
                                <el-form-item label="封面图" class="upload_thumb" :error="updateError.thumbnail ? updateError.thumbnail[0] : ''">
                                    <el-upload
                                        class="uploadThumbImg flex"
                                        :headers="headers"
                                        :action="uploadUrl"
                                        :show-file-list="false"
                                        :on-success="handleUploadSuccess"
                                        :before-upload="handleBeforeUpload"
                                        :data="uploadData"
                                        v-loading="imageLoading"
                                    >
                                        <img
                                            v-if="updateForm.thumbnail"
                                            :src="thumbnail_url"
                                            class="thumb"
                                        />
                                        <el-button><i class="el-icon-upload"></i> 选择图片</el-button>
                                    </el-upload>
                                    <div class="el-upload__tip">
                                        支持JPG/PNG格式，建议尺寸800*450px或16:9
                                        <br/>图片大小不超过10MB
                                    </div>
                                </el-form-item>
                                <el-form-item label="简介" :error="updateError.description ? updateError.description[0] : ''">
                                    <TinymceSimple v-model="updateForm.description"></TinymceSimple>
                                </el-form-item>
                                <el-form-item label="所属分类"  :error="updateError.categories ? updateError.categories[0] : ''">
                                    <el-cascader
                                        v-model="updateForm.categories"
                                        :options="category_options"
                                        clearable
                                        filterable
                                        :props="{
                                          expandTrigger: 'click',
                                          multiple: true,
                                          checkStrictly: true,
                                          emitPath: false,
                                          label: 'name',
                                          value: 'id',
                                        }"
                                        placeholder="请选择分类"
                                    ></el-cascader>
                                </el-form-item>
                                <el-form-item label-width="0" :error="updateError.author ? updateError.author[0] : ''">
                                    <el-row>
                                        <el-col :span="12">
                                            <el-form-item label-width="100px" label="作者">
                                                <el-input
                                                    v-model="updateForm.author"
                                                    placeholder="作者"
                                                ></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="12">
                                            <el-form-item label-width="100px" label="来源" :error="updateError.from ? updateError.from[0] : ''">
                                                <el-input
                                                    v-model="updateForm.from"
                                                    placeholder="来源"
                                                ></el-input>
                                            </el-form-item>
                                        </el-col>
                                    </el-row>
                                </el-form-item>
                                <el-form-item label="跳转链接" :error="updateError.redirect ? updateError.redirect[0] : ''">
                                    <el-input
                                        v-model="updateForm.redirect"
                                        placeholder="不需要跳转请留空"
                                    ></el-input>
                                </el-form-item>
                                <el-form-item label="排序" :error="updateError.sort ? updateError.sort[0] : ''">
                                    <el-input
                                        v-model="updateForm.sort"
                                        placeholder="数字越小越靠前"
                                    ></el-input>

                                </el-form-item>
                                <el-form-item label="发布状态" :error="updateError.published ? updateError.published[0] : ''">
                                    <el-radio-group v-model="updateForm.published">
                                        <el-radio :label="1">
                                            发布
                                        </el-radio>
                                        <el-radio :label="2">
                                            草稿
                                        </el-radio>
                                    </el-radio-group>
                                </el-form-item>
                                <el-form-item label="置顶状态" :error="updateError.pinned ? updateError.pinned[0] : ''">
                                    <el-radio-group v-model="updateForm.pinned">
                                        <el-radio :label="1">
                                            非置顶
                                        </el-radio>
                                        <el-radio :label="2">
                                            置顶
                                        </el-radio>
                                    </el-radio-group>
                                </el-form-item>
                                <el-form-item style="margin-top: 40px">
                                    <el-button type="primary" @click="saveForm('form')">保存</el-button>
                                </el-form-item>

                            </el-col>
                            <el-col :span="14">
                                <el-form-item label="内容" label-width="80px">
                                    <TinymceComplete v-model="updateForm.content" :action="action"></TinymceComplete>
                                </el-form-item>
                            </el-col>
                        </el-form>
                    </el-row>
                </div>
            </div>

        </el-scrollbar>
    </div>
</template>
<script>
import {category} from "../../api/category";
import TinymceSimple from "@/components/tinymce/tinymce-simple";
import TinymceComplete from "@/components/tinymce/tinymce-complete";
import {getBaseApi, getBaseHost} from '@/utils/index'
import {update,show} from '../../api/post'
import {getToken} from "@/utils/auth";

export default {
    data() {
        return {
            post_id: '',
            updateError: {},
            thumbnail_url: "",
            imageLoading: false,
            category_options: [],
            uploadData: {directory: "article"},
            action: getBaseApi() + '/blog/file/upload',
            headers: {
                Authorization: "Bearer " + getToken(),
            },
            updateForm: {
                name: '',
                categories:'',
                sub_name: '',
                author: '',
                from: '',
                description: '',
                redirect: '',
                sort: 0,
                content: '',
                thumbnail: '',
                pinned: 1,
                published: 1
            },
            rules: {},
            uploadUrl: getBaseApi() + "/blog/file/upload",
            categoryList: [],
            tagList: []
        }
    },
    components: {
        TinymceSimple, TinymceComplete
    },
    mounted() {
        this.post_id = this.$route.params.id
        //获取文章详情
        this.getCategory();
        this.getPostDetail(this.post_id)
    },
    methods: {
        getPostDetail(post_id){
            show(post_id).then(res=>{
                this.updateForm.name = res.data.name
                this.updateForm.sub_name = res.data.sub_name
                this.updateForm.author = res.data.author
                this.updateForm.from = res.data.from
                this.updateForm.description = res.data.description
                this.updateForm.redirect = res.data.redirect
                this.updateForm.sort = res.data.sort
                this.updateForm.content = res.data.content
                this.updateForm.thumbnail = res.data.thumbnail
                this.updateForm.pinned = res.data.pinned
                this.updateForm.published = res.data.published
                this.thumbnail_url = getBaseHost() + res.data.thumbnail
                let category_ids = []
                res.data.categories.forEach(item=>{
                    category_ids.push(item.id)
                })
                this.updateForm.categories = category_ids
            })
        },
        handleUploadSuccess(res, file) {
            this.updateForm.thumbnail = file.response.data.path;
            this.thumbnail_url = getBaseHost() + file.response.data.path;
            this.imageLoading = false;
        },
        handleBeforeUpload(file) {
            const isJPG = file.type === "image/jpeg" || "image/png";
            const isLt1M = file.size / 1024 / 1024 < 10;

            if (!isJPG) {
                this.$message.error("上传图片只能是 JPG/PNG 格式!");
            }
            if (!isLt1M) {
                this.$message.error("上传图片大小不能超过 10MB!");
            }
            if (isJPG && isLt1M) {
                this.imageLoading = true;
            }
            return isJPG && isLt1M;
        },
        saveForm() {
            this.updateError = {};
            update(this.post_id,this.updateForm).then((response) => {
                const {data} = response;
                this.$message({
                    message: response.message,
                    type: 'success'
                });
                setTimeout(() => {
                    this.$router.push({name: 'blog.post.index'});
                }, 1000);
            }).catch((reason) => {
                const { data } = reason;
                if (reason.code === 422) {
                    this.updateError = data;
                }
            });
        },
        getCategory() {
            const requestData = {};
            category(requestData)
                .then((response) => {
                    const {data} = response;
                    this.category_options = data.category;
                })
                .catch((reason) => {
                    this.category_options = [];
                });
        },
    }
}
</script>
