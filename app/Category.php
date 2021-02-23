<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Relationshipe between post and category
     * Each category has many posts
     *
     * @return object
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
