<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $table = 'post';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'thumbnail',
        'type',
        'topic_id',
        'status',
        'created_by'
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }
}
