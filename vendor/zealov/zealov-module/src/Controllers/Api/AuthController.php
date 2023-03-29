<?php
/****************************************
 * Created by PhpStorm.
 * Author=> 刘奇.
 * QQ=> 921491025
 * Date=> 2023/3/24.
 * Time=> 16=>03.
 *****************************************/

namespace Zealov\Controllers\Api;

use Illuminate\Routing\Controller;
use Zealov\Kernel\Utils\Menu;

class AuthController extends Controller
{
    public function getUserInfo()
    {
        $userInfo = [
            "id"           => 20,
            "name"         => "admin",
            "nick_name"    => "张三",
            "status"       => 1,
            "email"        => "claption@qq.com"
        ];
        $userInfo['accessedRoutes'] = require __DIR__ . '/../../Config/AdminMenu.php';
        //获取模块下的菜单
        $userInfo['accessedRoutes'] = array_merge($userInfo['accessedRoutes'], Menu::getMenuList());
        return response()->json([
            "success" => true,
            "code"    => 200,
            "data"    => $userInfo
        ]);
    }


}
