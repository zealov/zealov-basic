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

class StoreController
{

    public function module(){
        $data = [
            'modules'=>[
                [
                    'id'=>1,
                    'memberUserId'=>1,
                    'name'=>'EditorImageCatchConfig',
                    'title'=>'富文本图片抓取配置',
                    'cover'=>'https://ms-assets.modstart.com/data/image/2022/07/06/12507_zlyy_1885.png',
                    'categoryId'=>10,
                    'types'=>['pc','mobile'],
                    'tags'=>['富文本','图片抓取'],
                    'isRecommend'=>false,
                    'latestVersion'=>'1.0.0',
                    'isFee'=>false,
                    'isPrivate'=>false,
                    'priceYearEnable'=>false,
                    'priceYear'=>null,
                    'priceSuperEnable'=>false,
                    'priceSuper'=>null,
                    'description'=>'配置富文本图片抓取相关配置信息',
                    'viewCount'=>500,
                    'downloadCount'=>100,
                    'authMemberUsers'=>[],
                    'url'=>'http://zb.lsq.com/EditorImageCatchConfig-1.1.0.zip',
                    'env'=>['laravel8'],
                    'releases'=>[
                        [
                            'version'=>'1.1.0',
                            'feature'=>'功能特性优化，已知问题修复',
                            'time'=>'2023-05-11'
                        ]
                    ]
                ],
            ]
        ];
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData($data)
            ->withMessage(__('message.common.search.success'))
            ->build();
    }
}
