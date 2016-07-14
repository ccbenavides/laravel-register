<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class requestPublicacion extends Request
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
            'imagen'=>'between:1,10000|mimes:jpg,jpeg',
            'archivo'=>'between:1,10000|mimes:pdf',
            'estado'=>'numeric',
            'catblog_id'=>'required|integer',
            'estado_id'=>'numeric',
            'idioma_id'=>'numeric'
        ];
    }
}
