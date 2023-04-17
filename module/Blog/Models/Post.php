<?php

namespace Module\Blog\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'blog_posts';
    protected $fillable = ['name', 'sub_name', 'author', 'from', 'view', 'thumbnail', 'description','content', 'image_path', 'redirect', 'published', 'pinned', 'sort'];

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
        $model = self::query()->with('categories');

        $total = $model->count('id');

        $posts = $model->orderBy($validated['sort'] ?? 'created_at', $validated['order'] === 'ascending' ? 'asc' : 'desc')
            ->offset(($validated['offset'] - 1) * $validated['limit'])
            ->limit($validated['limit'])
            ->get();

        return [
            'data' => $posts,
            'total' => $total
        ];
    }

    public function categories(){
        return $this->morphToMany(
            Category::class,
            'subject',
            'blog_relationship',
            'subject_id',
            'relationship_id')
            ->where('blog_relationship.relationship_type','Module\\Blog\\Models\\Category');
    }


}
