<?php

namespace Module\Blog\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'files';
    protected $fillable = ['name', 'description', 'redirect', 'path', 'size', 'sort', 'published'];


    public static function getList(array $validated)
    {
        $model = self::query();

        $total = $model->count('id');

        $posts = $model->orderBy($validated['sort'] ?? 'created_at', $validated['order'] === 'ascending' ? 'asc' : 'desc')
            ->offset(($validated['offset'] - 1) * $validated['limit'])
            ->limit($validated['limit'])
            ->get();

        return [
            'data'  => $posts,
            'total' => $total
        ];
    }


}
