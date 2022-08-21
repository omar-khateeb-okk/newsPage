<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'posts';
    protected $fillable = [
        'name',
        'description',
        'img',
        'is_hidden',
        'category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function tags()
    {
        return $this->hasMany(PostTag::class);
    }

    public function get()
    {
        return $this->with('category')
            ->with('tag')
            ->get();
    }
}
