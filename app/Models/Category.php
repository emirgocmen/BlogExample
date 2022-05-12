<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    public $timestamps = false;

    protected $fillable=[
        'name',
        'slug',
        'status',
        'pid',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'onUpdate' => true,
                'source' => 'name'
            ]
        ];
    }

    protected $appends = ['active_articles_count','articles_count'];

    public function articles()
    {
        return $this->HasMany(Article::class);
    }

    public function subCategory()
    {
      return $this->hasMany(Category::class, 'pid');
    }

    public function mainCategory()
    {
      return $this->belongsTo(Category::class, 'pid');
    }

    public function getActiveArticlesCountAttribute(){
        return $this->hasMany(Article::class)->where('status',"1")->count();
    }

    public function getArticlesCountAttribute(){
        return $this->hasMany(Article::class)->count();
    }
    
}
