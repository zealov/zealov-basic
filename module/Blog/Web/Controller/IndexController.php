<?php
/****************************************
 * Created by PhpStorm.
 * Author: 刘奇.
 * QQ: 921491025
 * Date: 2023/7/2.
 * Time: 19:20.
 *****************************************/

namespace Module\Blog\Web\Controller;

use Zealov\Controllers\ZealovBaseController;

class IndexController extends ZealovBaseController
{

    public function index(){
        return $this->view('blog.index');
    }

    public function blog(){
        return $this->view('blog.blog-list');
    }

    public function detail(){
        return $this->view('blog.blog-detail');
    }

    public function page(){
        return $this->view('blog.page');
    }
}
