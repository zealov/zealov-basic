<?php
/****************************************
 * Created by PhpStorm.
 * Author: 刘奇.
 * QQ: 921491025
 * Date: 2023/7/25.
 * Time: 14:19.
 *****************************************/

namespace Module\Blog\Api\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Module\Blog\Models\Chunk;
use Module\Blog\Models\Model;
use Module\Blog\Models\Relationship;
use Zealov\Kernel\Response\ApiCode;

class RelationshipController extends Controller
{
    public function entity(Request $request)
    {
        $limit = $request->get('limit', 200);
        $offset = $request->get('offset', 1);
        $subject_type = $request->get('subject_type');
        $subject_id = $request->get('subject_id');

        $tableMap = Model::tableMap;
        $chunk = Chunk::find($subject_id);
        if (empty($chunk)) {
            return ResponseBuilder::asError(ApiCode::HTTP_BAD_REQUEST)
                ->withHttpCode(ApiCode::HTTP_BAD_REQUEST)
                ->withMessage(__('message.common.search.fail'))
                ->build();
        }
        $type = $chunk->type;
        $subject_type_model = $tableMap[$subject_type]['model'];
        $default_mode = 'Module\Blog\Models\Category';
        $target_model = $tableMap[$type]['model'];
        //获取相关绑定分类
        $relationship_ids = Relationship::where('subject_type', $subject_type_model)
            ->where('subject_id', $subject_id)
            ->where('relationship_type', $default_mode)
            ->pluck('relationship_id')
            ->toArray();

        //查询关联内容
        $model = Relationship::query()
            ->when($relationship_ids, function ($query) use (
                $tableMap,
                $type,
                $target_model,
                $relationship_ids
            ) {
                $query->join($tableMap[$type]['table'], 'relationship.subject_id', $tableMap[$type]['table'] . '.id')
                    ->where('relationship.subject_type', $target_model)
                    ->whereIn('relationship.relationship_id', $relationship_ids)
                    ->groupBy('relationship.subject_id');
            })->when(empty($relationship_ids), function ($query) use (
                $tableMap,
                $type,
                $target_model,
                $relationship_ids,
                $subject_type_model,
                $subject_id
            ) {
                $query->join($tableMap[$type]['table'], 'relationship.relationship_id', $tableMap[$type]['table'] . '.id')
                    ->where('relationship.subject_type', $subject_type_model)
                    ->where('relationship.subject_id', $subject_id)
                    ->groupBy('relationship.relationship_id');
            });
        $total = $model->get()->count();
        $data = $model->skip(($offset - 1) * $limit)
            ->orderByDesc($tableMap[$type]['table'] . '.created_at')
            ->take($limit)
            ->get();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(['data' => $data, 'total' => $total])
            ->withMessage(__('message.common.search.success'))
            ->build();

    }

    public function remove(Request $request)
    {
        $subject_type = $request->get('subject_type');
        $subject_id = $request->get('subject_id');
        $relationship_type = $request->get('relationship_type');
        $relationship_id = $request->get('relationship_id');

        $tableMap = Model::tableMap;
        $subject_type_model = $tableMap[$subject_type]['model'];
        $relationship_type_model = $tableMap[$relationship_type]['model'];
        $relationship = Relationship::query()
            ->where('subject_type', $subject_type_model)
            ->where('subject_id', $subject_id)
            ->where('relationship_type', $relationship_type_model)
            ->where('relationship_id', $relationship_id)
            ->first();
        if (empty($relationship)) {
            return ResponseBuilder::asError(ApiCode::HTTP_NOT_FOUND)
                ->withHttpCode(ApiCode::HTTP_NOT_FOUND)
                ->withMessage(__('message.common.search.failed'))
                ->build();
        }
        if (Relationship::query()->where('subject_type', $subject_type_model)
            ->where('subject_id', $subject_id)
            ->where('relationship_type', $relationship_type_model)
            ->where('relationship_id', $relationship_id)
            ->delete()) {
            return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
                ->withHttpCode(ApiCode::HTTP_OK)
                ->withMessage(__('message.common.delete.success'))
                ->build();
        }
    }
}
