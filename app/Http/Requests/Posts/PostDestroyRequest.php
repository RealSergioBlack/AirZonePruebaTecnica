<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostDestroyRequest extends FormRequest
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
}
