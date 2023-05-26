<?php
/****************************************
 * Created by PhpStorm.
 * Author: 刘奇.
 * QQ: 921491025
 * Date: 2023/5/25.
 * Time: 16:49.
 *****************************************/

namespace Module\AppStore\Utils;

use Chumper\Zipper\Zipper;
use Zealov\Exception\ThrowException;
use Zealov\Kernel\Utils\CurlUtil;
use Zealov\Kernel\Utils\FileUtil;

class AppStoreUtil
{
    const REMOTE_BASE = 'http://zb.lsq.com';

    private static function baseRequest($api, $data, $token)
    {
        return CurlUtil::postJSONBody(self::REMOTE_BASE . $api, $data, [
            'header' => [
                'api-token'        => $token,
                'X-Requested-With' => 'XMLHttpRequest',
            ]
        ]);
    }

    public static function downloadPackage($token, $module, $version)
    {
//        $ret = self::baseRequest('/api/store/module_package', [
//            'module' => $module,
//            'version' => $version,
//        ], $token);
//        $package = $ret['data']['package'] ;
        $package = self::REMOTE_BASE . '/EditorImageCatchConfig-1.1.0.zip';
//        $packageMd5 = $ret['data']['packageMd5'];
        $packageMd5 = 'bb1dbf2937f5e0e2979f206c6951a70e';
//        $licenseKey = $ret['data']['licenseKey'];
        $licenseKey = 'n9D3Y0X6PZmzvTrUsmB6aysVGsEDyMHUPaWqYJRosxHu8xEkfF';
        $data = CurlUtil::getRaw($package);
        $zipTemp = FileUtil::generateLocalTempPath('zip');
        file_put_contents($zipTemp, $data);
        ThrowException::throwsIf('文件MD5校验失败', md5_file($zipTemp) != $packageMd5);
        return [
            'code' => 0,
            'msg'  => 'ok',
            'data' => [
                'package'     => $zipTemp,
                'licenseKey'  => $licenseKey,
                'packageSize' => filesize($zipTemp),
            ]

        ];
    }

    public static function  unpackModule($module, $package, $licenseKey){
        $results = [];
        ThrowException::throwsIf('文件不存在 ' . $package, empty($package) || !file_exists($package));
        $moduleDir = base_path('module/' . $module);
        if (file_exists($moduleDir)) {
            $moduleBackup = '_delete_.' . date('Ymd_His') . '.' . $module;
            ThrowException::throwsIf('模块目录 module/' . $module . ' 不正常，请手动删除', !is_dir($moduleDir));
            $moduleBackupDir = base_path("module/$moduleBackup");
            try {
                rename($moduleDir, $moduleBackupDir);
            } catch (\Exception $e) {
                ThrowException::throws("备份模块 $module 到 $moduleBackup 失败（确保模块中所有文件和目录已关闭）");
            }
            ThrowException::throwsIf('备份模块旧文件失败', !file_exists($moduleBackupDir));
            $results[] = "备份模块 $module 到 $moduleBackup";
        }
        ThrowException::throwsIf('模块目录 module/' . $module . ' 不正常，请手动删除', file_exists($moduleDir));
        $zipper = new Zipper();
        $zipper->make($package);
        if ($zipper->contains($module . '/config.json')) {
            $zipper->folder($module . '');
        }
        $zipper->extractTo($moduleDir);
        $zipper->close();
        ThrowException::throwsIf('解压失败', !file_exists($moduleDir . '/config.json'));
        file_put_contents($moduleDir . '/license.json', json_encode([
            'licenseKey' => $licenseKey,
        ]));
        self::cleanDownloadedPackage($package);
        return [
            'code' => 0,
            'msg'  => 'ok',
            'data' => $results
        ];
    }

    public static function cleanDownloadedPackage($package)
    {
        FileUtil::safeCleanLocalTemp($package);
    }
}
