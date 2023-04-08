<?php

namespace Module\Blog\Api\Controller;

use App\Http\Controllers\Controller;

use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Zealov\Kernel\Request\UploadRequest;
use Zealov\Kernel\Response\ApiCode;
use Zealov\Kernel\Utils\FileSystem;

class FileSystemController extends Controller
{
    /**
     * 上传文件
     *
     * @param UploadRequest $request
     * @return Response
     */
    public function upload(UploadRequest $request): Response
    {
        $validated = $request->validated();
        $directory = $validated['directory']??'other';
        $fileSystem = new FileSystem($directory);
        try {
            if (isset($validated['name'])) {
                $path = $fileSystem->putFileAs($request, 'file', $validated['name']);
            } else {
                $path = $fileSystem->putFile($request);
            }
            return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
                ->withHttpCode(ApiCode::HTTP_OK)
                ->withMessage(__('message.common.create.success'))
                ->withData([
                    'path' => '/storage/'.$path,
                    'realPath' => asset('storage/' . $path)
                ])
                ->build();
        } catch (Throwable $exception) {
            return ResponseBuilder::asError(ApiCode::HTTP_BAD_REQUEST)
                ->withHttpCode(ApiCode::HTTP_BAD_REQUEST)
                ->withMessage($exception->getMessage())
                ->build();
        }
    }




}
