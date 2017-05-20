<?php

namespace sisAdmin\Http\Requests;

use sisAdmin\Http\Requests\Request;

class ColectivoFormRequest extends Request
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
        'marca'=>'max:45',
        'modelo'=>'integer',
        'matricula'=>'required|max:45',
        'posicionLatitud'=>'float',
        'posicionLongitud'=>'float',
        ];
    }
}
