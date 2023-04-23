<template>
    <div class="content_container no-bg">
        <el-scrollbar>
            <div class="container">
                <div class="page-title">编辑页面</div>
                <div>
                    <el-row>
                        <el-form :model="updateForm" :rules="rules" ref="form" label-width="100px">
                            <el-col :span="10">
                                <el-form-item label="标题" required :error="updateError.name ? updateError.name[0] : ''">
                                    <el-input
                                        v-model="updateForm.name"
                                        placeholder="请输入页面标题"
                                    ></el-input>
                                </el-form-item>
                                <el-form-item label="副标题" :error="updateError.sub_name ? updateError.sub_name[0] : ''">
                                    <el-input
                                        v-model="updateForm.sub_name"
                                        placeholder="请输入页面副标题"
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
import {update,show} from '../../api/page'
import {getToken} from "@/utils/auth";

export default {
    data() {
        return {
            page_id: '',
            updateError: {},
            thumbnail_url: "",
            imageLoading: false,
            category_options: [],
            uploadData: {directory: "page"},
            action: getBaseApi() + '/blog/file/upload',
            headers: {
                Authorization: "Bearer " + getToken(),
            },
            updateForm: {
                name: '',
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
            tagList: []
        }
    },
    components: {
        TinymceSimple, TinymceComplete
    },
    mounted() {
        this.page_id = this.$route.params.id
        this.getPostDetail(this.page_id)
    },
    methods: {
        getPostDetail(page_id){
            show(page_id).then(res=>{
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
            update(this.page_id,this.updateForm).then((response) => {
                const {data} = response;
                this.$message({
                    message: response.message,
                    type: 'success'
                });
                setTimeout(() => {
                    this.$router.push({name: 'blog.page.index'});
                }, 1000);
            }).catch((reason) => {
                const { data } = reason;
                if (reason.code === 422) {
                    this.updateError = data;
                }
            });
        },
    }
}
</script>
