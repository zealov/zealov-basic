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
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Symfony\Component\HttpFoundation\Response;
use Zealov\Kernel\Response\ApiCode;
use Zealov\Kernel\Utils\Menu;

class AuthController extends Controller
{
    public function getUserInfo()
    {
        $userInfo = [
            "id"        => 20,
            "name"      => "admin",
            "nick_name" => "张三",
            "status"    => 1,
            "email"     => "claption@qq.com",
            "roles"     => [1]
        ];
        $userInfo['accessedRoutes'] = require __DIR__ . '/../../Config/AdminMenu.php';
        //获取模块下的菜单
        $userInfo['accessedRoutes'] = array_merge($userInfo['accessedRoutes'], Menu::getMenuList());
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData($userInfo)
            ->build();
    }

    /**
     * 获取图形验证码
     * @return Response
     */
    public function captcha()
    {
        $data = app('captcha')->create('flat', true);
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData($data)
            ->withMessage(__('message.common.search.success'))
            ->build();
    }


}
