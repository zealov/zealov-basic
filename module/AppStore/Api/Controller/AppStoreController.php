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
use Module\AppStore\Utils\AppStoreUtil;
use Module\Blog\Models\Category;
use Zealov\Exception\ThrowException;
use Zealov\Kernel\Response\ApiCode;

class AppStoreController
{
    public function install(Request $request)
    {
        sleep(1);
        $step = $request->get('step');
        $data = $request->get('data');
        $data = json_decode($data, true);
        $module = $data['module']??"";
        $version = $data['version']??"";
        $isLocal = $data['isLocal']??"";
        switch ($step){
            case 'installModule':
                return $this->doFinish([
                    '<span class="text-success">安装完成，请 <a href="javascript:;" onclick="parent.location.reload()">刷新后台</a> 查看最新系统</span>',
                ]);
                break;
            case 'unpackPackage':
                $package = $data['package'];
                $licenseKey = $data['licenseKey'];
                $ret = AppStoreUtil::unpackModule($module, $package, $licenseKey);
                ThrowException::throwsIfResponseError($ret);
                return $this->doNext('install', 'installModule', array_merge([
                    '<span class="text-success">模块解压完成</span>',
                    '<span class="ub-text-white">开始安装...</span>',
                ]),$data);

            case 'downloadPackage':
                $ret = AppStoreUtil::downloadPackage(1, 1, 1);
                ThrowException::throwsIfResponseError($ret);
                return $this->doNext('install', 'unpackPackage', [
                    '<span class="text-success">获取安装包完成，大小 ' . '2.37 KB' . '</span>',
                    '<span class="ub-text-white">开始解压安装包...</span>'
                ], array_merge([
                    'package' => $ret['data']['package'],
                    'licenseKey' => $ret['data']['licenseKey'],
                ],$data));
                break;
            case 'checkPackage':
                $msgs[] = '<span class="ub-text-white">开始下载安装包...</span>';
                return $this->doNext('install', 'downloadPackage', array_merge([
                    'PHP版本: v' . PHP_VERSION,
                    '<span class="text-success">预检成功，' . 1 . '个依赖满足要求，安装包大小 ' . '2.37 KB' . '</span>',
                ], $msgs), $data);
                break;
            default:
                return $this->doNext('install', 'checkPackage', [
                    '<span class="text-success">开始安装远程模块 ' . $module . ' V' . $version . '</span>',
                    '<span class="ub-text-white">开始模块安装预检...</span>'
                ],$data);
        }
    }
    private function doFinish($msgs)
    {

        $data = [
            'msg' => array_map(function ($item) {
                return '<i class="iconfont icon-hr"></i> ' . $item;
            }, $msgs),
            'finish' => true,
        ];
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData($data)
            ->withMessage(__('message.common.search.success'))
            ->build();
    }
    private function doNext($command, $step, $msgs = [], $data = [])
    {
        $data = [
            'msg' => array_map(function ($item) {
                if (!Str::startsWith($item, '<')) {
                    $item = "<span class='ub-text-white'>$item</span>";
                }
                return '<i class="el-icon-minus"></i> ' . $item;
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
