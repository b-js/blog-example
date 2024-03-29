<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";

    protected $fillable = [
      'title', 'description'
    ];
    protected $dates = [
      'created_at', 'updated_at'
    ];

    public function posts()

    {

        return $this->belongsToMany(Article::class,'category_articles', 'category_id', 'article_id')->where('status', 1);
    }


}
