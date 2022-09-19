<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','slug','small_description',
                        'description','user_id','category_id','image'];
    protected $dates = [
        'created_at'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    use HasFactory;
}
