<?php

namespace Module\Blog\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'pages';
    protected $fillable = ['name', 'sub_name', 'view', 'thumbnail', 'description', 'content', 'image_path', 'redirect', 'published', 'sort'];

    protected static function newFactory()
    {
        return PostFactory::new();
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

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
