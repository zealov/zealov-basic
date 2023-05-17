<?php
/****************************************
 * Created by PhpStorm.
 * Author: 刘奇.
 * QQ: 921491025
 * Date: 2023/5/17.
 * Time: 17:45.
 *****************************************/

namespace Module\AppStore\Api\Controller;



use Illuminate\Http\Request;
use Illuminate\Support\Str;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Module\Blog\Models\Category;
use Zealov\Kernel\Response\ApiCode;

class AppStoreController
{
    public function install(Request $request)
    {
        $step = $request->get('step');
        $data = $request->get('data');
        $data = json_decode($data, true);
        $module = $data['module']??"";
        $version = $data['version']??"";
        $isLocal = $data['isLocal']??"";
        switch ($step){
            case 'installModule':
                break;
            default:
                return $this->doNext('install', 'checkPackage', [
                    '<span class="ub-text-success">开始安装远程模块 ' . $module . ' V' . $version . '</span>',
                    '<span class="ub-text-white">开始模块安装预检...</span>'
                ],$data);
        }
    }

    private function doNext($command, $step, $msgs = [], $data = [])
    {
        $data = [
            'msg' => array_map(function ($item) {
                if (!Str::startsWith($item, '<')) {
                    $item = "<span class='ub-text-white'>$item</span>";
                }
                return '<i class="iconfont icon-hr"></i> ' . $item;
            }, $msgs),
            'command' => $command,
            'step' => $step,
            'data' => $data,
            'finish' => false,
        ];
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData($data)
            ->withMessage(__('message.common.search.success'))
            ->build();
    }
}
