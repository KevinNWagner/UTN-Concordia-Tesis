<?php

namespace sisAdmin\Http\Requests;

use sisAdmin\Http\Requests\Request;

class CarteleraFormRequest extends Request
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
            'horaInicio'=>'date_format:H:i|required',
            'horaFin'=>'date_format:H:i|required',
            'cantidadPersonas'=>'integer|required',
            'duracionRecorrido'=>'date_format:H:i|required',
            'descripcion'=>'required',
        ];
    }
}
