<?php

namespace Module\Blog\Api\Controller;

use App\Http\Controllers\Controller;

use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Module\Blog\Models\File;
use Module\Blog\Requests\Api\File\CreateRequest;
use Module\Blog\Requests\Api\File\GetListRequest;
use Module\Blog\Requests\Api\File\UpdateRequest;
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

    public function store(CreateRequest $request){
        $validated = $request->validated();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(File::create($validated))
            ->withMessage(__('message.common.create.success'))
            ->build();
    }

    public function index(GetListRequest $request){
        $validated = $request->validated();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(File::getList($validated))
            ->withMessage(__('message.common.search.success'))
            ->build();
    }

    public function show($id){
        $file = File::find($id)->toArray();
        if (is_null($file)) {
            return ResponseBuilder::asError(ApiCode::HTTP_NOT_FOUND)
                ->withHttpCode(ApiCode::HTTP_NOT_FOUND)
                ->withMessage(__('message.common.search.failed'))
                ->build();
        }
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData($file)
            ->withMessage(__('message.common.search.success'))
            ->build();
    }

    public function update($id,UpdateRequest $request){
        $validated = $request->validated();
        $file = File::find($id);
        $file->update($validated);
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData()
            ->withMessage(__('message.common.update.success'))
            ->build();
    }



}
