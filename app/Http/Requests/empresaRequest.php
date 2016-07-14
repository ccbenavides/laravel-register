<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class empresaRequest extends Request
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
            'razon_social'=>'max:100|min:5|required',
            'ruc'=>'digits:11|required',
            'telefono_fijo'=>'min:5',
            'telefono_movistar'=>'min:5',
            'telefono_claro'=>'min:5',
            'telefono_otro'=>'min:5',
            'email'=>'required|min:6|max:60',
            'facebook_usuario'=>'min:5',
            'facebook_app_id'=>'min:5',
            'ruta_logo'=>'required'


        ];
    }
}
