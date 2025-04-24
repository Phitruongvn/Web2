<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;
    
    protected $table = 'topic';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sort_order',
        'status',
        'created_by'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'topic_id', 'id');
    }
}
