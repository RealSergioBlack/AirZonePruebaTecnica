<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Arr;

class PostRepository
{
    /**
     * Obtenemos la clase del modelo del repositorio
     *
     * @return mixed
     */
    public function model()
    {
        return config('api.models.post');
    }
    /**
     * Obtenemos la clase del modelo del repositorio
     *
     * @return App/Post
     */
    public function modelClass () {
        return Post::class;
    }


       /**
     * Recupera el listado de posts.
     *
     * @param RepositoryParams $repository_params
     * @return Collection<mixed>
     */
    public function getAll()
    {

        return Post::get();
    }
    
    /**
     * Recupera la información del post con el identificador único proporcionado.
     *
     * @param integer $post_id
     * @return mixed
     */
    public function findById($post_id)
    {
        return Post::find($post_id) != null ? Post::find($post_id) : null;
    }

    /**
     * Crea un nuevo post
     *
     * @param array $post_value
     * @return mixed
     */
    public function create($post_value)
    {
        $post = new Post($post_value);
        $post->save();
        return $post;
    }

    /**
     * Actualiza la información del post con el identificador único proporcionado.
     *
     * @param integer $post_id
     * @param array $post_new_values
     * @return mixed
     */
    public function updateById($post_id, $post_new_values)
    {
    
        $post = $this->findById($post_id);

        if($post != null) {

            collect($post->getFillable())
            ->each(function ($attribute_name) use ($post_new_values, $post) {
                
                if (Arr::has($post_new_values, $attribute_name)) {
                    $post[$attribute_name] = $post_new_values[$attribute_name];
                }
            });
            
            $post->save();
            
            return $post;
        } else {
            return null;
        }
    }

    /**
     * Borra la información del post con el identificador único proporcionado.
     *
     * @param integer $post_id
     * @return boolean
     */
    public function deleteById($post_id)
    {
        $post = $this->findById($post_id);
        if($post != null) {
            $post->delete();
            return $post;
        } else {
            return null;
        }
    }
    /**
     * Obtención de un post con sus comentarios y usuarios
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPostCommentsAndUsers ($post_id) {
        $post = $this->findById($post_id);
        if($post != null) {
            return Post::with('comments', 'users')->where('id', '=', $post_id)->first();
        } else {
            return null;
        }
    }

}
