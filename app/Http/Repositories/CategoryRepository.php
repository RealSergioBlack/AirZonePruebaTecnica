<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Arr;

class CategoryRepository
{
    /**
     * Obtenemos la clase del modelo del repositorio
     *
     * @return mixed
     */
    public function model()
    {
        return config('api.models.category');
    }
    /**
     * Obtenemos la clase del modelo del repositorio
     *
     * @return App/Category
     */
    public function modelClass () {
        return Category::class;
    }


       /**
     * Recupera el listado de categorys.
     *
     * @param RepositoryParams $repository_params
     * @return Collection<mixed>
     */
    public function getAll()
    {

        return Category::get();
    }
    
    /**
     * Recupera la información del category con el identificador único proporcionado.
     *
     * @param integer $category_id
     * @return mixed
     */
    public function findById($category_id)
    {
        return Category::find($category_id) != null ? Category::find($category_id) : null;
    }

    /**
     * Crea un nuevo category
     *
     * @param array $category_value
     * @return mixed
     */
    public function create($category_value)
    {
        $category = new Category($category_value);
        $category->save();
        return $category;
    }

    /**
     * Actualiza la información del category con el identificador único proporcionado.
     *
     * @param integer $category_id
     * @param array $category_new_values
     * @return mixed
     */
    public function updateById($category_id, $category_new_values)
    {
    
        $category = $this->findById($category_id);

        if($category != null) {

            collect($category->getFillable())
            ->each(function ($attribute_name) use ($category_new_values, $category) {
                
                if (Arr::has($category_new_values, $attribute_name)) {
                    $category[$attribute_name] = $category_new_values[$attribute_name];
                }
            });
            
            $category->save();
            
            return $category;
        } else {
            return null;
        }
    }

    /**
     * Borra la información del category con el identificador único proporcionado.
     *
     * @param integer $category_id
     * @return boolean
     */
    public function deleteById($category_id)
    {
        $category = $this->findById($category_id);
        if($category != null) {
            $category->delete();
            return $category;
        } else {
            return null;
        }
    }

}
