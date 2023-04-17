<?php
/****************************************
 * Created by PhpStorm.
 * Author: 刘奇.
 * QQ: 921491025
 * Date: 2023/4/6.
 * Time: 14:44.
 *****************************************/

namespace Module\Blog\Admin\Controller;

use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function index(){
        return view('module::Blog.View.admin.spa.index');
    }
    public function edit($id){
        return view('module::Blog.View.admin.spa.index');
    }

}
