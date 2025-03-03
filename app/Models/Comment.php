<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'comment', 'post_id', 'user_id'
    ];

    public function posts() {
        return $this->belongsTo(Post::class);
    }

    public function users() {
        return $this->belongsTo(User::class);
    }
}
