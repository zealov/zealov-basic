<?php

namespace Module\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relationship extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'relationship';
    protected $fillable = ['subject_type', 'subject_id', 'target_type', 'relationship_type', 'relationship_id'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function post(){
        return $this->belongsToMany(Post::class,'id','subject_id');
    }

}
