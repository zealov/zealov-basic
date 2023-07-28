"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[246],{8663:(t,e,a)=>{a.d(e,{W3:()=>r,Ue:()=>i,mJ:()=>n,$Z:()=>s,Vx:()=>l,ob:()=>c});var o=a(4319);function r(t){return(0,o.Z)({url:"/blog/category",method:"get",params:t})}function i(t){return(0,o.Z)({url:"/blog/category",method:"post",data:t})}function n(t){return(0,o.Z)({url:"/blog/category/updateSort",method:"post",data:t})}function s(t){return(0,o.Z)({url:"/blog/category/"+t,method:"get"})}function l(t,e){return(0,o.Z)({url:"/blog/category/"+t,method:"put",data:e})}function c(t){return(0,o.Z)({url:"/blog/category/"+t,method:"delete"})}},2670:(t,e,a)=>{a.d(e,{dt:()=>r,h:()=>i,bM:()=>n});var o=a(4319);function r(t){return(0,o.Z)({url:"/blog/chunk/type",method:"get",params:t})}function i(t){return(0,o.Z)({url:"/blog/chunk",method:"post",data:t})}function n(t){return(0,o.Z)({url:"/blog/chunk/relationship",method:"post",data:t})}},6526:(t,e,a)=>{a.d(e,{n:()=>r});var o=a(4319);function r(t){return(0,o.Z)({url:"/blog/relationship/entity",method:"get",params:t})}},5246:(t,e,a)=>{a.r(e),a.d(e,{default:()=>l});var o=a(8663),r=a(2670),i=a(6526),n=a(5108);const s={props:{id:{type:Number,default:1}},data:function(){return{CreateCategoryDialog:!1,createCategoryForm:{categories:""},categoryOptions:[],tableList:[],current_page:1,total:0,per_page:10,total_pages:5}},mounted:function(){n.log(this.id),this.getCategoryList(),this.getEntityList()},methods:{handleSizeChange:function(t){this.current_page=t,this.getEntityList()},handleCurrentChange:function(t){this.current_page=t,this.getEntityList()},getCategoryList:function(){var t=this;(0,o.W3)().then((function(e){var a=e.data;t.categoryOptions=a.category}))},createCategoryRelationship:function(){var t=this,e={chunk_id:this.id,relationship_type:"categories",relationship_id:this.createCategoryForm.categories.slice(-1)[0]};(0,r.bM)(e).then((function(e){t.$message({message:e.message,type:"success"}),t.CreateCategoryDialog=!1,t.getEntityList()}))},getEntityList:function(){var t=this,e={limit:this.per_page,offset:this.current_page,subject_type:"chunks",subject_id:this.id};(0,i.n)(e).then((function(e){var a=e.data;t.tableList=a.data,t.total=a.total,n.log(e)}))}}};const l=(0,a(1900).Z)(s,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"content_container no-bg"},[a("el-scrollbar",[a("div",{staticClass:"container",staticStyle:{"padding-top":"0","padding-bottom":"0"}},[a("div",{staticClass:"header_container is-sticky-top"},[a("div",{staticClass:"left"},[a("el-button",{attrs:{size:"small",type:"primary"},on:{click:function(e){t.CreateCategoryDialog=!0}}},[a("i",{staticClass:"el-icon-s-operation"}),t._v("按分类添加")])],1),t._v(" "),a("div",{staticClass:"right"})]),t._v(" "),a("div",{staticClass:"table-list"},[a("el-table",{attrs:{data:t.tableList}},[a("el-table-column",{attrs:{prop:"id","show-overflow-tooltip":!0,width:"55",align:"center",label:"ID"}}),t._v(" "),a("el-table-column",{attrs:{prop:"name","show-overflow-tooltip":!0,"min-width":"40%",label:"文章标题"}})],1)],1),t._v(" "),a("div",{staticClass:"footer_container is-sticky-bottom"},[a("el-pagination",{attrs:{"current-page":t.current_page,"pager-count":t.total_pages,"page-size":t.per_page,layout:"total, prev, pager, next, jumper",total:t.total},on:{"size-change":t.handleSizeChange,"current-change":t.handleCurrentChange}})],1)])]),t._v(" "),a("el-dialog",{attrs:{visible:t.CreateCategoryDialog,width:"560px","custom-class":"dialog_tc","close-on-click-modal":!1},on:{"update:visible":function(e){t.CreateCategoryDialog=e}},scopedSlots:t._u([{key:"footer",fn:function(){return[a("span",{staticClass:"dialog-footer"},[a("el-button",{on:{click:function(e){t.CreateCategoryDialog=!1}}},[t._v("取 消")]),t._v(" "),a("el-button",{attrs:{type:"primary"},on:{click:function(e){return t.createCategoryRelationship()}}},[t._v("确 定")])],1)]},proxy:!0}])},[a("el-form",{attrs:{model:t.createCategoryForm}},[a("el-form-item",{attrs:{required:""}},[a("el-cascader",{attrs:{options:t.categoryOptions,clearable:"",filterable:"",props:{expandTrigger:"click",label:"name",checkStrictly:!0,value:"id"},placeholder:"请选择分类"},model:{value:t.createCategoryForm.categories,callback:function(e){t.$set(t.createCategoryForm,"categories",e)},expression:"createCategoryForm.categories"}})],1)],1)],1)],1)}),[],!1,null,null,null).exports}}]);