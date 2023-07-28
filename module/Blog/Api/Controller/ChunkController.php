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
use Module\Blog\Requests\Api\Chunk\CreateRequest;
use Module\Blog\Requests\Api\Chunk\RelationshipRequest;
use Zealov\Kernel\Response\ApiCode;

class ChunkController extends Controller
{

    public function type(){
        $type = [
            [
                'key'=>'posts',
                'value'=>'文章'
            ],
            [
                'key'=>'pages',
                'value'=>'页面'
            ],
            [
                'key'=>'files',
                'value'=>'文件'
            ]
        ];
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(['data'=>$type])
            ->withMessage(__('message.common.create.success'))
            ->build();
    }

    public function store(CreateRequest $request){
        $validated = $request->validated();
        $chunk = Chunk::create($validated);
        $tableMap = Model::tableMap;
        $model = new $tableMap[$validated['subject_type']]['model'];
        $data = $model::find($validated['subject_id']);
        $data->chunk()->attach([$chunk->id=>['relationship_type' => 'Module\\Blog\\Models\\Chunk']]);
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData()
            ->withMessage(__('message.common.create.success'))
            ->build();
    }

    public function relationship(RelationshipRequest $request){
        $validated = $request->validated();
        $chunk = Chunk::find($validated['chunk_id']);

        $tableMap = Model::tableMap;
        $fun = $validated['relationship_type'];
        $chunk->$fun()->sync([$validated['relationship_id']=>['relationship_type' =>$tableMap[$validated['relationship_type']]['model']]]);
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData()
            ->withMessage(__('message.common.create.success'))
            ->build();
    }





}
