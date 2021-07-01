<?php

return [
    'route_prefix' => '',

    'tables' => [
        'categories' => 'categories',
        'categories_posts' => 'category_post',
        'comments' => 'comments',
        'comments_posts' => 'comment_post',
        'posts' => 'posts',
        'users' => 'user'

    ],
    'models' => [
        'category' => 'App\Models\Category',
        'comment' => 'App\Models\Comment',
        'post' => 'App\Models\Post',
        'user' => 'App\Models\User'
    ],
    'controllers' => [

    ]

];
