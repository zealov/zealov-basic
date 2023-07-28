<?php

namespace Module\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chunk extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'chunks';
    protected $fillable = ['name', 'type', 'sort'];


    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function categories(){
        return $this->morphToMany(
            Category::class,
            'subject',
            'relationship',
            'subject_id',
            'relationship_id')
            ->where('relationship.relationship_type','Module\\Blog\\Models\\Category');
    }

    public function pages(){
        return $this->morphToMany(
            Page::class,
            'subject',
            'relationship',
            'subject_id',
            'relationship_id')
            ->where('relationship.relationship_type','Module\\Blog\\Models\\Page');
    }

    public function files(){
        return $this->morphToMany(
            File::class,
            'subject',
            'relationship',
            'subject_id',
            'relationship_id')
            ->where('relationship.relationship_type','Module\\Blog\\Models\\File');
    }

}
