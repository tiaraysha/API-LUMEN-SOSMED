<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'content', 'image', 'user_id'
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
}
