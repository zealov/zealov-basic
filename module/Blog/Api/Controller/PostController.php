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
use Module\Blog\Models\Post;
use Module\Blog\Requests\Api\Post\CreateRequest;
use Module\Blog\Requests\Api\Post\GetListRequest;
use Module\Blog\Requests\Api\Post\UpdateRequest;
use Zealov\Kernel\Response\ApiCode;

class PostController extends Controller
{
    public function index(GetListRequest $request)
    {
        $validated = $request->validated();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(Post::getList($validated))
            ->withMessage(__('message.common.search.success'))
            ->build();
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->with('categories')->first()->toArray();
        if (is_null($post)) {
            return ResponseBuilder::asError(ApiCode::HTTP_NOT_FOUND)
                ->withHttpCode(ApiCode::HTTP_NOT_FOUND)
                ->withMessage(__('message.common.search.failed'))
                ->build();
        }
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData($post)
            ->withMessage(__('message.common.search.success'))
            ->build();
    }

    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
        $categories = $validated['categories'];
        $post = Post::create($validated);
        if (!empty($categories)) {
            $newCategories = [];
            foreach ($categories as $category) {
                $newCategories[$category] = ['relationship_type' => 'Module\\Blog\\Models\\Category'];
            }
            $post->categories()->sync($newCategories);
        }

        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData()
            ->withMessage(__('message.common.create.success'))
            ->build();
    }

    public function update(UpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $categories = $validated['categories'];
        $post = Post::find($id);
        if (is_null($post)) {
            return ResponseBuilder::asError(ApiCode::HTTP_NOT_FOUND)
                ->withHttpCode(ApiCode::HTTP_NOT_FOUND)
                ->withMessage(__('message.common.search.failed'))
                ->build();
        }
        $post->update($validated);
        if (!empty($categories)) {
            $newCategories = [];
            foreach ($categories as $category) {
                $newCategories[$category] = ['relationship_type' => 'Module\\Blog\\Models\\Category'];
            }
            $post->categories()->sync($newCategories);
        }
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData()
            ->withMessage(__('message.common.update.success'))
            ->build();
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return ResponseBuilder::asError(ApiCode::HTTP_NOT_FOUND)
                ->withHttpCode(ApiCode::HTTP_NOT_FOUND)
                ->withMessage(__('message.common.search.failed'))
                ->build();
        }
        $post->categories()->detach();
        $post->delete();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withMessage(__('message.common.delete.success'))
            ->build();

    }
}
