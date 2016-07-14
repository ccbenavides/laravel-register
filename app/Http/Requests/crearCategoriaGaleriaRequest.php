<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class crearCategoriaGaleriaRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>'required|max:60|min:5',
            'imagen'=>'between:1,10000|mimes:jpg,jpeg|required',
            'descripcion'=>'min:10',
            'estado'=>'required|boolean'

        ];
    }
}
