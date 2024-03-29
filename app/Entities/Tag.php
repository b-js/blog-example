<?php


namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = 'tags';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;


    public function posts()

    {

        return $this->belongsToMany(Article::class,'article_tags', 'tag_id', 'article_id')->where('status', 1);
    }

    public function showTags ()
    {

        $usedTags = TagArticle::distinct()->pluck('tag_id');

        $tags = [];
        foreach ($usedTags as $ut){
            $tags[] = Tag::find($ut);
        }

        return $tags;
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

}