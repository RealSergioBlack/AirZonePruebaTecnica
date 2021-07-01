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

}
