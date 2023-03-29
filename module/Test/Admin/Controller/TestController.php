<?php

namespace Module\Test\Admin\Controller;
use Illuminate\Routing\Controller;


class TestController extends Controller
{
    public function index(){
        return view('module::Test.View.admin.test.index');
    }
}
