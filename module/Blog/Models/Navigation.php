<?php

namespace Module\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Navigation extends Model
{

    use HasFactory;
    use SoftDeletes;
    public $table = 'navigations';
    protected $fillable = [
        'parent_id',
        'name',
        'image_path',
        'url',
        'target',
        'sort',
        'published',
        'description'
    ];

    public static function getList(array $validated)
    {
        $parent_id = $validated['parent_id']??0;
        $navigation = [];
        $model = self::select(['*']);

        $t = $model->orderBy('sort')->get()->toArray();
        $label = $validated['label']??0;
        if($label){
            $parent_id = self::where('label',$label)->value('id');
        }
        if (!empty($t)){
            $navigation = self::tree_page($t,'id', 'parent_id', 'children',$parent_id);
        }
        return ['navigation'=>$navigation];
    }

    public static function create(array $attributes)
    {
        return static::query()->create($attributes);
    }

    public static function updateSave($attributes)
    {
        $navigation = Navigation::find($attributes['id']);
        unset($attributes['id']);

        return [
            'result' => $navigation->update($attributes),
            'navigation' => $navigation
        ];
    }

    public  static function tree_page($list = [], $pk = 'id', $pid = 'parent_id', $child = '_child', $root = 0)
    {
        if (empty($list)) {
            return [];
        }
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }


    public function chunk(){
        return $this->morphToMany(
            Chunk::class,
            'subject',
            'relationship',
            'subject_id',
            'relationship_id')
            ->where('relationship.relationship_type','Module\\Blog\\Models\\Chunk');
    }

}
