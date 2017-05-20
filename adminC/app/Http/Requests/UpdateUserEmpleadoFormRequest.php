<?php

namespace sisAdmin\Http\Requests;

use sisAdmin\Http\Requests\Request;

class UpdateUserEmpleadoFormRequest extends Request
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
            'nombre' => 'max:50| required',
            'apellido' =>'max:50| required',
            'domicilio'=> 'max:100' ,
            'telefono'=> 'max:45' ,
            'celular'=> 'max:45' ,
            'fechaNacimiento'=>  'date|required' ,
            'fechaAntiguedad'=>  'date|required' ,
            'turno'=> 'integer|max:1' ,           
            'email' => 'email|max:255',
            'password' => 'min:6|confirmed',
            'idtipo' => 'required|integer',
        ];
    }
}
