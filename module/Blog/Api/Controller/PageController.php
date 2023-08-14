<?php
/****************************************
 * Created by PhpStorm.
 * Author: 刘奇.
 * QQ: 921491025
 * Date: 2023/4/11.
 * Time: 14:16.
 *****************************************/

namespace Module\Blog\Api\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Module\Blog\Models\Page;
use Module\Blog\Requests\Api\Page\CreateRequest;
use Module\Blog\Requests\Api\Page\GetListRequest;
use Module\Blog\Requests\Api\Page\UpdateRequest;
use Zealov\Kernel\Response\ApiCode;

class PageController extends Controller
{
    public function all()
    {
        $data = Page::select('id', 'name')->get();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(['data' => $data])
            ->withMessage(__('message.common.search.success'))
            ->build();
    }

    public function index(GetListRequest $request)
    {
        $validated = $request->validated();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(Page::getList($validated))
            ->withMessage(__('message.common.search.success'))
            ->build();
    }

    public function show($id)
    {
        $page = Page::where('id', $id)->first()->toArray();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData($page)
            ->withMessage(__('message.common.search.success'))
            ->build();
    }

    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
        Page::create($validated);
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData()
            ->withMessage(__('message.common.create.success'))
            ->build();
    }

    public function update(UpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $page = Page::find($id);
        $page->update($validated);
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData()
            ->withMessage(__('message.common.update.success'))
            ->build();
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        if (is_null($page)) {
            return ResponseBuilder::asError(ApiCode::HTTP_NOT_FOUND)
                ->withHttpCode(ApiCode::HTTP_NOT_FOUND)
                ->withMessage(__('message.common.search.failed'))
                ->build();
        }
        $page->delete();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withMessage(__('message.common.delete.success'))
            ->build();

    }
}
