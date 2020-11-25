<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Dans ce tableau, je vais définir les
     * champs avec lesquels laravel va travailler.
     */
    protected $fillable = [
        'name',
        'alias'
    ];

    /**
     * Get posts from category
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

}
