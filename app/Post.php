<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
  use SoftDeletes;

  protected $dates = [
    'published_at'
  ];
  protected $fillable = [
    'title', 'description', 'image', 'content', 'published_at', 'category_id', 'user_id'
  ];

  /**
   * Delete image from storage
   *
   * @return void
   */
  public function deleteImage()
  {
    Storage::delete($this->image);
  }

  /**
   * Relationshipe between post and category
   * each post belong to specific category
   *
   * @return void
   */
  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  /**
   * Relationshipe between post and tag
   * each post belong to multiple tags 
   *
   * @return object
   */
  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }

  /**
   * cheak if the post have a specific tag
   *
   * @param [type] $tagId
   * @return boolean
   */
  public function hasTag($tagId)
  {
    return in_array($tagId, $this->tags->pluck('id')->toArray());
  }

  /**
   * Relationshipe between post and user
   * each post belong to one user
   *
   * @return void
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function scopePublished($query)
  {
    return $query->where('published_at', '<=', now());
  }

  public function scopeSearched($query)
  {
    $search = request()->query('search');
    if (!$search) {
      return $query->Published();
    }
    return $query->Published()->where('title', 'LIKE', "%{$search}%");
  }
}
