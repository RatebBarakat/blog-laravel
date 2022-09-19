<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'body',
        'info',
        'user_id',
        'comment_id',
    ];
    protected $casts = [
        'body'=>'array'
    ];
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
