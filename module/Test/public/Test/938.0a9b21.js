"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[938],{6242:(e,t,a)=>{a.d(t,{Kz:()=>r,Ue:()=>i,FZ:()=>o,Vx:()=>n});var l=a(5814);function r(e){return(0,l.Z)({url:"/delegate",method:"get",params:e})}function i(e){return(0,l.Z)({url:"/delegate",method:"post",data:e})}function o(e){return(0,l.Z)({url:"/delegate/tree",method:"get",params:e})}function n(e,t){return(0,l.Z)({url:"/delegate/"+e,method:"put",data:t})}},3432:(e,t,a)=>{a.d(t,{B:()=>r,X:()=>i});var l=a(5814);function r(e){return(0,l.Z)({url:"/head_member",method:"get",params:e})}function i(e){return(0,l.Z)({url:"/head_member/level",method:"get",params:e})}},1938:(e,t,a)=>{a.r(t),a.d(t,{default:()=>c});var l=a(6242),r=a(3432),i=a(8276),o=a(7690),n=a(5108),s=a(4155);window.installImage=function(){n.log("下载");var e=document.querySelector(".el-image-viewer__img").src;n.log(e),window.downloadIamge(e,"图片名字")};const d={layout:"basic",middleware:["auth"],data:function(){return{role:"",updateLoading:!1,createError:{},updateError:{},createLoading:!1,createDelegateVisible:!1,updateDelegateVisible:!1,file_path_list:[],headMemberOptions:[],form:{id:"",name:"",age:"",injection_metering:"",is_contraception:"",status:"",reason:"",visit_at:"",file_path:""},createDelegateForm:{delegate_name:"",delegate_phone:"",delegate_email:"",delegate_id:""},updateDelegateForm:{id:"",delegate_name:"",delegate_phone:"",delegate_email:"",delegate_id:""},filter:{keyWords:""},total:0,offset:1,limit:10,total_pages:5,tableLoading:!0,tableData:[],dialog:!1,formLabelWidth:"120px",timer:null,app_url:""}},mounted:function(){this.role=(0,i.c)(),this.app_url=s.env.MIX_VUE_APP_HOST_API,this.getList(),this.getMemberLevelList(),window.downloadIamge=this.downloadIamge},methods:{editDelegateForm:function(e){this.updateDelegateForm.id=e.id,this.updateDelegateForm.delegate_name=e.delegate_name,this.updateDelegateForm.delegate_phone=e.delegate_phone,this.updateDelegateForm.delegate_email=e.delegate_email,this.updateDelegateForm.delegate_id=e.delegate_id,this.updateDelegateVisible=!0},getMemberLevelList:function(){var e=this;(0,r.X)().then((function(t){t.data.data.forEach((function(t){e.headMemberOptions.push({label:t.head_name+"（"+t.three_area+"）",value:t.id})})),n.log(t),n.log(e.headMemberOptions)}))},createDelegateValid:function(e){var t=this;this.$refs.createForm.validate((function(a){a&&t.createDelegate(e)}))},updateDelegateValid:function(e){var t=this;this.$refs.updateForm.validate((function(a){a&&t.updateDelegate(e)}))},updateDelegate:function(e){var t=this;this.updateLoading=!0,this.updateError={},(0,l.Vx)(this.updateDelegateForm.id,this.updateDelegateForm).then((function(e){n.log(e),t.$message({message:e.message,type:"success"}),t.getList(),t.updateDelegateVisible=!1})).catch((function(e){422===e.code&&(t.updateError=e.data)})).finally((function(){t.updateLoading=!1}))},createDelegate:function(e){var t=this;this.createLoading=!0,this.createError={},(0,l.Ue)(this.createDelegateForm).then((function(a){n.log(a),t.$message({message:a.message,type:"success"}),t.resetCreateForm(e),t.getList(),t.createDelegateVisible=!1})).catch((function(e){422===e.code&&(t.createError=e.data)})).finally((function(){t.createLoading=!1}))},resetCreateForm:function(e){this.$refs[e].resetFields()},downloadIamge:function(e,t){n.log(this.item);var a=this.item.name||"photo",l=new Image;l.setAttribute("crossOrigin","anonymous"),l.onload=function(){var e=document.createElement("canvas");e.width=l.width,e.height=l.height,e.getContext("2d").drawImage(l,0,0,l.width,l.height);var t=e.toDataURL("image/png"),r=document.createElement("a"),i=new MouseEvent("click");r.download=a||"photo",r.href=t,r.dispatchEvent(i)},l.src=e},checkImage:function(e){n.log("点击事件"),this.item=e;var t=document.querySelector(".el-image-viewer__actions__inner"),a=document.createElement("i");a.setAttribute("class","el-icon-download"),a.setAttribute("onclick","installImage()"),t.appendChild(a)},imageCom:function(e){var t=o.Z.getters["auth/token"],a=(new Date).getTime();return this.app_url+"/api/delegate/qrcode?delegate_id="+e.id+"&token="+t+"&time="+a},imagePreList:function(e){var t=o.Z.getters["auth/token"],a=(new Date).getTime();return[this.app_url+"/api/delegate/qrcode?delegate_id="+e.id+"&token="+t+"&time="+a]},submit:function(){var e=this;this.loading||this.$confirm("确定要提交表单吗？").then((function(t){e.loading=!0,e.timer=setTimeout((function(){(0,l.Vx)(e.form.id,e.form).then((function(t){setTimeout((function(){e.loading=!1}),400),e.dialog=!1,e.getList()}))}),1e3)})).catch((function(e){}))},cancelForm:function(){this.loading=!1,this.dialog=!1,clearTimeout(this.timer)},dialogReview:function(e){this.form.id=e.id,this.form.name=e.name,this.form.age=e.age,this.form.injection_metering=e.injection_metering,this.form.is_contraception=e.is_contraception,this.form.status=e.status,this.form.reason=e.reason,this.form.visit_at=e.visit_at,this.form.file_path=e.app_url+e.file_path,this.file_path_list.push(e.app_url+e.file_path),this.dialog=!0},search:function(){n.log(this.filter),n.log(123),this.getList()},getList:function(){var e=this,t={offset:this.offset,limit:this.limit,order:"descending",keyWords:this.filter.keyWords};n.log(t),(0,l.Kz)(t).then((function(t){e.tableData=t.data.list,e.total=t.data.total,e.tableLoading=!1})).catch((function(t){e.tableLoading=!1}))},handleSizeChange:function(e){this.limit=e,this.getList()},handleCurrentChange:function(e){this.offset=e,this.getList()},downloadFile:function(){var e=o.Z.getters["auth/token"];window.open(this.app_url+"/api/delegate/downloadFile?token="+e,"_blank")}}};const c=(0,a(1900).Z)(d,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"content_container"},[a("el-scrollbar",[a("div",{staticClass:"container",staticStyle:{"padding-top":"0"}},[a("div",{staticClass:"header_container is-sticky-top"},[a("div",{staticClass:"left"},[e.role.includes("manager")?a("el-button",{attrs:{size:"small",type:"primary"},on:{click:e.downloadFile}},[a("i",{staticClass:"el-icon-download"}),e._v(" 下载二维码文件包\n          ")]):e._e(),e._v(" "),e.role.includes("manager")?a("el-button",{attrs:{size:"small",type:"primary"},on:{click:function(t){e.createDelegateVisible=!0}}},[a("i",{staticClass:"el-icon-plus"}),e._v(" 添加医药代表\n          ")]):e._e()],1),e._v(" "),a("div",{staticClass:"right"},[a("div",{staticClass:"filter"},[a("el-form",{attrs:{inline:!0,size:"small"}},[a("el-form-item",[a("el-input",{attrs:{placeholder:"请输入代表姓名",clearable:""},model:{value:e.filter.keyWords,callback:function(t){e.$set(e.filter,"keyWords",t)},expression:"filter.keyWords"}})],1),e._v(" "),a("el-form-item",[a("el-button",{attrs:{size:"small",type:"primary"},on:{click:function(t){return e.search()}}},[a("i",{staticClass:"el-icon-search"})])],1)],1)],1)])]),e._v(" "),a("div",{directives:[{name:"loading",rawName:"v-loading",value:e.tableLoading,expression:"tableLoading"}],staticClass:"table-list"},[a("el-table",{attrs:{data:e.tableData}},[a("el-table-column",{attrs:{prop:"first_area",align:"center",label:"一级区域",width:"120"}}),e._v(" "),a("el-table-column",{attrs:{prop:"second_area",label:"二级区域",align:"center",width:"140"}}),e._v(" "),a("el-table-column",{attrs:{prop:"three_area",align:"center",label:"三级区域",width:"140"}}),e._v(" "),a("el-table-column",{attrs:{prop:"three_area_head_name",align:"center",label:"三级区域负责人姓名",width:"150"}}),e._v(" "),a("el-table-column",{attrs:{prop:"three_area_head_phone",align:"center",label:"三级区域负责人电话",width:"150"}}),e._v(" "),a("el-table-column",{attrs:{prop:"three_area_head_email",align:"center",label:"三级区域负责人邮箱"}}),e._v(" "),a("el-table-column",{attrs:{prop:"delegate_name",align:"center",label:"医药代表姓名"}}),e._v(" "),a("el-table-column",{attrs:{prop:"delegate_phone",align:"center",label:"医药代表手机号"}}),e._v(" "),a("el-table-column",{attrs:{prop:"delegate_email",align:"center",label:"医药代表邮箱"}}),e._v(" "),a("el-table-column",{attrs:{align:"center",label:"二维码"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("span",{staticClass:"cell title"},[a("div",{staticClass:"demo-image__preview",on:{click:function(a){return e.checkImage(t.row)}}},[a("el-image",{staticStyle:{width:"100px",height:"100px"},attrs:{src:e.imageCom(t.row),"preview-src-list":e.imagePreList(t.row)}})],1)])]}}])}),e._v(" "),e.role.includes("manager")?a("el-table-column",{attrs:{align:"center",label:"操作",width:"120"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("el-button",{attrs:{type:"text",title:"编辑"},on:{click:function(a){return e.editDelegateForm(t.row)}}},[a("i",{staticClass:"el-icon-edit"})])]}}],null,!1,1078719217)}):e._e()],1)],1),e._v(" "),a("div",{staticClass:"footer_container is-sticky-bottom"},[a("el-pagination",{attrs:{"current-page":e.offset,"pager-count":e.total_pages,"page-size":e.limit,layout:"total, prev, pager, next, jumper",total:e.total},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}})],1)])]),e._v(" "),a("el-dialog",{attrs:{"custom-class":"dialog_tc",title:"添加代理",visible:e.createDelegateVisible,width:"560px","close-on-click-modal":!1},on:{"update:visible":function(t){e.createDelegateVisible=t}}},[a("el-form",{ref:"createForm",attrs:{model:e.createDelegateForm,"label-width":"80px",size:"medium"}},[a("el-form-item",{attrs:{prop:"delegate_name",label:"姓名",rules:{required:!0,message:"请输入姓名",trigger:"blur"},error:e.createError.delegate_name?e.createError.delegate_name[0]:""}},[a("el-input",{attrs:{type:"text",placeholder:"请输入姓名"},model:{value:e.createDelegateForm.delegate_name,callback:function(t){e.$set(e.createDelegateForm,"delegate_name",t)},expression:"createDelegateForm.delegate_name"}})],1),e._v(" "),a("el-form-item",{attrs:{prop:"delegate_phone",label:"手机号",rules:{required:!0,message:"请输入手机号",trigger:"blur"},error:e.createError.delegate_phone?e.createError.delegate_phone[0]:""}},[a("el-input",{attrs:{type:"text",placeholder:"请输入手机号"},model:{value:e.createDelegateForm.delegate_phone,callback:function(t){e.$set(e.createDelegateForm,"delegate_phone",t)},expression:"createDelegateForm.delegate_phone"}})],1),e._v(" "),a("el-form-item",{attrs:{prop:"delegate_email",label:"邮箱",rules:{required:!0,message:"请输入邮箱",trigger:"blur"},error:e.createError.delegate_email?e.createError.delegate_email[0]:""}},[a("el-input",{attrs:{type:"text",placeholder:"请输入邮箱"},model:{value:e.createDelegateForm.delegate_email,callback:function(t){e.$set(e.createDelegateForm,"delegate_email",t)},expression:"createDelegateForm.delegate_email"}})],1),e._v(" "),a("el-form-item",{attrs:{prop:"delegate_id",label:"代理人",rules:{required:!0,message:"请选择代理人",trigger:"blur"},error:e.createError.delegate_id?e.createError.delegate_id[0]:""}},[a("el-select",{attrs:{filterable:"",placeholder:"请选择代理人"},model:{value:e.createDelegateForm.delegate_id,callback:function(t){e.$set(e.createDelegateForm,"delegate_id",t)},expression:"createDelegateForm.delegate_id"}},e._l(e.headMemberOptions,(function(e){return a("el-option",{key:e.value,attrs:{label:e.label,value:e.value}})})),1)],1)],1),e._v(" "),a("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[a("el-button",{on:{click:function(t){e.createDelegateVisible=!1}}},[e._v("取消")]),e._v(" "),a("el-button",{attrs:{type:"primary",loading:e.createLoading},on:{click:function(t){return e.createDelegateValid("createForm")}}},[e._v("确定")])],1)],1),e._v(" "),a("el-dialog",{attrs:{"custom-class":"dialog_tc",title:"修改代理",visible:e.updateDelegateVisible,width:"560px","close-on-click-modal":!1},on:{"update:visible":function(t){e.updateDelegateVisible=t}}},[a("el-form",{ref:"updateForm",attrs:{model:e.updateDelegateForm,"label-width":"80px",size:"medium"}},[a("el-form-item",{attrs:{prop:"delegate_name",label:"姓名",rules:{required:!0,message:"请输入姓名",trigger:"blur"},error:e.updateError.delegate_name?e.updateError.delegate_name[0]:""}},[a("el-input",{attrs:{type:"text",placeholder:"请输入姓名"},model:{value:e.updateDelegateForm.delegate_name,callback:function(t){e.$set(e.updateDelegateForm,"delegate_name",t)},expression:"updateDelegateForm.delegate_name"}})],1),e._v(" "),a("el-form-item",{attrs:{prop:"delegate_phone",label:"手机号",rules:{required:!0,message:"请输入手机号",trigger:"blur"},error:e.updateError.delegate_phone?e.updateError.delegate_phone[0]:""}},[a("el-input",{attrs:{type:"text",placeholder:"请输入手机号"},model:{value:e.updateDelegateForm.delegate_phone,callback:function(t){e.$set(e.updateDelegateForm,"delegate_phone",t)},expression:"updateDelegateForm.delegate_phone"}})],1),e._v(" "),a("el-form-item",{attrs:{prop:"delegate_email",label:"邮箱",rules:{required:!0,message:"请输入邮箱",trigger:"blur"},error:e.updateError.delegate_email?e.updateError.delegate_email[0]:""}},[a("el-input",{attrs:{type:"text",placeholder:"请输入邮箱"},model:{value:e.updateDelegateForm.delegate_email,callback:function(t){e.$set(e.updateDelegateForm,"delegate_email",t)},expression:"updateDelegateForm.delegate_email"}})],1),e._v(" "),a("el-form-item",{attrs:{prop:"delegate_id",label:"代理人",rules:{required:!0,message:"请选择代理人",trigger:"blur"},error:e.updateError.delegate_id?e.updateError.delegate_id[0]:""}},[a("el-select",{attrs:{filterable:"",placeholder:"请选择代理人"},model:{value:e.updateDelegateForm.delegate_id,callback:function(t){e.$set(e.updateDelegateForm,"delegate_id",t)},expression:"updateDelegateForm.delegate_id"}},e._l(e.headMemberOptions,(function(e){return a("el-option",{key:e.value,attrs:{label:e.label,value:e.value}})})),1)],1)],1),e._v(" "),a("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[a("el-button",{on:{click:function(t){e.updateDelegateVisible=!1}}},[e._v("取消")]),e._v(" "),a("el-button",{attrs:{type:"primary",loading:e.updateLoading},on:{click:function(t){return e.updateDelegateValid("updateForm")}}},[e._v("确定")])],1)],1)],1)}),[],!1,null,null,null).exports}}]);