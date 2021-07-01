<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostIndexRequest extends FormRequest
{
    /**
     * Determinacion del acceso
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Reglas de la request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * Return the model string class
     *
     * @return String
     */
    protected function getModelStringClass()
    {
        return config('api.models.post');
    }
}
