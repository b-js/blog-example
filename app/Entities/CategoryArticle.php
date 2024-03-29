<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryArticle extends Model
{
    protected $table = "category_articles";
    protected $primaryKey = "id";

    protected $fillable = [
        'category_id',
        'article_id',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'category_article', 'category_id', 'article_id');
    }
}
