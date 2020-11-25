<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Dans ce tableau, je vais définir les
     * champs avec lesquels laravel va travailler.
     */
    protected $fillable = [
        'title',
        'alias',
        'content',
        'featuredImage',
        'category_id',
        'user_id',
    ];


    /**
     * Get category that owns the post.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get category that owns the post.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
