"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[189],{1728:(t,e,a)=>{a.d(e,{Kz:()=>i,h:()=>n,Vx:()=>s,ob:()=>o,$Z:()=>r});var l=a(4319);function i(t){return(0,l.Z)({url:"/blog/page",method:"get",params:t})}function n(t){return(0,l.Z)({url:"/blog/page",method:"post",data:t})}function s(t,e){return(0,l.Z)({url:"/blog/page/"+t,method:"put",data:e})}function o(t){return(0,l.Z)({url:"/blog/page/"+t,method:"delete"})}function r(t){return(0,l.Z)({url:"/blog/page/"+t,method:"get"})}},3189:(t,e,a)=>{a.r(e),a.d(e,{default:()=>n});var l=a(1728);const i={data:function(){return{filter:{keywords:""},loadingTable:!1,total:0,offset:1,limit:15,total_pages:5,tableData:[]}},mounted:function(){this.getList()},methods:{createPage:function(){this.$router.push({name:"blog.page.create"})},getList:function(){var t=this,e={offset:this.offset,limit:this.limit,order:"descending"};(0,l.Kz)(e).then((function(e){t.tableData=e.data.data,t.total=e.data.total}))},redirectEdit:function(t){this.$router.push({path:"/admin/blog/page_edit/"+t})},deletePage:function(t){var e=this;this.$confirm("此操作将永久删除该页面, 是否继续?","提示",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then((function(){(0,l.ob)(t).then((function(t){e.$message({type:"success",message:t.message}),e.getList()}))})).catch((function(){e.$message({type:"info",message:"已取消删除"})}))},handleSizeChange:function(t){this.offset=t,this.getList()},handleCurrentChange:function(t){this.offset=t,this.getList()}}};const n=(0,a(1900).Z)(i,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"content_container no-bg"},[a("el-scrollbar",[a("div",{staticClass:"container",staticStyle:{"padding-top":"0","padding-bottom":"0"}},[a("div",{staticClass:"header_container is-sticky-top"},[a("div",{staticClass:"left"},[a("el-button",{attrs:{size:"small",type:"primary"},on:{click:t.createPage}},[a("i",{staticClass:"el-icon-plus"}),t._v(" 添加页面\n                    ")])],1),t._v(" "),a("div",{staticClass:"right"},[a("div",{staticClass:"filter"},[a("el-form",{attrs:{inline:!0,size:"small"}},[a("el-form-item",[a("el-input",{attrs:{placeholder:"请输入页面标题",clearable:""},model:{value:t.filter.keywords,callback:function(e){t.$set(t.filter,"keywords",e)},expression:"filter.keywords"}})],1),t._v(" "),a("el-form-item",[a("el-button",{attrs:{size:"small"},on:{click:function(e){return t.getList()}}},[a("i",{staticClass:"el-icon-search"})])],1)],1)],1)])]),t._v(" "),a("div",{directives:[{name:"loading",rawName:"v-loading",value:t.loadingTable,expression:"loadingTable"}],staticClass:"table-list"},[a("el-table",{attrs:{data:t.tableData}},[a("el-table-column",{attrs:{prop:"id","show-overflow-tooltip":!0,width:"100",align:"center",label:"ID"}}),t._v(" "),a("el-table-column",{attrs:{prop:"name","show-overflow-tooltip":!0,"min-width":"40%",label:"页面标题"}}),t._v(" "),a("el-table-column",{attrs:{prop:"created_at","show-overflow-tooltip":!0,"min-width":"15%",sortable:"",align:"center",label:"创建时间"}}),t._v(" "),a("el-table-column",{attrs:{prop:"label","show-overflow-tooltip":!0,"min-width":"15%",align:"center",label:"状态"},scopedSlots:t._u([{key:"default",fn:function(e){return[1==e.row.published?a("el-tag",{staticStyle:{margin:"0 3px"},attrs:{type:"success",size:"small"}},[t._v("已发布")]):a("el-tag",{staticStyle:{margin:"0 3px"},attrs:{type:"info",size:"small"}},[t._v("未发布")])]}}])}),t._v(" "),a("el-table-column",{attrs:{align:"center",label:"操作",width:"280"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-button",{attrs:{type:"text",title:"编辑"},on:{click:function(a){return t.redirectEdit(e.row.id)}}},[a("i",{staticClass:"el-icon-edit"})]),t._v(" "),a("el-button",{attrs:{type:"text",title:"删除"},on:{click:function(a){return t.deletePage(e.row.id)}}},[a("i",{staticClass:"el-icon-delete"})])]}}])})],1)],1),t._v(" "),a("div",{staticClass:"footer_container is-sticky-bottom"},[a("el-pagination",{attrs:{"current-page":t.offset,"pager-count":t.total_pages,"page-size":t.limit,layout:"total, prev, pager, next, jumper",total:t.total},on:{"size-change":t.handleSizeChange,"current-change":t.handleCurrentChange}})],1)])])],1)}),[],!1,null,null,null).exports}}]);