<?php
/****************************************
 * Created by PhpStorm.
 * Author: 刘奇.
 * QQ: 921491025
 * Date: 2023/7/22.
 * Time: 14:34.
 *****************************************/

namespace Module\Blog\Api\Controller;

use App\Http\Controllers\Controller;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Module\Blog\Models\Chunk;
use Module\Blog\Models\Config;
use Module\Blog\Models\Model;
use Module\Blog\Models\Navigation;
use Module\Blog\Models\Relationship;
use Module\Blog\Requests\Api\Chunk\CreateRequest;
use Module\Blog\Requests\Api\Chunk\RelationshipRequest;
use Module\Blog\Requests\Api\Chunk\UpdateRequest;
use Zealov\Kernel\Response\ApiCode;

class ChunkController extends Controller
{

    public function type()
    {
        $type = [
            [
                'key'   => 'posts',
                'value' => '文章'
            ],
            [
                'key'   => 'pages',
                'value' => '页面'
            ],
            [
                'key'   => 'files',
                'value' => '文件'
            ]
        ];
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(['data' => $type])
            ->withMessage(__('message.common.create.success'))
            ->build();
    }

    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
        $tableMap = Model::tableMap;
        $validated['subject_type'] = $tableMap[$validated['subject_type']]['model'];
        $chunk = Chunk::create($validated);
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData($chunk)
            ->withMessage(__('message.common.create.success'))
            ->build();
    }

    public function update(UpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $chunk = Chunk::find($id);
        $resultData = $chunk->update($validated);
        if ($resultData) {
            return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
                ->withHttpCode(ApiCode::HTTP_OK)
                ->withData($chunk)
                ->withMessage(__('message.common.update.success'))
                ->build();
        }

        return ResponseBuilder::asError(ApiCode::HTTP_BAD_REQUEST)
            ->withHttpCode(ApiCode::HTTP_BAD_REQUEST)
            ->withMessage(__('message.common.update.fail'))
            ->build();
    }

    public function destroy($id)
    {
        $chunk = Chunk::find($id);
        if (is_null($chunk)) {
            return ResponseBuilder::asError(ApiCode::HTTP_NOT_FOUND)
                ->withHttpCode(ApiCode::HTTP_NOT_FOUND)
                ->withMessage(__('message.common.search.failed'))
                ->build();
        }
        $chunk->delete();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withMessage(__('message.common.delete.success'))
            ->build();
    }

    public function relationship(RelationshipRequest $request)
    {
        $validated = $request->validated();
        $chunk = Chunk::find($validated['chunk_id']);

        $tableMap = Model::tableMap;
        $fun = $validated['relationship_type'];
        $newRelationship = [];
        $current_relationship_ids = [];
        if (in_array($validated['relationship_type'], ['files'])) {
            $current_relationship_ids = Relationship::query()
                ->where('subject_type', 'Module\Blog\Models\Chunk')
                ->where('subject_id', $validated['chunk_id'])
                ->where('relationship_type', $tableMap[$validated['relationship_type']]['model'])
                ->pluck('relationship_id')->toArray();
        }

        $relationship_ids = explode(',', $validated['relationship_id']);
        $relationship_ids = array_merge($current_relationship_ids, $relationship_ids);
        foreach ($relationship_ids as $relationship_id) {
            $newRelationship[$relationship_id] = ['relationship_type' => $tableMap[$validated['relationship_type']]['model']];
        }
        $chunk->$fun()->sync($newRelationship);
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData()
            ->withMessage(__('message.common.create.success'))
            ->build();
    }


}
