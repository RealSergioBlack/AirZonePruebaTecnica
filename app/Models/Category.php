<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'visible',
        'parent_id',

    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('api.tables.categories'));
    }

    public function posts () {
        return $this->belongsToMany(
            config('api.models.post'),
            config('api.tables.categories_posts'),
            'category',
            'blog'
        ); 
    }
}
