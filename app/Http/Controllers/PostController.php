<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostIndexRequest;
use App\Http\Requests\PostShowRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    protected $repository; 

    public function __construct()
    {
        $this->repository = new PostRepository;
    }


    /**
     * Listado de posts
     *
     * @param  \Illuminate\Http\PostIndexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(PostIndexRequest $request)
    {
        $elements = $this->repository->getAll();

        return response()
        ->json(["status" => "Ok", "data" => $elements], 201);
    }

    /**
     * Crear nueva post
     *
     * @param  \Illuminate\Http\PostStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $element = $this->repository->create($request->all());

        return response()
        ->json(["status" => "Ok", "data" => $element], 201);

    }

    /**
     * Mostrar una post
     *
     * @param  int  $id
     * @param  \Illuminate\Http\PostShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show(PostShowRequest $request, $id)
    {
        $element = $this->repository->findById($id);

        if (!$element) {
            return response()
                ->json(["status" => "Error", "data" => "Not found"], 404);
        }

        return response()
            ->json(["status" => "Ok", "data" => $element], 200);
    }

    /**
     * Modificar una post
     *
     * @param  \Illuminate\Http\PostUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $element = $this->repository->updateById($id, $request->all());
        if($element != null) {
            return response()
            ->json(["status" => "Ok", "data" => $element], 200);
        } else {
            return response()
            ->json(["status" => "Error", "data" => "Not found"], 404);  
        }

    }

    /**
     * Eliminar una post
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_element = $this->repository->deleteById($id);
        if ($deleted_element == null) {
            return response()
                ->json(["data" => "Not found"], 404);
        }

        return response()
            ->json([], 204);
    }

     
    /**
     * Obtención de un post con sus comentarios y usuarios
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPostCommentsAndUsers($post_id) {
        $post = $this->repository->getPostCommentsAndUsers($post_id);
        if($post != null) {
            return response()
            ->json(["status" => "Ok", "data" => $post], 200);
        } else {
            return response()
            ->json(["status" => "Error", "data" => "Not found"], 404);

        }
    }

}
