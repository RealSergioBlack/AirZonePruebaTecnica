<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryIndexRequest;
use App\Http\Requests\CategoryShowRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    protected $repository; 

    public function __construct()
    {
        $this->repository = new CategoryRepository;
    }


    /**
     * Listado de categorias
     *
     * @param  \Illuminate\Http\CategoryIndexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryIndexRequest $request)
    {
        $elements = $this->repository->getAll();

        return response()
        ->json(["status" => "Ok", "data" => $elements], 201);
    }

    /**
     * Crear nueva categoria
     *
     * @param  \Illuminate\Http\CategoryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $element = $this->repository->create($request->all());

        return response()
        ->json(["status" => "Ok", "data" => $element], 201);

    }

    /**
     * Mostrar una categoria
     *
     * @param  int  $id
     * @param  \Illuminate\Http\CategoryShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryShowRequest $request, $id)
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
     * Modificar una categoria
     *
     * @param  \Illuminate\Http\CategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
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
     * Eliminar una categoria
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
        ->json(["status" => "Ok", "data" => "Data has been removed"], 200);
    }

}
