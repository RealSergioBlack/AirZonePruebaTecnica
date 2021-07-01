<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user',
        'datetime',
        'content',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('api.tables.comments'));
    }
    
    public function users()
    {
        return $this->belongsTo(config('api.models.user'), 'user', 'id');
    }

    public function posts () {
        return $this->belongsToMany(
            config('api.models.post'),
            config('api.tables.comments_posts'),
            'comment',
            'blog'
        ); 
    }


}
