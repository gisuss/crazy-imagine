<?php

namespace App\Models;

use App\Traits\HasCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasCache;
    use SoftDeletes;

    protected $fillable = [
        'post_id',
        'email',
        'name',
        'body',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
