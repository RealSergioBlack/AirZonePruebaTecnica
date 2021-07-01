<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user',
        'title',
        'slug',
        'marks',
        'picture',
        'short_content',
        'content',
        'updated',
        'comment',
        'pending',
        'public',
        'active',
    ];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('api.tables.posts'));
    }

    public function users()
    {
        return $this->belongsTo(config('api.models.user'), 'user', 'id');
    }

    public function categories () {
        return $this->belongsToMany(
            config('api.models.category'),
            config('api.tables.categories_posts'),
            'blog',
            'category'
        ); 
    }

    public function comments () {
        return $this->belongsToMany(
            config('api.models.comment'),
            config('api.tables.comments_posts'),
            'comment',
            'blog'
        ); 
    }
}
